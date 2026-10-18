<?php

namespace App\Console\Commands;

use App\Models\Blog;
use App\Models\Category;
use App\Models\CsvImport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use League\Csv\Reader;

class ProcessBlogCsv extends Command
{
    protected $signature = 'blog:process-csv';
    protected $description = 'Process CSV file and import blog posts with Puppeteer image download';

    public function handle()
    {
        $this->info("Starting blog processing...");

        // Debug environment first
        $this->debugNodeEnvironment();

        $relativePath = 'app' . DIRECTORY_SEPARATOR . 'csv' . DIRECTORY_SEPARATOR . 'blog.csv';
        $filePath = storage_path($relativePath);

        $this->info("Attempting to access CSV file at: " . $filePath);

        if (!file_exists($filePath)) {
            $this->error("CSV file not found at: " . $filePath);
            $this->info("Directory contents:");
            $this->info(implode("\n", scandir(dirname($filePath))));
            return 1;
        }

        $storagePath = 'csv/blog.csv';
        $csvImport = CsvImport::firstOrCreate(
            ['file_name' => $storagePath],
            ['last_processed_row' => 0]
        );

        try {
            $csv = Reader::createFromPath($filePath, 'r');
            $csv->setDelimiter(';');
            $csv->setHeaderOffset(0);

            $records = $csv->getRecords();
            $lastProcessedRow = $csvImport->last_processed_row;
            $newLastRow = $lastProcessedRow;

            foreach ($records as $index => $row) {
                if ($index <= $lastProcessedRow) continue;

                if (empty($row['name']) || empty($row['desc'])) {
                    $this->warn("Skipping row {$index}: Missing required fields");
                    $newLastRow = $index;
                    continue;
                }

                if (Blog::where('title', $row['name'])->exists()) {
                    $this->warn("Skipping duplicate post: " . $row['name']);
                    $newLastRow = $index;
                    continue;
                }

                $images = $this->processCreativeFabricaImages([
                    $row['gbr1'] ?? null,
                    $row['gbr2'] ?? null,
                    $row['gbr3'] ?? null,
                    $row['gbr4'] ?? null,
                    $row['gbr5'] ?? null
                ]);

                // Membuat blog post
                $blog = Blog::create([
                    'user_id' => 2,
                    'title' => $row['name'],
                    'slug' => Blog::createSlug($row['name']),
                    'font_file' => $row['alink'],
                    'description' => $row['sdesc'] . "\n\n" . $row['desc'],
                    'image_1' => $images[0] ?? null,
                    'image_2' => $images[1] ?? null,
                    'image_3' => $images[2] ?? null,
                    'status' => 'published'
                ]);

                // Proses kategori
                if (!empty($row['categ'])) {
                    $this->processCategories($blog, $row['categ']);
                }

                $newLastRow = $index;
                $this->info("Processed row {$index}: " . $row['name']);
                break; // Process one row at a time
            }

            $csvImport->update(['last_processed_row' => $newLastRow]);
            return 0;

        } catch (\Exception $e) {
            $this->error("Error processing CSV: " . $e->getMessage());
            return 1;
        }
    }

    protected function processCategories(Blog $blog, string $categoriesString)
    {
        // 1. Bersihkan dan split kategori dari CSV
        $categoryNames = array_filter(
            array_map('trim', explode(',', $categoriesString)),
            fn($name) => !empty($name)
        );

        // 2. Cari atau buat kategori (tanpa duplikat)
        $categories = collect($categoryNames)->map(function ($name) {
            return Category::firstOrCreate(['name' => $name]);
        });

        // 3. Attach ke blog dengan sync (pastikan tidak duplikat relasi)
        $blog->categories()->sync($categories->pluck('id')->toArray(), false);

        $this->info("Attached categories to blog {$blog->id}: " . implode(', ', $categoryNames));
    }

    protected function processCreativeFabricaImages(array $imageUrls): array
    {
        $savedImages = [];
        File::ensureDirectoryExists(public_path('storage/images'));

        foreach ($imageUrls as $url) {
            if (empty($url) || !filter_var($url, FILTER_VALIDATE_URL)) {
                continue;
            }

            try {
                $isCreativeFabrica = str_contains($url, 'creativefabrica.com');
                $fileName = Str::random(20) . '.' . $this->determineExtensionFromUrl($url);
                $savePath = public_path('storage/images/' . $fileName);

                if ($isCreativeFabrica) {
                    $success = $this->downloadCreativeFabricaImage($url, $savePath);
                } else {
                    $success = $this->downloadWithPuppeteer($url, $savePath);
                }

                if ($success && file_exists($savePath) && filesize($savePath) > 10240) {
                    $savedImages[] = 'images/' . $fileName;
                    $this->info("Successfully downloaded: {$fileName} (" . filesize($savePath) . " bytes)");
                } else {
                    $this->warn("Failed to download image from {$url}");
                    if (file_exists($savePath)) {
                        unlink($savePath);
                    }
                }

                if (count($savedImages) >= 3) break;

            } catch (\Exception $e) {
                $this->warn("Error downloading image: " . $e->getMessage());
            }
        }

        return $savedImages;
    }

    protected function downloadCreativeFabricaImage(string $url, string $savePath): bool
    {
        $this->info("Downloading Creative Fabrica image: {$url}");

        $nodePath = $this->getNodePath();
        $scriptPath = base_path('resources/js/creativeFabricaDownloader.js');

        $command = sprintf(
            '%s %s %s %s 2>&1',
            escapeshellarg($nodePath),
            escapeshellarg($scriptPath),
            escapeshellarg($url),
            escapeshellarg($savePath)
        );

        $this->info("Executing: {$command}"); // Debug command

        exec($command, $output, $returnCode);

        if ($returnCode !== 0) {
            $this->warn("Creative Fabrica download error: " . implode("\n", $output));
            return false;
        }

        if (!file_exists($savePath)) {
            $this->warn("Downloaded file not found at: {$savePath}");
            return false;
        }

        $fileSize = filesize($savePath);
        if ($fileSize < 10240) {
            $this->warn("Downloaded file too small: {$fileSize} bytes");
            unlink($savePath);
            return false;
        }

        return true;
    }

    protected function downloadWithPuppeteer(string $url, string $savePath): bool
    {
        $maxRetries = 3;
        $retryDelay = 5000; // 5 detik

        for ($attempt = 1; $attempt <= $maxRetries; $attempt++) {
            try {
                $nodePath = $this->getNodePath();
                $scriptPath = base_path('resources/js/puppeteerImageDownloader.js');

                $command = sprintf(
                    '%s %s %s %s 2>&1',
                    escapeshellarg($nodePath),
                    escapeshellarg($scriptPath),
                    escapeshellarg($url),
                    escapeshellarg($savePath)
                );

                exec($command, $output, $returnCode);

                if ($returnCode === 0 && file_exists($savePath)) {
                    $fileSize = filesize($savePath);
                    if ($fileSize > 10240) {
                        return true;
                    }

                    $this->warn("Downloaded file too small: {$fileSize} bytes");
                    unlink($savePath);
                }

                $this->warn("Attempt {$attempt} failed: " . implode("\n", $output));

                if ($attempt < $maxRetries) {
                    sleep($retryDelay / 1000); // Delay sebelum retry
                    $retryDelay *= 2; // Exponential backoff
                }

            } catch (\Exception $e) {
                $this->warn("Attempt {$attempt} error: " . $e->getMessage());
            }
        }

        return false;
    }

    protected function getNodePath(): string
    {
        // Coba beberapa lokasi umum Node.js
        $possiblePaths = [
            exec('where node 2>&1'),
            exec('which node 2>&1'),
            'node',
            '"C:\\Program Files\\nodejs\\node.exe"',
            '"C:\\Program Files (x86)\\nodejs\\node.exe"',
            getenv('APPDATA') . '\\npm\\node.exe'
        ];

        foreach ($possiblePaths as $path) {
            if (!empty($path) && !str_contains($path, 'not found') && file_exists(trim($path, '"'))) {
                return $path;
            }
        }

        throw new \RuntimeException('Node.js executable not found. Please install Node.js and ensure it\'s in your PATH');
    }

    protected function determineExtensionFromUrl(string $url): string
    {
        $ext = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);
        return in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp']) ? $ext : 'jpg';
    }

    protected function debugNodeEnvironment()
    {
        $this->info("=== Node.js Environment Debug ===");

        try {
            // Cek Node.js
            exec('node -v 2>&1', $nodeVersion, $nodeCode);
            $this->info("Node version: " . implode("\n", $nodeVersion));

            // Cek npm
            exec('npm -v 2>&1', $npmVersion, $npmCode);
            $this->info("npm version: " . implode("\n", $npmVersion));

            // Cek path Node.js
            $nodePath = $this->getNodePath();
            $this->info("Node path: " . $nodePath);

            // Cek Puppeteer
            $puppeteerCheck = shell_exec("$nodePath -e \"console.log(require.resolve('puppeteer'))\" 2>&1");
            $this->info("Puppeteer check: " . ($puppeteerCheck ? 'Found' : 'Not found'));

            // Test download
            $testUrl = 'https://www.creativefabrica.com/wp-content/uploads/2021/01/25/School-Children-Fonts-8064161-2-580x387.jpg';
            $testPath = public_path('storage/images/test.jpg');

            $this->info("Testing Creative Fabrica download...");
            $success = $this->downloadCreativeFabricaImage($testUrl, $testPath);

            if ($success) {
                $this->info("Test download successful! Size: " . filesize($testPath) . " bytes");
                unlink($testPath);
            } else {
                $this->warn("Test download failed");
            }

        } catch (\Exception $e) {
            $this->error("Debug error: " . $e->getMessage());
        }
    }
}

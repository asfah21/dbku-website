import puppeteer from 'puppeteer';
import fs from 'fs';
import path from 'path';
import { URL } from 'url';

async function downloadCreativeFabricaImage(url, savePath) {
    // Validasi URL
    if (!url.includes('creativefabrica.com')) {
        throw new Error('URL is not from Creative Fabrica');
    }

    const browser = await puppeteer.launch({
        headless: "new",
        args: [
            '--no-sandbox',
            '--disable-setuid-sandbox',
            '--disable-dev-shm-usage',
            '--disable-accelerated-2d-canvas',
            '--disable-gpu'
        ],
        executablePath: process.env.PUPPETEER_EXECUTABLE_PATH || undefined
    });

    try {
        const page = await browser.newPage();

        // Set user agent dan headers khusus Creative Fabrica
        await page.setUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');
        await page.setExtraHTTPHeaders({
            'Referer': 'https://www.creativefabrica.com/',
            'Accept-Language': 'en-US,en;q=0.9',
            'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9'
        });

        // Block resource yang tidak perlu
        await page.setRequestInterception(true);
        page.on('request', (req) => {
            if (['image', 'document', 'media'].includes(req.resourceType())) {
                req.continue();
            } else {
                req.abort();
            }
        });

        // Tambahkan delay dan interaksi mouse untuk meniru manusia
        await page.setViewport({ width: 1280, height: 800 });
        await page.mouse.move(100, 100);
        await new Promise(resolve => setTimeout(resolve, 2000 + Math.random() * 3000));
        await page.mouse.move(200, 200, { steps: 10 });
        await new Promise(resolve => setTimeout(resolve, 1000));

        // Navigasi ke URL
        const response = await page.goto(url, {
            waitUntil: 'networkidle2',
            timeout: 60000
        });

        if (!response || !response.ok()) {
            throw new Error(`Failed to load page: ${response?.status()}`);
        }

        // Dapatkan konten gambar
        const imageBuffer = await response.buffer();

        // Buat direktori jika belum ada
        fs.mkdirSync(path.dirname(savePath), { recursive: true });
        fs.writeFileSync(savePath, imageBuffer);

        // Verifikasi file
        const stats = fs.statSync(savePath);
        if (stats.size < 10240) {
            throw new Error('Downloaded file too small');
        }

        return true;
    } finally {
        await browser.close();
    }
}

// Handle command line
const [,, url, savePath] = process.argv;
if (!url || !savePath) {
    console.error('Usage: node creativeFabricaDownloader.js <url> <savePath>');
    process.exit(1);
}

downloadCreativeFabricaImage(url, savePath)
    .then(success => process.exit(success ? 0 : 1))
    .catch(err => {
        console.error('Error:', err.message);
        process.exit(1);
    });

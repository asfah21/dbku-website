import puppeteer from 'puppeteer';
import fs from 'fs';
import path from 'path';

async function downloadImage(url, savePath) {
    const browser = await puppeteer.launch({
        headless: "new",
        args: [
            '--no-sandbox',
            '--disable-setuid-sandbox',
            '--disable-dev-shm-usage'
        ],
        executablePath: process.env.PUPPETEER_EXECUTABLE_PATH || undefined
    });

    try {
        const page = await browser.newPage();
        await page.setUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');

        // Block non-essential resources
        await page.setRequestInterception(true);
        page.on('request', (req) => {
            if (['image', 'document'].includes(req.resourceType())) {
                req.continue();
            } else {
                req.abort();
            }
        });

        const response = await page.goto(url, {
            waitUntil: 'networkidle2',
            timeout: 30000
        });

        if (!response || !response.ok()) {
            throw new Error(`HTTP ${response?.status()}`);
        }

        const imageBuffer = await response.buffer();
        fs.mkdirSync(path.dirname(savePath), { recursive: true });
        fs.writeFileSync(savePath, imageBuffer);

        // Verify file
        const stats = fs.statSync(savePath);
        if (stats.size < 10240) {
            throw new Error('File too small');
        }

        return true;
    } finally {
        await browser.close();
    }
}

// Command line handling
const [,, url, savePath] = process.argv;
if (!url || !savePath) {
    console.error('Usage: node puppeteerImageDownloader.js <url> <savePath>');
    process.exit(1);
}

downloadImage(url, savePath)
    .then(success => process.exit(success ? 0 : 1))
    .catch(err => {
        console.error('Error:', err.message);
        process.exit(1);
    });

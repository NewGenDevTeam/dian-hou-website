const puppeteer = require('puppeteer');
const path = require('path');

const images = [
    { url: 'https://cdn.dribbble.com/userupload/46628802/file/4b1eb1d80a2bdc8759fd4d8526ed41f7.jpg?resize=1600x900&vertical=center', name: 'ref-1-hero.png' },
    { url: 'https://cdn.dribbble.com/userupload/46628801/file/83b8dbdab8c69b5e0d7feb1d4065c7e4.jpg?resize=1600x900&vertical=center', name: 'ref-2-section.png' },
    { url: 'https://cdn.dribbble.com/userupload/46628803/file/5707744c81c60ffbe65206e13c9c8f21.jpg?resize=1600x1042&vertical=center', name: 'ref-3-section.png' },
    { url: 'https://cdn.dribbble.com/userupload/46628800/file/5b4667475fd259e3ec484451b5d899b1.jpg?crop=736x0-5248x3384&resize=1600x900', name: 'ref-4-moodboard.png' },
];

(async () => {
    const browser = await puppeteer.launch({ headless: true, args: ['--no-sandbox'] });

    for (const img of images) {
        const page = await browser.newPage();
        await page.setViewport({ width: 1600, height: 900 });
        await page.goto(img.url, { waitUntil: 'load', timeout: 30000 });
        await page.screenshot({ path: path.join(__dirname, '../screenshots', img.name), fullPage: true });
        console.log('Saved', img.name);
        await page.close();
    }

    await browser.close();
    console.log('All done.');
})();

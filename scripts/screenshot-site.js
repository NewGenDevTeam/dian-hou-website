const puppeteer = require('puppeteer');
const path = require('path');

const pages = [
    { url: 'http://localhost:3000/',               name: 'out-1-hero.png' },
    { url: 'http://localhost:3000/about.html',     name: 'out-2-about.png' },
    { url: 'http://localhost:3000/menu.html',      name: 'out-3-menu.png' },
    { url: 'http://localhost:3000/experience.html',name: 'out-4-experience.png' },
    { url: 'http://localhost:3000/reserve.html',   name: 'out-5-reserve.png' },
];

(async () => {
    const browser = await puppeteer.launch({ headless: true, args: ['--no-sandbox'] });
    for (const p of pages) {
        const page = await browser.newPage();
        await page.setViewport({ width: 1440, height: 900 });
        await page.goto(p.url, { waitUntil: 'networkidle0', timeout: 20000 });
        // Wait for fonts + animations to settle
        await new Promise(r => setTimeout(r, 2200));
        await page.screenshot({ path: path.join(__dirname, '../screenshots', p.name) });
        console.log('✓', p.name);
        await page.close();
    }
    await browser.close();
    console.log('All screenshots saved.');
})();

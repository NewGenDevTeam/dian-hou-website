const puppeteer = require('puppeteer');
const path = require('path');

(async () => {
    const browser = await puppeteer.launch({ headless: true, args: ['--no-sandbox'] });
    const page = await browser.newPage();
    await page.setViewport({ width: 1440, height: 900 });

    await page.goto('https://dribbble.com/shots/27054866-Huo-Chinese-Restaurant-Website', {
        waitUntil: 'networkidle0', timeout: 30000
    });
    await new Promise(r => setTimeout(r, 4000));

    // Press Escape to close any dropdowns/modals, then click body
    await page.keyboard.press('Escape');
    await page.mouse.click(700, 600);
    await new Promise(r => setTimeout(r, 1500));

    // Get the CDN image URL
    const imgUrl = await page.evaluate(() => {
        const imgs = [...document.querySelectorAll('img')];
        const big = imgs.find(i => i.naturalWidth > 200 && i.src.includes('cdn.dribbble'));
        return big ? big.src : null;
    });
    console.log('Main image URL:', imgUrl);

    // Screenshot the full Dribbble shot area - scroll to specific position
    await page.evaluate(() => window.scrollTo(0, 200));
    await new Promise(r => setTimeout(r, 800));
    await page.screenshot({
        path: path.join(__dirname, '../screenshots/ref-shot-v2.png'),
        clip: { x: 0, y: 0, width: 1440, height: 900 }
    });
    console.log('Saved ref-shot-v2.png');

    // Navigate directly to the image if found
    if (imgUrl) {
        const imgPage = await browser.newPage();
        await imgPage.setViewport({ width: 1440, height: 900 });
        await imgPage.goto(imgUrl, { waitUntil: 'load' });
        await imgPage.screenshot({ path: path.join(__dirname, '../screenshots/ref-direct-img.png') });
        console.log('Saved ref-direct-img.png');
        await imgPage.close();
    }

    // Also try fetching the page source to find image links
    const html = await page.content();
    const matches = html.match(/cdn\.dribbble\.com[^"'\s)]+/g) || [];
    const unique = [...new Set(matches)];
    console.log('CDN links found:');
    unique.forEach(l => console.log('  https://' + l));

    await browser.close();
})();

const puppeteer = require('puppeteer');

(async () => {
    const browser = await puppeteer.launch({ 
        headless: true,
        args: ['--no-sandbox', '--disable-setuid-sandbox']
    });
    const page = await browser.newPage();
    
    await page.goto('https://www.google.com/maps/place/Divine+IV+and+Wellness/@33.2488454,-111.8658575,15z');
    await page.waitForTimeout(3000);
    
    const reviewContent = await page.evaluate(() => {
        return Array.from(document.querySelectorAll('div')).map(el => {
            const text = el.textContent || '';
            return (text.length > 50 && /\b(excellent|great|amazing|recommend|service|staff|customer|satisfied)\b/i.test(text)) ? text.trim() : null;
        }).filter(x => x !== null && x.length > 50);
    });
    
    const fs = require('fs');
    fs.writeFileSync('/tmp/browser_reviews.json', JSON.stringify(reviewContent));
    
    await browser.close();
    console.log('Browser automation completed');
})().catch(console.error);
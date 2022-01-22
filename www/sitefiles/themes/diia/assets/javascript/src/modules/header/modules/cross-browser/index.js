import device from 'current-device';

const { detect } = require('detect-browser');

export default function CrossBrowser() {
    const browser = detect();
    if (browser) {
        device.noConflict();
        // console.log(device.type);
        // console.log(device.orientation);
        // console.log(device.os);
        // console.log(browser);
        const browserName = browser.name;
        const browserVersion = `${browser.name}-${browser.version.slice(0, 2)}`;
        const browserOs = browser.os.split(' ').join('-');
        $('body').addClass(`${browserName} ${browserVersion} ${browserOs}`);
        $('html').addClass(`${browserOs}`);
    }
}

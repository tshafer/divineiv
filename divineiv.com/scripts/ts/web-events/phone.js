var _a, _b;
console.debug('setting up web-events/phone');
const webEventCreateUrl = (_b = (_a = document
    .querySelector('[data-web-events-create]')) === null || _a === void 0 ? void 0 : _a.dataset) === null || _b === void 0 ? void 0 : _b.webEventsCreate;
if (webEventCreateUrl) {
    document.addEventListener('click', ev => {
        var _a, _b;
        const target = ev.target;
        if (target instanceof Element && target.closest('.dynamic-phone-number')) {
            const event = 'phone_click';
            const { IsProductionUrl: isProd, SiteId: siteId, WebPageId: webpageId, PrimaryKey: foreignKey, } = window.doctorlogic.PageInformation;
            const anchor = target.closest('a');
            const hasTouchSupport = detectTouchSupport();
            const screenHeight = ((_a = window.screen) === null || _a === void 0 ? void 0 : _a.height) || 0;
            const screenWidth = ((_b = window.screen) === null || _b === void 0 ? void 0 : _b.width) || 0;
            const data = {
                Href: anchor === null || anchor === void 0 ? void 0 : anchor.href,
                DisplayValue: anchor === null || anchor === void 0 ? void 0 : anchor.innerHTML,
                UserAgent: navigator.userAgent,
                'window.innerHeight': window.innerHeight,
                'window.outerHeight': window.outerHeight,
                Cookie: getDLCookie(),
                'window.screen.height': screenHeight,
                'window.screen.width': screenWidth,
                HasTouchSupport: hasTouchSupport,
                DeviceType: getDeviceType({ hasTouchSupport, screenHeight, screenWidth })
            };
            const url = `${webEventCreateUrl}?e=${event}&s=${siteId}&w=${webpageId}&f=${foreignKey}`;
            if (isProd) {
                console.trace('WebEvents', {
                    url,
                    data,
                });
                navigator.sendBeacon(url, JSON.stringify(data));
            }
            else {
                console.trace('WebEvents are not created on non-production urls.', {
                    url,
                    data,
                });
            }
        }
    });
}
else {
    console.error('No WebEvents create url found.');
}
function getDLCookie() {
    var _a;
    const cookie = (_a = document.cookie
        .split('; ')
        .find(c => c.startsWith('__dl='))) === null || _a === void 0 ? void 0 : _a.substring(5);
    if (cookie) {
        return decodeURIComponent(cookie);
    }
    return '';
}
function detectTouchSupport() {
    return 'ontouchstart' in window ||
        navigator.maxTouchPoints > 0 ||
        navigator.msMaxTouchPoints > 0;
}
function getDeviceType({ hasTouchSupport, screenHeight, screenWidth }) {
    const screenMax = Math.max(screenHeight, screenWidth);
    if (hasTouchSupport) {
        if (screenMax <= 1000) {
            return 'mobile';
        }
        else if (screenMax <= 1400) {
            return 'tablet';
        }
    }
    return 'desktop';
}
//# sourceMappingURL=phone.js.map
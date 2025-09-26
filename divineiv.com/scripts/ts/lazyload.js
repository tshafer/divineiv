(dl => {
    const classes = {
        complete: 'complete',
        visible: 'visible',
    };
    const addVisible = (element) => element && element.classList && element.classList.add(classes.visible);
    const addComplete = (element) => element && element.classList && element.classList.add(classes.complete);
    const revealSrc = (element) => {
        addVisible(element);
        const src = element.dataset.src;
        if (src) {
            element.addEventListener('load', ev => addComplete(ev.target));
            element.src = src;
        }
    };
    const revealBackground = (element) => {
        addVisible(element);
        const styleAttr = element.attributes.getNamedItem('style');
        if (styleAttr) {
            styleAttr.textContent = styleAttr.textContent.replace(/\s*background-image\s*:\s*none\s*;$/, '');
        }
        const bg = element.dataset.bg;
        if (bg) {
            element.style.background = bg;
        }
        addComplete(element);
    };
    const revealVideo = (element) => {
        for (const source of element.children) {
            if (source instanceof HTMLSourceElement && typeof source.tagName === 'string') {
                source.src = source.dataset.src;
            }
        }
        element.load();
        element.classList.remove('lazy');
    };
    const revealElement = (element) => {
        if (element instanceof HTMLImageElement || element instanceof HTMLIFrameElement) {
            revealSrc(element);
        }
        else if (element instanceof HTMLVideoElement) {
            revealVideo(element);
        }
        if (element instanceof HTMLElement) {
            revealBackground(element);
        }
    };
    const intersectionHandler = (entries, observer) => entries.forEach(entry => {
        if (entry.isIntersecting) {
            const target = entry.target;
            revealElement(target);
            observer.unobserve(target);
        }
    });
    const init = () => {
        const lazyItems = document.querySelectorAll('.lazy-load-image,video.lazy,.lazy-background,.lazy-iframe');
        if ('IntersectionObserver' in window) {
            const lazyObserver = new IntersectionObserver(intersectionHandler, { rootMargin: '100px' });
            lazyItems.forEach(element => lazyObserver.observe(element));
        }
        else {
            lazyItems.forEach(element => revealElement(element));
        }
    };
    dl.LazyLoad = {
        classes,
        init,
    };
})(window.doctorlogic = window.doctorlogic || {});
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', window.doctorlogic.LazyLoad.init);
}
else {
    window.doctorlogic.LazyLoad.init();
}
//# sourceMappingURL=lazyload.js.map
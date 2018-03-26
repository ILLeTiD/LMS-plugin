export const scrollToTopAnimated = (scrollDuration, el) => {
    var cosParameter = el.scrollTop / 2,
        scrollCount = 0,
        oldTimestamp = performance.now();

    function step(newTimestamp) {
        scrollCount += Math.PI / (scrollDuration / (newTimestamp - oldTimestamp));
        if (scrollCount >= Math.PI) el.scrollTop = 0;
        if (el.scrollTop === 0) return;
        el.scrollTop = Math.round(cosParameter + cosParameter * Math.cos(scrollCount));
        oldTimestamp = newTimestamp;
        window.requestAnimationFrame(step);
    }

    window.requestAnimationFrame(step);
};
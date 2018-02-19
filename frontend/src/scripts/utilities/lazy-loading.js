export const initLazyLoading = () => {
    const elements = document.querySelectorAll('[data-src]');
    const config = {
        rootMargin: '0px 0px 50px 0px',
        threshold: 0
    };

    let observer = new IntersectionObserver(function (entries, self) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                console.log(`Image ${entry.target.src} is in the viewport!`);
                preloadImage(entry.target);
                // Stop watching and load the image
                self.unobserve(entry.target);
            }
        });
    }, config);

    elements.forEach(element => {
        observer.observe(element);
    });

    const preloadImage = (element) => {
        const src = element.getAttribute('data-src');
        const isImg = (element.nodeName.toLowerCase() === 'img');

        if (!src) {
            return;
        }
        if (isImg) {
            element.src = src;
        } else {
            element.style.backgroundImage = `url(${src})`;
        }
    };
};
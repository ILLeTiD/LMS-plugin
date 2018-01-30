class Slide {
    constructor() {
        console.log('slide constructed!');
        this.collectSlidesIds();
    }

    collectSlidesIds() {
        const self = this;
        let slides = [];
        $('#course .slide').each(function (i) {
            slides.push({
                index: $(this).index(),
                id: $(this).data('slide-id'),
                type: $(this).data('type')
            })
        });

        this.slides = slides;
        console.log('slide ctrl', this.slides);
    }

    get amount() {
        return $('.slide').length;
    }

    get current() {
        return $('.slide.active');
    }

    set currentByIndex(index) {
        console.log('set current by index');
        $('.slide.active').removeClass('active');
        $('.slide').eq(index).addClass('active');
    }

    set currentById(id) {
        console.log('set current by ID');
        $('.slide.active').removeClass('active');
        $(`.slide[data-slide-id=${id}]`).addClass('active');
    }

    goToIndex(index) {
        this.currentByIndex = index;
    }
}
export default Slide;

class Slide {
    constructor() {
        console.log('slide constructed2');
    }

    get amount() {
        return $('.slide').length;
    }

    get current() {
        return $('.slide.active');
    }

    set current(index) {
        $('.slide.active').removeClass('active');
        $('.slide').eq(index).addClass('active');
    }

    goTo(index) {
        this.current = index;
    }
}
export default Slide;

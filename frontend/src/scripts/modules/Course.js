//
import Slide from './Slide';
import UrlCtr from './slideUrlControl'
import {GoInFullscreen, GoOutFullscreen, IsFullScreenCurrently} from '../utilities/fullscreen'
class Course {
    constructor() {
        console.log('course inited!');
        this.slide = new Slide();
        this.urlCrl = UrlCtr;
    }


    init() {
        $('.slides').addClass('loaded');
        const initialSlide = this.initialSlide();
        initialSlide.addClass('active');
        this.listeners();
        this.checkControls();
    }

    listeners() {
        //@TODO add left/right arrow switching
        $('.slide-navigation .next').on('click', this.nextSlide.bind(this));
        $('.slide-navigation .prev').on('click', this.prevSlide.bind(this));
        $('.slide-fullscreen').on('click', this.toggleFullscreen.bind(this));
    }

    initialSlide() {
        //@TODO get slide from store or db fake index for now
        let slideFromDb = 0;

        const hash = window.location.hash;
        console.log(hash);
        if (hash && hash.indexOf('#slide') != -1) {
            const slideToShow = +hash.substr(6);
            console.log(+this.slide.amount, slideToShow);

            if (slideToShow > +this.slide.amount) {
                history.replaceState({current: slideFromDb}, `Slide ${slideFromDb}`, `#slide${slideFromDb}`);
                this.slide.current = slideFromDb;
            } else {
                this.slide.current = slideToShow - 1;
                slideFromDb = slideToShow - 1;
            }
            console.log(+slideToShow);
            // UI.showStepByIndex(state.current - 1);
        } else {
            this.urlCrl.addToUrl(1, {current: slideFromDb,});
        }

        return $('.slides').find('.slide').eq(slideFromDb);
    }

    toggleFullscreen(e) {
        e.preventDefault();
        console.log('toggle fullscreen');
        if (!IsFullScreenCurrently()) {
            GoInFullscreen($('#course').get(0))
        } else {
            GoOutFullscreen()
        }
    }

    nextSlide(e) {
        e.preventDefault();

        const currentSlide = this.slide.current;
        let goNext = true;
        if (currentSlide.data('type') == 'quiz') {
            //@TODO check tollerance lvl
        }
        if (goNext) this.slide.current = currentSlide.index() + 1;
        this.checkControls();
        this.urlCrl.addToUrl(this.slide.current.index() + 1);
    }

    prevSlide(e) {
        e.preventDefault();
        const currentSlide = this.slide.current;
        this.slide.current = currentSlide.index() - 1;
        this.checkControls();
        this.urlCrl.addToUrl(+this.slide.current.index() + 1);
    }

    checkControls() {
        if (this.slide.current.is(':first-child')) {
            console.log('first');
            $('.slide-navigation .prev').hide();
        } else {
            $('.slide-navigation .prev').show();
        }

        if (this.slide.current.is(':last-child')) {
            console.log('last');
            $('.slide-navigation .next').hide();
        } else {
            $('.slide-navigation .next').show();
        }
    }

}
export default Course;
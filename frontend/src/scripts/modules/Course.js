//
import SlideCtr from './Slide';
import UrlCtr from './slideUrlControl'
import Hint from './Hint'
import Alert from '../utilities/Alerts'
import {GoInFullscreen, GoOutFullscreen, IsFullScreenCurrently} from '../utilities/fullscreen'

class Course {
    constructor() {
        console.log('course inited1!');
        this.slideCtr = new SlideCtr();
        this.urlCrl = UrlCtr;
        this.courseId = $('#course').data('id');
        this.userId = $('#course').data('user-id');
    }


    init() {
        console.log('init Course');
        this.getCurrentSlideFromDb();
    }


    afterDb(id) {
        const initialSlide = this.initialSlide(id);
        initialSlide.addClass('active');
        this.listeners();
        this.checkControls();
        $('.slides').addClass('loaded');
    }

    listeners() {
        //@TODO add left/right arrow switching
        $('.slide-navigation .next').on('click', this.nextSlide.bind(this));
        $('.slide-navigation .prev').on('click', this.prevSlide.bind(this));
        $('.slide-fullscreen').on('click', this.toggleFullscreen.bind(this));
    }

    getCurrentSlideFromDb() {
        const self = this;
        $.ajax({
            method: "POST",
            url: lmsAjax.ajaxurl,
            data: {
                action: 'progress_get_all',
                user_id: this.userId,
                course_id: this.courseId,
            },
            error: function (request, status, error) {
                new Alert(request.responseText);
                console.log(request.responseText);
            }
        }).done(function (json) {
            console.log('slide from db action', json);
            if (json.error) new Alert(`"${json.error}" please reload page`);
            const passedIds = json.ids ? json.ids : [];
            self.passedIds = passedIds;
            self.afterDb();
        });

    }

    initialSlide() {
        let slideFromDb = 0;
        let initialSlideIndex = 0;

        console.log('passed ids', this.passedIds);

        if (this.passedIds.length == 0) {
            console.log('empty ids');
            this.urlCrl.addToUrl(1, {current: initialSlideIndex,});
            return $('.slides').find('.slide').eq(initialSlideIndex);
        }

        let hash = window.location.hash;

        let lastSlideIdFromDB = this.passedIds[0];
        let lastElIndexFromDB = this.slideCtr.slides.find(value => value.id == lastSlideIdFromDB);
        let lastSlideIndexFromDB = lastElIndexFromDB.index;

        //check if valid slide
        //if 0 user first time at course so show first slide

        if (hash && hash.indexOf('#slide') != -1) {
            const slideToShow = +hash.substr(6);
            const elementToShow = this.slideCtr.slides.find(value => value.index == (slideToShow - 1));
            const idToShow = elementToShow.id;


            if (this.passedIds.includes(idToShow) && !(slideToShow > +this.slideCtr.amount || slideToShow <= 0)) {
                console.log('show slide from db by ID');
                this.slideCtr.currentById = idToShow;
                lastSlideIndexFromDB = this.slideCtr.current.index();
                //  } else if (slideToShow > +this.slideCtr.amount || slideToShow <= 0) {
            } else {

                console.log('wrong slide11');
                console.log('id from DB', lastSlideIdFromDB);
                console.log('index from DB', lastSlideIndexFromDB);
                history.replaceState({current: lastSlideIndexFromDB}, `Slide ${lastSlideIndexFromDB + 1}`, `#slide${lastSlideIndexFromDB + 1}`);
                this.slideCtr.currentById = +lastSlideIdFromDB;
            }
            // else {
            //     this.slideCtr.currentByIndex = slideToShow - 1;
            //     slideFromDb = slideToShow - 1;
            // }
            // UI.showStepByIndex(state.current - 1);
        } else {
            // this.urlCrl.addToUrl(1, {current: slideFromDb,});
            console.log('slide from DB');
            history.replaceState({current: lastSlideIndexFromDB}, `Slide ${lastSlideIndexFromDB + 1}`, `#slide${lastSlideIndexFromDB + 1}`);
            this.slideCtr.currentById = +lastSlideIdFromDB;
        }

        return $('.slides').find('.slide').eq(lastSlideIndexFromDB);
    }

    toggleFullscreen(e) {
        e.preventDefault();
        console.log('toggle fullscreen');
        if (!IsFullScreenCurrently()) {
            GoInFullscreen($('#course').get(0))
        } else {
            GoOutFullscreen();
        }
    }

    nextSlide(e) {
        e.preventDefault();

        const currentSlide = this.slideCtr.current;
        const currentId = currentSlide.data('slide-id');
        const nextSlide = this.slideCtr.current.next();
        let goNext = true;
        console.log(currentId);

        console.log(nextSlide.data('type'));
        if (nextSlide.data('type') == 'quiz') {
            //@TODO check tollerance lvl
            console.log('quiz slide');
            const hint = new Hint('test');
        }

        if (goNext) {
            $.ajax(
                {
                    method: "POST",
                    url: lmsAjax.ajaxurl,
                    data: {
                        action: 'progress_commit',
                        user_id: this.userId,
                        course_id: this.courseId,
                        slide_id: currentId
                    }
                }
            ).done(function (msg) {
                console.log(msg);
            });

            this.slideCtr.currentByIndex = currentSlide.index() + 1;
            this.checkControls();
            this.urlCrl.addToUrl(this.slideCtr.current.index() + 1);
        }
    }


    prevSlide(e) {
        e.preventDefault();
        const currentSlide = this.slideCtr.current;
        this.slideCtr.currentByIndex = currentSlide.index() - 1;
        this.checkControls();
        this.urlCrl.addToUrl(+this.slideCtr.current.index() + 1);
    }

    checkControls() {
        if (this.slideCtr.current.is(':first-child')) {
            console.log('first slide');
            $('.slide-navigation .prev').hide();
        } else {
            $('.slide-navigation .prev').show();
        }

        if (this.slideCtr.current.is(':last-child')) {
            console.log('last slide');
            $('.slide-navigation .next').hide();
        } else {
            $('.slide-navigation .next').show();
        }
    }
}
export default Course;
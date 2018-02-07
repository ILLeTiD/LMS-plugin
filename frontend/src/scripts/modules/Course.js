import SlideCtr from './Slide';
import UrlCtr from './slideUrlControl'
import Hint from './Hint'
import Quiz from './Quiz'
import Alert from '../utilities/Alerts'
import 'hammerjs'
import Muuri from 'muuri';

import {GoInFullscreen, GoOutFullscreen, IsFullScreenCurrently} from '../utilities/fullscreen'

class Course {
    constructor() {
        console.log('course inited1!');
        this.slideCtr = new SlideCtr(this);
        this.urlCrl = UrlCtr;
        this.canGoNext = true;
        this.flexThreshold = 50;
    }

    init($courseEl) {
        console.log('init Course');
        this.courseEl = $courseEl;
        this.courseId = $courseEl.data('id');
        this.userId = $courseEl.data('user-id');
        this.getCurrentSlideFromDb();
        //      this.getAnswersFromDB();

    }

    setActiveSlideOnInit() {

        const initialSlideIndex = this.getinitialSlideIndex();
        this.showSlide(initialSlideIndex, initialSlideIndex + 1);
        this.listeners();

        //remove loader when we have slide to show
        this.courseEl.removeClass('unloaded');
        this.courseEl.find('#course-loader').remove();
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
            if (json.error) new Alert(`"${json.error}" please reload page`);
            self.passedIds = json.ids ? json.ids : [];
            self.setActiveSlideOnInit();
        });

    }

    getinitialSlideIndex() {
        let initialSlideIndex = 0;

        console.log('passed slide ids', this.passedIds);

        //if user don`t have activities on this course just show 1st step
        if (this.passedIds.length == 0) {
            console.log('fist time at course');
            return initialSlideIndex;
        }

        let hash = window.location.hash;

        //collect info about last step from activities
        let lastSlideIdFromDB = this.passedIds[0];
        let lastElIndexFromDB = this.slideCtr.slides.find(value => value.id == lastSlideIdFromDB);
        let lastSlideIndexFromDB = lastElIndexFromDB.index;

        //check if valid slide in url hash
        if (hash && hash.indexOf('#slide') != -1) {
            //extract step info from hash
            const slideToShow = parseInt(hash.substr(6));
            const elementToShow = this.slideCtr.slides.find(value => value.index == (slideToShow - 1));
            const idToShow = elementToShow.id;

            //check if user can go to this step
            if (this.passedIds.includes(idToShow) && !(slideToShow > +this.slideCtr.amount || slideToShow <= 0)) {
                console.log('show slide from db by ID');
                this.slideCtr.currentById = idToShow;
                lastSlideIndexFromDB = this.slideCtr.current.index();
                //  } else if (slideToShow > +this.slideCtr.amount || slideToShow <= 0) {
            } else {
                //user cant go to slide in hash but has some activities so show last activity
                console.log('wrong slide11');
                console.log('id from DB', lastSlideIdFromDB);
                console.log('index from DB', lastSlideIndexFromDB);
                history.replaceState({current: lastSlideIndexFromDB}, `Slide ${lastSlideIndexFromDB + 1}`, `#slide${lastSlideIndexFromDB + 1}`);
                this.slideCtr.currentById = +lastSlideIdFromDB;
                lastSlideIndexFromDB = this.slideCtr.current.index();
            }
        } else {
            // user just go to course not to specific slide and has some activity in past
            console.log('slide from DB');
            history.replaceState({current: lastSlideIndexFromDB}, `Slide ${lastSlideIndexFromDB + 1}`, `#slide${lastSlideIndexFromDB + 1}`);
            this.slideCtr.currentById = +lastSlideIdFromDB;
            lastSlideIndexFromDB = this.slideCtr.current.index();
        }
        console.log(lastSlideIndexFromDB);
        return lastSlideIndexFromDB;
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
        const nextSlideIndex = nextSlide.index();

        if (this.canGoNext) {
            console.log('next slide index', nextSlideIndex);
            this.showSlide(nextSlideIndex, nextSlideIndex + 1)
        }
    }

    prevSlide(e) {
        e.preventDefault();
        const currentSlide = this.slideCtr.current;
        const prevSlideIndex = currentSlide.prev().index();
        console.log('prev slide index', prevSlideIndex);
        this.showSlide(prevSlideIndex, prevSlideIndex + 1)
    }

    showSlide(indexSlide, indexHash) {
        this.slideCtr.currentByIndex = indexSlide;
        this.checkControls();
        const currentId = this.slideCtr.current.data('slide-id');
        this.urlCrl.addToUrl(indexHash, {
            current: indexHash,
        });
        this.commitActivity(currentId);


        if (this.slideCtr.current.data('type') === 'quiz') {
            const quizSlide = this.slideCtr.quizes.find(e => e.id == currentId);
            if (!quizSlide.inited) {
                quizSlide.quiz.init();
                quizSlide.inited = true;
                console.log('initeed quiz', quizSlide);
                console.log(this.slideCtr.quizes);
            }
        }

        if (this.slideCtr.current.data('type') === 'quiz' && this.slideCtr.current.data('quiz-type') === 'puzzle') {
            console.log('puzzle reinit');
            const grid = new Muuri(".lms-puzzles-grid", {
                dragEnabled: true
                // dragAxis: 'y'
            });
        }
    }

    commitActivity(currentId) {
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
            console.log('commited slide activity ', msg);
        });
    }

    checkControls() {
        if (this.slideCtr.current.is(':first-child')) {
            $('.slide-navigation .prev').hide();
        } else {
            $('.slide-navigation .prev').show();
        }

        if (this.slideCtr.current.is(':last-child')) {
            $('.slide-navigation .next').hide();
        } else {
            $('.slide-navigation .next').show();
        }
    }
}
export default Course;
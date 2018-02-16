import SlideCtr from './Slide';
import UrlCtr from './slideUrlControl'
import Hint from './Hint'
import Quiz from './Quiz'
import {initLazyLoading} from '../utilities/lazy-loading';
import Alert from '../utilities/Alerts'
import 'hammerjs'
import Muuri from 'muuri';
import mediaelement from 'mediaelement';

import {GoInFullscreen, GoOutFullscreen, IsFullScreenCurrently} from '../utilities/fullscreen'

class Course {
    constructor() {
        //console.log('course inited1!');
        this.slideCtr = new SlideCtr(this);
        this.urlCrl = new UrlCtr(this.slideCtr, this);
        this.canGoNext = true;
        this.flexThreshold = 50;
        this.passedIds = [];
        this.slideDisplayType = 'all_at_once';
        this.navType = 'slide';
    }

    init($courseEl) {
        //console.log('init Course');
        this.courseEl = $courseEl;
        this.courseId = $courseEl.data('id');
        this.userId = $courseEl.data('user-id');
        this.getLatestSlideFromDb();
        this.initAudio();
        initLazyLoading();
    }

    initAudio() {
        const self = this;
        if ($.fn.mediaelementplayer) {
            //console.log('MEDIA ELEMENT');
            this.player = $('#slide-control-player').mediaelementplayer({
                pluginPath: 'https://cdnjs.com/libraries/mediaelement/',
                shimScriptAccess: 'always',
                stretching: 'responsive',
                success: function (mediaElement, originalNode, instance) {
                    // do things
                    //console.log('media element ', mediaElement);
                    //console.log('originalNode ', originalNode);
                    //console.log('instance ', instance);
                    self.playerInstance = instance;
                }
            });

            //console.log('this player ', this.player);
        }
    }

    setSlideAudio() {
        const slide = this.slideCtr.current;
        // if (slide.data('type') != 'regular') return;
        const audioBlock = slide.find(`.grid-block[data-audio-src]`).first();
        const firstAudioSrc = audioBlock.data('audio-src');
        if (firstAudioSrc) {
            //console.log('slide has audio');
            this.courseEl.find('.slide-control-audio').addClass('audio-inited');
            this.playerInstance.setSrc(firstAudioSrc);
            this.playerInstance.load();
            this.playerInstance.play();
        } else {
            this.courseEl.find('.slide-control-audio').removeClass('audio-inited');
            //console.log('slide has NO audio');
            if (!this.playerInstance.paused) {
                this.playerInstance.pause();
            }
        }
        //console.log('audio src ', firstAudioSrc);
    }

    getLatestSlideFromDb() {
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
                //console.log(request.responseText);
            }
        }).done(function (json) {
            if (json.error) new Alert(`"${json.error}" please reload page`);
            self.passedIds = json.ids ? json.ids : [];
            self.setActiveSlideOnInit();
        });
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
        $('html').keydown((e) => {
            //    //console.log(e);
            if (e.keyCode == 37 && !this.slideCtr.current.is(':first-child')) {
                this.prevSlide();
            }
            if (e.keyCode == 39 && !this.slideCtr.current.is(':last-child')) {
                if (this.navType == 'slide') {
                    this.nextSlide();
                } else if (this.navType == 'section') {
                    console.log('RIGHT CLICK KEY');
                    this.nextSection();
                }
            }
        });

        //default ESC button exit fullscreen handler
        document.addEventListener("fullscreenchange", () => {
            if (!document.webkitIsFullScreen && !document.mozFullScreen && !document.msFullscreenElement) {
                this.courseEl.find('.course-controls').removeClass('option-shown');
                this.courseEl.removeClass('fullscreen-init');
                this.courseEl.find('.course-controls').removeClass('fullscreen-init');
            }
        }, false);

        $('.slide-control-navigation .next').on('click', this.nextSlide.bind(this));
        $('.section-control-navigation .next').on('click', this.nextSection.bind(this));
        $('.slide-control-navigation .prev').on('click', this.prevSlide.bind(this));
        $('.slide-fullscreen').on('click', this.toggleFullscreen.bind(this));
        $('.slide-control-fullscreen-option').on('click', this.toggleFullscreenOption.bind(this));
    }

    getinitialSlideIndex() {
        let initialSlideIndex = 0;
        //if user don`t have activities on this course just show 1st step
        if (this.passedIds.length == 0) {
            //console.log('fist time at course');
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
                //console.log('show slide from db by ID');
                this.slideCtr.currentById = idToShow;
                lastSlideIndexFromDB = this.slideCtr.current.index();
                //  } else if (slideToShow > +this.slideCtr.amount || slideToShow <= 0) {
            } else {
                //user cant go to slide in hash but has some activities so show last activity
                //console.log('wrong slide11');
                //console.log('id from DB', lastSlideIdFromDB);
                //console.log('index from DB', lastSlideIndexFromDB);
                history.replaceState({current: lastSlideIndexFromDB}, `Slide ${lastSlideIndexFromDB + 1}`, `#slide${lastSlideIndexFromDB + 1}`);
                this.slideCtr.currentById = +lastSlideIdFromDB;
                lastSlideIndexFromDB = this.slideCtr.current.index();
            }
        } else {
            // user just go to course not to specific slide and has some activity in past
            //console.log('slide from DB');
            history.replaceState({current: lastSlideIndexFromDB}, `Slide ${lastSlideIndexFromDB + 1}`, `#slide${lastSlideIndexFromDB + 1}`);
            this.slideCtr.currentById = +lastSlideIdFromDB;
            lastSlideIndexFromDB = this.slideCtr.current.index();
        }
        //console.log(lastSlideIndexFromDB);
        return lastSlideIndexFromDB;
    }

    toggleFullscreen(e) {
        if (e) e.preventDefault();
        //console.log('toggle fullscreen!');
        if (!IsFullScreenCurrently()) {
            // GoInFullscreen($('html').get(0))
            //console.log(this.courseEl);
            GoInFullscreen(this.courseEl[0]);
        } else {
            GoOutFullscreen();
            this.courseEl.find('.course-controls').removeClass('option-shown');
        }

        this.courseEl.toggleClass('fullscreen-init');
        this.courseEl.find('.course-controls').toggleClass('fullscreen-init');
    }

    toggleFullscreenOption(e) {
        e.preventDefault();
        //console.log('options clicked');
        this.courseEl.find('.course-controls').toggleClass('option-shown');
    }

    nextSlide(e) {
        if (e) e.preventDefault();

        const currentSlide = this.slideCtr.current;
        const currentId = currentSlide.data('slide-id');
        const nextSlide = this.slideCtr.current.next();
        const nextSlideIndex = nextSlide.index();

        if (this.canGoNext) {
            //console.log('next slide index', nextSlideIndex);
            this.showSlide(nextSlideIndex, nextSlideIndex + 1);
            this.commitActivity(currentId);
        } else {
            new Alert('Please answer the question to go next')
        }
    }

    prevSlide(e) {
        if (e) e.preventDefault();
        this.canGoNext = true;
        const currentSlide = this.slideCtr.current;
        const prevSlideIndex = currentSlide.prev().index();
        //console.log('prev slide index', prevSlideIndex);
        this.showSlide(prevSlideIndex, prevSlideIndex + 1)
    }

    showSlide(indexSlide, indexHash) {
        this.slideCtr.currentByIndex = indexSlide;
        this.slideSectionsCount = this.slideCtr.current.data('section-count');
        this.slideDisplayType = this.slideCtr.current.data('section-display');
        this.currentSection = 1;


        this.checkControls();
        const currentId = this.slideCtr.current.data('slide-id');
        this.urlCrl.addToUrl(indexHash, {
            current: indexHash,
        });

        this.setSlideAudio();

        this.setSlideSectionDisplay();

        if (this.slideCtr.current.data('type') === 'quiz') {
            if ((this.slideCtr.current.data('tolerance') === "strict" || this.slideCtr.current.data('tolerance') === "flexible") && !this.passedIds.includes(this.slideCtr.current.data('slide-id'))) {
                this.canGoNext = false;
            }
            //init current quiz
            const quizSlide = this.slideCtr.quizes.find(e => e.id == currentId);

            //hack to recalc quiz hint
            setTimeout(() => {
                window.scrollTo(0, 1);
                window.scrollTo(0, 0);
            }, 16);

            if (!quizSlide.inited) {
                quizSlide.quiz.init();
                quizSlide.inited = true;
            }
        }

        this.calculateProgress();
    }

    nextSection(e) {
        if (e) e.preventDefault();
        console.log('next section handler');
        console.log('current optoins', this.currentSection, this.slideSectionsCount);
        this.slideCtr.current.find('.grid-block').eq(this.currentSection).addClass('active');
        this.currentSection++;
        if (this.currentSection >= this.slideSectionsCount) {
            this.slideCtr.current.addClass('passed');
            this.navType = 'slide';
            this.enableCourseNav();
            this.disableSectionNav();
        }
    }

    setSlideSectionDisplay() {
        this.checkCourseNavigation();
    }

    /*
     block of utility methods
     */
    disableCourseNav() {
        this.courseEl.find('.slide-control-navigation').addClass('disabled')
    }

    enableCourseNav() {
        this.courseEl.find('.slide-control-navigation').removeClass('disabled')
    }

    disableSectionNav() {
        this.courseEl.find('.section-control-navigation').removeClass('active')
    }

    enableSectionNav() {
        this.courseEl.find('.section-control-navigation').addClass('active')
    }


    //@TODO add some state
    checkCourseNavigation() {
        if (this.slideDisplayType == 'once_at_a_time') {
            this.navType = 'section';
            this.disableCourseNav();
            this.enableSectionNav();
        }

        if (this.slideDisplayType == 'all_at_once' || this.slideSectionsCount == 1 || this.slideCtr.current.hasClass('passed')) {
            this.navType = 'slide';
            this.enableCourseNav();
            this.disableSectionNav();
        }
    }

    commitActivity(currentId) {
        if (!this.passedIds.includes(currentId)) this.passedIds.push(currentId);
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
            //console.log('commited slide activity ', msg);
        });
    }

    calculateProgress(current = this.slideCtr.current.index(), amount = this.slideCtr.amount) {
        //console.log('start calculating progress');
        const courseProgressLine = $('.course-progress');
        courseProgressLine.css('width', `${((current + 1) / amount) * 100}%`);
    }

    checkControls() {
        if (this.slideCtr.current.is(':first-child')) {
            $('.slide-control-navigation .prev').hide();
        } else {
            $('.slide-control-navigation .prev').show();
        }

        if (this.slideCtr.current.is(':last-child')) {
            $('.slide-control-navigation .next').hide();
        } else {
            $('.slide-control-navigation .next').show();
        }
    }
}
export default Course;
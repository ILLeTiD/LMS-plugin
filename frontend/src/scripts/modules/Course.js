import SlideCtr from './Slide';
import Hint from './Hint'
import Quiz from './Quiz'
import {initLazyLoading} from '../utilities/lazy-loading';
import Alert from '../utilities/Alerts'
import 'hammerjs'
import Muuri from 'muuri';
import mediaelement from 'mediaelement';
import {selectors} from './selectors'
import {GoInFullscreen, GoOutFullscreen, IsFullScreenCurrently} from '../utilities/fullscreen'

class Course {
    constructor() {
        this.slideCtr = new SlideCtr(this);
        // this.urlCrl = new UrlCtr(this.slideCtr, this);
        this.canGoNext = true;
        this.flexThreshold = 50;
        this.passedIds = [];
        this.slideDisplayType = 'all_at_once';
        this.navType = 'slide';
        this.selectors = selectors;
        this.slides = [];

    }

    init($courseEl) {
        console.log(this.selectors);
        this.courseEl = $courseEl;
        this.courseId = $courseEl.data('id');
        this.userId = $courseEl.data('user-id');
        this.getLatestSlideFromDb();
        this.initAudio();
        initLazyLoading();
        this.collectSlides();
    }

    collectSlides() {
        const self = this;
        $(this.selectors.slide).each(function (i) {
            const slide = {
                index: +$(this).data('slide-index'),
                id: $(this).data('slide-id'),
                type: $(this).data('type'),
                active: false,
                sectionDisplay: $(this).data('section-display'),
                passed: $(this).data('passed') ? $(this).data('passed') : false,
                latest: $(this).data('latest') ? $(this).data('latest') : false,
            };

            if ($(this).data('type') == 'quiz') {
                slide.inited = false;
                slide.quiz = new Quiz(
                    $(this),
                    $(this).data('quiz-type'),
                    $(this).data('tolerance'),
                    self);
            }
            self.slides.push(slide);
        });
    }

    initAudio() {
        const self = this;
        if ($.fn.mediaelementplayer) {
            console.log('MEDIA ELEMENT');
            this.player = $(this.selectors.audioPlayerControl).mediaelementplayer({
                pluginPath: 'https://cdnjs.com/libraries/mediaelement/',
                shimScriptAccess: 'always',
                features: ['playpause', 'volume'],
                stretching: 'responsive',
                success: function (mediaElement, originalNode, instance) {
                    self.playerInstance = instance;
                }
            });
        }
    }

    setSlideAudio() {
        const slide = this.slideCtr.current;
        const audioBlock = slide.find(this.selectors.audioGridBlock).first();
        const firstAudioSrc = audioBlock.data('audio-src');
        const isLoop = audioBlock.data('audio-loop');
        if (firstAudioSrc) {
            console.log('IS LOOP?', isLoop);
            console.log(this.playerInstance);
            //console.log('slide has audio');
            this.courseEl.find(this.selectors.courseControlsAudio).addClass('audio-inited');
            if (isLoop) {
                this.playerInstance.options.loop = true;
            }

            this.playerInstance.setSrc(firstAudioSrc);
            this.playerInstance.load();
            this.playerInstance.play();
        } else {
            this.courseEl.find(this.selectors.courseControlsAudio).removeClass('audio-inited');
            if (!this.playerInstance.paused) {
                this.playerInstance.pause();
            }
        }
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
            }
        }).done(function (json) {
            if (json.error) new Alert(`"${json.error}" please reload page`);
            console.log(json);
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
        this.courseEl.find(this.selectors.preloader).remove();
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
            const idToShow = elementToShow ? elementToShow.id : {};
            //check if user can go to this step
            if (this.passedIds.includes(idToShow) && !(slideToShow > +this.slideCtr.amount || slideToShow <= 0)) {
                this.slideCtr.currentById = idToShow;
                lastSlideIndexFromDB = this.slideCtr.current.data('slide-index');
            } else {
                //user cant go to slide in hash but has some activities so show last activity
                console.log('wrong slide11');
                history.replaceState({current: lastSlideIndexFromDB}, `Slide ${lastSlideIndexFromDB + 1}`, `#slide${lastSlideIndexFromDB + 1}`);
                this.slideCtr.currentById = +lastSlideIdFromDB;
                lastSlideIndexFromDB = this.slideCtr.current.data('slide-index');
            }
        } else {
            // user just go to course not to specific slide and has some activity in past
            history.replaceState({current: lastSlideIndexFromDB}, `Slide ${lastSlideIndexFromDB + 1}`, `#slide${lastSlideIndexFromDB + 1}`);
            this.slideCtr.currentById = +lastSlideIdFromDB;
            lastSlideIndexFromDB = this.slideCtr.current.data('slide-index');
        }
        return lastSlideIndexFromDB;
    }

    addToUrl(part, obj = {}) {
        const index = this.slideCtr.current.index();
        const current = index + 1;

        var stateObj;
        if ($.isEmptyObject(obj)) {
            stateObj = {
                current: current,
            };
        } else {
            stateObj = obj;
        }

        history.pushState(stateObj, `Step ${part}`, `#slide${part}`);
    }


    listeners() {
        $('html').keydown((e) => {
            if (e.keyCode == 37 && !this.slideCtr.current.is(':first-child')) {
                this.prevSlide();
            }
            if (e.keyCode == 39 && !this.slideCtr.current.is(':last-child')) {
                if (this.navType == 'slide') {
                    this.nextSlide();
                } else if (this.navType == 'section') {
                    this.nextSection();
                }
            }
        });

        window.addEventListener('popstate', (e) => {
            console.log('CHANGE URL LISTENER');
            var state = e.state;

            try {
                this.showSlide(state.current - 1, state.current, false);
            } catch (e) {
                this.slideCtr.currentByIndex = 0;
            }
        });

        $(window).on('load', () => {
            //default ESC button exit fullscreen handler
            $(document).on('webkitfullscreenchange mozfullscreenchange fullscreenchange MSFullscreenChange', () => {
                if (!IsFullScreenCurrently()) {
                    console.log('exit from fullscreen');
                    this.courseEl.find(this.selectors.courseControls).removeClass('lms-option-shown');
                    this.courseEl.removeClass('lms-fullscreen-init');
                    this.courseEl.find(this.selectors.courseControls).removeClass('lms-fullscreen-init');
                    this.fullscreenPaintNavButtons(true);
                }
            });
        });

        $(this.selectors.shortcodeBackToCourses).on('click', this.shortcodeBackToCourses.bind(this));
        $(this.selectors.shortcodeRestart).on('click', this.shortcodeRestart.bind(this));
        $(this.selectors.shortcodePrev).on('click', this.prevSlide.bind(this));
        $(this.selectors.shortcodeNext).on('click', this.nextSlide.bind(this));
        $(this.selectors.quizCheckButton).on('click', this.checkQuiz.bind(this));
        $(this.selectors.slideNavigation).on('click', '.next', this.nextSlide.bind(this));
        $(this.selectors.sectionNavigation).on('click', '.next', this.nextSection.bind(this));
        $(this.selectors.slideNavigation).on('click', '.prev', this.prevSlide.bind(this));
        $(this.selectors.courseControlsFullscreen).on('click', this.toggleFullscreen.bind(this));
        $(this.selectors.fullscreenOptions).on('click', this.toggleFullscreenOption.bind(this));
    }

    checkQuiz(e) {
        if (e) e.preventDefault();
        this.slideCtr.current.find('.lms-quiz-check-button').click();
    }

    shortcodeBackToCourses(e) {
        if (e) e.preventDefault();
        window.location.href = lmsAjax.coursesLink;
    }

    shortcodeRestart(e) {
        if (e) e.preventDefault();
        console.log('START DELETEING');
        $.ajax(
            {
                method: "POST",
                url: lmsAjax.ajaxurl,
                data: {
                    action: 'progress_restart',
                    user_id: this.userId,
                    course_id: this.courseId,
                }
            }
        ).done(function (json) {
            if (json.error) new Alert(`"${json.error}" please reload page`);
            window.location.reload();
        });
    }

    toggleFullscreen(e) {
        if (e) e.preventDefault();

        // console.log('is', IsFullScreenCurrently());
        if (!IsFullScreenCurrently()) {
            GoInFullscreen(this.courseEl[0]);
            this.courseEl.addClass('lms-fullscreen-init');
            this.courseEl.find(this.selectors.courseControls).addClass('lms-fullscreen-init');
            this.fullscreenPaintNavButtons(true);
        } else {
            GoOutFullscreen();
            this.courseEl.find(this.selectors.courseControls).removeClass('lms-option-shown');
            this.courseEl.removeClass('lms-fullscreen-init');
            this.courseEl.find(this.selectors.courseControls).removeClass('lms-fullscreen-init');
            //this.fullscreenPaintNavButtons(true);
        }
    }

    toggleFullscreenOption(e) {
        e.preventDefault();
        this.courseEl.find(this.selectors.courseControls).toggleClass('lms-option-shown');
    }

    fullscreenPaintNavButtons(onCangeFullscreen = false) {
        const getColor = () => {
            const slide = this.slideCtr.current;
            const type = slide.data('type');
            let color = '#fff';
            color = slide.data('icon-color');
            // if (type == 'quiz') {
            //     color = slide.data('icon-color');
            // } else {
            //     color = slide.find('.lms-grid-block').first().data('icon-color');
            // }
            if (onCangeFullscreen) {
                return !IsFullScreenCurrently() ? color : '#fff';
            } else {
                return IsFullScreenCurrently() ? color : '#fff';
            }

        };
        // console.log('COLOR', getColor());
        // console.log('IS FULLSCREEN?', IsFullScreenCurrently());
        $('.lms-course-controls svg .cls-1, .lms-course-controls svg .cls-2').each(function (i) {
            $(this).css('stroke', getColor());
        });
    }

    nextSlide(e) {
        if (e) e.preventDefault();

        const currentSlide = this.slideCtr.current;
        const currentId = currentSlide.data('slide-id');
        const nextSlide = this.slideCtr.current.next();
        const nextSlideIndex = nextSlide.data('slide-index');

        if (this.canGoNext) {
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
        this.showSlide(prevSlideIndex, prevSlideIndex + 1)
    }

    showSlide(indexSlide, indexHash, changeUrl = true) {
        this.slideCtr.currentByIndex = indexSlide;
        this.slideSectionsCount = this.slideCtr.current.data('section-count');
        this.slideDisplayType = this.slideCtr.current.data('section-display');
        this.currentSection = 1;

        this.checkControls();
        this.fullscreenPaintNavButtons();
        const currentId = this.slideCtr.current.data('slide-id');
        if (changeUrl) {
            this.addToUrl(indexHash, {
                current: indexHash,
            });
        }
        this.setSlideAudio();
        this.setSlideSectionDisplay();

        if (this.slideCtr.current.data('type') === 'quiz') {
            console.log('IS SLIDE QUIZ');
            if (!this.passedIds.includes(this.slideCtr.current.data('slide-id'))) {
                console.log('IS SLIDE QUIZ FIRST TIME');
                $('.lms-nav-button--prev').addClass('disabled');
                $('.lms-nav-button--check').addClass('active');
                this.canGoNext = false;
            } else {
                $('.lms-nav-button--prev').removeClass('disabled');
                $('.lms-nav-button--check').removeClass('active');
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
                // this.canGoNext = true;
                this.courseEl.find(this.selectors.slideNavigation).addClass('quiz-unpassed');
                quizSlide.inited = true;
            }
        } else {
            console.log('remove CHECK');
            $('.lms-nav-button--prev').removeClass('disabled');
            $('.lms-nav-button--check').removeClass('active');
        }

        this.calculateProgress();
    }

    nextSection(e) {
        if (e) e.preventDefault();
        this.slideCtr.current.find(this.selectors.gridBlock).eq(this.currentSection).addClass('active');
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
        this.courseEl.find(this.selectors.slideNavigation).addClass('disabled')
    }

    enableCourseNav() {
        this.courseEl.find(this.selectors.slideNavigation).removeClass('disabled')
    }

    disableSectionNav() {
        this.courseEl.find(this.selectors.sectionNavigation).removeClass('active')
    }

    enableSectionNav() {
        this.courseEl.find(this.selectors.sectionNavigation).addClass('active')
    }


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

    commitActivity(currentId, commitMessage = 'finished') {
        if (!this.passedIds.includes(currentId)) this.passedIds.push(currentId);
        $.ajax(
            {
                method: "POST",
                url: lmsAjax.ajaxurl,
                data: {
                    action: 'progress_commit',
                    user_id: this.userId,
                    course_id: this.courseId,
                    slide_id: currentId,
                    commit_message: commitMessage
                }
            }
        ).done(function (msg) {
            console.log('commited slide activity ', msg);
        });
    }

    calculateProgress(current = this.slideCtr.current.index(), amount = this.slideCtr.amount) {
        const courseProgressLine = $(this.selectors.progressBar);
        courseProgressLine.css('width', `${((current + 1) / amount) * 100}%`);
    }

    checkControls() {
        if (this.slideCtr.current.is(':first-child')) {
            $(`${this.selectors.slideNavigation} .prev`).hide();
        } else {
            $(`${this.selectors.slideNavigation} .prev`).show();
        }

        if (this.slideCtr.current.is(':last-child')) {
            $(`${this.selectors.slideNavigation} .next`).hide();
        } else {
            $(`${this.selectors.slideNavigation} .next`).show();
        }
    }
}
export default Course;
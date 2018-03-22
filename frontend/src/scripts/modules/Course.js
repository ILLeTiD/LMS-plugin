import SlideCtr from './Slide';
import {initLazyLoading} from '../utilities/lazy-loading';
import lmsConfirmAlert from '../utilities/lmsConfirmAlert'
import Alert from '../utilities/Alerts'
import 'hammerjs'
import 'mediaelement/full';
import {selectors} from './selectors'
import {ProgressLogger} from './CourseProgressLogger'
import {Activity} from  './ActivityLogger'
import {GoInFullscreen, GoOutFullscreen, IsFullScreenCurrently} from '../utilities/fullscreen'
import {showArrow} from '../utilities/checkIfArrowAllowed'
import quizFactory from './quiz-functions/quizFactory'
import Stickyfill from 'stickyfilljs'
class Course {
    constructor() {
        this.slideCtr = new SlideCtr(this);
        this.canGoNext = true;
        this.flexThreshold = 50;
        this.passedIds = [];
        this.slideDisplayType = 'all_at_once';
        this.navType = 'slide';
        this.selectors = selectors;
        this.slides = [];
        this.initedVideos = [];
        this.isLastSlide = false;
        this.isEnd = false;
        this.isStart = false;
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
        showArrow();


    }

    //@TODO rework slides , remove slides from here, add mobx to track slide changes
    collectSlides() {
        const self = this;
        $(this.selectors.slide).each(function (i) {

            let sectionsOrder = [];
            if ($(this).data('section-display') == 'once_at_a_time') {
                $(this).find('.lms-grid-block').each((i, val) => {
                    sectionsOrder.push(i);
                    if ($(val).data('linked-to')) {
                        sectionsOrder.push($(val).data('linked-to') - 1);
                    }
                });
            }
            sectionsOrder = [...new Set(sectionsOrder)];
            sectionsOrder.shift();

            const slide = {
                index: +$(this).data('slide-index'),
                id: $(this).data('slide-id'),
                type: $(this).data('type'),
                active: false,
                sectionDisplay: $(this).data('section-display'),
                sectionOrder: sectionsOrder,
                passed: $(this).data('passed') ? $(this).data('passed') : false,
                latest: $(this).data('latest') ? $(this).data('latest') : false,
            };

            if ($(this).data('type') == 'quiz') {
                slide.inited = false;
                slide.quiz = quizFactory(
                    $(this),
                    $(this).data('quiz-type'),
                    $(this).data('tolerance'),
                    self.CourseInstance);
            }
            self.slides.push(slide);
        });
    }

    initVideo() {
        const self = this;
        if ($.fn.mediaelementplayer) {

            this.slideCtr.current.find('.lms-video-player').each(function (i) {
                const isHiddenControls = $(this).hasClass('lms-video-player--disabled');
                const isAutoplay = $(this).hasClass('autoplay');
                if (isHiddenControls) {
                    $(this).mediaelementplayer({
                        videoWidth: '100%',
                        videoHeight: '100%',
                        enableAutosize: true,
                        pluginPath: 'https://cdnjs.com/libraries/mediaelement/',
                        shimScriptAccess: 'always',
                        alwaysShowControls: false,
                        stretching: 'responsive',
                        features: ['current', 'duration', 'tracks', 'volume', 'fullscreen'],
                        success: function (mediaElement, originalNode, instance) {
                            if (isAutoplay) {
                                console.log('IS AUTOPLAY');
                                instance.play();
                            }
                            self.initedVideos.push({
                                slideIndex: self.slideCtr.current.data('slide-index'),
                                player: instance
                            });
                        }
                    });
                } else {
                    $(this).mediaelementplayer({
                        pluginPath: 'https://cdnjs.com/libraries/mediaelement/',
                        shimScriptAccess: 'always',
                        alwaysShowControls: false,
                        stretching: 'responsive',
                        success: function (mediaElement, originalNode, instance) {
                            if (isAutoplay) {
                                console.log('IS AUTOPLAY');
                                instance.play();
                            }
                            self.initedVideos.push({
                                slideIndex: self.slideCtr.current.data('slide-index'),
                                player: instance
                            });
                        }
                    });
                }
            });
        }
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

        console.log('USER ', this.userId);
        console.log('USER ', this.courseId);
        $.ajax({
            method: "POST",
            url: lmsAjax.ajaxurl,
            data: {
                action: 'progress_get_all',
                user_id: this.userId,
                course_id: this.courseId,
            },
            error: function (request, status, error) {
                // new Alert(request.responseText, 'error');
                console.log('alert');
            }
        }).done(function (json) {
            if (json.error) {
                new Alert(`"${json.error}" please reload page`, 'error');
            }
            console.log(json);
            self.passedIds = json.ids && json.ids[0] != null ? json.ids : [];
            self.setActiveSlideOnInit();
        });
    }

    beforeStarted() {
        console.log('BEFORE STARTED');
        $('.lms-course-controls-start').show();
        $('.lms-slide-control-navigation').addClass('hide-imp');
        $('.lms-section-control-navigation').addClass('hide-imp');
        $('.lms-button-start-course').on('click', (e) => {
            if (e) e.preventDefault();
            Activity.startCourse(this.userId, this.courseId, false);
            this.afterStarted();
        });
    }

    afterStarted() {
        console.log('AFTER STARTED');
        $('.lms-slide-control-navigation').removeClass('hide-imp');
        $('.lms-section-control-navigation').removeClass('hide-imp');
        $('.lms-course-controls-start').remove();
        this.listeners();
        this.isStart = false;
    }

    checkStartStatus() {
        console.log('check START');
        this.isStart = true;
        if (this.courseEl.data('enrollment-status') == 'enrolled') {
            this.beforeStarted();
        } else {
            this.afterStarted();
        }
    }

    setActiveSlideOnInit() {
        const initialSlideIndex = this.getinitialSlideIndex();
        this.showSlide(initialSlideIndex, initialSlideIndex + 1);
        this.checkStartStatus();


        //remove loader when we have slide to show
        this.removePreoader();
    }

    removePreoader() {
        console.log('REMOVE PRELOADRER');
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

    keyboardArrowHandler(e) {
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
    }


    listeners() {
        $('html').on('keydown', this.keyboardArrowHandler.bind(this));
        //$('html').keydown();

        window.addEventListener('popstate', (e) => {
            console.log('CHANGE URL LISTENER');
            var state = e.state;

            try {
                this.showSlide(state.current - 1, state.current, false);
            } catch (e) {
                this.slideCtr.currentByIndex = 0;
            }
        });

        $(document).mousemove(function (event) {
            if (IsFullScreenCurrently()) {
                if (event.pageY >= $(window).height() * 0.8) {
                    $('.lms-course-controls.lms-fullscreen-init').addClass('lms-option-shown');
                } else {
                    $('.lms-course-controls.lms-fullscreen-init').removeClass('lms-option-shown');
                }
            }
        });

        //default ESC button exit fullscreen handler
        const resizeHandler = () => {
            if (!IsFullScreenCurrently()) {
                console.log('HAAAAAAAANDLEDDD');
                this.courseEl.find(this.selectors.courseControls).removeClass('lms-option-shown');
                this.courseEl.removeClass('lms-fullscreen-init');
                this.courseEl.find(this.selectors.courseControls).removeClass('lms-fullscreen-init');
                // this.fullscreenPaintNavButtons(true);

                $('.lms-course').find('p,h1,h2,h3,h4,h5,h6').each(function (i) {
                    var fontSize = $(this).css("fontSize");
                    fontSize = parseInt(fontSize) - 4 + "px";
                    $(this).css("fontSize", fontSize);
                });
            }
        };
        //IDK why but this works
        $('.lms-course').on('webkitfullscreenchange', resizeHandler);
        $(document).on('mozfullscreenchange', resizeHandler);
        $('.lms-course').on('fullscreenchange', resizeHandler);
        $(document).on('MSFullscreenChange', resizeHandler);

        $(this.selectors.shortcodeBackToCourses).on('click', this.shortcodeBackToCourses.bind(this));
        $(this.selectors.shortcodeRestart).on('click', this.shortcodeRestart.bind(this));
        $(this.selectors.shortcodePrev).on('click', this.prevSlide.bind(this));
        $(this.selectors.shortcodeNext).on('click', this.nextSlide.bind(this));
        $(this.selectors.quizCheckButton).on('click', this.checkQuiz.bind(this));
        $(this.selectors.slideNavigation).on('click', '.next', this.nextSlide.bind(this));
        $(this.selectors.sectionNavigation).on('click', '.next', this.nextSection.bind(this));
        $(this.selectors.sectionNavigation).on('click', '.prev', this.prevSlide.bind(this));
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

        lmsConfirmAlert({
            title: 'Do you want restart course?',
            text: '',
        }, () => {
            Activity.redoCourse(this.userId, this.courseId);
        });

    }

    toggleFullscreen(e) {
        if (e) e.preventDefault();

        // console.log('is', IsFullScreenCurrently());
        if (!IsFullScreenCurrently()) {
            GoInFullscreen(this.courseEl[0]);
            this.courseEl.addClass('lms-fullscreen-init');
            this.courseEl.find(this.selectors.courseControls).addClass('lms-fullscreen-init');
            // this.fullscreenPaintNavButtons(true);
            $('.lms-course').find('p,h1,h2,h3,h4,h5,h6').each(function (i) {
                var fontSize = $(this).css("fontSize");
                fontSize = parseInt(fontSize) + 4 + "px";
                $(this).css("fontSize", fontSize);
            });
        } else {

            // $('.lms-course').find('p,h1,h2,h3,h4,h5,h6').each(function (i) {
            //     console.log($(this));
            //     var fontSize = $(this).css("fontSize");
            //     fontSize = parseInt(fontSize) - 4 + "px";
            //     console.log('FZ', fontSize);
            //     $(this).css("fontSize", fontSize);
            // });
            GoOutFullscreen();
            this.courseEl.find(this.selectors.courseControls).removeClass('lms-option-shown');
            this.courseEl.removeClass('lms-fullscreen-init');
            this.courseEl.find(this.selectors.courseControls).removeClass('lms-fullscreen-init');
            //this.fullscreenPaintNavButtons(true);
        }

        this.initedVideos.forEach(i => {
            console.log('player', i);
            setTimeout(() => {
                i.player.setPlayerSize();
            }, 0);
        });
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
        $('.lms-course-controls svg .cls-fill').each(function (i) {
            $(this).css('fill', getColor());
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
            ProgressLogger.commitProgress(this.userId, this.courseId, currentId, 'finished')
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

    removeNotificationFromPrevSteps() {
        console.log('remove');
        $('.iziToast-opened').each(function (i) {
            console.log($(this));
            $(this).find('.iziToast-close').click();
        });
    }

    showSlide(indexSlide, indexHash, changeUrl = true) {
        this.slideCtr.currentByIndex = indexSlide;

        this.slideSectionsCount = this.slideCtr.current.data('section-count');
        this.slideDisplayType = this.slideCtr.current.data('section-display');
        this.currentSection = 1;

        this.checkControls();

        this.removeNotificationFromPrevSteps();
        // this.fullscreenPaintNavButtons();
        const currentId = this.slideCtr.current.data('slide-id');
        if (changeUrl) {
            this.addToUrl(indexHash, {
                current: indexHash,
            });
        }

        this.setSlideSectionDisplay();

        if (!this.isStart) {
            this.setSlideAudio();
        }

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

            if (this.navType == 'slide' && this.isLastSlide) {
                this.endOfCourse();
            }

            console.log('remove CHECK');
            $('.lms-nav-button--prev').removeClass('disabled');
            $('.lms-nav-button--check').removeClass('active');


            if (!this.initedVideos.find(i => i.slideIndex == indexSlide)) {
                this.initVideo();
            }


            this.initedVideos.forEach(i => {
                console.log('player', i);
                setTimeout(() => {
                    i.player.setPlayerSize();
                }, 1);
                if (i.slideIndex != indexSlide) {
                    i.player.pause();
                }
            });

            // setTimeout(() => {
            //     console.log('resize');
            //     $(window).trigger('resize');
            // }, 100);
        }

        this.calculateProgress();
    }

    nextSection(e) {
        const scrollToTopAnim = (scrollDuration, el) => {
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
        if (e) e.preventDefault();
        const slideIndex = this.slideCtr.currentIndex;
        const slide = this.slides.find(i => i.index == slideIndex);
        const slideNode = this.slideCtr.current;
        const slideLayout = slideNode.data('slide-layout');
        const nextSectionIndex = slide.sectionOrder.shift();
        const section = this.slideCtr.current.find(this.selectors.gridBlock).eq(nextSectionIndex);
        const firstAudioBlock = slideNode.find(this.selectors.audioGridBlock).first();
        // console.log(section);
        section.addClass('active');


        if (slideLayout == 'full-width') {
            const myElement = slideNode.find('.lms-grid-container')[0];
            $(myElement).animate({scrollTop: section[0].offsetTop + section.outerHeight()}, 400);
        }


        if (section.data('audio-src') && section[0] != firstAudioBlock[0]) {
            this.courseEl.find(this.selectors.courseControlsAudio).addClass('audio-inited');
            this.playerInstance.setSrc(section.data('audio-src'));
            this.playerInstance.load();
            this.playerInstance.play();
        }


        if (slide.sectionOrder.length <= 0) {
            this.slideCtr.current.addClass('passed');
            this.navType = 'slide';
            this.enableCourseNav();
            this.disableSectionNav();

            if (this.isLastSlide) {
                this.endOfCourse();
            }
        }
    }

    setSlideSectionDisplay() {
        this.checkCourseNavigation();
    }

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

    calculateProgress(current = this.slideCtr.current.index(), amount = this.slideCtr.amount) {
        const courseProgressLine = $(this.selectors.progressBar);
        courseProgressLine.css('width', `${((current + 1) / amount) * 100}%`);
    }

    endOfCourse() {
        console.log('END OF COURSE!!');
        $('.lms-course-controls-end').addClass('is-active');
        $('.lms-slide-control-navigation').hide();
        $('.lms-button-complete-course').on('click', this.confirmCompletionCourse.bind(this));

        //unbind all event listeners
        $('html').off('keydown');
    }

    confirmCompletionCourse(e) {
        if (e) e.preventDefault();
        console.log('COMPLETE OF COURSE ');
        const currentSlide = this.slideCtr.current;
        const currentId = currentSlide.data('slide-id');
        ProgressLogger.commitProgress(this.userId, this.courseId, currentId, 'finished');
        Activity.completeCourse(this.userId, this.courseId);
        ProgressLogger.resetAllCourseProgress(this.userId, this.courseId);
    }

    checkControls() {
        if (this.slideCtr.current.is(':first-child')) {
            $(`${this.selectors.slideNavigation} .prev`).hide();
            $(`${this.selectors.sectionNavigation} .prev`).hide();
        } else {
            $(`${this.selectors.slideNavigation} .prev`).show();
            $(`${this.selectors.sectionNavigation} .prev`).show();
        }

        if (this.slideCtr.current.is(':last-child')) {
            this.isLastSlide = true;
            $(`${this.selectors.slideNavigation} .next`).hide();
        } else {
            $(`${this.selectors.slideNavigation} .next`).show();
        }
    }
}
export default Course;
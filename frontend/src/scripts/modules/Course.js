//
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
        this.slideCtr = new SlideCtr();
        this.urlCrl = UrlCtr;
        this.courseId = $('#course').data('id');
        this.userId = $('#course').data('user-id');
        this.canGoNext = true;
        this.flexThreshold = 50;
    }

    init() {
        console.log('init Course');
        this.getCurrentSlideFromDb();
        //      this.getAnswersFromDB();

    }

    getAnswersFromDB() {
        const self = this;
        $.ajax({
            method: "POST",
            url: lmsAjax.ajaxurl,
            data: {
                action: 'get_course_answers',
                user_id: this.userId,
                course_id: this.courseId,
            },
            error: function (request, status, error) {
                new Alert(request.responseText);
                console.log(request.responseText);
            }
        }).done(function (json) {
            if (json.error) new Alert(`"${json.error}" please reload page`);
            self.formAnswers = json.questions;
            console.log(json);
            console.log(self.formAnswers);
        });
    }

    setActiveSlideOnInit() {

        const initialSlide = this.getinitialSlideIndex();
        // initialSlide.addClass('active');
        // this.checkControls();
        this.showSlide(initialSlide, initialSlide + 1);
        this.listeners();
        $('.slides').addClass('loaded');
    }

    quizSubmit(e) {
        e.preventDefault();

        const form = $(e.target);
        const serialized = form.serializeArray();
        const slide = form.closest('.slide');
        const slideId = slide.data('slide-id');
        const correctAnswersCount = form.data('answers-count');
        let checkedAnswers = [];

        form.find('input[type="checkbox"]:checked').each(function (i) {
            checkedAnswers.push({index: $(this).data('index'), correct: null});
        });

        const self = this;

        $.ajax({
            method: "POST",
            url: lmsAjax.ajaxurl,
            data: {
                action: 'check_options_answer',
                user_id: this.userId,
                slide_id: slideId,
                course_id: this.courseId,
                indexes: checkedAnswers
            },
            error: function (request, status, error) {
                new Alert(request.responseText);
                console.log(request.responseText);
            }
        }).done(function (json) {
            if (json.error) new Alert(`"${json.error}" please reload page`);
            console.log(json);
            checkedAnswers = json.checkedAnswers;
            inputsCheck(checkedAnswers);
            toleranceCheck(checkedAnswers, slide.data('tolerance'));
        });

        const toleranceCheck = (checkedAnswers, tolerance) => {
            console.log(tolerance);
            console.log(checkedAnswers);
            console.log('correct', correctAnswersCount);

            if (tolerance === 'strict') {
                if (checkedAnswers.length > correctAnswersCount || checkedAnswers.length < correctAnswersCount) {
                    new Alert('Please try again', 'info', 3000);
                    return;
                }
                const canGo = checkedAnswers.reduce((acc, current) => {
                    return current.correct;
                }, true);

                if (canGo) {
                    this.canGoNext = true;
                    new Alert('you can go to the next slide', 'success', 3000);
                    return true;
                } else {
                    this.canGoNext = false;
                    new Alert('Please try again', 'info', 3000);
                    return false;
                }

            } else if (tolerance === 'flexible') {
                // correctAnswersCount
                const answeredCorrect = checkedAnswers.reduce((acc, current) => {
                    if (current.correct) acc++;
                    return acc;
                }, 0);

                const percentOfCorrect = Math.round((answeredCorrect / correctAnswersCount) * 100);
                console.log(percentOfCorrect);

                if (percentOfCorrect >= this.flexThreshold) {
                    this.canGoNext = true;
                    new Alert('you can go to the next slide', 'success', 3000);
                    return true;
                } else {
                    this.canGoNext = false;
                    new Alert('Please try again', 'info', 3000);
                    return false;
                }
            } else {
                new Alert('you can go to the next slide', 'info', 3000);
            }
        };

        const inputsCheck = (checkedAnswers) => {
            checkedAnswers.forEach(item => {
                const className = item['correct'] ? 'correct' : 'error';
                form.find(`input[data-index="${item.index}"]`).addClass(className);
            });
        };
    }

    listeners() {
        //@TODO add left/right arrow switching
        $('.slide-navigation .next').on('click', this.nextSlide.bind(this));
        $('.slide-navigation .prev').on('click', this.prevSlide.bind(this));
        $('.slide-fullscreen').on('click', this.toggleFullscreen.bind(this));
        $('.quiz-form').on('submit', this.quizSubmit.bind(this));
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

        console.log(currentId);

        console.log(nextSlide.data('type'));
        if (nextSlide.data('type') == 'quiz') {
            //@TODO check tollerance lvl
            const quiz = new Quiz(
                nextSlide,
                nextSlide.data('quiz-type'),
                nextSlide.data('tolerance'));
            console.log('quiz slide');
        }


        if (this.canGoNext) {
            this.commitActivity(currentId);
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
        console.log('show slide ', indexSlide, indexHash);
        this.slideCtr.currentByIndex = indexSlide;
        this.checkControls();
        this.urlCrl.addToUrl(indexHash, {
            current: indexHash,

        });

        if (this.slideCtr.current.data('type') === 'quiz' && this.slideCtr.current.data('quiz-type') === 'puzzle') {
            console.log('puzzle reinit');
            const grid = new Muuri(".lms-puzzles-grid", {
                dragEnabled: true
                // dragAxis: 'y'
            });
        }
        console.log('showSlide method');
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
            console.log(msg);
        });
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
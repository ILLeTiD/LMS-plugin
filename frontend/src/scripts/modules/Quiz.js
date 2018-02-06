import 'hammerjs'
import Muuri from 'muuri';
import Hint from './Hint'
import Alert from '../utilities/Alerts'

class Quiz {

    constructor(slide, type, tolerance, CourseInstance) {
        this.slide = slide;
        this.slideId = slide.data('slide-id');
        this.type = type;
        this.tolerance = tolerance;
        this.courseId = $('#course').data('id');
        this.userId = $('#course').data('user-id');
        this.CourseInstance = CourseInstance;
        console.log('course instance', CourseInstance);
    }

    init() {
        this.listeners();
        this.hint = this.slide.data('hint');
        console.info('Quiz Inited');
        const hint = new Hint(this.hint);

        if (this.type === 'puzzle') {
            this.initPuzzle();
        }
    }

    listeners() {
        //this.slide.find('.check-answer').on('click', this.checkOptionQuizAnswer.bind(this));
        this.slide.find('.quiz-form-options').on('submit', this.quizSubmitOptions.bind(this));
        this.slide.find('.quiz-form-text_field, .quiz-form-text_area').on('submit', this.quizSubmitText.bind(this));

    }

    quizSubmitOptions(e) {
        e.preventDefault();
        console.log('submitting option form');
        const form = $(e.target);
        const serialized = form.serializeArray();
        const slide = form.closest('.slide');
        const slideId = slide.data('slide-id');
        const correctAnswersCount = form.data('answers-count');
        const inputType = correctAnswersCount == 1 ? 'radio' : 'checkbox';
        let checkedAnswers = [];

        form.find(`input[type="${inputType}"]:checked`).each(function (i) {
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
            optionAnswerAfterCheck(checkedAnswers, slide.data('tolerance'), correctAnswersCount);
        });

        const optionAnswerAfterCheck = (checkedAnswers, tolerance, correctAnswersCount) => {
            if (tolerance === 'strict' || correctAnswersCount == 1) {
                if (checkedAnswers.length > correctAnswersCount || checkedAnswers.length < correctAnswersCount) {
                    new Alert('Please try again', 'info', 3000);
                    return;
                }
                const canGo = checkedAnswers.every((current) => {
                    return current.correct === true;
                });

                if (canGo) {
                    this.CourseInstance.canGoNext = true;
                    new Alert('you can go to the next slide', 'success', 3000);
                    return true;
                } else {
                    this.CourseInstance.canGoNext = false;
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

                if (percentOfCorrect >= this.flexThreshold) {
                    this.CourseInstance.canGoNext = true;
                    new Alert('you can go to the next slide', 'success', 3000);
                    return true;
                } else {
                    this.CourseInstance.canGoNext = false;
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

    quizSubmitText(e) {
        e.preventDefault();
        console.log('submitting text form');
        const form = $(e.target);
        const serialized = form.serializeArray();
        const slide = form.closest('.slide');
        const slideId = slide.data('slide-id');
        const correctAnswersCount = form.data('answers-count');
        const tagType = form.data('form-type') == 'text_field' ? 'input[type="text"]' : 'textarea';
        let checkedAnswers = [];

        form.find(`${tagType}`).each(function (i) {
            checkedAnswers.push({text: $(this).val(), correct: null});
        });

        const self = this;

        $.ajax({
            method: "POST",
            url: lmsAjax.ajaxurl,
            data: {
                action: 'check_text_answer',
                user_id: this.userId,
                slide_id: slideId,
                course_id: this.courseId,
                user_answer: checkedAnswers
            },
            error: function (request, status, error) {
                new Alert(request.responseText);
                console.log(request.responseText);
            }
        }).done(function (json) {
            if (json.error) new Alert(`"${json.error}" please reload page`);
            console.log(json);

        });
        const textAnswerAfterCheck = (checkedAnswers, tolerance, correctAnswersCount) => {
            if (tolerance === 'strict') {
                if (checkedAnswers.length > correctAnswersCount || checkedAnswers.length < correctAnswersCount) {
                    new Alert('Please try again', 'info', 3000);
                    return;
                }
                const canGo = checkedAnswers.every((current) => {
                    return current.correct === true;
                });

                if (canGo) {
                    this.CourseInstance.canGoNext = true;
                    new Alert('you can go to the next slide', 'success', 3000);
                    return true;
                } else {
                    this.CourseInstance.canGoNext = false;
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

                if (percentOfCorrect >= this.flexThreshold) {
                    this.CourseInstance.canGoNext = true;
                    new Alert('you can go to the next slide', 'success', 3000);
                    return true;
                } else {
                    this.CourseInstance.canGoNext = false;
                    new Alert('Please try again', 'info', 3000);
                    return false;
                }
            } else {
                new Alert('you can go to the next slide', 'info', 3000);
            }
        };
    }


    initPuzzle() {
        console.log('init murri');
        const grid = new Muuri(".lms-puzzles-grid", {
            dragEnabled: true
            // dragAxis: 'y'
        });
    }

    refreshPuzzle() {
        grid.layout();
    }
}

export default Quiz;

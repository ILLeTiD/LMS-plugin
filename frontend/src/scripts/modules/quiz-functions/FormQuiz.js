import AbstractQuiz from './AbstractQuiz'
import Alert from '../../utilities/Alerts'
import Hint from './Hint'
class FormQuiz extends AbstractQuiz {
    constructor(slide, type, tolerance, CourseInstance) {
        super(slide, type, tolerance, CourseInstance)
    }

    listeners() {
        //this.slide.find('.check-answer').on('click', this.checkOptionQuizAnswer.bind(this));
        this.slide.find(this.selectors.quizFormOptions).on('submit', this.quizSubmitOptions.bind(this));
        this.slide.find(`${this.selectors.quizFormTextField}, ${this.selectors.quizFormTextArea}`).on('submit', this.quizSubmitText.bind(this));
    }


    quizSubmitOptions(e) {
        e.preventDefault();
        //console.log('submitting option form');
        const form = $(e.target);
        const serialized = form.serializeArray();
        const slide = form.closest(this.selectors.slide);
        const slideId = slide.data('slide-id');
        const correctAnswersCount = form.data('answers-count');
        const inputType = correctAnswersCount == 1 ? 'radio' : 'checkbox';
        let checkedAnswers = [];

        form.find(`input[type="${inputType}"]:checked`).each(function (i) {
            checkedAnswers.push({index: $(this).data('index'), value: $(this).val(), correct: null});
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
                //console.log(request.responseText);
            }
        }).done(function (json) {
            if (json.error) new Alert(`"${json.error}" please reload page`);

            checkedAnswers = json.checkedAnswers;
            inputsCheck(checkedAnswers);
            optionAnswerAfterCheck(checkedAnswers, slide.data('tolerance'), correctAnswersCount);
        });

        const optionAnswerAfterCheck = (checkedAnswers, tolerance, correctAnswersCount) => {
            if (!checkedAnswers) {
                new Alert(lmsAjax.notificationMessages[`${this.type}_quiz_unanswered`].message, lmsAjax.notificationMessages[`${this.type}_quiz_unanswered`].title, 'info', 3000);
                return false;
            }

            if (tolerance === 'strict' || correctAnswersCount == 1) {
                if (checkedAnswers.length > correctAnswersCount || checkedAnswers.length < correctAnswersCount) {
                    new Alert(lmsAjax.notificationMessages[`${this.type}_quiz_fail`].message, lmsAjax.notificationMessages[`${this.type}_quiz_fail`].title, 'error', 3000);
                    return;
                }
                const canGo = checkedAnswers.every((current) => {
                    return current.correct === true;
                });

                if (canGo) {
                    this.afterQuizPassed();
                } else {
                    this.afterQuizFailed();
                }
            } else if (tolerance === 'flexible') {
                // correctAnswersCount
                const answeredCorrect = checkedAnswers.reduce((acc, current) => {
                    if (current.correct) acc++;
                    return acc;
                }, 0);

                const percentOfCorrect = Math.round((answeredCorrect / correctAnswersCount) * 100);

                if (percentOfCorrect >= this.flexThreshold) {
                    this.afterQuizPassed();
                } else {
                    this.afterQuizFailed();
                }
            } else {
                new Alert(lmsAjax.notificationMessages[`quiz_success`].message, lmsAjax.notificationMessages[`quiz_success`].title, 'success', 3000);

            }
        };

        const inputsCheck = (checkedAnswers) => {
            if (checkedAnswers) {
                checkedAnswers.forEach(item => {
                    const className = item['correct'] ? 'correct' : 'error';
                    form.find(`input[data-index="${item.index}"]`).addClass(className);
                });
            } 

        };
    }

    quizSubmitText(e) {
        e.preventDefault();
        //console.log('submitting text form');
        const form = $(e.target);
        const serialized = form.serializeArray();
        const slide = form.closest(this.selectors.slide);
        const slideId = slide.data('slide-id');
        const correctAnswersCount = form.data('answers-count');
        const tagType = form.data('form-type') == 'text_field' ? 'input[type="text"]' : 'textarea';
        let checkedAnswers = [];


        form.find(`${tagType}`).each(function (i) {
            checkedAnswers.push({text: $(this).val(), correct: null});
        });

        const isAllEmpty = checkedAnswers.reduce((acc, val) => val.text == "", true);
        if (isAllEmpty) {
            new Alert(lmsAjax.notificationMessages[`${this.type}_quiz_unanswered`].message, lmsAjax.notificationMessages[`${this.type}_quiz_unanswered`].title, 'info', 3000);
            return false;
        }

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
                //console.log(request.responseText);
            }
        }).done(function (json) {
            if (json.error) new Alert(`"${json.error}" please reload page`);
            //console.log(json);
            self.slide.find(self.selectors.quizForm).removeClass('quiz-passed');

            textAnswerAfterCheck(json.isCorrect, self.tolerance);
            if (json.isCorrect) {
                self.slide.find(self.selectors.quizForm).addClass('quiz-passed');
            }
        });

        const textAnswerAfterCheck = (isCorrect, tolerance,) => {
            const canGo = isCorrect;
            if (tolerance === 'strict' || tolerance === 'flexible') {
                if (canGo) {
                    this.afterQuizPassed();
                } else {
                    this.afterQuizFailed();
                }
            } else {
                this.passed = true;
                this.slide.addClass('passed');
                if (canGo) {
                    new Alert(lmsAjax.notificationMessages[`quiz_success`].message, lmsAjax.notificationMessages[`quiz_success`].title, 'success', 3000);
                } else {
                    new Alert(lmsAjax.notificationMessages[`quiz_success`].message, lmsAjax.notificationMessages[`quiz_success`].title, 'success', 3000);
                }
            }
        };
    }

}

export default FormQuiz;

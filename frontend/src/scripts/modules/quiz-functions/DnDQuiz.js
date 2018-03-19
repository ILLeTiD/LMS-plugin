import dragula from 'dragula';
import AbstractQuiz from './AbstractQuiz'
import Alert from '../../utilities/Alerts'
import Hint from '../Hint'

class DnDQuiz extends AbstractQuiz {
    constructor(slide, type, tolerance, CourseInstance) {
        super(slide, type, tolerance, CourseInstance)
    }

    init() {
        this.listeners();
        this.hint = this.slide.data('hint');
        if (this.hint) {
            const hint = new Hint(this.hint, this.slide);
        }

        console.log("INIT DND!!!!");
        this.initDnD();

    }

    listeners() {
        this.slide.find(this.selectors.quizCheckDnD).on('click', this.checkQuiz.bind(this));
    }

    afterQuizPassed() {
        this.CourseInstance.canGoNext = true;
        this.passed = true;
        this.slide.addClass('passed');
        $('.lms-nav-button--prev').removeClass('disabled');
        $('.lms-nav-button--check').removeClass('active');
        new Alert(lmsAjax.notificationMessages.quiz_success.message, lmsAjax.notificationMessages.quiz_success.title, 'success', 3000);

        if (this.CourseInstance.isLastSlide) {
            this.CourseInstance.endOfCourse();
        }
        return true;

    }

    afterQuizFailed() {
        this.CourseInstance.canGoNext = false;
        new Alert(lmsAjax.notificationMessages.quiz_fail.message, lmsAjax.notificationMessages.quiz_fail.title, 'error', 3000);
        $('.lms-nav-button--prev').addClass('disabled');
        $('.lms-nav-button--check').addClass('active');

        return false;

    }

    initDnD() {
        const self = this;
        const docElem = this.slide[0];
        console.log('Slide EL ', docElem);
        const dnd = docElem.querySelector(this.selectors.dndQuiz);
        this.board = dnd.querySelector('.board');
        const itemContainers = Array.prototype.slice.call(dnd.querySelectorAll('.lms-dnd-dragula'));
        this.columnGrids = [];

        dragula(itemContainers).on('drop', function (el) {
            setTimeout(() => {
                $('.lms-dnd-dragula').each(function (i) {
                    if ($.trim($(this).html()) == '') {
                        $(this).parent().addClass('lms-dnd-quiz-drag__item--empty');
                    } else {
                        $(this).parent().removeClass('lms-dnd-quiz-drag__item--empty');
                    }
                });
            }, 100);
        });
    }

    checkQuiz(e) {
        e.preventDefault();
        const boards = [...this.columnGrids];
        this.statsDnD = [];
        const self = this;


        this.slide.find('.lms-dnd-quiz-drag__object').each(function (i) {
            const isDragged = $(this).parent().parent().hasClass('lms-dnd-quiz-drop__zone');
            const indexToCheck = $(this).parent().parent().data('dz');
            console.log('PARENT ', $(this).parent().parent());
            console.log('IS DRAGGED', isDragged);
            let isCorrect;
            if (indexToCheck == $(this).data('dz')) {
                isCorrect = true;
            }
            if (!isDragged) {
                isCorrect = false;
            }
            self.statsDnD.push({
                boardIndex: indexToCheck,
                itemRealIndex: $(this).data('real-index'),
                itemBoardIndex: $(this).data('dz'),
                correct: isCorrect,
                isDragged: isDragged
            });
        });
        console.log(this.statsDnD);

        const isAllNotMoved = this.statsDnD.every(item => item.isDragged == false);
        console.log('isDragged', isAllNotMoved);

        if (isAllNotMoved) {
            console.log('unaswered');
            new Alert(lmsAjax.notificationMessages.quiz_unanswered.message, lmsAjax.notificationMessages.quiz_unanswered.title, 'info', 3000);
            return false;
        }


        const percentOfCorrect = this.statsDnD.reduce((acc, item, index, arr) => {
            const isCorrect = item.correct;
            const percent = (1 / arr.length) * 100;
            return isCorrect ? acc + percent : acc;
        }, 0);
        const roundedPercentOfCorrect = Math.round(percentOfCorrect);
        console.log('PERCENT OF CORRECT', roundedPercentOfCorrect);
        //console.log(this.tolerance);
        if (this.tolerance == 'strict') {
            if (roundedPercentOfCorrect == 100) {
                this.afterQuizPassed();
            } else {
                this.afterQuizFailed();
            }
        } else if (this.tolerance == 'flexible') {
            if (roundedPercentOfCorrect >= 50) {
                this.afterQuizPassed();
            } else {
                this.afterQuizFailed();
            }
        } else {
            this.afterQuizPassed();
        }
    }
}

export default DnDQuiz;

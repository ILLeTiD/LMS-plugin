import 'hammerjs'
import Muuri from 'muuri';
import Hint from './Hint'

class Quiz {

    constructor(slide, type, tolerance) {
        this.slide = slide;
        this.slideId = slide.data('slide-id');
        this.type = type;
        this.tolerance = tolerance;
        this.courseId = $('#course').data('id');
        this.userId = $('#course').data('user-id');
        this.init();
    }

    init() {
        this.listeners();
        this.hint = this.slide.data('hint');
        console.info('Quiz Inited');
        const hint = new Hint('this.hint');
        if (this.type === 'puzzle') {
            this.initPuzzle();
        }
    }

    listeners() {
        this.slide.find('.check-answer').on('click', this.checkOptionQuizAnswer.bind(this))
    }

    checkOptionQuizAnswer(e) {
        e.preventDefault();

        const userAnswers = [];
        console.log('clicked');
        this.slide.find('input[type=checkbox]:checked').each(function (el) {
            console.log($(this));
            userAnswers.push({
                text : $(this).val(),
                correct: null
            });
        });
        console.log(userAnswers);
        $.ajax(
            {
                method: "POST",
                url: lmsAjax.ajaxurl,
                data: {
                    action: 'check_options_answer',
                    user_id: this.userId,
                    course_id: this.courseId,
                    slide_id: this.slideId,
                    answers: userAnswers
                }
            }
        ).done(function (msg) {
            console.log(msg);
        });
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

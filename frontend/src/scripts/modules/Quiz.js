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
        // console.log('course instance', CourseInstance);
    }

    init() {
        this.listeners();

        this.hint = this.slide.data('hint');
        // console.info('Quiz Inited');
        const hint = new Hint(this.hint, this.slide);

        if (this.type === 'puzzle') {
            this.initPuzzle();
        }
        if (this.type === 'drag_and_drop') {
            this.initDnD();
        }
    }

    listeners() {
        //this.slide.find('.check-answer').on('click', this.checkOptionQuizAnswer.bind(this));
        this.slide.find('.quiz-form-options').on('submit', this.quizSubmitOptions.bind(this));
        this.slide.find('.quiz-form-text_field, .quiz-form-text_area').on('submit', this.quizSubmitText.bind(this));
        this.slide.find('.check-puzzle').on('click', this.checkPuzzle.bind(this));
        this.slide.find('.check-dnd').on('click', this.checkDnD.bind(this));
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
            textAnswerAfterCheck(json.isCorrect, self.tolerance);
        });

        const textAnswerAfterCheck = (isCorrect, tolerance,) => {
            if (tolerance === 'strict' || tolerance === 'flexible') {
                const canGo = isCorrect;

                if (canGo) {
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
        //Array.from(Array(10).keys())
        const gridNode = this.slide.find('.lms-puzzles-grid')[0];


        console.log('init murri');
        console.log('Puzzle grid node ', gridNode);
        this.grid = new Muuri(gridNode, {
            dragEnabled: true
            // dragAxis: 'y'
        });
    }

    checkPuzzle(e) {
        e.preventDefault();
        //make array with numbers from 1 to puzzles length
        const rightPuzzle = [...Array(this.slide.find('.lms-puzzles-grid__item').length).keys()];
        const muuriItems = this.grid.getItems();
        const realIndexes = muuriItems.map(i => {
            return $(i._element).data('index');
        });
        const isCorrect = realIndexes.every((item, index) => rightPuzzle[index] == item);

        if ((this.tolerance == 'strict' || this.tolerance == 'flexifble') && isCorrect) {
            this.CourseInstance.canGoNext = true;
            new Alert('You can go to the next slide', 'success', 3000);
        } else {
            this.CourseInstance.canGoNext = false;
            new Alert('Please try again', 'error', 3000);
        }
        console.log('Is puzzle correct? ', isCorrect)
    }

    refreshPuzzle() {
        this.grid.layout();
    }

    initDnD() {
        const self = this;
        const docElem = this.slide[0];
        const dnd = document.querySelector('.dnd-quiz');
        this.board = dnd.querySelector('.board');
        const itemContainers = Array.prototype.slice.call(dnd.querySelectorAll('.board-column-content'));
        this.columnGrids = [];
        this.dragCounter = 0;
        let boardGrid;

        itemContainers.forEach(function (container, index) {

            var muuri = new Muuri(container, {
                items: '.board-item',
                layoutDuration: 400,
                layoutEasing: 'ease',
                dragEnabled: true,
                dragSort: function () {
                    return self.columnGrids;
                },
                dragSortInterval: 0,
                dragContainer: document.body,
                dragReleaseDuration: 400,
                dragReleaseEasing: 'ease'
            })
                .on('dragStart', function (item) {
                    ++self.dragCounter;
                    docElem.classList.add('dragging');
                    item.getElement().style.width = item.getWidth() + 'px';
                    item.getElement().style.height = item.getHeight() + 'px';
                })
                .on('dragEnd', function (item) {
                    if (--this.dragCounter < 1) {
                        docElem.classList.remove('dragging');
                    }
                })
                .on('dragReleaseEnd', function (item) {
                    item.getElement().style.width = '';
                    item.getElement().style.height = '';
                    self.columnGrids.forEach(function (muuri) {
                        muuri.refreshItems();
                    });
                })
                .on('layoutStart', function () {
                    boardGrid.refreshItems().layout();
                });

            self.columnGrids.push(muuri);

        });
        console.log(this);
        console.log('this ', this.columnGrids);
        console.log('self ', self.columnGrids);

        boardGrid = new Muuri(this.board, {
            layoutDuration: 400,
            layoutEasing: 'ease',
            dragEnabled: false,
            dragSortInterval: 0,
            dragStartPredicate: {
                handle: '.board-column-header'
            },
            dragReleaseDuration: 400,
            dragReleaseEasing: 'ease'
        });
    }

    checkDnD(e) {
        e.preventDefault();
        const boards = [...this.columnGrids];
        this.statsDnD = [];

        boards.forEach((board, index) => {
            const items = board.getItems();
            const indexToCheck = index;
            const indexes = items.forEach(i => {
                console.log(this.statsDnD);
                this.statsDnD.push({
                    boardIndex: indexToCheck,
                    itemRealIndex: $(i._element).data('real-index'),
                    itemBoardIndex: $(i._element).data('dz'),
                    correct: indexToCheck == $(i._element).data('dz')
                });
            });
            // console.log('stats ', this.statsDnD);
        });

        const percentOfCorrect = this.statsDnD.reduce((acc, item, index, arr) => {
            const isCorrect = item.correct;
            const percent = (1 / arr.length) * 100;
            console.log(percent);
            console.log(arr.length);
            console.log(isCorrect);
            return isCorrect ? acc + percent : acc;
        }, 0);
        const roundedPercentOfCorrect = Math.round(percentOfCorrect);
        console.log(this.tolerance);
        if (this.tolerance == 'strict') {
            if (roundedPercentOfCorrect == 100) {
                this.CourseInstance.canGoNext = true;
                new Alert('Correct. You can go next', 'success', 3000);
                return false;
            } else {
                this.CourseInstance.canGoNext = false;
                new Alert('Please try again', 'info', 3000);
                return false;
            }
        } else if (this.tolerance == 'flexible') {
            if (roundedPercentOfCorrect >= 50) {
                this.CourseInstance.canGoNext = true;
                new Alert('Correct. You can go next', 'success', 3000);
                return false;
            } else {
                this.CourseInstance.canGoNext = false;
                new Alert('Please try again', 'info', 3000);
                return false;
            }
        }
        console.log('Rounded percent of correct answers', roundedPercentOfCorrect);
    }
}

export default Quiz;

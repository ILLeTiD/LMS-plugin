import 'hammerjs'
import Muuri from 'muuri';
import Alert from '../../utilities/Alerts'
import Hint from '../Hint'
import AbstractQuiz from './AbstractQuiz'
import QuizResultSaver from './QuizResultSaver'

class PuzzleQuiz extends AbstractQuiz {
    constructor(slide, type, tolerance, CourseInstance) {
        super(slide, type, tolerance, CourseInstance)
    }

    init() {
        this.listeners();
        this.hint = this.slide.data('hint');
        if (this.hint) {
            const hint = new Hint(this.hint, this.slide);
        }

        this.initPuzzle();

    }

    listeners() {
        this.slide.find(this.selectors.quizCheckPuzzle).on('click', this.checkQuiz.bind(this));
    }

    initPuzzle() {
        //Array.from(Array(10).keys())
        const gridNode = this.slide.find(this.selectors.puzzleGrid)[0];

        this.grid = new Muuri(gridNode, {
            dragEnabled: true
            // dragAxis: 'y'
        });
    }

    checkQuiz(e) {
        e.preventDefault();
        //make array with numbers from 1 to puzzles length
        const rightPuzzle = [...Array(this.slide.find(this.selectors.puzzleGridItem).length).keys()];
        const muuriItems = this.grid.getItems();
        const realIndexes = muuriItems.map(i => {
            return $(i._element).data('index');
        });
        const isCorrect = realIndexes.every((item, index) => rightPuzzle[index] == item);

        if ((this.tolerance == 'strict' || this.tolerance == 'flexifble') && isCorrect) {
            QuizResultSaver.save(this.CourseInstance.userId, this.CourseInstance.courseId, this.slide.data('slide-id'), [{
                value: rightPuzzle,
                correct: true,
                type: "puzzle",
                tolerance: this.tolerance
            }]);
            this.afterQuizPassed();

        } else {
            this.afterQuizFailed();
        }
        //console.log('Is puzzle correct? ', isCorrect)
    }

    refreshPuzzle() {
        this.grid.layout();
    }

}

export default PuzzleQuiz;

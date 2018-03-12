import DnDQuiz from './DnDQuiz'
import FormQuiz from './FormQuiz'
import PuzzleQuiz from './PuzzleQuiz'
export default (slide, type, tolerance, CourseInstance) => {
    switch (type) {
        case 'puzzle':
            return new PuzzleQuiz(slide, type, tolerance, CourseInstance);
            break;
        case 'drag_and_drop':
            return new DnDQuiz(slide, type, tolerance, CourseInstance);
            break;
        case 'forms':
            return new FormQuiz(slide, type, tolerance, CourseInstance);
            break;
    }
}
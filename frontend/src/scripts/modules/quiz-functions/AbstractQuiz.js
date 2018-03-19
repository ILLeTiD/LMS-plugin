//reference to new quiz types

import Hint from '../Hint'
import Alert from '../../utilities/Alerts'
import {selectors} from '../selectors'
class AbstractQuiz {
    constructor(slide, type, tolerance, CourseInstance) {
        this.slide = slide;
        this.slideId = slide.data('slide-id');
        this.type = type;
        this.tolerance = tolerance;
        this.selectors = selectors;
        this.courseId = $(this.selectors.course).data('id');
        this.userId = $(this.selectors.course).data('user-id');
        this.CourseInstance = CourseInstance;
        this.passed = null;
    }

    init() {
        this.listeners();
        this.hint = this.slide.data('hint');
        if (this.hint) {
            const hint = new Hint(this.hint, this.slide);
        }
    }

    listeners() {
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

    checkQuiz(e) {

    }
}

export default AbstractQuiz;

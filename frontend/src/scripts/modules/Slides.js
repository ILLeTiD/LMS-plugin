import quizFactory from './quiz-functions/quizFactory'
import {selectors} from './selectors'
class Slides {
    slides = [];
    selectors = selectors;
    constructor(CourseInstance) {
        this.CourseInstance = CourseInstance;
        this.collectSlides();
    }

    collectSlides() {
        $(this.selectors.slide).each((index, element) => {
            let sectionsOrder = [];
            if ($(element).data('section-display') == 'once_at_a_time') {
                $(element).find('.lms-grid-block').each((i, val) => {
                    sectionsOrder.push(i);
                    if ($(val).data('linked-to')) {
                        sectionsOrder.push($(val).data('linked-to') - 1);
                    }
                });
            }
            sectionsOrder = [...new Set(sectionsOrder)];
            sectionsOrder.shift();

            const slide = {
                index: +$(element).data('slide-index'),
                id: $(element).data('slide-id'),
                type: $(element).data('type'),
                active: false,
                sectionDisplay: $(element).data('section-display'),
                sectionOrder: sectionsOrder,
                passed: $(element).data('passed') ? $(element).data('passed') : false,
                latest: $(element).data('latest') ? $(element).data('latest') : false,
                quiz : false,
            };

            if ($(element).data('type') == 'quiz') {
                slide.inited = false;
                slide.quiz = quizFactory(
                    $(element),
                    $(element).data('quiz-type'),
                    $(element).data('tolerance'),
                    this.CourseInstance);
            }
            this.slides.push(slide);
        });
    }

    get amount() {
        return this.slides.length;
    }

    get current() {
        return $('.lms-slide.active');
    }

    get currentIndex() {
        return $('.lms-slide.active').data('slide-index');
    }

    set currentByIndex(index) {
        $('.lms-slide.active').removeClass('active');
        $(`.lms-slide[data-slide-index=${index}]`).addClass('active');
    }

    set currentById(id) {
        $('.lms-slide.active').removeClass('active');
        $(`.lms-slide[data-slide-id=${id}]`).addClass('active');
    }

    goToIndex(index) {
        this.currentByIndex = index;
    }
}
export default Slides;

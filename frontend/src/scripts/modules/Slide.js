import Quiz from './Quiz'

class Slide {
    constructor(CourseInstance) {
        this.CourseInstance = CourseInstance;
        this.collectSlidesIds();
    }

    collectSlidesIds() {
        const self = this;
        let slides = [];
        let quizes = [];
        $('#lms-course .lms-slide').each(function (i) {
            slides.push({
                index: +$(this).data('slide-index'),
                id: $(this).data('slide-id'),
                type: $(this).data('type'),
                sectionDisplay: $(this).data('section-display')
            });

            if ($(this).data('type') == 'quiz') {
                quizes.push({
                    index: +$(this).data('slide-index'),
                    id: $(this).data('slide-id'),
                    inited: false,
                    passed: false,
                    quiz: new Quiz(
                        $(this),
                        $(this).data('quiz-type'),
                        $(this).data('tolerance'),
                        self.CourseInstance)

                });
            }
        });

        this.slides = slides;
        this.quizes = quizes;
    }

    get amount() {
        return this.slides.length;
    }

    get current() {
        return $('.lms-slide.active');
    }

    set currentByIndex(index) {
        //console.log('set current by index');
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
export default Slide;

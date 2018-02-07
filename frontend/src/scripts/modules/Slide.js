import Quiz from './Quiz'

class Slide {
    constructor(CourseInstance) {
        this.CourseInstance = CourseInstance;
        console.log('slide constructed!');
        console.log(CourseInstance);
        this.collectSlidesIds();
    }

    collectSlidesIds() {
        const self = this;
        let slides = [];
        let quizes = [];
        $('#course .slide').each(function (i) {
            slides.push({
                index: $(this).index(),
                id: $(this).data('slide-id'),
                type: $(this).data('type'),
            });

            if ($(this).data('type') == 'quiz') {
                quizes.push({
                    index: $(this).index(),
                    id: $(this).data('slide-id'),
                    inited: false,
                    passed: false,
                    quiz: new Quiz(
                        $(this),
                        $(this).data('quiz-type'),
                        $(this).data('tolerance'),
                        self.CourseInstance)

                });

                console.log('quiz slide');
            }
        });

        this.slides = slides;
        this.quizes = quizes;
    }

    get amount() {
        return this.slides.length;
    }

    get current() {
        return $('.slide.active');
    }

    set currentByIndex(index) {
        console.log('set current by index');
        $('.slide.active').removeClass('active');
        $('.slide').eq(index).addClass('active');
    }

    set currentById(id) {
        console.log('set current by ID');
        $('.slide.active').removeClass('active');
        $(`.slide[data-slide-id=${id}]`).addClass('active');
    }

    goToIndex(index) {
        this.currentByIndex = index;
    }
}
export default Slide;

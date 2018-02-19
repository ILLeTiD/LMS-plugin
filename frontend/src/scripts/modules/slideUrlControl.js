class stepsUrlControl {

    constructor(SlideCtrl, Course) {
        this.Course = Course;
        this.SlideCtrl = SlideCtrl;
        //console.log('URL SLIDE CTRL ', this.SlideCtrl);
        this.changeUrlListen();
        //console.log('init Url step controller');
    }

    addToUrl(part, obj = {}) {
        const index = $('.lms-form-step.active').index();
        const current = index + 1;
        const amount = $('.lms-form-step').length;

        var stateObj;
        if ($.isEmptyObject(obj)) {
            stateObj = {
                current: current,
                amount: amount,
            };
        } else {
            stateObj = obj;
        }

        history.pushState(stateObj, `Step ${part}`, `#slide${part}`);
    }

    changeUrlListen() {
        // const UI = new FormUI();

        window.addEventListener('popstate', (e) => {
            var state = e.state;
            //console.log('STATE !1!', e.state);

            // if (state.current > (this.SlideCtrl.current.index() + 1)) {
            //     this.Course.nextSlide();
            // } else {
            //     this.Course.prevSlide();
            // }

            // UI.showStepByIndex(state.current - 1);

            try {
                this.SlideCtrl.currentByIndex = state.current - 1;
            } catch (e) {
                this.SlideCtrl.currentByIndex = 0;
            }
        });
    }
}

export default stepsUrlControl;
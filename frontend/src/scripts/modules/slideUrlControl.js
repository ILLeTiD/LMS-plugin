class stepsUrlControl {

    constructor(SlideCtrl, Course) {
        this.Course = Course;
        this.SlideCtrl = SlideCtrl;
        this.changeUrlListen();
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
        window.addEventListener('popstate', (e) => {
            var state = e.state;

            try {
                this.Course.showSlide(state.current, state.current, false);
            } catch (e) {
                this.SlideCtrl.currentByIndex = 0;
            }
        });
    }
}

export default stepsUrlControl;
const stepsUrlControl = {
    addToUrl(part, obj = {}) {
        const index = $('.form-step.active').index();
        const current = index + 1;
        const amount = $('.form-step').length;

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
    },

    initStepUrl()  {
        const UI = new FormUI();

        const hash = window.location.hash;
        if (hash && hash.indexOf('#step') != -1) {
            const stepToShow = +hash.substr(5);
            console.log(+formOptions.amount, stepToShow);

            if (stepToShow > +formOptions.amount) {
                history.replaceState({current: 1}, `Step ${1}`, `#slide${1}`);
                UI.showStepByIndex(0);
            } else {
                // this.addToUrl(stepToShow, {current: stepToShow});
                UI.showStepByIndex(stepToShow - 1);
            }
            console.log(+stepToShow);
            // UI.showStepByIndex(state.current - 1);
        } else {
            this.addToUrl(1, {current: 1,});
        }
    },

    changeUrlListen () {
        const UI = new FormUI();

        window.addEventListener('popstate', function (e) {
            var state = e.state;

            // if (state.current > (formOptions.current.index() + 1)) {
            //     UI.showNext();
            // } else {
            //     UI.showPrevStep();
            // }

            // UI.showStepByIndex(state.current - 1);

            try {
                UI.showStepByIndex(state.current - 1);
            } catch (e) {
                UI.showStepByIndex(0);
            }
        });
    },
};

export default stepsUrlControl;
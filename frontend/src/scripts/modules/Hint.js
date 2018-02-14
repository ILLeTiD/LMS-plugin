import iziToast from 'izitoast'
import Popper from 'popper.js'
import Tooltip from 'tooltip.js'

class Hint {
    constructor(message, slide, timeOut = 5000) {
        this.message = message;
        this.slide = slide;
        this.timeOut = timeOut;
        this.hintRefference = this.slide.find('.quiz__hint');
        this.tooltip = new Tooltip(this.hintRefference, {
            placement: "bottom right",
            title: "The hint will appear 30 seconds after starting slide",
            trigger: "click",
        });
        this.startTimer();

        console.info('Hint inited!', this.message);
    }

    startTimer() {
        const self = this;
        self.hintRefference.on('click', function (e) {
            e.preventDefault();
        });

        this.timer = setTimeout(() => {
            self.hintRefference.on('click', function (e) {
                e.preventDefault();
                self.tooltip._tooltipNode.innerText = self.message;
            });

            self.tooltip.options.title = 'Stuck? Click to reveal a hint';
            self.tooltip.show();
        }, this.timeOut);
    }

    removeTimer() {
        //console.log(this.timer);
        clearTimeout(this.timer);
    }
}
export default  Hint;

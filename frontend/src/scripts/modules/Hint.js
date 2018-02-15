import iziToast from 'izitoast'
import Popper from 'popper.js'
import Tooltip from 'tooltip.js'

class Hint {
    constructor(message, slide, timeOut = 30000) {
        this.message = message;
        this.slide = slide;
        this.timeOut = timeOut;
        this.hintRefference = this.slide.find('.quiz__hint');
        this.tooltip = new Tooltip(this.hintRefference, {
            placement: "bottom right",
            title: "The hint will appear 30 seconds after starting slide",
            trigger: "click",
            offset: "10px"
        });
        this.startTimer();

        console.info('Hint inited!', this.tooltip);
    }

    startTimer() {
        // this.tooltip.update();
        const self = this;
        self.hintRefference.on('click', function (e) {
            e.preventDefault();
        });

        this.timer = setTimeout(() => {
            self.hintRefference.on('click', function (e) {
                e.preventDefault();
                self.tooltip._tooltipNode.innerHTML = `<div class="tooltip-inner">${self.message}</div> `;
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

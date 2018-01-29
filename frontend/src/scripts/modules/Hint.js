import iziToast from 'izitoast'
class Hint {
    constructor(message, timeOut = 5000) {
        this.message = message;
        this.timeOut = timeOut;
        this.startTimer();
    }

    startTimer() {
        this.timer = setTimeout(() => {
            iziToast.show({
                title: 'Hint',
                message: this.message,
                timeout: this.timeOut,
                toastOnce: false,
                position: 'topRight',
                theme: 'dark',
            });
        }, this.timeOut);
    }

    removeTimer() {
        console.log(this.timer);
        clearTimeout(this.timer);
    }
}
export default  Hint;

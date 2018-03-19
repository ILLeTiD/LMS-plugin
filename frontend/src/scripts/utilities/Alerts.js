import iziToast from './iziToast.js'

class Alert {
    constructor(message, title = '', type = 'error', timeOut = 50000) {
        this.message = message;
        this.timeOut = timeOut;
        this.type = type;
        this.title = title;
        this.showAlert();
    }

    showAlert() {
        switch (this.type) {
            case 'error' :
                iziToast.error({
                    title: this.title ? this.title : lmsAjax.notificationMessages.error.title,
                    message: this.message,
                    position: 'topRight',
                });
                break;
            case 'success' :
                iziToast.success({
                    title: this.title ? this.title : 'OK',
                    message: this.message,
                    position: 'topRight',
                });
                break;
            case 'warning' :
                iziToast.warning({
                    title: this.title ? this.title : 'Caution',
                    message: this.message,
                    position: 'topRight',
                });
                break;
            case 'info' :
                iziToast.warning({
                    title: this.title ? this.title : 'Info',
                    message: this.message,
                    position: 'topRight',
                });
                break;
        }
    }
}
export default  Alert;

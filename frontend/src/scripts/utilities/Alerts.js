import iziToast from 'izitoast'
class Alert {
    constructor(message, type = 'error', timeOut = 5000) {
        this.message = message;
        this.timeOut = timeOut;
        this.type = type;
        this.showAlert();
    }

    showAlert() {
        switch (this.type) {
            case 'error' :
                iziToast.error({
                    title: 'Error',
                    message: this.message,
                    position: 'topRight',
                });
                break;
            case 'success' :
                iziToast.success({
                    title: 'OK',
                    message: this.message,
                    position: 'topRight',
                });
                break;
            case 'warning' :
                iziToast.warning({
                    title: 'Caution',
                    message: this.message,
                    position: 'topRight',
                });
                break;
        }
    }
}
export default  Alert;

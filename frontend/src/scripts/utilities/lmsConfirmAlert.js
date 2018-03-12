import swal from 'sweetalert2'
export default ({title, text}, callback) => {
    swal({
        title,
        text,
        showCancelButton: true,
        backdrop: `rgba(0,0,0,0.0)`,
    }).then((result) => {
        console.log(result);

        if (result.value && callback) {
            callback();
        }

    });
}
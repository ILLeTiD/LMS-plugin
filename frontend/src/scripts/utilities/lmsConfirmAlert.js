import swal from 'sweetalert2'
export default ({title, text}, callback) => {
    swal({
        title,
        text,
        showCancelButton: true,
        confirmButtonText: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80"><defs><style>.cls-1{fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:3px;}</style></defs><title>Check</title><g id="Arrow-right"><polyline class="cls-1" points="28 40.96 35.52 49.23 52 31.11"/></g></svg>',
        confirmButtonAriaLabel: 'Ok, great!',
        cancelButtonText: '<svg id="Close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80"><defs><style>.cls-1{fill:none;stroke:#000;stroke-linecap:round;stroke-miterlimit:10;stroke-width:3px;}</style></defs><title>Close</title><line class="cls-1" x1="28.41" y1="51.42" x2="51.59" y2="28.23"/><line class="cls-1" x1="51.59" y1="51.42" x2="28.41" y2="28.23"/></svg>',
        cancelButtonAriaLabel: 'Close',
        confirmButtonColor: 'transparent',
        cancelButtonColor: 'transparent',
        buttonsStyling: false,
        backdrop: `rgba(0,0,0,0.0)`,
    }).then((result) => {
        console.log(result);

        if (result.value && callback) {
            callback();
        }

    });
}
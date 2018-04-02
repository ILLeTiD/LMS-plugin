import lmsConfirmAlert from '../utilities/lmsConfirmAlert'
import swal from 'sweetalert2'
class ProfilePage {
    constructor() {
        this.user_id = lmsAjax.userID;

        console.log('USER ID', this.user_id);
        console.log('test!!1');
    }

    init() {
        this.listeners();
        this.fetchProfileFields();
    }

    listeners() {

        console.log('listeners!!1');
        $("#lms-user-form").validate({
            rules: {
                newPass: {
                    required: true,
                    minlength: 6,


                },

                confirmPass: {
                    equalTo: "#newPass",
                    minlength: 6,
                },


            },
            messages: {
                password: {
                    required: "the password is required"

                }
            }

        });
        $('.change-pass').on('change', (e) => {
            const $this = $(e.target);
            console.log($this);
            $('.lms-form-passwords').toggle();
            $('#newPass,#confirmPass').each(function (i) {
                if ($(this).attr('disabled')) {
                    $(this).removeAttr('disabled');
                } else {
                    $(this).attr('disabled', 'true');
                }
            });
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#lms-user-form-avatar-image').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#lms-user-form-avatar input").change(function () {
            readURL(this);
        });


        $(".lms-user-delete-account__button").on('click', (e) => {
            if (e) e.preventDefault();
            swal({
                title: 'Do you want to delete account? ',
                text: 'type your password to confirm',
                input: 'password',
                showCancelButton: true,
                confirmButtonText: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80"><defs><style>.cls-1{fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:3px;}</style></defs><title>Check</title><g id="Arrow-right"><polyline class="cls-1" points="28 40.96 35.52 49.23 52 31.11"/></g></svg>',
                confirmButtonAriaLabel: 'Ok, great!',
                cancelButtonText: '<svg id="Close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80"><defs><style>.cls-1{fill:none;stroke:#000;stroke-linecap:round;stroke-miterlimit:10;stroke-width:3px;}</style></defs><title>Close</title><line class="cls-1" x1="28.41" y1="51.42" x2="51.59" y2="28.23"/><line class="cls-1" x1="51.59" y1="51.42" x2="28.41" y2="28.23"/></svg>',
                cancelButtonAriaLabel: 'Close',
                confirmButtonColor: 'transparent',
                cancelButtonColor: 'transparent',
                buttonsStyling: false,
                backdrop: `rgba(0,0,0,0.0)`,
                showLoaderOnConfirm: true,
                preConfirm: (paswword) => {
                    return new Promise((resolve) => {
                        $.ajax(
                            {
                                method: "POST",
                                url: lmsAjax.ajaxurl,
                                data: {
                                    action: 'removeUser',
                                    user_id: this.user_id,
                                    userpass: paswword
                                }
                            }
                        ).done(function (json) {
                            console.log('logged out', json
                            );
                            if (json.correct == true) {
                                // swal.showValidationError(
                                //     'This password correct.'
                                // );
                                //     resolve();
                            } else {
                                swal.showValidationError(
                                    'This password incorrect.'
                                )
                            }
                            resolve();
                        });
                    })
                },
                allowOutsideClick: () => !swal.isLoading()
            }).then((result) => {
                if (result.value) {
                    swal({
                        type: 'success',
                        title: 'Account was deleted!',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    setTimeout(() => {
                        window.location.href = lmsAjax.homeUrl;
                    }, 1500);
                }
            });
            // lmsConfirmAlert({
            //     title: 'Do you want to delete account? ',
            //     text: '',
            // }, () => {
            //     $.ajax(
            //         {
            //             method: "POST",
            //             url: lmsAjax.ajaxurl,
            //             data: {
            //                 action: 'removeUser',
            //                 user_id: this.user_id
            //             }
            //         }
            //     ).done(function (json) {
            //         console.log('logged out', json
            //         );
            //         window.location.href = lmsAjax.homeUrl;
            //     });
            // });
        });


    }

    checkPasswords() {
        const newPassField = $('.newPass');
        const reTyped = $('.confirmPass');

        console.log('old val ', newPassField.val());
        console.log('old val ', reTyped.val());
        if (newPassField.val() != reTyped.val()) {

        }
    }

    fetchProfileFields() {
        // $.ajax(
        //     {
        //         method: "POST",
        //         url: lmsAjax.ajaxurl,
        //         data: {
        //             action: 'load_user_profile_field',
        //             user_id: this.user_id
        //         }
        //     }
        // ).done((json) => {
        //     console.log(json);
        //     if (json.error) new Alert(`"${json.error}" please reload page`);
        //
        // });
    }
}

export  default ProfilePage;
import lmsConfirmAlert from '../utilities/lmsConfirmAlert'
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
            lmsConfirmAlert({
                title: 'Do you want to delete account? ',
                text: '',
            }, () => {
                $.ajax(
                    {
                        method: "POST",
                        url: lmsAjax.ajaxurl,
                        data: {
                            action: 'removeUser',
                            user_id: this.user_id
                        }
                    }
                ).done(function (json) {
                    console.log('logged out', json
                    );
                    window.location.href = lmsAjax.homeUrl;
                });
            });
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
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
        $('.lms-user-profile-edit__form').on('submit', function (e) {
            if ($('.change-pass').attr("checked")) {
                console.log('test')
            }
            e.preventDefault();
        });
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
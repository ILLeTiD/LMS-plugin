class ProfilePage {
    constructor() {
        this.user_id = lmsAjax.userID;

        console.log('USER ID', this.user_id);
    }

    init() {
        this.listeners();
        this.fetchProfileFields();
    }

    listeners() {

    }

    fetchProfileFields() {
        $.ajax(
            {
                method: "POST",
                url: lmsAjax.ajaxurl,
                data: {
                    action: 'load_user_profile_field',
                    user_id: this.user_id
                }
            }
        ).done((json) => {
            console.log(json);
            if (json.error) new Alert(`"${json.error}" please reload page`);

        });
    }
}

export  default ProfilePage;
import flatpickr from "flatpickr";
import {observable, computed, action} from 'mobx';
class ActivityPage {
    @observable   userID = lmsAjax.userID;
    @observable filters = {
        user_id: this.userID,
        from_date: '',
        to_date: '',
    };

    constructor() {
    }

    init() {
        console.log('ACTIVITY INITED');

        this.activityItems = [];
        this.initDatePickers();
        this.initialActivityLoad()
    }

    initDatePickers() {
        $(".lms-activity-filter-datepicked").flatpickr({
            maxDate: "today"
        });
    }

    initialActivityLoad() {
        const self = this;
        $.ajax(
            {
                method: "POST",
                url: lmsAjax.ajaxurl,
                data: {
                    action: 'load_user_activity',
                    filters: this.filters
                }
            }
        ).done((json) => {
            if (json.error) new Alert(`"${json.error}" please reload page`);
            console.log('commited slide activity ', json);
            this.activityItems = json.items;
            console.log(this.activityItems);
        });
    }

    loadActivityItems() {
        $.ajax(
            {
                method: "POST",
                url: lmsAjax.ajaxurl,
                data: {
                    action: 'load_user_activity',
                    filters: this.filters
                }
            }
        ).done(function (json) {
            if (json.error) new Alert(`"${json.error}" please reload page`);
            console.log('commited slide activity ', json);
        });
    }

    listeners() {

    }
}

export default ActivityPage

import flatpickr from "flatpickr";
import {observable, computed, autorun, action, reaction, observe} from 'mobx';
import moment from 'moment';
import  'moment/locale/sv'
import Alert from '../utilities/Alerts'
class ActivityPage {
    constructor() {
    }

    userID = lmsAjax.userID;
    @observable filters = {
        user_id: this.userID,
        from_date: '',
        to_date: '',
        type: ''
    };
    @observable items = [];

    init() {
        moment.locale($('html').attr('lang'));
        //using mobX to manage state more at https://mobx.js.org/refguide/autorun.html
        autorun(
            () => {
                return this.loadActivityItems(this.filters)
            }
        );
        autorun(
            () => {
                $('.lms-activity-list').html('');
                return this.items.forEach(item => this.renderActivityItem(item.type, item.text, item.date))
            }
        );

        this.initDatePickers();
        this.listeners();
    }

    initDatePickers() {
        $(".lms-activity-filter-datepicked").flatpickr({
            maxDate: "today"
        });
    }

    renderActivityItem(type, message, date) {
        $('.lms-activity-list').append(`
                <div class="lms-activity-item">
                    <div class="lms-activity-item__wrapper">
                        <div class="lms-activity-item__ico">
                            ${type}
                        </div>
                        <div class="lms-activity-item__message">
                            ${message}
                        </div>
                        <div class="lms-activity-item__date">
                            ${moment(date).fromNow()}
                        </div>
                    </div>
                </div>
        `)
    }

    loadActivityItems(filters) {
        $.ajax(
            {
                method: "POST",
                url: lmsAjax.ajaxurl,
                data: {
                    action: 'load_user_activity',
                    filters: filters
                }
            }
        ).done((json) => {
            if (json.error) new Alert(`"${json.error}" please reload page`);
            setTimeout(() => {
                this.items = json.items;
            }, 2000);
        });
    }

    listeners() {
        $('#activity-filter-type').on('change', (e) => {
            this.filters.type = e.target.value
        });

        $('.lms-activity-filter--date-from input').on('change', (e) => {
            this.filters.from_date = e.target.value
        });

        $('.lms-activity-filter--date-to input').on('change', (e) => {
            this.filters.to_date = e.target.value
        })

    }
}

export default ActivityPage

import flatpickr from "flatpickr";
import {observable, autorun} from 'mobx';
import moment from 'moment';
import tippy from 'tippy.js'
// import  'moment/locale/sv'
import Alert from '../../utilities/Alerts'
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
                if (this.items.length > 0) {
                    return this.items.forEach(item => this.renderActivityItem(item.type, item.text, item.date));
                } else {
                    $('.lms-activity-list').append(`
                     <div class="lms-activity-item lms-activity-item--not-found">
                        <div class="lms-activity-item__wrapper">
                            <div class="lms-activity-item__ico">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
                                <defs>
                                    <style>
                                        .cls-1,.cls-2,.cls-3{fill:none;stroke:#fff;stroke-linecap:round;stroke-width:3px;}.cls-1,.cls-2{stroke-miterlimit:10;}.cls-1,.cls-3{fill-rule:evenodd;}.cls-3{stroke-linejoin:round;}
                                    </style>
                                </defs>
                                <title>Help</title>
                                <g id="Home">
                                    <path class="cls-1" d="M34.42,30.58a5.58,5.58,0,1,1,8.17,4.94A4.79,4.79,0,0,0,40,39.75v1"/>
                                    <circle class="cls-2" cx="40" cy="46.65" r="0.35"/>
                                    <path class="cls-3"
                                          d="M53.28,54.59H45l-5,7-5-7H26.72a5.52,5.52,0,0,1-5.52-5.52V22.51A5.52,5.52,0,0,1,26.72,17H53.28a5.52,5.52,0,0,1,5.52,5.51V49.07A5.52,5.52,0,0,1,53.28,54.59Z"/>
                                </g>
                            </svg>
                             </div>
                            <div class="lms-activity-item__message">
                                
                            </div>
                            <div class="lms-activity-item__date">
                               
                            </div>
                        </div>
                    </div>
                    `);
                }
                return;
            }
        );

        this.initDatePickers();
        this.listeners();
    }

    initDatePickers() {
        $(".lms-activity-filter-datepicked").flatpickr({
            maxDate: "today",
            dateFormat: lmsAjax.timeFormat,

        });
    }

    renderActivityItem(type, message, date) {
        const $item = `
                <div class="lms-activity-item lms-activity-item--${type}">
                    <div class="lms-activity-item__wrapper">
                        <div class="lms-activity-item__ico">
                            <svg class="lms-activity-course-ico" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
                <defs>
                    <style>.cls-1 {
                            fill: none;
                            stroke: #fff;
                            stroke-linecap: round;
                            stroke-linejoin: round;
                            stroke-width: 3px;
                        }</style>
                </defs>
                <title>Course</title>
                <polygon class="cls-1" points="59.8 33.8 40 43.6 20.2 33.8 40 24 59.8 33.8"/>
                <path class="cls-1" d="M50.94,38.39v7.06c0,4.1-4.89,7.41-10.91,7.41s-10.92-3.31-10.92-7.41V38.39"/>
                <line class="cls-1" x1="56.38" y1="35.49" x2="56.38" y2="47.75"/>
            </svg>
                            <svg class="lms-activity-account-ico" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
                <defs>
                    <style>.cls-1 {
                            fill: none;
                            stroke: #fff;
                            stroke-linecap: round;
                            stroke-linejoin: round;
                            stroke-width: 3px;
                        }</style>
                </defs>
                <title>Profile</title>
                <circle class="cls-1" cx="40" cy="31.59" r="7.59"/>
                <path class="cls-1" d="M25.19,54a14.81,14.81,0,0,1,29.62,0"/>
            </svg>
                            <svg class="lms-help-ico" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
                                <defs>
                                    <style>
                                        .cls-1,.cls-2,.cls-3{fill:none;stroke:#fff;stroke-linecap:round;stroke-width:3px;}.cls-1,.cls-2{stroke-miterlimit:10;}.cls-1,.cls-3{fill-rule:evenodd;}.cls-3{stroke-linejoin:round;}
                                    </style>
                                </defs>
                                <title>Help</title>
                                <g id="Home">
                                    <path class="cls-1" d="M34.42,30.58a5.58,5.58,0,1,1,8.17,4.94A4.79,4.79,0,0,0,40,39.75v1"/>
                                    <circle class="cls-2" cx="40" cy="46.65" r="0.35"/>
                                    <path class="cls-3"
                                          d="M53.28,54.59H45l-5,7-5-7H26.72a5.52,5.52,0,0,1-5.52-5.52V22.51A5.52,5.52,0,0,1,26.72,17H53.28a5.52,5.52,0,0,1,5.52,5.51V49.07A5.52,5.52,0,0,1,53.28,54.59Z"/>
                                </g>
                            </svg>
                        </div>
                        <div class="lms-activity-item__message">
                            ${message}
                        </div>

                        <div class="lms-activity-item__date"  data-date="${date}" title="${date}">
                            ${moment(date).fromNow()}
                        </div>
                    </div>
                </div>
        `;
        // let $item = $('.lms-activity-item').clone();
        // $item.addClass(`lms-activity-item-${type}`);
        // $item.find('.lms-activity-item__message').text(message);
        // $item.find('.lms-activity-item__date').text(moment(date).fromNow());
        $('.lms-activity-list').append($item);
        tippy('.lms-activity-item__date', {
            placement: 'bottom',
        });

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
            console.log(json);
            if (json.error) new Alert(`"${json.error}" please reload page`);

            this.items = json.items.length > 0 ? json.items : [{
                type: 'not-found',
                text: 'Sorry, not found any activity with this parameters. Try clear filters.',
                date: new Date()
            }];
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
        });
    }
}

export default ActivityPage

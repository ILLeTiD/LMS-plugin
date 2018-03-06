import moment from 'moment';
import  'moment/locale/sv'
import {Activity} from './ActivityLogger'
class CoursesPage {
    constructor() {

    }

    init() {
        this.listeners();
        this.formatDate();
    }


    listeners() {
        $('.lms-course-begin-button').on('click', this.acceptInvite.bind(this));
        $('.lms-course-reject-button').on('click', this.rejectEnrollment.bind(this));
        $('.lms-course-archive-button').on('click', this.archiveEnrollment.bind(this));
    }

    acceptInvite(e) {
        if (e) e.preventDefault();
        const $button = $(e.target);
        const courseID = $button.data('course-id');
        const userID = $button.data('user-id');
        Activity.acceptInvite(userID, courseID);
        Activity.commit(userID, courseID, 'course', 'enrolled');
    }

    rejectEnrollment(e) {
        console.log('reject');
        if (e) e.preventDefault();
        const $button = $(e.target);
        const courseID = $button.data('course-id');
        const userID = $button.data('user-id');
        Activity.rejectInvite(userID, courseID);
        Activity.commit(userID, courseID, 'course', 'rejected_invite');
    }

    archiveEnrollment(e) {
        if (e) e.preventDefault();
        const $button = $(e.target);
        const courseID = $button.data('course-id');
        const userID = $button.data('user-id');
        Activity.rejectInvite(userID, courseID);
        Activity.commit(userID, courseID, 'course', 'archived_course');
    }

    formatDate() {
        moment.locale($('html').attr('lang'));
        console.log($('html').attr('lang'));
        $('.lms-date').each(function (i) {
            const formatted = moment($(this).data('timestamp')).fromNow();
            $(this).text(formatted);
        });
    }
}
export default CoursesPage;
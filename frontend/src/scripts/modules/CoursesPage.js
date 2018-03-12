import moment from 'moment';
import  'moment/locale/sv'
import lmsConfirmAlert from '../utilities/lmsConfirmAlert'
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
        $('.lms-course-redo-button').on('click', this.redoCourse.bind(this));
        $('.lms-course-archive-button').on('click', this.archiveEnrollment.bind(this));
    }

    acceptInvite(e) {
        if (e) e.preventDefault();
        const $button = $(e.target);
        const courseID = $button.data('course-id');
        const userID = $button.data('user-id');
        Activity.acceptInvite(userID, courseID);
        Activity.commit(userID, 'course', 'enrolled', courseID);
    }

    rejectEnrollment(e) {
        console.log('reject');
        if (e) e.preventDefault();
        const $button = $(e.target);
        const courseID = $button.data('course-id');
        const userID = $button.data('user-id');
        Activity.rejectInvite(userID, courseID);
        Activity.commit(userID, 'course', 'rejected', courseID);
    }

    archiveEnrollment(e) {
        if (e) e.preventDefault();
        const $button = $(e.target);
        const courseID = $button.data('course-id');
        const userID = $button.data('user-id');
        Activity.rejectInvite(userID, courseID);
        Activity.commit(userID, 'course', 'archived_course', courseID);
    }

    redoCourse(e) {
        if (e) e.preventDefault();
        const $button = $(e.target);
        lmsConfirmAlert({
            title: 'Oops...',
            text: 'Something went wrong!',
        }, () => {
            //var player = new MediaElementPlayer('#slide-control-player');
            const courseID = $button.data('course-id');
            const userID = $button.data('user-id');
            Activity.redoCourse(userID, courseID);
            Activity.commit(userID, 'course', 'restarted', courseID);
        });
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
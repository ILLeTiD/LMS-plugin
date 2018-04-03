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
        $('.lms-course-begin-button-public').on('click', this.enrollToPublicCourse.bind(this));
        $('.lms-course-start-button').on('click', this.startCourse.bind(this));
        $('.lms-course-reject-button').on('click', this.rejectEnrollment.bind(this));
        $('.lms-course-redo-button').on('click', this.redoCourse.bind(this));
        $('.lms-course-reset-button').on('click', this.redoCourse.bind(this));
        $('.lms-course-archive-button').on('click', this.archiveEnrollment.bind(this));
    }

    enrollToPublicCourse(e) {
        if (e) e.preventDefault();
        console.log('sdfdsfsd');
        const $button = $(e.target);
        const courseID = $button.data('course-id');
        const userID = $button.data('user-id');
        console.log(courseID, userID);
        Activity.enrollToPublicCourse(userID, courseID);
    }

    acceptInvite(e) {
        if (e) e.preventDefault();
        const $button = $(e.target);
        const courseID = $button.data('course-id');
        const userID = $button.data('user-id');
        Activity.acceptInvite(userID, courseID);

    }

    startCourse(e) {
        if (e) e.preventDefault();
        const $button = $(e.target);
        const courseID = $button.data('course-id');
        const userID = $button.data('user-id');
        Activity.startCourse(userID, courseID);

    }

    rejectEnrollment(e) {
        console.log('reject');
        if (e) e.preventDefault();
        const $button = $(e.target);

        lmsConfirmAlert({
            title: 'Do you want reject invite?',
            text: '',
        }, () => {
            const courseID = $button.data('course-id');
            const userID = $button.data('user-id');
            Activity.rejectInvite(userID, courseID);
        });

    }

    archiveEnrollment(e) {
        if (e) e.preventDefault();
        const $button = $(e.target);
        const courseID = $button.data('course-id');
        const userID = $button.data('user-id');
        Activity.archiveEnrollment(userID, courseID);
    }

    redoCourse(e) {
        if (e) e.preventDefault();
        const $button = $(e.target);
        lmsConfirmAlert({
            title: 'Do you want restart course?',
            text: '',
        }, () => {
            //var player = new MediaElementPlayer('#slide-control-player');
            const courseID = $button.data('course-id');
            const userID = $button.data('user-id');
            Activity.redoCourse(userID, courseID);
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
import Course from './Course';
import CoursesPage from './CoursesPage';
import ActivityPage from './ActivityPage';
import {selectors} from './selectors'
import moment from 'moment'
class App {

    constructor() {
        this.course = new Course();
        this.coursesPage = new CoursesPage();
        this.actvityPage = new ActivityPage();
        this.init();
    }

    init() {
        console.info('App Initialized');
        if ($('#lms-course').length > 0) {
            this.course.init($('#lms-course'));
        }

        if ($('body').hasClass('post-type-archive-course') || $('body').hasClass('single-course')) {
            this.coursesPage.init();
        }
        if ($('.lms-activity-page').length) {
            console.log('acitivity!!!');
            this.actvityPage.init();
        }
        // $(selectors.shortcodeBackToCourses).on('click', shortcodeBackToCourses);
        // $(selectors.shortcodeRestart).on('click', shortcodeRestart);
        //
        // const shortcodeBackToCourses = (e) => {
        //     if (e) e.preventDefault();
        //     window.location.href = lmsAjax.coursesLink;
        // };
        //
        // const shortcodeRestart = (user_id, course_id) => {
        //     console.log('START DELETEING');
        //     $.ajax(
        //         {
        //             method: "POST",
        //             url: lmsAjax.ajaxurl,
        //             data: {
        //                 action: 'progress_restart',
        //                 user_id: this.userId,
        //                 course_id: this.courseId,
        //             }
        //         }
        //     ).done(function (json) {
        //         if (json.error) new Alert(`"${json.error}" please reload page`);
        //         window.location.reload();
        //     });
        // }

    }
}

export default App;

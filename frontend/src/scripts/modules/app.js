import Course from './Course';
import CoursesPage from './CoursesPage';
import {selectors} from './selectors'
import moment from 'moment'
class App {

    constructor() {
        this.course = new Course();
        this.coursesPage = new CoursesPage();
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
    }
}

export default App;

import Course from './Course';
import CoursesPage from './CoursesPage';
import newCoursesChecker from './newCoursesChecker';
import {selectors} from './selectors'
import moment from 'moment'
import detectIE from '../utilities/detectIE'
var objectFitImages = require('object-fit-images');
class App {

    constructor() {
        this.course = new Course();
        this.coursesPage = new CoursesPage();
        this.newCoursesChecker =  new newCoursesChecker();
        this.init();
    }

    init() {
        console.info('App Initialized!');

        this.newCoursesChecker.init();
        objectFitImages('img.lms-grid-block__image');
        const isIE = detectIE() ? 'is-ie' : '';
        $('body').addClass(`${isIE}`);

        if ($('#lms-course').length > 0) {
            this.course.init($('#lms-course'));
        }

        if ($('body').hasClass('post-type-archive-course') || $('body').hasClass('single-course')) {
            this.coursesPage.init();
        }
    }
}

export default App;

import CoursePage from './pages/CoursePage';
import CoursesPage from './pages/CoursesPage';
import ProfilePage from './pages/ProfilePage';
import newCoursesChecker from './newCoursesChecker';
import {selectors} from './selectors'
import moment from 'moment'
import detectIE from '../utilities/detectIE'
import lmsConfirmAlert from '../utilities/lmsConfirmAlert'
var objectFitImages = require('object-fit-images');

class App {

    constructor() {
        this.course = new CoursePage();
        this.coursesPage = new CoursesPage();
        this.profilePage = new ProfilePage();
        this.newCoursesChecker = new newCoursesChecker();
        this.init();
    }

    init() {

        console.info('App Initialized!');
        this.listeners();

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
        if ($('.lms-account-page').length > 0) {
            this.profilePage.init();
        }
    }

    listeners() {
        $('.lms-menu-item-logout-button').on('click', 'a', function (e) {
            if (e) e.preventDefault();
            lmsConfirmAlert({
                title: 'Do you want logout? ',
                text: '',
            }, () => {
                $.ajax(
                    {
                        method: "POST",
                        url: lmsAjax.ajaxurl,
                        data: {
                            action: 'logOutUser',
                        }
                    }
                ).done(function (json) {
                    console.log('logged out', json
                    );
                    window.location.href = lmsAjax.homeUrl;
                });
            });
        });
    }
}

export default App;

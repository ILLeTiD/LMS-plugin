import Course from './Course';
class App {

    constructor() {
        this.course = new Course();
        this.init();
    }

    init() {
        console.info('App Initialized');
        if ($('#lms-course').length > 0) {
            this.course.init($('#lms-course'));
        }
    }
}

export default App;

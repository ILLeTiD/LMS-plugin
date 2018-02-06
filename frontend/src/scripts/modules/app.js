import Course from './Course';
class App {

    constructor() {
        this.course = new Course();
        this.init();
    }

    init() {
        console.info('App Initialized');
        if ($('#course').length > 0) {
            this.course.init($('#course'));
        }
    }
}

export default App;

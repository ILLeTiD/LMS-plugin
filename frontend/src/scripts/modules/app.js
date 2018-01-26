import Course from './Course';
class App {

    constructor() {
        this.course = new Course();
        this.init();
    }

    init() {
        console.info('App Initialized');
        this.course.init();
    }
}

export default App;

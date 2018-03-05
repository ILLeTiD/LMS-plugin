import "babel-polyfill";
import './utilities/nodeListForEach'
import "web-animations-js"
import ActivityPage from './modules/ActivityPage'
jQuery(document).ready(function ($) {
    //you can now use $ as your jQuery object.
    const activityPage = new ActivityPage();
    if ($('.lms-activity-page').length) {
        console.log('acitivity!!!');
        activityPage.init();
    }
});
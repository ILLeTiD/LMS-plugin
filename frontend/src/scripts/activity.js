import "babel-polyfill";
import './utilities/nodeListForEach'
import "web-animations-js"
import ActivityPage from './modules/ActivityPage'
import detectIE from './utilities/detectIE'
jQuery(document).ready(function ($) {
    //you can now use $ as your jQuery object.
    const isIE = detectIE() ? 'is-ie' : '';
    $('body').addClass(`${isIE}`);

    const activityPage = new ActivityPage();
    if ($('.lms-activity-page').length) {
        console.log('acitivity!!!');
        activityPage.init();
    }
});
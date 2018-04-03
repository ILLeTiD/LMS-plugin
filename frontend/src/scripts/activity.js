import "babel-polyfill";
import './utilities/nodeListForEach'
import "web-animations-js"
import ActivityPage from './modules/pages/ActivityPage'
import detectIE from './utilities/detectIE'
import lmsConfirmAlert from './utilities/lmsConfirmAlert'
jQuery(document).ready(function ($) {
    const isIE = detectIE() ? 'is-ie' : '';
    $('body').addClass(`${isIE}`);

    const activityPage = new ActivityPage();
    if ($('.lms-activity-page').length) {
        activityPage.init();
    }
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
});
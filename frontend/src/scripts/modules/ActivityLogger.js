import Alert from '../utilities/Alerts'

export const Activity = {
    acceptInvite(userId, courseId){
        $.ajax(
            {
                method: "POST",
                url: lmsAjax.ajaxurl,
                data: {
                    action: 'activity_accept_invite',
                    user_id: userId,
                    course_id: courseId,
                }
            }
        ).done(function (json) {
            if (json.error) new Alert(`"${json.error}" please reload page`);
            console.log('course started ', json);
        });
    },
    rejectInvite(userId, courseId){
        $.ajax(
            {
                method: "POST",
                url: lmsAjax.ajaxurl,
                data: {
                    action: 'activity_reject_invite',
                    user_id: userId,
                    course_id: courseId,
                }
            }
        ).done(function (json) {
            if (json.error) new Alert(`"${json.error}" please reload page`);
            console.log('course rejected', json);
            window.location.href = lmsAjax.coursesLink;
        });
    },
    commit(user_id, course_id, activity_type, activity_name) {
        console.log('COMMIT !');
        $.ajax(
            {
                method: "POST",
                url: lmsAjax.ajaxurl,
                data: {
                    action: 'activity_commit',
                    user_id,
                    course_id,
                    activity_type,
                    activity_name,
                }
            }
        ).done(function (msg) {
            console.log('commited slide activity ', msg);
        });
    }
};
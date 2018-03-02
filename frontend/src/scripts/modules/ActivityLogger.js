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
    commit(userId, courseId, activityType, commitMessage) {
        console.log('COMMIT !');
        $.ajax(
            {
                method: "POST",
                url: lmsAjax.ajaxurl,
                data: {
                    action: 'activity_commit',
                    user_id: userId,
                    course_id: courseId,
                    commit_message: activityType,
                    commit_description: commitMessage,
                }
            }
        ).done(function (msg) {
            console.log('commited slide activity ', msg);
        });
    }
};
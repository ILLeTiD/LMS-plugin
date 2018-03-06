import Alert from '../utilities/Alerts'
export const ProgressLogger = {
    commitProgress(user_id, course_id, slide_id, name = 'finished'){
        $.ajax(
            {
                method: "POST",
                url: lmsAjax.ajaxurl,
                data: {
                    action: 'progress_commit',
                    user_id,
                    course_id,
                    slide_id,
                    name
                }
            }
        ).done(function (json) {
            if (json.error) new Alert(`"${json.error}" please reload page`);
            console.log('slide finished ', json);
        });
    }
};


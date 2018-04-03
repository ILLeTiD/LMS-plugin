const QuizResultSaver = {
    save(user_id, course_id, slide_id, result) {
        const self = this;
        $.ajax(
            {
                method: "POST",
                url: lmsAjax.ajaxurl,
                data: {
                    action: 'save_quiz_result',
                    user_id,
                    course_id,
                    slide_id,
                    result
                }
            }
        ).done(function (json) {
            if (json.error) new Alert(`"${json.error}" please reload page`);
        });
    }
};

export default QuizResultSaver;

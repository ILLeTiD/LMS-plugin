import Alert from '../utilities/Alerts'

export const Activity = {
    acceptInvite(userId, courseId){
        const self = this;
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
            $.when(self.defferedCommit(userId, 'course', 'enrolled', courseId)).then(function (data, textStatus, jqXHR) {
                window.location.href = json.course_link;
            });
        });
    },
    startCourse(userId, courseId, reloadPage = true) {
        const self = this;
        $.ajax(
            {
                method: "POST",
                url: lmsAjax.ajaxurl,
                data: {
                    action: 'activity_start_course',
                    user_id: userId,
                    course_id: courseId,
                }
            }
        ).done(function (json) {
            if (json.error) new Alert(`"${json.error}" please reload page`);
            console.log('course started ', json);

            $.when(self.defferedCommit(userId, 'course', 'started', courseId)).then(function (data, textStatus, jqXHR) {
                if (reloadPage) {
                    window.location.href = json.course_link;
                }
            });
        });
    },
    rejectInvite(userId, courseId){
        const self = this;
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

            $.when(self.defferedCommit(userId, 'course', 'rejected', courseId)).then(function (data, textStatus, jqXHR) {
                window.location.href = lmsAjax.coursesLink;
            });

        });
    },
    archiveEnrollment(userId, courseId){
        const self = this;
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

            $.when(self.defferedCommit(userId, 'course', 'archived_course', courseId)).then(function (data, textStatus, jqXHR) {
                window.location.href = lmsAjax.coursesLink;
            });

        });
    },
    redoCourse(userId, courseId){
        const self = this;
        $.ajax(
            {
                method: "POST",
                url: lmsAjax.ajaxurl,
                data: {
                    action: 'activity_redo_course',
                    user_id: userId,
                    course_id: courseId,
                }
            }
        ).done(function (json) {
            if (json.error) new Alert(`"${json.error}" please reload page`);
            console.log('course restarted', json);

            $.when(self.defferedCommit(userId, 'course', 'restarted', courseId)).then(function (data, textStatus, jqXHR) {
                window.location.href = json.course_link;
            });

        });
    },
    completeCourse(userId, courseId, reloadPage = true){
        const self = this;
        $.ajax(
            {
                method: "POST",
                url: lmsAjax.ajaxurl,
                data: {
                    action: 'activity_complete_course',
                    user_id: userId,
                    course_id: courseId,
                }
            }
        ).done(function (json) {
            if (json.error) new Alert(`"${json.error}" please reload page`);
            console.log('course restarted', json);

            $.when(self.defferedCommit(userId, 'course', 'completed', courseId)).then(function (data, textStatus, jqXHR) {
                if (reloadPage) {
                    window.location.href = lmsAjax.coursesLink;
                }
            });
        });
    },
    defferedCommit(user_id, activity_type, activity_name, course_id = '') {
        const self = this;
        return $.ajax(
            {
                method: "POST",
                url: lmsAjax.ajaxurl,
                data: {
                    action: 'activity_commit',
                    user_id,
                    activity_type,
                    activity_name,
                    course_id,
                }
            }
        )
    },
    commit(user_id, activity_type, activity_name, course_id = '') {

        const self = this;
        console.log('COMMIT !!');
        $.ajax(
            {
                method: "POST",
                url: lmsAjax.ajaxurl,
                data: {
                    action: 'activity_commit',
                    user_id,
                    activity_type,
                    activity_name,
                    course_id,
                }
            }
        ).done(function (msg) {
            console.log('commited slide activity ', msg);
        });
    }
};
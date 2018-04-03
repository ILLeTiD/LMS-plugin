class newCoursesChecker {
    constructor() {

    }

    init() {
        this.isCoursesPage = $('body').hasClass('post-type-archive-course');
        this.coursesFetcher();
    }

    coursesFetcher() {
        // console.log('is courses page?', this.isCoursesPage);
        if (!lmsAjax.userID || lmsAjax.userID == 0) return;

        const self = this;
        $.ajax(
            {
                method: "POST",
                url: lmsAjax.ajaxurl,
                data: {
                    action: 'get_all_users_courses',
                    user_id: lmsAjax.userID,
                }
            }
        )
            .then(function (json) {
                if (json.error) new Alert(`"${json.error}" please reload page`);
                console.log('course started ', json);
                return json.courses;

            })
            .then(self.checkNewCourses.bind(self))
            .then(self.coursesPageArchiveActions.bind(self));
    }


    checkNewCourses(courses) {
        const ifUserHasNewCourse = courses.find(i => i.viewed == null);
        console.log('is User Has NEW COURSES!!!1', !!ifUserHasNewCourse);

        if (!ifUserHasNewCourse) return false;
        if (!this.isCoursesPage) {
            const menuLinkHref = lmsAjax.coursesLink;
            const linkNode = $('.menu').find(`a[href="${menuLinkHref}"]`);
            const linkNodeParent = linkNode.parent();

            linkNodeParent.addClass('has-new-courses');
        }
        return courses;


    }

    coursesPageArchiveActions(courses = false) {
        // console.log('COURSES before', courses);
        if (!this.isCoursesPage) return false;
        if (!courses) return false;
        // console.log('COURSES after', courses);


        courses.forEach(i => {
            const id = i.id;
            const isNew = i.is_new;
            if (isNew) {
                const courseItem = $(`.lms-courses-list__item[data-course-id=${id}]`);
                courseItem.find('.lms-courses-course__title')
                    .append(`<small class="lms-courses-course__title--new">New invite!</small>`);
                courseItem.addClass('is-new-course');
            }
        });
        const self = this;
        $.ajax(
            {
                method: "POST",
                url: lmsAjax.ajaxurl,
                data: {
                    action: 'set_all_users_courses_viewed',
                    user_id: lmsAjax.userID,
                }
            }
        )
            .then(function (json) {
                if (json.error) new Alert(`"${json.error}" please reload page`);
                console.log('course started ', json);
                return json.courses;

            })
    }
}
export default newCoursesChecker;
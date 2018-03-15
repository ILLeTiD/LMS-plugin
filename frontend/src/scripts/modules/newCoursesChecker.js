import store from './store'

class newCoursesChecker {
    constructor() {
        this.store = new store('lmsUserCourses');
    }

    init() {

        this.isCoursesPage = $('body').hasClass('post-type-archive-course');
        this.coursesFetcher();
    }

    coursesFetcher() {
        console.log('is courses page', this.isCoursesPage);

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
        ).done(function (json) {
            if (json.error) new Alert(`"${json.error}" please reload page`);
            console.log('course started ', json);
            self.coursesCompareAndStore(json.courses);
        });
    }

    coursesCompareAndStore(newCourses) {
        let oldItems = this.store.getData();
        console.log('OLD ITEMS', oldItems);
        console.log('NEW ITEMS', newCourses);

        newCourses.forEach(i => {
            const isNew = oldItems.find(el => el.id === i.id);
            console.log('is NEW', isNew);

            if (!isNew) {
                oldItems.push(i);
            }
        });

        console.log('oldItems ', oldItems);
        this.store.saveData(oldItems);
        this.checkNewCourses();
    }

    checkNewCourses() {
        const ifUserHasNewCourse = this.store.getData().find(i => i.is_new == true);
        console.log('is User Has NEW COURSES', ifUserHasNewCourse);

        if (ifUserHasNewCourse) {
            const menuLinkHref = lmsAjax.coursesLink;
            const linkNode = $('.menu').find(`a[href="${menuLinkHref}"]`);
            const linkNodeParent = linkNode.parent();
            console.log('new link nodes', linkNode, linkNodeParent);

            linkNodeParent.addClass('has-new-courses');

            if (this.isCoursesPage) {
                this.coursesPageArchiveActions()
            }
        }
    }

    coursesPageArchiveActions() {
        const items = this.store.getData();

        items.forEach(i => {
            const id = i.id;
            const isNew = i.is_new;
            if (isNew) {
                const courseItem = $(`.lms-courses-list__item[data-course-id=${id}]`);
                courseItem.addClass('is-new-course');
            }
        });

        const newItems = items.map(i => {
            i.is_new = false;
            return i;
        });
        console.log('NEW ITEMS ', newItems);

        this.store.saveData(newItems);
    }
}
export default newCoursesChecker;
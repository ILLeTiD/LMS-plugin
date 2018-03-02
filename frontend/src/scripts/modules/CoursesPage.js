import moment from 'moment'
class CoursesPage {
    constructor() {

    }

    init() {
        this.listeners();
        this.formatDate();
        this.hideRedundantButtons();
        console.log('COURSES PAGE INIT');
    }

    listeners() {
        $('.lms-courses-course__read-more').on('click', this.toggleMore.bind(this));
        $('.lms-courses-course__read-less').on('click', this.toggleMore.bind(this));
    }

    formatDate() {
        $('.lms-date').each(function (i) {
            const formatted = moment($(this).data('timestamp')).fromNow();
            $(this).text(formatted);
        });
    }

    // Hide the 'read more' buttons if all the text is already showing.
    hideRedundantButtons() {
        console.log('START HIDE BUTTONS');
        const itemLenght = $('.lms-courses-list__item').length - 1;
        for (var i = 0; i < itemLenght; i++) {
            var itemID = 'blox-post-content-' + i;

            if (!isOverFlowing(itemID)) {

                var readMore = 'read-more-' + i;
                var readMoreButton = document.getElementById(readMore);
                readMoreButton.style.display = 'none';

                var readLess = 'read-less-' + i;
                var readLessButton = document.getElementById(readLess);
                readLessButton.style.display = 'none';
            }
        }
    }

// Check if the paragraph is larger than its container div
    isOverFlowing(index) {

        var container = document.getElementById(index);
        var paragraph = document.getElementById(index).children;

        if (paragraph.length > 0 && container.clientHeight < paragraph[0].clientHeight) {
            return true;
        }
        else {
            return false;
        }

    }

// Expand and contract the content section
    toggleMore(e) {
        if (e) e.preventDefault();
        console.log('CLICKED', e);

        const index = $(e.target).closest('.lms-courses-list__item').data('item-index');
        var itemID = 'blox-post-content-' + index;
        var containerItem = document.getElementById(itemID);

        if (containerItem.style.maxHeight != 'none') {
            containerItem.style.maxHeight = 'none';

            // Change buttons
            var readMore = 'read-more-' + index;
            var readMoreButton = document.getElementById(readMore);
            readMoreButton.style.display = 'none';

            var readLess = 'read-less-' + index;
            var readLessButton = document.getElementById(readLess);
            readLessButton.style.display = 'inline';

        } else {

            // If on a narrow screen, show some more lines
            if (window.innerWidth > 800) {
                containerItem.style.maxHeight = '70px';
            }
            else {
                containerItem.style.maxHeight = '130px';
            }

            // Change buttons
            var readMore = 'read-more-' + index;
            var readMoreButton = document.getElementById(readMore);
            readMoreButton.style.display = 'inline';

            var readLess = 'read-less-' + index;
            var readLessButton = document.getElementById(readLess);
            readLessButton.style.display = 'none';
        }
    }
}
export default CoursesPage;
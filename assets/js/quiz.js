;
(function ($) {

    var slideFormat = function () {
        var slideFormat = $('input[name=slide_format]:checked').val(),
            regularSlideMetaBoxes = [
                '#lms_slide_content_meta_box',
                '#lms_slide_settings_meta_box'
            ],
            quizSlideMetaBoxes = [
                '#lms_slide_quiz_meta_box'
            ];

        if (slideFormat === 'quiz') {
            $(regularSlideMetaBoxes.join(',')).addClass('hidden');
        } else {
            $(quizSlideMetaBoxes.join(',')).addClass('hidden');
        }
    };

    $(function () {
        slideFormat();
    });

})(jQuery);
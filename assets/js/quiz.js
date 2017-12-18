;
(function ($) {

    var quizTypes = {
        forms: '#lms_slide_forms_meta_box',
        drag_and_drop: '#lms_slide_drag_and_drop_meta_box',
        puzzle: '#lms_slide_puzzle_meta_box'
    };


    var quizType = function () {
        var quizTypeElement = $('.js-choose-quiz-type');
        var activeQuizType = quizTypeElement.val();

        $(Object.values(quizTypes).join(',')).addClass('hidden');
        $(quizTypes[activeQuizType]).removeClass('hidden');
    };

    $(function () {

        $('.js-choose-quiz-type').on('change', function () {
            var quizTypeElement = $('.js-choose-quiz-type');
            var activeQuizType = quizTypeElement.val();

            $(Object.values(quizTypes).join(',')).addClass('hidden');
            $(quizTypes[activeQuizType]).removeClass('hidden');
        });
    });

})(jQuery);
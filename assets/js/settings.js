;
(function ($) {
    $(function () {

        $('.lms-profile-fields').on('click', '.js-remove-profile-field', function (event) {
            $('.js-delete-confirmation__yes').data('field', $(this).data('field'));

            $('.lms-delete-confirmation').fadeIn();

            event.preventDefault();
        });

        $('.js-delete-confirmation__yes').on('click', function () {
            var button = $(this),
                fieldId = button.data('field'),
                field = $('#profile-field-' + fieldId);

            field.remove();

            $('.lms-delete-confirmation').fadeOut();
        });

        $('.js-delete-confirmation__no').on('click', function () {
            $('.lms-delete-confirmation').fadeOut();
        });

        $('.lms-profile-fields').sortable({
            handle: '.js-sortable-handle'
        });

    });

})(jQuery);
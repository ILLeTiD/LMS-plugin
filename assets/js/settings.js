;
(function ($) {
    $(function () {

        $('.js-add-field-button').on('click', function (event) {
            var container = $('.lms-profile-fields'),
                fields = container.find('.lms-profile-field'),
                newFieldIndex = fields.length;

            $.get(ajaxurl, {
                action: 'add_profile_field',
                id: newFieldIndex
            }, function (response) {
                container.append(response);
            });

            event.preventDefault();
        });

        $('.lms-profile-fields').on('change', '.js-change-field-type', function (event) {
            var select = $(this),
                type = select.val(),
                container = select.parent().parent(),
                options = container.find('textarea');

            if (type === 'select' || type === 'radio') {
                options.show();
            } else {
                options.hide();
            }
        });

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
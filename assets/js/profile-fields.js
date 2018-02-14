(function ($) {

    $(function () {
        $('.js-change-field-type').on('change', function () {
            var select = $(this),
                type = select.val(),
                options = select.siblings('.lms-profile-field-options-container');

            if (type === 'select' || type === 'radio') {
                options.show();
            } else {
                options.hide();
            }
        });

        $('.js-add-option').on('click', function (event) {
            var container = $('.lms-profile-field-options'),
                options = container.find('.lms-profile-field-option'),
                newOptionIndex = options.length;

            $.get(ajaxurl, {
                action: 'add_profile_field_option',
                id: newOptionIndex
            }, function (response) {
                container.append(response);
            });

            container.find('.no-items').hide();

            event.preventDefault();
        });

        $('.lms-profile-field-options').on('click', '.js-delete-option', function (event) {
            var button = $(this),
                option = button.parent().parent();

            option.remove();

            event.preventDefault();
        });

        $('.lms-profile-field-options').sortable({
            handle: '.js-sortable-handle'
        });
    });

})(jQuery);
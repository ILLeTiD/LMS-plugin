;
(function ($) {

    $(function () {
        $('.js-print').on('click', function (event) {
            var button = $(this),
                content = button.parent().siblings('.lms-printable'),
                form = $('<form></form>', {
                    action: ajaxurl + '?action=print_version',
                    method: 'POST',
                    class: 'hidden',
                    target: '_blank'
                });

            form.append('<textarea name="content">' + content.html() + '</textarea>');

            $(document.body).append(form);

            form.submit();

            event.preventDefault();
        });
    });

})(jQuery);
;
(function ($) {
    $(function () {
        var $loader = $('.js-ajax-loader'),
            $messageBox = $('.js-ajax-message');

        $('.js-course-slides tbody').sortable({
            handle: '.js-sortable-handle',
            update: function (event, ui) {
                var url = ajaxurl + '?action=sort_slides',
                    data = $('input[name="slide_weight[]"]').serialize();

                $loader.show();

                $.ajax({
                    method: 'POST',
                    url: url,
                    data: data
                }).done(function (response) {
                    $loader.hide();
                    $messageBox.text(response.message);
                    $messageBox.fadeIn().delay(1000).fadeOut();
                });
            }
        });

        $('.js-delete-slide').on('click', function (event) {
            var slide_id = $(this).data('slide');

            $('.js-delete-confirmation__yes').data('slide', slide_id);

            $('.lms-delete-confirmation').fadeIn();

            event.preventDefault();
        });

        $('.js-delete-confirmation__yes').on('click', function () {
            var url = ajaxurl + '?action=delete_slide',
                slide_id = $(this).data('slide');

            $loader.show();

            $.ajax({
                method: 'POST',
                url: url,
                data: {
                    slide_id: slide_id
                }
            }).done(function (response) {
                $loader.hide();
                $messageBox.text(response.message);
                $messageBox.fadeIn().delay(1000).fadeOut();

                $('tr#post-' + response.slide.ID).remove();
            });

            $('.lms-delete-confirmation').fadeOut();
        });

        $('.js-delete-confirmation__no').on('click', function () {
            $('.lms-delete-confirmation').fadeOut();
        });

    });
})(jQuery);
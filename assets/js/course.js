;
(function ($) {
    $(function () {
        $('.js-course-slides tbody').sortable({
            handle: '.js-sortable-handle',
            update: function (event, ui) {
                var url = ajaxurl + '?action=sort_slides',
                    data = $('input[name="slide_weight[]"]').serialize();
                $.ajax({
                    method: 'POST',
                    url: url,
                    data: data
                }).done(function (response) {
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

            $.ajax({
                method: 'POST',
                url: url,
                data: {
                    slide_id: slide_id
                }
            }).done(function (response) {
                $('tr#post-' + response.slide.ID).remove();
            });

            $('.lms-delete-confirmation').fadeOut();
        });

        $('.js-delete-confirmation__no').on('click', function () {
            $('.lms-delete-confirmation').fadeOut();
        });
    });
})(jQuery);
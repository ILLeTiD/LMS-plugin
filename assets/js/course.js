;
(function ($) {
    $(function () {
        $('.js-course-slides tbody').sortable({
            handle: '.js-sortable-handle',
            update: function (event, ui) {
                var url = ajaxurl + '?action=sort_slides',
                    data = $('input[name="slide_weight[]"], input[name=post_ID]').serialize();
                $.ajax({
                    method: 'POST',
                    url: url,
                    data: data
                }).done(function (response) {
                });
            }
        });
    });
})(jQuery);
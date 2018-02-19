(function ($) {
    $(function () {
        $('.js-add-image').on('click', function () {
            var button = $(this).parent(),
                container = button.parent(),
                originAttachment = wp.media.editor.send.attachment,
                thumbnail = container.find('img.thumbnail'),
                image = container.find('div.image'),
                thumbnailInput = button.siblings('input[type=hidden].thumbnail'),
                imageInput = button.siblings('input[type=hidden].image');

            wp.media.editor.send.attachment = function (props, attachment) {
                button.hide();
                thumbnail.attr('src', attachment.sizes.slide_thumbnail.url);
                thumbnailInput.val(attachment.sizes.slide_thumbnail.url);
                imageInput.val(attachment.url);
                image.show();

                wp.media.editor.send.attachment = originAttachment;
            };

            wp.media.editor.open();

            return false;
        });

        $('.js-update-image').click(function (e) {
            var button = $(this),
                container = button.parent().parent(),
                originAttachment = wp.media.editor.send.attachment,
                thumbnail = container.find('img.thumbnail'),
                thumbnailInput = container.find('input[type=hidden].thumbnail'),
                imageInput = container.find('input[type=hidden].image');

            wp.media.editor.send.attachment = function (props, attachment) {
                thumbnail.attr('src', attachment.sizes.slide_thumbnail.url);
                thumbnailInput.val(attachment.sizes.slide_thumbnail.url);
                imageInput.val(attachment.url);

                wp.media.editor.send.attachment = originAttachment;
            };

            wp.media.editor.open();

            e.preventDefault();
        });

        $('.js-remove-image').click(function (e) {
            var button = $(this),
                container = button.parent().parent().parent(),
                image = container.find('div.image'),
                thumbnailInput = container.find('input[type=hidden].thumbnail'),
                imageInput = container.find('input[type=hidden].image');

            console.log(container.find('.wp-media-buttons'));

            image.hide();
            container.find('.wp-media-buttons').show();
            thumbnailInput.val('');
            imageInput.val('');

            e.preventDefault();
        });
    });
})(jQuery);

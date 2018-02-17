<?php
/**
 * Upload image component.
 *
 * string $name Name prefix for the inputs for thumbnail and image.
 * string $image Image URL.
 * string $thumbnail Thumbnail URL.
 */
?>

<div>
    <div class="wp-media-buttons <?= $image ? 'hidden' : ''; ?>">
        <button type="button"
                class="button add_media js-add-image"
        >
            <span class="wp-media-buttons-icon"></span> <?= __('Add Media', 'lms-plugin'); ?>
        </button>
    </div>

    <div class="image <?= ! $image ? 'hidden' : ''; ?>">
        <a href="#" class="js-update-image">
            <img class="thumbnail"
                 src="<?= $thumbnail; ?>"
            >
        </a>

        <div class="slide-image__help">
            <span><?= __('Click the image to edit or update', 'lms-plugin'); ?></span>
            <a href="#" class="js-remove-image"><?= __('Remove image'); ?></a>
        </div>
    </div>

    <input type="hidden"
           name="<?= $name; ?>[thumbnail]"
           class="thumbnail"
           value="<?= $thumbnail; ?>"
    >

    <input type="hidden"
           name="<?= $name; ?>[image]"
           class="image"
           value="<?= $image; ?>"
    >

</div>

<script>
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
</script>

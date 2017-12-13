<table>
    <tr>
        <td><?= __('Content', 'lms-plugin'); ?> 1</td>
        <td>
            <textarea name="slide_content[0][text]"></textarea>
        </td>
        <td>
            <div class="slide-image">
                <button type="button" id="insert-media-button" class="button insert-media add_media js-set-slide-image" data-editor="content">
                    <span class="wp-media-buttons-icon"></span> <?= __('Add Media', 'lms-plugin'); ?>
                </button>

                <div class="js-slide-image" style="display: none;">
                    <a href="#" class="js-update-slide-image">
                        <img class="js-slide-image-thumbnail" src="" style="max-width:100%;">
                    </a>

                    <?= __('Click the image to edit or update', 'lms-plugin'); ?>
                    <a href="#" class="js-remove-slide-image"><?= __('Remove image'); ?></a>
                </div>

                <input type="hidden" name="slide_image[0]">

                <label>
                    <input type="checkbox" name="slide_content[0][image_as_background]" value="true">
                    <?= __('Image as background', 'lms-plugin'); ?>
                </label>
            </div>
        </td>
    </tr>
</table>

<a href="#" class="js-add-slide-content">+ <?= __('Add content', 'lms-plugin'); ?></a>

<script>
    (function ($) {

        window.send_to_editor_default = window.send_to_editor;

        $('.js-set-slide-image').click(function () {
            var $button = $(this);
            wp.media.editor.send.attachment = function (props, attachment) {
                var $wrapper = $button.siblings('.js-slide-image'),
                    $thumbnail = $wrapper.find('.js-slide-image-thumbnail'),
                    $slideImage = $button.siblings('input[type=hidden]');

                $button.hide();
                $thumbnail.attr('src', attachment.sizes.thumbnail.url);
                $slideImage.val(attachment.url);
                $wrapper.show();
            };

            wp.media.editor.open('#slide_image');

            return false;
        });

        $('.js-update-slide-image').click(function (e) {
            var $button = $(this);

            e.preventDefault();

            wp.media.editor.send.attachment = function (props, attachment) {
                var $thumbnail = $button.find('.js-slide-image-thumbnail'),
                    $slideImage = $button.parent().siblings('input[type=hidden]');

                $thumbnail.attr('src', attachment.sizes.thumbnail.url);
                $slideImage.val(attachment.url);
            };

            wp.media.editor.open('#slide_image');

            return false;

        });

        $('.js-remove-slide-image').click(function (e) {
            e.preventDefault();

            $(this).parent().hide();
            $(this).parent().siblings('.js-set-slide-image').show();
            $(this).siblings('input[type=hidden]').val('');
        });

    })(jQuery);
</script>

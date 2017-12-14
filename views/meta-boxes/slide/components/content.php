<?php $i = is_null($i) ? '' : $i; ?>

<div class="slide" id="slide-<?= $i === '' ? 'template' : $i; ?>" <?= $i === '' ? 'hidden' : ''; ?> style="display: flex;">
    <div style="width: 100%; max-width: 150px;"><h4><?= __('Content', 'lms-plugin'); ?> <span class="slide-number"><?= ++$slideNumber; ?></span></h4></div>
    <div style="width: 100%; max-width: 450px;">
        <textarea name="slide_content[<?= $i; ?>][text]" style="width: 100%;"><?= $slide['text'] ?></textarea>
    </div>
    <div>
        <div class="slide-image">
            <button type="button" id="insert-media-button" class="button insert-media add_media js-set-slide-image <?= ! empty($slide['image']) ? 'hidden' : ''; ?>" data-editor="content">
                <span class="wp-media-buttons-icon"></span> <?= __('Add Media', 'lms-plugin'); ?>
            </button>

            <div class="js-slide-image <?= empty($slide['image']) ? 'hidden' : ''; ?>">
                <a href="#" class="js-update-slide-image">
                    <img class="js-slide-image-thumbnail" src="<?= $slide['thumbnail']; ?>" style="max-width:100%;">
                </a>

                <?= __('Click the image to edit or update', 'lms-plugin'); ?>
                <a href="#" class="js-remove-slide-image"><?= __('Remove image'); ?></a>

                <label>
                    <input type="checkbox" name="slide_content[<?= $i; ?>][image_as_background]" value="true" <?= $slide['image_as_background'] == true ? 'checked' : ''; ?>>
                    <?= __('Image as background', 'lms-plugin'); ?>
                </label>
            </div>

            <input type="hidden" name="slide_content[<?= $i; ?>][thumbnail]" class="slide-thumbnail" value="<?= $slide['thumbnail']; ?>">
            <input type="hidden" name="slide_content[<?= $i; ?>][image]" class="slide-image" value="<?= $slide['image']; ?>">

        </div>
    </div>
</div>

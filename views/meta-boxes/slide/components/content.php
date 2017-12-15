<?php $i = is_null($i) ? '' : $i; ?>

<div class="slide-content" id="slide-<?= $i === '' ? 'template' : $i; ?>">
    <div class="slide-content__title" style="">
        <h4><?= __('Content', 'lms-plugin'); ?> <span class="slide-number"><?= ++$slideNumber; ?></span></h4>
        <a href="#" class="js-advanced-settings"><?= __('Advanced Settings', 'lms-plugin'); ?></a>
    </div>
    <div class="slide-content__text">
        <textarea name="slide_content[<?= $i; ?>][text]"><?= $slide['text'] ?></textarea>
    </div>
    <div class="slide-content__image">
        <div class="slide-image">
            <button type="button" id="insert-media-button" class="button insert-media add_media js-set-slide-image <?= ! empty($slide['image']) ? 'hidden' : ''; ?>" data-editor="content">
                <span class="wp-media-buttons-icon"></span> <?= __('Add Media', 'lms-plugin'); ?>
            </button>

            <div class="js-slide-image <?= empty($slide['image']) ? 'hidden' : ''; ?>">
                <a href="#" class="js-update-slide-image">
                    <img class="js-slide-image-thumbnail slide-image__thumbnail" src="<?= $slide['thumbnail']; ?>">
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

    <?php include 'advanced-settings.php'; ?>

</div>

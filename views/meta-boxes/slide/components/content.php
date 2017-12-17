<?php $i = is_null($i) ? '' : $i; ?>

<div class="slide-content field" id="slide-<?= $i === '' ? 'template' : $i; ?>">
    <div class="field__title" style="">
        <h4><?= __('Content', 'lms-plugin'); ?> <span class="slide-number"><?= ++$slideNumber; ?></span></h4>
        <a href="#" class="slide-content__advance-settings-link js-advanced-settings">
            <?= __('Advanced Settings', 'lms-plugin'); ?>
        </a>
    </div>
    <div class="field__value">
        <textarea name="slide_content[<?= $i; ?>][text]"><?= $slide['text'] ?></textarea>
        <div class="slide-content__image slide-image">
            <button type="button" id="insert-media-button" class="button insert-media add_media js-set-slide-image <?= ! empty($slide['image']) ? 'hidden' : ''; ?>" data-editor="content">
                <span class="wp-media-buttons-icon"></span> <?= __('Add Media', 'lms-plugin'); ?>
            </button>

            <div class="js-slide-image <?= empty($slide['image']) ? 'hidden' : ''; ?>">
                <a href="#" class="js-update-slide-image slide-image__thumbnail-wrapper">
                    <img class="js-slide-image-thumbnail slide-image__thumbnail" src="<?= $slide['thumbnail']; ?>">
                </a>

                <div class="slide-image__help">
                    <span><?= __('Click the image to edit or update', 'lms-plugin'); ?></span>
                    <a href="#" class="js-remove-slide-image"><?= __('Remove image'); ?></a>
                </div>

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

<?php
/**
 * Upload image component.
 * (it requires image.js)
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


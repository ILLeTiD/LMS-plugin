<div class="slide-content__image slide-image">
    <button type="button"
            id="insert-media-button"
            class="button insert-media add_media js-set-slide-image <?= array_get($slide, 'image') ? 'hidden' : ''; ?>"
            data-editor="content">
        <span class="wp-media-buttons-icon"></span> <?= __('Add Media', 'lms-plugin'); ?>
    </button>

    <div class="js-slide-image <?= empty($slide['image']) ? 'hidden' : ''; ?>">
        <a href="#" class="js-update-slide-image slide-image__thumbnail-wrapper">
            <img class="js-slide-image-thumbnail slide-image__thumbnail"
                 src="<?= array_get($slide, 'thumbnail'); ?>"
            >
        </a>

        <div class="slide-image__help">
            <span><?= __('Click the image to edit or update', 'lms-plugin'); ?></span>
            <a href="#" class="js-remove-slide-image"><?= __('Remove image'); ?></a>
        </div>

<!--        <label>-->
<!--            <input type="checkbox"-->
<!--                   name="slide_content[--><?//= $i; ?><!--][image_as_background]"-->
<!--                   value="1"-->
<!--                   --><?//= checked(array_get($slide, 'image_as_background')); ?>
<!--            >-->
<!--            --><?//= __('Image as background', 'lms-plugin'); ?>
<!--        </label>-->
    </div>

    <input type="hidden"
           name="slide_content[<?= $i; ?>][thumbnail]"
           class="slide-thumbnail" value="<?= array_get($slide, 'thumbnail'); ?>"
    >

    <input type="hidden"
           name="slide_content[<?= $i; ?>][image]"
           class="slide-image" value="<?= array_get($slide, 'image'); ?>"
    >

</div>

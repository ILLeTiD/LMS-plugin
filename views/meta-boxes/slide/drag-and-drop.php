<div class="field">
    <div class="field__title">
        <?= __('Layout', 'lms-plugin'); ?>
    </div>
    <div class="field__value">
        <select name="drag_and_drop_layout">
            <?php foreach ($dragAndDropLayoutOptions as $type => $name): ?>
                <option value="<?= $type; ?>" <?= selected($post->drag_and_drop_layout, $type); ?>><?= __($name, 'lms-plugin'); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<?php for ($i = 0; $i < 3; $i++): ?>
    <div class="field">
        <div class="field__title">
            <?= __('Image', 'lms-plugin'); ?> <?= $i + 1; ?>
        </div>
        <div class="field__value">
            <div class="slide-content__image slide-image">
                <button type="button" id="insert-media-button" class="button insert-media add_media js-set-slide-image <?= ! empty($images[$i]['image']) ? 'hidden' : ''; ?>" data-editor="content">
                    <span class="wp-media-buttons-icon"></span> <?= __('Add Media', 'lms-plugin'); ?>
                </button>

                <div class="js-slide-image <?= empty($images[$i]['image']) ? 'hidden' : ''; ?>">
                    <a href="#" class="js-update-slide-image slide-image__thumbnail-wrapper">
                        <img class="js-slide-image-thumbnail slide-image__thumbnail" src="<?= $images[$i]['thumbnail']; ?>">
                    </a>

                    <div class="slide-image__help">
                        <span><?= __('Click the image to edit or update', 'lms-plugin'); ?></span>
                        <a href="#" class="js-remove-slide-image"><?= __('Remove image'); ?></a>
                    </div>
                </div>

                <input type="hidden" name="drag_and_drop_images[<?= $i; ?>][thumbnail]" class="slide-thumbnail" value="<?= $images[$i]['thumbnail']; ?>">
                <input type="hidden" name="drag_and_drop_images[<?= $i; ?>][image]" class="slide-image" value="<?= $images[$i]['image']; ?>">

            </div>
            <label>
                <?= __('Drop Zone', 'lms-plugin'); ?>
                <input type="text" name="drag_and_drop_images[<?= $i; ?>][drop_zone]" value="<?= isset($images[$i]) ? $images[$i]['drop_zone'] : ''; ?>">
            </label>
        </div>
    </div>
<?php endfor; ?>

<?php for ($i = 0; $i < 3; $i++): ?>
    <div class="field">
        <div class="field__title">
            <?= __('Drop Zone', 'lms-plugin'); ?> <?= $i + 1; ?>
        </div>
        <div class="field__value">
            <div class="slide-content__image slide-image">
                <button type="button" id="insert-media-button" class="button insert-media add_media js-set-slide-image <?= ! empty($zones[$i]['image']) ? 'hidden' : ''; ?>" data-editor="content">
                    <span class="wp-media-buttons-icon"></span> <?= __('Add Media', 'lms-plugin'); ?>
                </button>

                <div class="js-slide-image <?= empty($zones[$i]['image']) ? 'hidden' : ''; ?>">
                    <a href="#" class="js-update-slide-image slide-image__thumbnail-wrapper">
                        <img class="js-slide-image-thumbnail slide-image__thumbnail" src="<?= $zones[$i]['thumbnail']; ?>">
                    </a>

                    <div class="slide-image__help">
                        <span><?= __('Click the image to edit or update', 'lms-plugin'); ?></span>
                        <a href="#" class="js-remove-slide-image"><?= __('Remove image'); ?></a>
                    </div>
                </div>

                <input type="hidden" name="drag_and_drop_zones[<?= $i; ?>][thumbnail]" class="slide-thumbnail" value="<?= $zones[$i]['thumbnail']; ?>">
                <input type="hidden" name="drag_and_drop_zones[<?= $i; ?>][image]" class="slide-image" value="<?= $zones[$i]['image']; ?>">

            </div>
        </div>
    </div>
<?php endfor; ?>

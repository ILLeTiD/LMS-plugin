<div class="lms-puzzle-wrap">
    <?php for ($i = 0; $i < 6; $i++): ?>
        <div class="slide-content__image slide-image">
            <button type="button" id="insert-media-button" class="button insert-media add_media js-set-slide-image <?= ! empty($puzzle[$i]['image']) ? 'hidden' : ''; ?>" data-editor="content">
                <span class="wp-media-buttons-icon"></span> <?= __('Add Media', 'lms-plugin'); ?>
            </button>

            <div class="field__title"> <?= __('Piece ' . ($i + 1), 'lms-plugin'); ?> </div>

            <div class="js-slide-image <?= empty($puzzle[$i]['image']) ? 'hidden' : ''; ?>">
                <a href="#" class="js-update-slide-image slide-image__thumbnail-wrapper">
                    <img class="js-slide-image-thumbnail slide-image__thumbnail" src="<?= isset($puzzle[$i]) ? $puzzle[$i]['thumbnail'] : ''; ?>">
                </a>
                <div>
                    <a href="#" class="js-remove-slide-image"><?= __('Remove image'); ?></a>
                </div>
            </div>

            <input type="hidden" name="puzzle[<?= $i; ?>][thumbnail]" class="slide-thumbnail" value="<?= isset($puzzle[$i]) ? $puzzle[$i]['thumbnail'] : ''; ?>">
            <input type="hidden" name="puzzle[<?= $i; ?>][image]" class="slide-image" value="<?= isset($puzzle[$i]) ? $puzzle[$i]['image'] : ''; ?>">

        </div>
    <?php endfor; ?>
</div>

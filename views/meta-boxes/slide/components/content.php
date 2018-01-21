<?php $i = is_null($i) ? '' : $i; ?>

<div class="lms-slide-section" id="slide-<?= $i === '' ? 'template' : $i; ?>">

    <h4 class="lms-slide-section__title">
        <i class="fa fa-bars" aria-hidden="true"></i>
        <?= __('Section', 'lms-plugin'); ?> <span class="slide-number"><?= $i + 1; ?></span>
    </h4>

    <div class="row no-gutters">
        <div class="col-9">

            <?php //wp_editor(array_get($slide, 'text'), "slide_content_{$i}", [
            //     'media_buttons' => false,
            //     'textarea_name' => "slide_content[{$i}][text]",
            //     'textarea_rows' => 4,
            //     'editor_class' => 'lms-slide-section__editor'
            // ]); ?>
            <textarea name="slide_content[<?= $i; ?>][text]" id="slide_content_<?= $i; ?>" class="lms-slide-section__editor"><?= array_get($slide, 'text'); ?></textarea>

        </div>

        <div class="col-3 lms-slide-section__second-column">

            <?php include 'image.php'; ?>

            <a href="#" class="lms-slide-section__advance-settings-link js-advanced-settings">
                <?= __('Advanced Settings', 'lms-plugin'); ?>
            </a>

        </div>
    </div>

    <?php include 'advanced-settings.php'; ?>

    <!-- TODO: Restore slide after removing functionality. -->
    <button type="button" class="notice-dismiss lms-slide-section__remove-button js-remove-slide">
        <span class="screen-reader-text"><?= __('Dismiss this notice.'); ?></span>
    </button>

</div>

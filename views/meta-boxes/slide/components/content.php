<?php $i = is_null($i) ? '' : $i; ?>

<div class="lms-slide-section" id="slide-section-<?= $i === '' ? 'template' : $i; ?>" data-section="<?= $i; ?>">

    <h4 class="lms-slide-section__title">
        <i class="fa fa-bars js-sortable-handle" aria-hidden="true"></i>
        <?= __('Section', 'lms-plugin'); ?> <span class="slide-number"><?= isset($slideNumber) ? $slideNumber++ : $i + 1; ?></span>
    </h4>

    <div class="row no-gutters">
        <div class="col-9">

            <textarea name="slide_content[<?= $i; ?>][text]"
                      id="section_text_<?= $i; ?>"
                      class="lms-slide-section__editor wp-editor-area"
            ><?= array_get($slide, 'text'); ?></textarea>

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

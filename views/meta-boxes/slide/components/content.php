<?php $i = is_null($i) ? '' : $i; ?>

<div class="slide-content field" id="slide-<?= $i === '' ? 'template' : $i; ?>">
    <!-- TODO: Restore slide after removing functionality. -->
    <button type="button" class="notice-dismiss js-remove-slide">
        <span class="screen-reader-text"><?= __('Dismiss this notice.'); ?></span>
    </button>

    <div class="field__title" style="">
        <h4><?= __('Content', 'lms-plugin'); ?> <span class="slide-number"><?= ++$slideNumber; ?></span></h4>
        <a href="#" class="slide-content__advance-settings-link js-advanced-settings">
            <?= __('Advanced Settings', 'lms-plugin'); ?>
        </a>
    </div>
    <div class="field__value">
        <textarea name="slide_content[<?= $i; ?>][text]"><?= array_get($slide, 'text'); ?></textarea>

        <?php include 'image.php'; ?>
    </div>

    <?php include 'advanced-settings.php'; ?>

</div>

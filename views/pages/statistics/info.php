<div id="lms_participant_info_meta_box" class="postbox">
    <h2 class="hndle ui-sortable-handle"><span><?= __('Info', 'lms-plugin'); ?></span></h2>
    <div class="inside">
        <p>
        <div class="lms-statistics-info__label">
            <?= __('From', 'lms-plugin'); ?>:
            <strong><?= $from; ?></strong>
        </div>
        <div class="lms-statistics-info__label">
            <?= __('To', 'lms-plugin'); ?>:
            <strong><?= $to; ?></strong>
        </div>

        <p>
        <div class="lms-statistics-info__label">
            <?= __('Courses', 'lms-plugin'); ?>:
            <strong><?= $courses->count(); ?></strong>
        </div>
        <div class="lms-statistics-info__label">
            <?= __('Participants', 'lms-plugin'); ?>:
            <strong><?= $participants->count(); ?></strong>
        </div>
    </div>
</div>

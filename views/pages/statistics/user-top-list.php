<div id="lms_statistics_progress_meta_box" class="postbox">
    <h2 class="hndle ui-sortable-handle">
        <span><?= __('User Top List', 'lms-plugin'); ?></span>
    </h2>
    <div class="inside">
        <div>
            <h4><?= __('Most Hardworking', 'lms-plugin'); ?></h4>
            <ol>
                <?php foreach ($users as $user): ?>
                    <li>
                        <?= $user->name; ?>
                        <span>(<?= $user->completed_courses; ?> <?= __('completed', 'lms-plugin'); ?></span>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>

        <div class="lsm-link-wrap right">
            <a href="#"><i class="fa fa-print" aria-hidden="true"></i> <?= __('Print report', 'lms-plugin'); ?></a>
        </div>
    </div>
</div>

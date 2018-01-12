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
                        <span>(<?= $user->number; ?> <?= __('completed', 'lms-plugin'); ?>)</span>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>

        <?php component('components.print-button', ['link' => '', 'text' => __('Print Report', 'lms-plugin')]); ?>

    </div>
</div>

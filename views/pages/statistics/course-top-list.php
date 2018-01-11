<div id="lms_statistics_progress_meta_box" class="postbox">
    <h2 class="hndle ui-sortable-handle">
        <span><?= __('Course Top List', 'lms-plugin'); ?></span>
    </h2>
    <div class="inside">
        <div>
            <h4><?= __('Most participants', 'lms-plugin'); ?></h4>
            <ol>
                <?php foreach ($most_participants as $course): ?>
                    <li>
                        <a href="<?= page_url('course.edit', ['post' => $course->id]); ?>">
                            <?= $course->name; ?>
                        </a>
                        <span>(<?= $course->participants; ?> p)</span>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>

        <div>
            <h4><?= __('Best completion', 'lms-plugin'); ?></h4>
            <ol>
                <?php foreach ($best_completion as $course): ?>
                    <li>
                        <?= $course->name; ?>
                        <span>(<?= $course->best_grade; ?> p)</span>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>

        <div class="lsm-link-wrap right">
            <a href="#"><i class="fa fa-print" aria-hidden="true"></i> <?= __('Print report', 'lms-plugin'); ?></a>
        </div>
    </div>
</div>

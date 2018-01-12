<div id="lms-course-top-list-meta-box" class="postbox">
    <h2 class="hndle ui-sortable-handle">
        <span><?= __('Course Top List', 'lms-plugin'); ?></span>
    </h2>
    <div class="inside">
        <div class="lms-top-lists">
            <div class="lms-top-list">
                <h4 class="lms-top-list__title"><?= __('Most participants', 'lms-plugin'); ?></h4>
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

            <div class="lms-top-list">
                <h4 class="lms-top-list__title"><?= __('Best completion', 'lms-plugin'); ?></h4>
                <ol>
                    <?php foreach ($best_completion as $course): ?>
                        <li>
                            <a href="<?= page_url('course.edit', ['post' => $course->id]); ?>">
                                <?= $course->name; ?>
                            </a>
                            <span>(<?= $course->grade; ?>%)</span>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>

        <?php component('components.print-button', ['link' => '', 'text' => __('Print Report', 'lms-plugin')]); ?>

    </div>
</div>

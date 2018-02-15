<div id="lms-course-top-list-meta-box" class="postbox">
    <h2 class="hndle ui-sortable-handle">
        <span><?= __('Course Top List', 'lms-plugin'); ?></span>
    </h2>
    <div class="inside">
        <div class="lms-printable">
            <div class="lms-top-lists">
                <div class="lms-top-list">
                    <h4 class="lms-top-list__title"><?= __('Most participants', 'lms-plugin'); ?></h4>
                    <?php if ($most_participants->count()): ?>
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
                    <?php else: ?>
                        <?= __('No data', 'lms-plugin'); ?>
                    <?php endif; ?>
                </div>

                <div class="lms-top-list">
                    <h4 class="lms-top-list__title"><?= __('Best completion', 'lms-plugin'); ?></h4>
                    <?php if ($best_completion->count()): ?>
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
                    <?php else: ?>
                        <?= __('No data', 'lms-plugin'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php component('components.print-button'); ?>

    </div>
</div>

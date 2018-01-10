<table class="wp-list-table widefat fixed striped posts lms-activities-table">
    <thead>
    <tr>
        <td id="cb" class="manage-column column-cb check-column"></td>
        <th class="column-activity"><?= __('Activity', 'lms-plugin'); ?></th>
        <th class="column-action"><?= __('Action', 'lms-plugin'); ?></th>
        <th class="column-course"><?= __('Course', 'lms-plugin'); ?></th>
    </tr>
    </thead>

    <tbody>
    <?php if ($activities->count()): ?>
        <?php foreach ($activities as $activity): ?>
            <tr>
                <td></td>
                <td>
                    <?= $activity->date; ?>
                    <?= __('at', 'lms-plugin'); ?>
                    <?= $activity->time;  ?>
                    <div>
                        <?= $activity->description;  ?>
                        <?php if ($activity->slide): ?>
                            <a href="<?= edit_slide_url($activity->slide); ?>">
                                <?= $activity->slide->name; ?>
                            </a>
                        <?php else: ?>
                            <a href="<?= edit_course_url($activity->course); ?>">
                                <?= $activity->course->name; ?>
                            </a>
                        <?php endif;?>
                    </div>
                </td>
                <td>
                    <?= $activity->name;  ?>
                </td>
                <td>
                    <a href="<?= edit_course_url($activity->course); ?>">
                        <?= $activity->course->name; ?>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr class="no-items">
            <td class="colspanchange" colspan="4">
                <?= __('No activities found.', 'lms-plugin'); ?>
            </td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>

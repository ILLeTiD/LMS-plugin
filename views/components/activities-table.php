<table class="wp-list-table widefat fixed striped posts lms-activities-table">
    <thead>
    <tr>
        <td id="cb" class="manage-column column-cb check-column"></td>
        <th class="column-activity"><?= __('Activity', 'lms-plugin'); ?></th>
        <th class="column-action"><?= __('Type', 'lms-plugin'); ?></th>
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
                        <?php $description = array_get($dictionary, "{$activity->type}.{$activity->name}"); ?>
                        <?php if ($activity->type == 'course'): ?>
                            <?= sprintf($description, lms_course_edit_link($activity->course)); ?>
                        <?php else: ?>
                            <?= $description; ?>
                        <?php endif; ?>
                    </div>
                </td>
                <td>
                    <?= ucfirst($activity->type); ?>
                </td>
                <td>
                    <?php if ($activity->type == 'course'): ?>
                        <a href="<?= edit_course_url($activity->course); ?>">
                            <?= $activity->course->name; ?>
                        </a>
                    <?php else: ?>
                        —
                    <?php endif; ?>
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

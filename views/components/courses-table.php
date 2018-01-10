<table class="wp-list-table widefat fixed striped posts">
    <thead>
    <tr>
        <td id="cb" class="manage-column column-cb check-column"></td>
        <th class="manage-column">
            <a href="#"><span><?= __('Title', 'lms-plugin'); ?></span></a>
        </th>
        <th class="manage-column"><?= __('Author', 'lms-plugin'); ?></th>
        <th class="manage-column"><?= __('Category', 'lms-plugin'); ?></th>
        <th class="manage-column"><?= __('Enrollment Date', 'lms-plugin'); ?></th>
        <th class="manage-column"><?= __('Last Activity', 'lms-plugin'); ?></th>
        <th class="manage-column"><?= __('Progress', 'lms-plugin'); ?></th>
        <th class="manage-column"><?= __('Status', 'lms-plugin'); ?></th>
        <th class="manage-column"></th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($enrollments as $enrollment): ?>
        <tr>
            <td></td>
            <td>
                <a href="<?= edit_course_url($enrollment->course); ?>">
                    <?= $enrollment->course->name; ?>
                </a>
            </td>
            <td>
                <a href="<?= admin_url('edit.php?post_type=course&author='.$enrollment->course->author->id); ?>">
                    <?= $enrollment->course->author->name; ?>
                </a>
            </td>
            <td>
                <?php if ($enrollment->course->category): ?>
                    <a href="<?= admin_url('edit.php?post_type=course&category_name='.$enrollment->course->category->slug); ?>">
                        <?= $enrollment->course->category->name; ?>
                    </a>
                <?php else: ?>
                    —
                <?php endif ?>
            </td>
            <td><?= $enrollment->enrollment_date; ?></td>
            <td><?= $enrollment->last_activity; ?></td>
            <td><?= $enrollment->progress; ?>%</td>
            <td>
                <span class="lms-status-<?= $enrollment->status; ?>">
                    <?= get_status_label($enrollment->status); ?>
                </span>
                <?php if ($enrollment->status == 'completed'): ?>
                    <br>
                    <?= date(get_option('date_format'), $user->{'completed_'.$enrollment->course->id}); ?>
                <?php endif; ?>
            </td>
            <td>
                <?php component('components.change-status', [
                    'user' => $user,
                    'enrollment' => $enrollment,
                    'statuses' => $statuses
                ]); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script>
    (function ($) {

        $(function () {
            $('.js-status-select').on('change', function (event) {
                this.form.submit();
            });

            $('.js-change-status-form').on('submit', function (event) {
                var form = $(this),
                    url = form.attr('action') ;

                $.ajax({
                    method: form.attr('method'),
                    url: url,
                    data: form.serialize()
                }).done(function (response) {
                    console.log(response);
                });

                event.preventDefault();
            });
        });

    })(jQuery);
</script>

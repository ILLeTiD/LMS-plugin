<form action="<?= admin_url('admin-ajax.php?action=change_status'); ?>"
      method="POST"
      class="js-change-status-form"
>
    <input type="hidden" name="user_id" value="<?= $user->ID; ?>">
    <input type="hidden" name="course_id" value="<?= $enrollment->course->id; ?>">

    <select name="status" class="js-status-select">
        <?php foreach ($statuses as $name => $label): ?>
            <option
                value="<?= $name; ?>"
                <?= selected($name, $enrollment->status); ?>
            >
                <?= $label; ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

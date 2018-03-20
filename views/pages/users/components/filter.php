<div class="alignleft actions">
    <label>
        <?= __('From', 'lms-plugin'); ?>:
        <input type="text" class="lms-has-datepicker" name="from" value="<?= $filter_from; ?>">
    </label>
    <label>
        <?= __('To', 'lms-plugin'); ?>:
        <input type="text" class="lms-has-datepicker" name="to" value="<?= $filter_to; ?>">
    </label>
</div>
<div class="alignleft actions">
    <select name="role">
        <option value="">All roles</option>
        <?php wp_dropdown_roles($filter_role); ?>
    </select>

    <button class="button">Filter</button>
</div>


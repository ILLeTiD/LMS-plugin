<div class="alignleft actions">
    <label>
        <?= __('From', 'lms-plugin'); ?>:
        <input type="text" class="lms-has-datepicker" name="from" value="">
    </label>
    <label>
        <?= __('To', 'lms-plugin'); ?>:
        <input type="text" class="lms-has-datepicker" name="to" value="">
    </label>
</div>
<div class="alignleft actions">
    <select name="role">
        <option value="">All roles</option>
        <option value="backoffice">Backoffice</option>
        <option value="technicians">Technicians</option>
        <option value="sales">Sales</option>
    </select>

    <button class="button">Filter</button>
</div>


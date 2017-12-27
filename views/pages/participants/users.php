<table class="users wp-list-table widefat striped lms-without-border">
    <thead>
        <tr>
            <td class="check-column">
                <input type="checkbox" class="js-checkbox-select-all" data-class="lms-checkbox-user">
            </td>
            <th>
                <?= __('Name', 'lms-plugin'); ?>
            </th>
            <th>
                <?= __('Role', 'lms-plugin'); ?>
            </th>
            <th class="lms-align-right">
                <?= __('Last Activity', 'lms-plugin'); ?>
            </th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users->results as $user): ?>
        <tr>
            <td>
                <input type="checkbox" class="lms-checkbox-user">
            </td>
            <td>
                <?= $user->display_name; ?>
            </td>
            <td>
                <?= ucfirst(implode(', ', $user->roles)); ?>
            </td>
            <td>
                <?= $user->last_activity ?: __('Unknown', 'lms-plugin'); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

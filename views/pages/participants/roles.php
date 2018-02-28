<table class="wp-list-table widefat striped lms-without-border">
    <thead>
    <tr>
        <td class="check-column">
            <input type="checkbox" class="js-checkbox-select-all" data-class="lms-checkbox-role">
        </td>
        <th><?= __('Name', 'lms-plugin'); ?></th>
        <th class="lms-align-right"><?= __('Users', 'lms-plugin'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($roles as $name => $label): ?>
        <tr>
            <td>
                <input class="lms-checkbox-role" type="checkbox" name="roles[]" value="<?= $name; ?>">
            </td>
            <td>
                <?= $label; ?>
            </td>
            <td class="lms-align-right"></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

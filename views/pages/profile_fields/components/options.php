<?php
$show_options = isset($field) && in_array(array_get($field, 'type'), ['select', 'radio']);
?>

<div class="lms-profile-field-options-container <?= $show_options ? '' : 'hidden'; ?>">
    <table class="wp-list-table widefat striped lms-profile-field-options-table">
        <thead>
            <tr>
                <th><?= __('Text', 'lms-plugin'); ?></th>
                <th><?= __('Default value', 'lms-plugin'); ?></th>
                <th></th>
                <th><?= __('Sort', 'lms-plugin'); ?></th>
            </tr>
        </thead>
        <tbody class="lms-profile-field-options">
            <?php if ($options = array_get($field, 'options')): ?>
                <?php $i = 0; ?>
                <?php foreach ($options as $option): ?>
                    <?php include('option.php'); ?>
                    <?php $i++; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <tr class="no-items">
                    <td class="colspanchange" colspan="6">
                        <?= __('No options yet.', 'lms-plugin'); ?>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="#" class="js-add-option">
        <?= __('+ Add field', 'lms-plugin'); ?>
    </a>
</div>

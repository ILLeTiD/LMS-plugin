<tr class="lms-profile-field-option">
    <td>
        <input type="text"
               name="options[<?= $i; ?>][value]"
               value="<?= array_get($option, 'value'); ?>"
        >
    </td>
    <td>
        <input type="radio"
               name="default_option"
               value="<?= $i; ?>"
               <?= isset($field) ? checked(array_get($field, 'default_option'), $i) : ''; ?>
        >
    </td>
    <td>
        <a href="#"
           class="lms-button_delete-option js-delete-option"
        >
            <?= __('Delete', 'lms-plugin'); ?>
        </a>
    </td>
    <td>
        <i class="fa fa-bars js-sortable-handle" aria-hidden="true"></i>
    </td>
</tr>


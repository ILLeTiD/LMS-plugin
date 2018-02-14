<tr class="lms-profile-field-option">
    <td>
        <input type="text"
               name="options[<?= $i; ?>][value]"
               value="<?= array_get($option, 'value'); ?>"
        >
    </td>
    <td>
        <input type="radio"
               name="options[<?= $i; ?>][default]"
               value="1"
               <?= checked(array_get($option, 'default')); ?>
        >
    </td>
    <td>
        <a href="#"
           class="js-delete-option"
        >
            <?= __('Delete', 'lms-plugin'); ?>
        </a>
    </td>
    <td>
        <i class="fa fa-bars js-sortable-handle" aria-hidden="true"></i>
    </td>
</tr>


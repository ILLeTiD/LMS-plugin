<tr class="lms-profile-field-option">
    <td>
        <input type="text"
               name="options[]"
               value="<?= $option; ?>"
        >
    </td>
    <td>
        <input type="radio"
               name="default_option"
               value="<?= $i; ?>"
               <?= checked($i, array_get($field, 'default_option')); ?>
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


<tr class="lms-profile-field">
    <td>
       <?= array_get($field, 'name'); ?>
    </td>
    <td>
       <?= array_get($field, 'slug'); ?>
    </td>
    <td class="muted">
        <?= ucfirst(array_get($field, 'type')); ?>
    </td>
    <td class="muted">
        <?= array_get($field, 'required') ? __('Yes', 'lms-plugin') : __('No', 'lms-plugin'); ?>
    </td>
    <td class="muted">
        <?php if (isset($field['standard'])): ?>
            <i>
                <?= __('Standard', 'lms-plugin'); ?>
            </i>
        <?php else: ?>
            <a href="<?= admin_url('edit.php?post_type=course&page=profile_field.edit&id=' . $i); ?>">
                <?= __('Edit', 'lms-plugin'); ?>
            </a>
        <?php endif; ?>
    </td>
    <td>
        <i class="fa fa-bars lms-profile-field__bars js-sortable-handle" aria-hidden="true"></i>
        <input type="hidden" name="fields_order[]" value="<?= $i; ?>">
    </td>
</tr>

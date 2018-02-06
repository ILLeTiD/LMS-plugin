<tr class="lms-profile-field">
    <td>
        <input type="text"
               name="fields[<?= $i; ?>][name]"
               value="<?= array_get($field, 'name'); ?>"
        >
    </td>
    <td>
        <input type="text"
               name="fields[<?= $i; ?>][slug]"
               value="<?= array_get($field, 'slug'); ?>"
        >
    </td>
    <td>
        <select name="fields[<?= $i; ?>][type]"
                class="js-change-field-type"
                <?= isset($field['standard']) ? 'disabled' : ''; ?>
        >
            <option value="text"
                <?= selected('text', array_get($field, 'type')); ?>
            >
                <?= __('Text', 'lms-plugin'); ?>
            </option>
            <option value="mail"
                <?= selected('mail', array_get($field, 'type')); ?>
            >
                <?= __('Mail', 'lms-plugin'); ?>
            </option>
            <option value="password"
                <?= selected('password', array_get($field, 'type')); ?>
            >
                <?= __('Password', 'lms-plugin'); ?>
            </option>
            <option value="checkbox"
                <?= selected('checkbox', array_get($field, 'type')); ?>
            >
                <?= __('Checkbox', 'lms-plugin'); ?>
            </option>
            <option value="select"
                <?= selected('select', array_get($field, 'type')); ?>
            >
                <?= __('Select', 'lms-plugin'); ?>
            </option>
            <option value="radio"
                <?= selected('radio', array_get($field, 'type')); ?>
            >
                <?= __('Radio', 'lms-plugin'); ?>
            </option>
        </select>
    </td>
    <td>
        <select name="fields[<?= $i; ?>][required]"
                <?= isset($field['standard']) ? 'disabled' : ''; ?>
        >
            <option value="0"
                    <?= selected(array_get($field, 'required'), 0); ?>
            >
                <?= __('No', 'lms-plugin'); ?>
            </option>
            <option value="1"
                    <?= selected(array_get($field, 'required'), 1); ?>
            >
                <?= __('Yes', 'lms-plugin'); ?>
            </option>
        </select>
    </td>
    <td>
        <?php if (isset($field['standard'])): ?>
            <i class="lms-profile-field__standard">
                <?= __('Standard', 'lms-plugin'); ?>
            </i>
            <input type="hidden" name="fields[<?= $i; ?>][standard]" value="1">
            <input type="hidden" name="fields[<?= $i; ?>][type]" value="<?= array_get($field, 'type'); ?>">
            <input type="hidden" name="fields[<?= $i; ?>][required]" value="1">
        <?php else: ?>
            <a href="#"
               class="lms-profile-field__remove-button js-remove-profile-field"
            >
                <?= __('Delete', 'lms-plugin'); ?>
            </a>
        <?php endif; ?>
    </td>
    <td>
        <i class="fa fa-bars lms-profile-field__bars js-sortable-handle" aria-hidden="true"></i>
    </td>
</tr>

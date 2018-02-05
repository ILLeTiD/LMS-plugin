<div id = "profile-field-<?= $i; ?>"
     class="lms-profile-field">
    <h4 class="lms-profile-field__title">
        <i class="fa fa-bars js-sortable-handle" aria-hidden="true"></i>
        <?= __('Field', 'lms-plugin'); ?>
    </h4>
    <div class="row">
        <div class="col-4">
            <select name="settings[fields][<?= $i; ?>][type]"
                    class="js-change-field-type">
                    <option value="text"
                        <?= selected('text', array_get($field, 'type')); ?>
                    >
                        <?= __('Text', 'lms-plugin'); ?>
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
            </select>
        </div>
        <div class="col-4">
            <input type="text"
                   name="settings[fields][<?= $i; ?>][name]"
                   value="<?= array_get($field, 'name'); ?>"
            >
            <textarea name="settings[fields][<?= $i; ?>][options]"
                      class="<?= array_get($field, 'type') != 'select' ? 'hidden' : ''; ?>"
            ><?= array_get($field, 'options'); ?></textarea>
        </div>
        <div class="col-4">
            <label>
                <input type="checkbox"
                       name="settings[fields][<?= $i; ?>][required]"
                       <?= checked(array_get($field, 'required')); ?>
                       value="1"
                >
                <?= __('Required', 'lms-plugin'); ?>
            </label>
        </div>
    </div>

    <button type="button"
            class="notice-dismiss lms-button-remove-profile-field js-remove-profile-field"
            data-field="<?= $i; ?>"
    >
        <span class="screen-reader-text"><?= __('Dismiss this notice.'); ?></span>
    </button>

    <hr>

</div>

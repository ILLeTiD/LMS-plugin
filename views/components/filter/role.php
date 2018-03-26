<select name="role">
    <option value=""><?= __('All roles', 'lms-plugin'); ?></option>
    <?php wp_dropdown_roles($role); ?>
</select>


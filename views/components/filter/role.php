<?php if (count($roles)): ?>
    <select name="role">
        <option value=""><?= __('All roles', 'lms-plugin'); ?></option>
        <?php foreach ($roles as $name => $r): ?>
            <?= d($role); ?>
            <option value="<?= $name; ?>"
                <?= selected($name, $role); ?>
            >
                <?= $r['label']; ?>
            </option>
        <?php endforeach; ?>
    </select>
<?php endif; ?>


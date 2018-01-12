<div class="tablenav top">
    <form method="POST">
        <div class="alignleft actions">
            <select name="from">
                <option><?= __('From', 'lms-plugin'); ?></option>
            </select>
            <select name="from">
                <option><?= __('To', 'lms-plugin'); ?></option>
            </select>
        </div>
        <div class="alignleft actions">
            <select name="category">
                <option><?= __('All categories', 'lms-plugin'); ?></option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category->term_id; ?>"
                            <?= selected($category->term_id, $filter['category']); ?>
                    >
                        <?= $category->name; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button class="button"><?= __('Filter', 'lms-plugin'); ?></button>
        </div>
    </form>
</div>

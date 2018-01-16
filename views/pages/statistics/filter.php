<div class="tablenav top">
    <form method="POST">
        <div class="alignleft actions">
            <select name="from">
                <option value=""><?= __('From', 'lms-plugin'); ?></option>
                <?php foreach ($dateFilter as $date): ?>
                    <option value="<?= $date->format('Y-m-d H:i:s'); ?>"
                            <?= selected($date->format('Y-m-d H:i:s'), $from); ?>
                    >
                        <?= $date->format(get_option('date_format')); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <select name="to">
                <option value=""><?= __('To', 'lms-plugin'); ?></option>
                <?php foreach ($dateFilter as $date): ?>
                    <option value="<?= $date->format('Y-m-d H:i:s'); ?>"
                            <?= selected($date->format('Y-m-d H:i:s'), $to); ?>
                    >
                        <?= $date->format(get_option('date_format')); ?>
                    </option>
                <?php endforeach; ?>
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

<div class="tablenav top">
    <form method="POST">
        <div class="alignleft actions">
            <label>
                <?= __('From', 'lms-plugin'); ?>:
                <input type="text" id="from" name="from" value="<?= $from; ?>">
            </label>
            <label>
                <?= __('To', 'lms-plugin'); ?>:
                <input type="text" id="to" name="to" value="<?= $to; ?>">
            </label>
        </div>
        <div class="alignleft actions">
            <?php if ($categories->count()): ?>
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
            <?php endif; ?>

            <button class="button"><?= __('Filter', 'lms-plugin'); ?></button>
        </div>
    </form>
</div>

<script>
    (function ($) {

        $(function () {
            var dateFormat = 'yy-mm-dd',
                from = $('#from').datepicker({dateFormat: dateFormat})
                    .on('change', function () {
                        to.datepicker('option', 'minDate', getDate(this));
                    }),
                to = $('#to').datepicker({dateFormat: dateFormat})
                    .on('change', function () {
                        from.datepicker('option', 'maxDate', getDate(this));
                    });

            function getDate(element) {
                var date;
                try {
                    date = $.datepicker.parseDate(dateFormat, element.value);
                } catch (error) {
                    date = null;
                }

                return date;
            }
        });
    })(jQuery);
</script>

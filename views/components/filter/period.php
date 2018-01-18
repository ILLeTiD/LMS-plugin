<label>
    <?= __('From', 'lms-plugin'); ?>:
    <input type="text" id="from" name="from" value="<?= $from; ?>">
</label>
<label>
    <?= __('To', 'lms-plugin'); ?>:
    <input type="text" id="to" name="to" value="<?= $to; ?>">
</label>

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


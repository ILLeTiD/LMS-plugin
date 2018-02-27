<div class="alignleft actions">
    <label>
        From:
        <input type="text" id="from" name="from" value="" class="hasDatepicker">
    </label>
    <label>
        To:
        <input type="text" id="to" name="to" value="" class="hasDatepicker">
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

</div>
<div class="alignleft actions">
    <select name="role">
        <option value="">All roles</option>
        <option value="backoffice">Backoffice</option>
        <option value="technicians">Technicians</option>
        <option value="sales">Sales</option>
    </select>

    <button class="button">Filter</button>
</div>


<div class="lms-activity-filters">
    <!--    <div class="activity-filters__wrapper">-->
    <div class="lms-activity-filter lms-activity-filter--date-from">
        <span><?php _e('from', 'lms-plugin') ?></span> <input type="date" placeholder="Select Date.." class="lms-activity-filter-datepicked">
    </div>
    <div class="lms-activity-filter lms-activity-filter--date-to">
        <span><?php _e('to', 'lms-plugin') ?></span> <input type="date" placeholder="Select Date.." class="lms-activity-filter-datepicked">
    </div>
    <div class="lms-activity-filter lms-activity-filter--type">
        <select name="activity-filter-type" id="activity-filter-type">
            <option value="all" selected>
                <?php _e('All activity', 'lms-plugin') ?>
            </option>
            <option value="course">
                <?php _e('Course activity', 'lms-plugin') ?>
            </option>
            <option value="account">
                <?php _e('Account activity', 'lms-plugin') ?>
            </option>
        </select>
    </div>
    <!--    </div>-->
</div>
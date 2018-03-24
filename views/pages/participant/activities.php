<div class="wrap">
    <h1 class="wp-heading-inline">
        <?= $user->name . __('\'s', 'lms-plugin'); ?>
        <?= __('Courses', 'lms-plugin'); ?>:
    </h1>

    <a href="<?= admin_url('?post_type=course&page=participant&uid=' . $user->ID); ?>">
        <?= __('Back to Participant', 'lms-plugin'); ?>
    </a>

    <a href="<?= admin_url('user-edit.php?user_id=' . $user->ID); ?>"
       class="page-title-action"
    >
        <?= __('Edit User', 'lms-plugin'); ?>
    </a>

    <hr class="wp-header-end">

    <form method="GET">
        <input type="hidden" name="post_type" value="course">
        <input type="hidden" name="page" value="participant_activities">
        <input type="hidden" name="uid" value="<?= $user->id; ?>">

        <p class="search-box">
            <input type="search" id="user-search-input" name="search" value="<?= $search; ?>">
            <input type="submit" id="search-submit" class="button" value="<?= __('Search Activity', 'lms-plugin'); ?>">
        </p>

        <div class="tablenav top">
            <div class="alignleft actions">
                <input type="text" 
                        class="lms-has-datepicker" 
                        name="filter[from]" 
                        value="<?= array_get($filter, 'from'); ?>"
                        placeholder="<?= __('To', 'lms-plugin'); ?>"
                >
                <input type="text" 
                        class="lms-has-datepicker" 
                        name="filter[to]" 
                        value="<?= array_get($filter, 'to'); ?>"
                        placeholder="<?= __('From', 'lms-plugin'); ?>"
                >
            </div>
            <div class="alignleft actions">
                <select name="filter[type]">
                    <option value=""><?= __('All activities', 'lms-plugin'); ?></option>
                    <option value="account"
                            <?= selected(array_get($filter, 'type'), 'account'); ?>
                    ><?= __('Account', 'lms-plugin'); ?></option>
                    <option value="course"
                            <?= selected(array_get($filter, 'type'), 'course'); ?>
                    ><?= __('Course', 'lms-plugin'); ?></option>
                </select>
            </div>
            <div class="alignleft actions">
                <select name="filter[course]">
                    <option value=""><?= __('All courses', 'lms-plugin'); ?></option>
                    <?php foreach ($courses as $course): ?>
                        <option value="<?= $course->id; ?>"
                            <?= selected(array_get($filter, 'course'), $course->id); ?>
                        >
                            <?= $course->name; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <button class="button"><?= __('Filter', 'lms-plugin'); ?></button>
            </div>

            <?= $activities->pagination->display('top'); ?>

            <br class="clear">
        </div>
    </form>

    <?php component('components.activities-table', compact('activities', 'dictionary')); ?>


    <div class="tablenav bottom">

        <?= $activities->pagination->display('bottom'); ?>

        <br class="clear">
    </div>

</div>

<script>
    (function ($) {
        $(function () {
            $('.lms-has-datepicker').datepicker({ dateFormat: 'yy-mm-dd' });
        });
    })(jQuery);
</script>

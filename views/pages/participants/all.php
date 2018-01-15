<div class="wrap">
    <h1 class="wp-heading-inline">
        <?= __('All Participants', 'lms-plugin'); ?>
    </h1>

    <hr class="wp-header-end">

    <form id="posts-filter" method="get">

        <p class="search-box">
            <label class="screen-reader-text" for="post-search-input">Search Courses:</label>
            <input type="search" id="post-search-input" name="s" value="">
            <input type="submit" id="search-submit" class="button" value="Search Courses">
        </p>

        <input type="hidden" name="post_status" class="post_status_page" value="all">
        <input type="hidden" name="post_type" class="post_type_page" value="course">

        <input type="hidden" id="_wpnonce" name="_wpnonce" value="2a8c4a228e"><input type="hidden" name="_wp_http_referer" value="/wp-admin/edit.php?post_type=course">

        <div class="tablenav top">
            <div class="alignleft actions bulkactions">
                <label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label>
                <select name="action" id="bulk-action-selector-top">
                    <option value="-1">Bulk Actions</option>
                    <option value="edit" class="hide-if-no-js">Edit</option>
                    <option value="trash">Move to Trash</option>
                </select>
                <input type="submit" id="doaction" class="button action" value="Apply">
            </div>

            <div class="alignleft actions">
                <label for="filter-by-date" class="screen-reader-text">Filter by date</label>
                <select name="m" id="filter-by-date">
                    <option selected="selected" value="0">All dates</option>
                    <option value="201712">December 2017</option>
                </select>
                <label for="filter-by-role" class="screen-reader-text">Filter by role</label>
                <select name="role_filter" id="filter-by-role">
                    <option value="all"><?= __('All roles', 'lms-plugin'); ?></option>
                    <?php foreach ($roles as $name => $role): ?>
                        <option value="<?= $name; ?>"><?= $role['label']; ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="submit" name="filter_action" id="post-query-submit" class="button" value="Filter">
            </div>

            <div class="tablenav-pages one-page">
                <span class="displaying-num">
                    <?= sprintf(_n( '%s item', '%s items', count($users)), count($users) ); ?>
                </span>
                <span class="pagination-links"><span class="tablenav-pages-navspan" aria-hidden="true">«</span>
<span class="tablenav-pages-navspan" aria-hidden="true">‹</span>
<span class="paging-input"><label for="current-page-selector" class="screen-reader-text">Current Page</label><input class="current-page" id="current-page-selector" type="text" name="paged" value="1" size="1" aria-describedby="table-paging"><span class="tablenav-paging-text"> of <span class="total-pages">1</span></span></span>
<span class="tablenav-pages-navspan" aria-hidden="true">›</span>
<span class="tablenav-pages-navspan" aria-hidden="true">»</span></span></div>
            <br class="clear">
        </div>
        <h2 class="screen-reader-text">Posts list</h2>
        <table class="wp-list-table widefat fixed striped posts">
            <thead>
            <tr>
                <td id="cb" class="manage-column column-cb check-column">
                    <label class="screen-reader-text" for="cb-select-all-1">Select All</label>
                    <input id="cb-select-all-1" type="checkbox">
                </td>
                <th scope="col" id="name" class="manage-column column-name">
                    <?= __('Name', 'lms-plugin'); ?>
                </th>
                <th scope="col" id="role" class="manage-column column-role">
                    <?= __('Role', 'lms-plugin'); ?>
                </th>
                <th scope="col" id="last-activity" class="manage-column column-last-activity">
                    <?= __('Last Activity'); ?>
                </th>
                <th scope="col" id="completed" class="manage-column column-completed">
                    <?= __('Completed'); ?>
                </th>
                </th>
                <th scope="col" id="in-progress" class="manage-column column-in-progress">
                    <?= __('In Progress'); ?>
                </th>
                </th>
                <th scope="col" id="failed" class="manage-column column-failed">
                    <?= __('Failed'); ?>
                </th>
                </th>
                <th scope="col" id="pending-invites" class="manage-column column-pending-invites">
                    <?= __('Pending Invites'); ?>
                </th>
                </th>
            </tr>
            </thead>

            <tbody id="the-list">
            <?php foreach ($users as $user): ?>
                <tr id="post-<?= $user->id; ?>" class="iedit author-self level-0 post-4 type-course status-publish hentry">
                    <th scope="row" class="check-column">
                        <label class="screen-reader-text" for="cb-select-<?= $user->id; ?>">Select Test</label>
                        <input id="cb-select-<?= $user->ID; ?>" type="checkbox" name="post[]" value="<?= $user->id; ?>">
                        <div class="locked-indicator">
                            <span class="locked-indicator-icon" aria-hidden="true"></span>
                            <span class="screen-reader-text">“Test” is locked</span>
                        </div>
                    </th>
                    <td class="name column-name has-row-actions" data-colname="Title">
                        <div class="locked-info"><span class="locked-avatar"></span> <span class="locked-text"></span></div>
                        <strong>
                            <a class="row-title"
                               href="<?= admin_url('edit.php?post_type=course&page=participant&uid=' . $user->id); ?>"
                               aria-label="“Test” (Edit)"
                            >
                                <?= $user->name; ?>
                            </a>
                        </strong>
                    </td>
                    <td class="role column-role" data-colname="Role">
                        <a href="#"><?= $roles[$user->roles[0]]['label']; ?></a>
                    </td>
                    <td class="last-activity column-last-activity" data-colname="Last Activity">
                        <?php if ($user->last_activity): ?>
                            <?= date(get_option('date_format'), $user->last_activity); ?>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td class="completed column-completed"
                        data-colname="<?= __('Completed', 'lms-plugin'); ?>"
                    >
                        <?= $user->enrollments()->where(['status' => 'completed'])->count(); ?>
                    </td>
                    <td class="in-progress column-in-progress"
                        data-colname="<?= __('In Progress', 'lms-plugin'); ?>"
                    >
                        <?= $user->enrollments()->where(['status' => 'in_progress'])->count(); ?>
                    </td>
                    <td class="failed column-failed"
                        data-colname="<?= __('Failed', 'lms-plugin'); ?>"
                    >
                        <?= $user->enrollments()->where(['status' => 'failed'])->count(); ?>
                    </td>
                    <td class="pending-invites column-pending-invites"
                        data-colname="<?= __('Pending Invites', 'lms-plugin'); ?>"
                    >
                        <?= $user->enrollments()->where(['status' => 'invited'])->count(); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>

            <tfoot>
            <tr>
                <td id="cb" class="manage-column column-cb check-column">
                    <label class="screen-reader-text" for="cb-select-all-1">Select All</label>
                    <input id="cb-select-all-1" type="checkbox">
                </td>
                <th scope="col" id="name" class="manage-column column-name">
                    <?= __('Name', 'lms-plugin'); ?>
                </th>
                <th scope="col" id="role" class="manage-column column-role">
                    <?= __('Role', 'lms-plugin'); ?>
                </th>
                <th scope="col" id="last-activity" class="manage-column column-last-activity">
                    <?= __('Last Activity'); ?>
                </th>
                <th scope="col" id="completed" class="manage-column column-completed">
                    <?= __('Completed'); ?>
                </th>
                </th>
                <th scope="col" id="in-progress" class="manage-column column-in-progress">
                    <?= __('In Progress'); ?>
                </th>
                </th>
                <th scope="col" id="failed" class="manage-column column-failed">
                    <?= __('Failed'); ?>
                </th>
                </th>
                <th scope="col" id="pending-invites" class="manage-column column-pending-invites">
                    <?= __('Pending Invites'); ?>
                </th>
                </th>
            </tr>
            </tfoot>

        </table>
        <div class="tablenav bottom">

            <div class="alignleft actions bulkactions">
                <label for="bulk-action-selector-bottom" class="screen-reader-text">Select bulk action</label><select name="action2" id="bulk-action-selector-bottom">
                    <option value="-1">Bulk Actions</option>
                    <option value="edit" class="hide-if-no-js">Edit</option>
                    <option value="trash">Move to Trash</option>
                </select>
                <input type="submit" id="doaction2" class="button action" value="Apply">
            </div>
            <div class="alignleft actions">
            </div>
            <div class="tablenav-pages one-page">
                <span class="displaying-num">
                    <?= sprintf(_n( '%s item', '%s items', count($users)), count($users) ); ?>
                </span>
                <span class="pagination-links"><span class="tablenav-pages-navspan" aria-hidden="true">«</span>
<span class="tablenav-pages-navspan" aria-hidden="true">‹</span>
<span class="screen-reader-text">Current Page</span><span id="table-paging" class="paging-input"><span class="tablenav-paging-text">1 of <span class="total-pages">1</span></span></span>
<span class="tablenav-pages-navspan" aria-hidden="true">›</span>
<span class="tablenav-pages-navspan" aria-hidden="true">»</span></span></div>
            <br class="clear">
        </div>

    </form>
</div>

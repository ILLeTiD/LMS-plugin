<div class="wrap">
    <h1 class="wp-heading-inline">
        <?= __('Participants', 'lms-plugin'); ?>: <?= $course->post_title; ?>
    </h1>

    <a href="#TB_inline?width=auto&height=500&inlineId=lms-invite-participants"
       class="page-title-action thickbox js-invite-popup-button"
    >
        <?= __('Invite', 'lms-plugin'); ?>
    </a>

    <?php include 'invite.php'; ?>

    <?php if (array_key_exists('invited', $_GET)): ?>
        <div id="message" class="updated notice notice-success is-dismissible">
            <p><?= __('Participants have been invited.', 'lms-plugin'); ?></p>
            <button type="button" class="notice-dismiss">
                <span class="screen-reader-text"><?= __('Dismiss this notice.'); ?></span>
            </button>
        </div>
    <?php endif; ?>

    <hr class="wp-header-end">


    <h2 class="screen-reader-text">Filter posts list</h2>
    <ul class="subsubsub">
        <li class="all">
            <a href="<?= admin_url('edit.php?post_type=course&page=course_participants&cid=' . $course->ID); ?>"
               <?= is_null($status) ? 'class="current" aria-current="page"' : ''; ?>
            >
                <?= __('All', 'lms-plugin'); ?>
                <span class="count">(<?= $course->enrollments()->count(); ?>)</span>
            </a> |
        </li>
        <li class="enrolled">
            <a href="<?= admin_url('edit.php?post_type=course&page=course_participants&cid=' . $course->ID) . '&status=in_progress'; ?>"
                <?= $status == 'in_progress' ? 'class="current" aria-current="page"' : ''; ?>
            >
                <?= __('Enrolled', 'lms-plugin'); ?>
                <span class="count">
                    (<?= $course->enrollments()->whereIn('status', ['in_progress', 'completed', 'failed'])->count(); ?>)
                </span>
            </a> |
        </li>
        <li class="pending-invites">
            <a href="<?= admin_url('edit.php?post_type=course&page=course_participants&cid=' . $course->ID) . '&status=invited'; ?>"
                <?= $status == 'invited' ? 'class="current" aria-current="page"' : ''; ?>
            >
                <?= __('Pending Invites', 'lms-plugin'); ?>
                <span class="count">
                    (<?= $course->enrollments()->where(['status' => 'invited'])->count(); ?>)
                </span>
            </a>
        </li>
    </ul>

    <form id="posts-filter">

        <?php component('components.search', ['s' => $search]); ?>

        <input type="hidden" name="post_type" value="course">
        <input type="hidden" name="page" value="course_participants">
        <input type="hidden" name="cid" value="<?= $course->id; ?>">
        <input type="hidden" name="status" value="<?= $status; ?>">

        <div class="tablenav top">
            <div class="alignleft actions bulkactions">
                <label for="bulk-action-selector-top" class="screen-reader-text">
                    <?= __('Select bulk action', 'lms-plugin'); ?>
                </label>
                <select name="action" id="bulk-action-selector-top">
                    <option value="-1"><?= __('Bulk Actions', 'lms-plugin'); ?></option>
                    <option value="resend_invite"><?= __('Resend invite', 'lms-plugin'); ?></option>
                    <option value="uninvite"><?= __('Uninvite', 'lms-plugin'); ?></option>
                    <option value="reset_result"><?= __('Reset result', 'lms-plugin'); ?></option>
                    <option value="fail"><?= __('Fail', 'lms-plugin'); ?></option>
                </select>
                <input type="submit" class="button action" value="<?= __('Apply', 'lms-plugin'); ?>">
            </div>

            <div class="alignleft actions">
                <?php component('components.filter.period', [
                    'from' => $from,
                    'to' => $to
                ]); ?>
            </div>

            <div class="alignleft actions">
                <?php component('components.filter.role', [
                    'roles' => $roles,
                    'role' => $role
                ]); ?>

                <button class="button"><?= __('Filter', 'lms-plugin'); ?></button>
            </div>

            <div class="tablenav-pages one-page"><span class="displaying-num">1 item</span>
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
                <th scope="col" id="enrollment-date" class="manage-column column-enrollment-date">
                    <?= __('Enrollment Date'); ?>
                </th>
                <th scope="col" id="last-activity" class="manage-column column-last-activity">
                    <?= __('Last Activity'); ?>
                </th>
                <th scope="col" id="progress" class="manage-column column-progress">
                    <?= __('Progress'); ?>
                </th>
                <th scope="col" id="status" class="manage-column column-status">
                    <?= __('Status'); ?>
                </th>
            </tr>
            </thead>

            <tbody id="the-list">
            <?php if ($participants->count()): ?>
                <?php foreach ($participants as $enrollment): ?>
                    <tr id="post-<?= $enrollment->user->id; ?>" class="iedit author-self level-0 post-4 type-course status-publish hentry">
                        <th scope="row" class="check-column">
                            <label class="screen-reader-text" for="cb-select-<?= $enrollment->user->id; ?>">Select Test</label>
                            <input id="cb-select-<?= $enrollment->user->id; ?>" type="checkbox" name="post[]" value="<?= $enrollment->user->id; ?>">
                            <div class="locked-indicator">
                                <span class="locked-indicator-icon" aria-hidden="true"></span>
                                <span class="screen-reader-text">“Test” is locked</span>
                            </div>
                        </th>
                        <td class="name column-name has-row-actions" data-colname="Title">
                            <div class="locked-info"><span class="locked-avatar"></span> <span class="locked-text"></span></div>
                            <strong>
                                <a href="<?= admin_url('edit.php?post_type=course&page=participant&uid=' . $enrollment->user->ID); ?>" class="row-title">
                                    <?= $enrollment->user->name; ?>
                                </a>
                            </strong>
                            <div class="row-actions">
                                <span class="view">
                                    <a href="<?= admin_url('edit.php?post_type=course&page=participant&uid=' . $enrollment->user->ID); ?>">
                                        <?= __('View', 'lms-plugin'); ?>
                                    </a> |
                                </span>
                                <span class="resend-invite">
                                    <a href="#" aria-label="<?= __('Resend Invite', 'lms-plugin'); ?> “<?= $enrollment->user->name; ?>”">
                                        <?= __('Resend invite', 'lms-plugin'); ?>
                                    </a> |
                                </span>
                                <span class="univite trash">
                                    <a href="#" aria-label="<?= __('Uninvite', 'lms-plugin'); ?> “<?= $enrollment->user->name; ?>”">
                                        <?= __('Uninvite', 'lms-plugin'); ?>
                                    </a> |
                                </span>
                                <span class="reset-result">
                                    <a href="#" aria-label="<?= __('Reset result', 'lms-plugin'); ?> “<?= $enrollment->user->name; ?>”">
                                        <?= __('Reset result', 'lms-plugin'); ?>
                                    </a> |
                                </span>
                                <span class="fail trash">
                                    <a href="#" aria-label="<?= __('Fail', 'lms-plugin'); ?> “<?= $user->display_name; ?>”">
                                        <?= __('Fail', 'lms-plugin'); ?>
                                    </a>
                                </span>
                            </div>
                        </td>
                        <td class="role column-role" data-colname="Role">
                            <a href="#"><?= $roles[$enrollment->user->roles[0]]['label']; ?></a>
                        </td>
                        <td class="enrollment-date column-enrollment-date" data-colname="<?= __('Enrollment Date', 'lms-plugin'); ?>">
                            <?= $enrollment->created_at; ?>
                        </td>
                        <td class="last-activity column-last-activity" data-colname="<?= __('Last Activity', 'lms-plugin'); ?>">
                            <?= $enrollment->updated_at; ?>
                        </td>
                        <td class="progress column-progress" data-colname="<?= __('Progress', 'lms-plugin'); ?>">
                            <?= $enrollment->progress; ?>%
                        </td>
                        <td class="status column-status" data-colname="<?= __('Status', 'lms-plugin'); ?>">
                            <span class="lms-status-<?= $enrollment->status; ?>">
                                <?= $statuses[$enrollment->status]; ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr class="no-items">
                    <td class="colspanchange" colspan="4">
                        <?= __('No participants found.', 'lms-plugin'); ?>
                    </td>
                </tr>
            <?php endif; ?>
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
                <th scope="col" id="enrollment-date" class="manage-column column-enrollment-date">
                    <?= __('Enrollment Date'); ?>
                </th>
                <th scope="col" id="last-activity" class="manage-column column-last-activity">
                    <?= __('Last Activity'); ?>
                </th>
                <th scope="col" id="progress" class="manage-column column-progress">
                    <?= __('Progress'); ?>
                </th>
                <th scope="col" id="status" class="manage-column column-status">
                    <?= __('Status'); ?>
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
            <div class="tablenav-pages one-page"><span class="displaying-num">1 item</span>
                <span class="pagination-links"><span class="tablenav-pages-navspan" aria-hidden="true">«</span>
<span class="tablenav-pages-navspan" aria-hidden="true">‹</span>
<span class="screen-reader-text">Current Page</span><span id="table-paging" class="paging-input"><span class="tablenav-paging-text">1 of <span class="total-pages">1</span></span></span>
<span class="tablenav-pages-navspan" aria-hidden="true">›</span>
<span class="tablenav-pages-navspan" aria-hidden="true">»</span></span></div>
            <br class="clear">
        </div>

    </form>
</div>


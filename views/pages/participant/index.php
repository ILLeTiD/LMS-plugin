<div class="wrap">
    <h1 class="wp-heading-inline">
        <?= __('Participant', 'lms-plugin'); ?>:
        <?= $user->display_name; ?>
    </h1>

    <a href="<?= admin_url('user-edit.php?user_id=' . $user->ID); ?>"
       class="page-title-action"
    >
        <?= __('Edit User', 'lms-plugin'); ?>
    </a>

    <hr class="wp-header-end">

    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">
            <div id="postbox-container-1" class="postbox-container">
                <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                    <div id="lms_participant_info_meta_box" class="postbox ">
                        <button type="button" class="handlediv" aria-expanded="true">
                            <span class="screen-reader-text">Toggle panel: Participants</span>
                            <span class="toggle-indicator" aria-hidden="true"></span>
                        </button>
                        <h2 class="hndle ui-sortable-handle"><span><?= __('Info', 'lms-plugin'); ?></span></h2>
                        <div class="inside">
                            <div class="lms-participant">
                                <?= get_avatar($user->ID, 75); ?>
                                <div class="lms-participant__info">
                                    <span class="lms-participant__name"><?= $user->display_name; ?></span>
                                    <a href="#"><?= $roles[$user->roles[0]]['label']; ?></a>
                                </div>

                                <div class="lms-participant__last-activity">
                                    <?= __('Last Activity', 'lms-plugin'); ?>:
                                    <?php if ($user->last_activity): ?>
                                        <?= date(get_option('date_format'), $user->last_activity); ?>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <?= __('Last Enrollment', 'lms-plugin'); ?>:
                                    <?php if ($user->last_enrollment): ?>
                                        <?= date(get_option('date_format'), $user->last_enrollment); ?>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="postbox-container-2" class="postbox-container">
                <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                    <div id="lms_participant_progress_meta_box" class="postbox ">
                        <button type="button" class="handlediv" aria-expanded="true">
                            <span class="screen-reader-text">Toggle panel: Progress</span>
                            <span class="toggle-indicator" aria-hidden="true"></span>
                        </button>
                        <h2 class="hndle ui-sortable-handle">
                            <span><?= __('Progress', 'lms-plugin'); ?></span>
                        </h2>
                        <div class="inside">
                            <!--<p>No progress</p>-->
                            <div class="lsm-progress">
                                <div class="lsm-progress-list">
                                    <ul>
                                        <?php foreach ($progress as $status => $item): ?>
                                            <li class="lsm-progress-elem lsm-<?= str_replace('_', '-', $status); ?>">
                                                <?= $statuses[$status]; ?>:
                                                <?= $item['percent']; ?>% /
                                                <?= $item['number']; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>

                                <div class="lsm-progress-line">
                                    <?php foreach ($progress as $status => $item): ?>
                                        <div class="lsm-progress-line-point lsm-line-<?= str_replace('_', '-', $status); ?>"
                                            style="width: <?= $item['percent']; ?>%;"
                                        >
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="lsm-link-wrap right">
                                <a href="#"><i class="fa fa-print" aria-hidden="true"></i> Print report</a>
                            </div>
                        </div>
                    </div>
                </div><div id="advanced-sortables" class="meta-box-sortables ui-sortable"></div></div>

        </div>
    </div>

    <div class="clear"></div>

    <h1 class="wp-heading-inline">
        <?= __('courses', 'lms-plugin'); ?>
    </h1>

    <?php if (($total_enrollments = $user->enrollments()->count()) > 3): ?>
        <a href="<?= admin_url('edit.php?post_type=course&page=participant_courses&uid=' . $user->id); ?>">
            <?= __('view full list', 'lms-plugin'); ?>
        </a>
        (<?= $total_enrollments; ?>)
    <?php endif; ?>

    <?php component('components.courses-table', [
        'user' => $user,
        'enrollments' => $user->enrollments()->take(3),
        'statuses' => $statuses
    ]); ?>

    <h1 class="wp-heading-inline">
        <?= __('activities', 'lms-plugin'); ?>
    </h1>

    <?php if (($total_activities = $user->activities()->count()) > 3): ?>
        <a href="<?= admin_url('edit.php?post_type=course&page=participant_activities&uid=' . $user->id); ?>"><?= __('view full list', 'lms-plugin'); ?></a>
        (<?= $total_activities; ?>)
    <?php endif; ?>

    <?php component('components.activities-table', [
        'activities' => $user->activities()->take(3),
    ]); ?>

</div>


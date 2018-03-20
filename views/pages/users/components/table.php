<table class="wp-list-table widefat fixed striped users">
    <thead>
    <?php include ('columns.php'); ?>
    </thead>

    <tbody>
    <?php if ($users->get_results()): ?>
        <?php foreach ($users->get_results() as $user): ?>
            <tr>
                <th scope="row" class="check-column">
                    <label class="screen-reader-text" for="user_1">Select admin</label>
                    <input type="checkbox" name="users[]" id="user_1" class="administrator" value="1">
                </th>
                <td>
                    <?php
                    $edit_link = esc_url(add_query_arg('wp_http_referer', urlencode(wp_unslash($_SERVER['REQUEST_URI'])), get_edit_user_link($user->ID )));
                    ?>
                    <a href="<?= $edit_link; ?>">
                        <?php if ( $user->first_name && $user->last_name ) : ?>
                            <?= $user->first_name; ?> <?= $user->last_name; ?>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </a>

                    <?php include ('row-actions.php'); ?>

                </td>
                <td>
                    <a href="<?= esc_url("mailto:{$user->user_email}"); ?>">
                        <?= $user->user_email; ?>
                    </a>
                </td>
                <td>
                    <?= implode(', ', lms_role_list($user)); ?>
                </td>
                <td>
                    <?php switch($user->lms_status): 
                        case ('waiting'): 
                        case ('denied'): ?>
                            <?= __('Registered', 'lms-plugin'); ?>
                            <br>
                            <?php break;
                        case ('invited'):
                        case ('uninvited'): ?>
                            <?= __('Invited', 'lms-plugin'); ?>
                            <br>
                            <?php break; ?>
                    <?php endswitch; ?>

                    <?php if ($user->lms_last_activity): ?>
                        <?= date(get_option('date_format'), $user->lms_last_activity); ?>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td>
                    <?php switch($user->lms_status): 
                        case ('invited'): ?>
                            <?= __('Pending invite', 'lms-plugin'); ?>
                            <?php break;
                        case ('waiting'): ?>
                            <?= __('Waiting', 'lms-plugin'); ?>
                            <?php break;
                        case ('uninvited'): ?>
                            <?= __('Uninvited', 'lms-plugin'); ?>
                            <?php break;
                        case ('denied'): ?>
                            <?= __('Denied Registry', 'lms-plugin'); ?>
                            <?php break;
                        default: ?>
                            -
                    <?php endswitch; ?>
                </td>
            </tr>
        <?php endforeach;?>
    <?php else: ?>
        <tr>
            <td colspan="6">
                <?= __('No users found.', 'lms-plugin'); ?>
            </td>
        </tr>
    <?php endif; ?>
    </tbody>

    <tfoot>
    <?php include ('columns.php'); ?>
    </tfoot>

</table>


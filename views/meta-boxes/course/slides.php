<table class="wp-list-table widefat fixed striped posts js-course-slides">
    <thead>
    <tr>
        <td id="cb" class="manage-column column-cb check-column">
            <label class="screen-reader-text" for="cb-select-all-1"><?= __('Select All', 'lms-plugin'); ?></label>
            <input id="cb-select-all-1" type="checkbox">
        </td>
        <th class="manage-column lms-title-column">
            <a href="#"><span><?= __('Title', 'lms-plugin'); ?></span></a>
        </th>
        <th class="manage-column"><?= __('Template', 'lms-plugin'); ?></th>
        <th class="manage-column lms-date-column"><?= __('Date', 'lms-plugin'); ?></th>
        <th class="manage-column"><?= __('Sort', 'lms-plugin'); ?></th>
    </tr>
    </thead>

    <tbody>
        <?php foreach ($slides->posts as $slide): ?>
            <tr id="post-<?= $slide->ID; ?>">
                <th scope="row" class="check-column">
                    <label class="screen-reader-text" for="cb-select-<?= $slide->ID; ?>">Select Hello world!</label>
                    <input id="cb-select-<?= $slide->ID; ?>" type="checkbox" name="post[]" value="1">
                    <div class="locked-indicator">
                        <span class="locked-indicator-icon" aria-hidden="true"></span>
                        <span class="screen-reader-text">“<?= $slide->post_title; ?>” is locked</span>
                    </div>
                </th>

                <td>
                    <strong><a class="row-title" href="<?= get_edit_post_link($slide->ID); ?>&course=<?= $slide->ID; ?>"><?= $slide->post_title; ?></a></strong>
                    <div class="row-actions">
                        <span class="edit"><a href="<?= get_edit_post_link($slide->ID); ?>&course=<?= $slide->ID; ?>"><?= __('Edit', 'lms-plugin'); ?></a> | </span>
                        <span class="inline hide-if-no-js"><a href="#" class="editinline"><?= __('Quick Edit', 'lms-plugin'); ?></a> | </span>
                        <span class="trash"><a href="#" class="submitdelete"><?= __('Trash', 'lms-plugin'); ?></a> | </span>
                        <span class="view"><a href="#"><?= __('View', 'lms-plugin'); ?></a> | </span>
                        <span class="lms-clone"><a href="#"><?= __('Clone', 'lms-plugin'); ?></a></span>
                    </div>
                </td>

                <td><i><?= $slideTemplates[$slide->slide_template]; ?></i></td>
                <td>
                    <?= $slide->post_date == $slide->post_modified ? 'Created' : 'Updated'; ?>
                    <?= get_the_modified_date(get_option('date_format'), $slide->ID); ?>
                </td>
                <td>
                    <span class="dashicons-before dashicons-menu js-sortable-handle"></span>
                    <input type="hidden" name="slide_weight[]" value="<?= $slide->ID; ?>">
                </td>
            </tr>
        <?php endforeach; ?>

    <tr class="lms-links">
        <td></td>

        <td class="lms-add-slide">
            <a href="<?= admin_url('post-new.php?post_type=slide&course=' . $post->ID); ?>">
                + <?= __('Add Slide', 'lms-plugin'); ?>
            </a>
        </td>

        <td></td>
        <td></td>

        <td class="lms-export-slide">
            <a href="<?= admin_url('post-new.php?post_type=slide&course=' . $post->ID); ?>">
                <?= __('Import .svg', 'lms-plugin'); ?>
            </a>
            <a href="<?= admin_url('post-new.php?post_type=slide&course=' . $post->ID); ?>">
                <?= __('Export .svg', 'lms-plugin'); ?>
            </a>
        </td>
    </tr>
    </tbody>

</table>


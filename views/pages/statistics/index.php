<div class="wrap lms-statistics__wrap">
    <h1 class="wp-heading-inline">
        <?= __('Statistics', 'lms-plugin'); ?>
    </h1>

    <hr class="wp-header-end">

    <?php include('filter.php'); ?>

    <div id="poststuff" class="lms-printable">
        <div id="post-body" class="metabox-holder columns-2">
            <div id="postbox-container-1" class="postbox-container">
                <div id="normal-sortables" class="meta-box-sortables ui-sortable">

                    <?php include('info.php'); ?>

                </div>
            </div>

            <div id="postbox-container-2" class="postbox-container">
                <div id="normal-sortables" class="meta-box-sortables ui-sortable">

                    <?php include('progress.php'); ?>

                    <?php include('course-top-list.php'); ?>

                    <?php include('user-top-list.php'); ?>

                </div>
                <div id="advanced-sortables" class="meta-box-sortables ui-sortable"></div>
            </div>
        </div>

    </div>

    <div class="clear"></div>

    <?php component('components.print-button'); ?>

</div>

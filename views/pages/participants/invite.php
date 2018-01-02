<div id="lms-invite-participants" class="lms-invite hidden">
    <h1 class="lms-invite__title"><?= __('Invite participants', 'lms-plugin'); ?></h1>

    <form action="<?=  admin_url('admin-ajax.php?action=invite'); ?>" method="POST" class="js-invite-form">

        <input type="hidden"
               name="course"
               value="<?= $course->ID;?>"
        >

        <div class="lms-invite__holder accordion-container">
            <div class="lms-invite-roles accordion-section open">
                <h4 class="lms-invite-roles__title accordion-section-title"><?= __('Roles', 'lms-plugin'); ?></h4>
                <div class="lms-invite-roles__content accordion-section-content lms-without-padding">
                    <?php include 'roles.php'; ?>
                </div>
            </div>

            <div class="lms-invite-users accordion-section">
                <h4 class="lms-invite-users__title accordion-section-title"><?= __('Users', 'lms-plugin'); ?></h4>
                <div class="lms-invite-users__content accordion-section-content lms-without-padding">
                    <div class="lms-invite-search">
                        <input type="text" name="search">
                        <button type="button" class="js-search-user"><?= __('Search User', 'lms-plugin'); ?></button>
                        <div class="lms-invite-search__hint js-not-found hidden"><?= __('Not found', 'lms-plugin'); ?></div>
                    </div>

                    <div class="search__result"></div>
                </div>
            </div>
        </div>

        <div class="lms-invite__footer">
            <button class="lms-invite__button button js-invite"><?= __('Invite', 'lms-plugin'); ?></button>
        </div>
    </form>

</div>


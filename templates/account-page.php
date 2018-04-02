<?php
/**
 * Template Name: Account Page
 */

if (!is_user_logged_in()) {
    wp_redirect(home_url() . '/login');
    exit;
}
$all_meta_for_user = get_user_meta(get_current_user_id());

get_header();
?>

<?php //d($all_meta_for_user); ?>

<?php //
//lms_get_template(''); ?>
    <main class="lms-account-page">
        <div class="lms-account-page__wrapper">
            <section class="lms-user-profile lms-user-section">
                <header class="lms-user-profile__header lms-user-section__header">
                    <h2 class="lms-user-profile__title lms-user-section__title">
                        <?php _e('Account', 'lms-plugin'); ?>
                    </h2>
                </header>
                <div class="lms-user-profile-edit">
                    <form action=""
                          class="lms-form lms-user-form lms-user-profile-edit__form">
                        <div class="lms-user-form-info">
                            <div class="lms-form__group">
                                <label class="lms-form__label">
                                    Name
                                    <input type="text" name="fullname" placeholder="Texts">
                                </label>
                            </div>
                            <div class="lms-form__group">
                                <label class="lms-form__label">
                                    Email
                                    <input type="email" name="email" placeholder="Texts">
                                </label>
                            </div>
                            <div class="lms-form__group">
                                <label class="lms-form__label">
                                    Password
                                    <input type="password" autocomplete="false" name="pass" placeholder="Texts">
                                </label>
                            </div>
                            <div class="lms-form__group">
                                <label class="lms-form__label">
                                    Job Title
                                    <input type="text" name="jobtitle" placeholder="Texts">
                                </label>
                            </div>
                        </div>

                        <div id="lms-user-form-avatar"
                             class="lms-user-form-avatar">
                            <label class="lms-user-form-avatar__wrapper">
                                <img id="lms-user-form-avatar-image" src="" alt="">
                                <input type="file" name="file">
                            </label>
                        </div>
                        <div class="lms-user-form__full">
                            <button class="lms-user-section__button">
                                <?php _e('Save Changes', 'lms-plugin') ?>
                            </button>
                        </div>
                    </form>
                </div>
            </section>
            <section class="lms-user-notification lms-user-section">
                <header class="lms-user-notification__header lms-user-section__header">
                    <h2 class="lms-user-notification__title lms-user-section__title">
                        <?php _e('Notifications', 'lms-plugin'); ?>
                    </h2>
                </header>
                <p>
                    When you invited to a course
                </p>
                <button class="lms-user-section__button">
                    <?php _e('Save Changes', 'lms-plugin') ?>
                </button>
            </section>
            <div class="lms-user-delete-account">
                <button class="lms-user-delete-account__button">
                    <?php _e('Delete Account', 'lms-plugin') ?>
                </button>
            </div>
        </div>
    </main>
<?php
get_footer();

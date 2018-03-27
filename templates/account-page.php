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
    <pre>
    <?php d($all_meta_for_user); ?>
    </pre>
<?php lms_get_template('activity-parts/activity-header.php'); ?>
    <section class="lms-profile">
        <div class="lms-profile__wrapper">
            <header class="lms-profile__header">
                <h1 class="lms-profile__title">
                    <?php _e('Edit profile page', 'lms-plugin'); ?>
                </h1>
            </header>
            <main class="lms-profile__main">
                <div class="lms-profile-edit">
                    <form action="" class="lms-profile-edit__form">

                    </form>
                </div>
            </main>
        </div>
    </section>
<?php
get_footer();

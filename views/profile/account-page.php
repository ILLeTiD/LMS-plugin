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
    <!--    <pre>-->
    <!--    --><?php //d($userFields) ?>
    <!--</pre>-->
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
                          method="post"
                          class="lms-form lms-user-form lms-user-profile-edit__form">
                        <div class="lms-user-form-info">
                            <?php foreach ($userFields as $field): ?>

                                <?php switch ($field['type']):
                                    case 'text': ?>
                                        <div class="lms-form__group">
                                            <label class="lms-form__label">
                                                <?= $field['name'] ?>
                                                <input type="text"
                                                       name="<?= $field['slug']; ?>"
                                                       placeholder="<?= $field['name']; ?>"
                                                       value="<?= old($field['slug'], $field['user_value']); ?>"
                                                    <?= array_get($field, 'required') ? 'required' : ''; ?>
                                                >
                                            </label>
                                        </div>

                                        <?php break; ?>

                                    <?php case 'mail': ?>
                                        <div class="lms-form__group">
                                            <label class="lms-form__label">
                                                <?= $field['name'] ?>
                                                <input type="email"
                                                       name="<?= $field['slug']; ?>"
                                                       placeholder="<?= $field['name']; ?>"
                                                       value="<?= old($field['slug'], $field['user_value']); ?>"
                                                    <?= array_get($field, 'required') ? 'required' : ''; ?>
                                                >
                                            </label>
                                        </div>
                                        <?php break; ?>


                                    <?php case 'checkbox': ?>
                                        <div class="lms-form__group">
                                            <label class="lms-form__label">
                                                <?= $field['name'] ?>
                                                <input type="checkbox"
                                                       name="<?= $field['slug']; ?>"
                                                       value="1"
                                                    <?= checked(old($field['slug'])); ?>
                                                    <?= array_get($field, 'required') ? 'required' : ''; ?>
                                                >
                                            </label>
                                        </div>
                                        <?php break; ?>
                                    <?php case 'select': ?>
                                        <div class="lms-form__group">
                                            <select name="<?= $field['slug']; ?>"
                                                <?= array_get($field, 'required') ? 'required' : ''; ?>
                                            >
                                                <option value="">
                                                    <?= $field['name']; ?>
                                                </option>

                                                <?php foreach (array_get($field, 'options') as $option): ?>
                                                    <option value="<?= kebab_case($option['value']); ?>"
                                                        <?= selected(old(kebab_case($field['slug'])), kebab_case($option['value'])); ?>
                                                    >
                                                        <?= $option['value']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <?php break; ?>

                                    <?php case 'radio': ?>
                                        <?= $field['name']; ?>:

                                        <?php foreach (array_get($field, 'options') as $option): ?>
                                            <div class="lms-form__group">
                                                <label>
                                                    <input type="radio"
                                                           name="<?= $field['slug']; ?>"
                                                           value="<?= kebab_case($option['value']); ?>"
                                                        <?= array_get($field, 'required') ? 'required' : ''; ?>
                                                        <?= checked(old($field['slug']), kebab_case($option['value'])); ?>
                                                    >
                                                    <?= $option['value']; ?>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>

                                        <?php break; ?>
                                    <?php endswitch; ?>
                            <?php endforeach; ?>
                            <div class="lms-form__group">
                                <input type="checkbox" name="change-pass" class="change-pass">
                                <input type="password" name="new-pass">
                                <input type="password" name="confirm-pass">
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

<?php
include 'header-auth.php';
?>

<?php if (empty($success)): ?>
    <div class="auth-content">
        <div class="auth-content__intro">
            <h2 class="auth-content__title">
                <?php _e('Learn something new?', 'lms-plugin') ?>
            </h2>
            <p class="auth-content__text">
                <?php _e('Register your account to access online course today', 'lms-plugin') ?>
            </p>
        </div>

        <?php include('errors.php'); ?>

        <form action="" method="POST">
            <?php foreach ($fields as $field): ?>
                <p>
                <?php switch ($field['type']):
                    case 'text': ?>
                        <input type="text"
                            name="<?= $field['slug']; ?>"
                            placeholder="<?= $field['name']; ?>"
                            value="<?= old($field['slug']); ?>"
                            <?= array_get($field, 'required') ? 'required' : ''; ?>
                        >
                    <?php break; ?>

                    <?php case 'mail': ?>
                        <input type="email"
                            name="<?= $field['slug']; ?>"
                            placeholder="<?= $field['name']; ?>"
                            value="<?= old($field['slug']); ?>"
                            <?= array_get($field, 'required') ? 'required' : ''; ?>
                        >
                    <?php break; ?>

                    <?php case 'password': ?>
                        <input type="password"
                            name="<?= $field['slug']; ?>"
                            placeholder="<?= $field['name']; ?>"
                            <?= array_get($field, 'required') ? 'required' : ''; ?>
                        >
                    <?php break; ?>

                    <?php case 'checkbox': ?>
                        <label>
                            <input type="checkbox"
                                name="<?= $field['slug']; ?>"
                                value="1"
                                <?= checked(old($field['slug'])); ?>
                                <?= array_get($field, 'required') ? 'required' : ''; ?>
                            >
                            <?= $field['name']; ?>
                        </label>
                    <?php break; ?>
                    <?php case 'select': ?>
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
                    <?php break; ?>

                    <?php case 'radio': ?>
                        <?= $field['name']; ?>:

                            <?php foreach (array_get($field, 'options') as $option): ?>
                                <label>
                                    <input type="radio"
                                        name="<?= $field['slug']; ?>"
                                        value="<?= kebab_case($option['value']); ?>"
                                        <?= array_get($field, 'required') ? 'required' : ''; ?>
                                        <?= checked(old($field['slug']), kebab_case($option['value'])); ?>
                                    >
                                    <?= $option['value']; ?>
                                </label>
                            <?php endforeach; ?>
                        <?php break; ?>
                <?php endswitch; ?>
            <?php endforeach; ?>


            <p>
                <div class="g-recaptcha" data-sitekey="6LcpW1AUAAAAAMjOc3Rul7E3rljh6wohBSCdMAvA"></div>
            </p>

            <p>
                <button><?= __('Sign Up', 'lms-plugin'); ?></button>
        </form>
    </div><!-- #content -->

    <footer class="auth-footer" role="contentinfo">
        <div class="wrap">
            <p class="auth-footer__terms">
                <?php
                $url = get_site_url() . '/terms';
                $link = sprintf(wp_kses(__('By creating account, your agree to our <a href="%s">Terms</a>.', 'lms-plugin'), array('a' => array('href' => array()))), esc_url($url));
                echo $link;
                ?>
            </p>
            <div class="auth-footer__signin">
                <?php
                $url = get_site_url() . '/login';
                $link = sprintf(wp_kses(__('Already have an account? <a href="%s">Sign in</a>.', 'lms-plugin'), array('a' => array('href' => array()))), esc_url($url));
                echo $link;
                ?>
            </div>
        </div><!-- .wrap -->
    </footer><!-- #colophon -->
<?php else: ?>
    <div class="auth-content">
        <?php include('errors.php'); ?>
    </div>
<?php endif; ?>

<?php
include 'footer-auth.php';

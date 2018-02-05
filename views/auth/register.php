<?php
include 'header-auth.php';
?>
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
            <p>
                <input type="text"
                       name="name"
                       placeholder="<?= __('Full Name', 'lms-plugin'); ?>"
                       value="<?= old('name'); ?>"
                >
            <p>
                <input type="email"
                       name="email"
                       placeholder="<?= __('Email Address', 'lms-plugin'); ?>"
                       value="<?= old('email'); ?>"
                >
            <p>
                <input type="password"
                       name="password"
                       placeholder="<?= __('Password', 'lms-plugin'); ?>"
                >

            <?php if (count($fields)): ?>
                <?php foreach ($fields as $field): ?>
                    <p>
                    <?php switch ($field['type']):
                        case 'text': ?>
                            <input type="text"
                                   name="<?= metakey_case($field['name']); ?>"
                                   placeholder="<?= $field['name']; ?>"
                                   value="<?= old(metakey_case($field['name'])); ?>"
                                   <?= array_get($field, 'required') ? 'required' : ''; ?>
                            >
                        <?php break; ?>

                        <?php case 'checkbox': ?>
                            <label>
                                <input type="checkbox"
                                       name="<?= metakey_case($field['name']); ?>"
                                       value="1"
                                       <?= checked(old(metakey_case($field['name']))); ?>
                                       <?= array_get($field, 'required') ? 'required' : ''; ?>
                                >
                                <?= $field['name']; ?>
                            </label>
                        <?php break; ?>
                        <?php case 'select': ?>
                            <select name="<?= metakey_case($field['name']); ?>"
                                    <?= array_get($field, 'required') ? 'required' : ''; ?>
                            >
                                <option value="">
                                    <?= $field['name']; ?>
                                </option>

                                <?php foreach (explode("\n", array_get($field, 'options')) as $option): ?>
                                    <option value="<?= metakey_case($option); ?>"
                                            <?= selected(old(metakey_case($field['name'])), metakey_case($option)); ?>
                                    >
                                        <?= $option; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        <?php break; ?>

                        <?php case 'radio': ?>
                            <?= $field['name']; ?>:

                                <?php foreach (explode("\n", array_get($field, 'options')) as $option): ?>
                                    <label>
                                        <input type="radio"
                                               name="<?= metakey_case($field['name']); ?>"
                                               value="<?= metakey_case($option); ?>"
                                               <?= array_get($field, 'required') ? 'required' : ''; ?>
                                               <?= checked(old(metakey_case($field['name'])), metakey_case($option)); ?>
                                        >
                                        <?= $option; ?>
                                    </label>
                                <?php endforeach; ?>
                            </select>
                            <?php break; ?>
                    <?php endswitch; ?>
                <?php endforeach; ?>
            <?php endif; ?>

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
<?php
include 'footer-auth.php';

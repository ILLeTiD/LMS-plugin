<?php

namespace LmsPlugin\Controllers\Auth;

use FishyMinds\WordPress\Plugin\Plugin;
use LmsPlugin\Controllers\Controller;
use LmsPlugin\Models\User;
use LmsPlugin\Profile;
use LmsPlugin\ProfileFieldsManager;
use WP_Error;

class RegisterController extends Controller
{
    private $fields_manager;

    public function __construct(Plugin $plugin)
    {
        $this->fields_manager = new ProfileFieldsManager($plugin);

        parent::__construct($plugin);
    }

    public function showForm()
    {
        if ( ! $this->canUsersRegister()) {
            wp_redirect('/login');
        }

        $this->view('auth.register', [
            'fields' => $this->fields_manager->get()
        ]);
    }

    public function register()
    {
        $input = array_only($_POST, ['full-name', 'email', 'password', 'g-recaptcha-response']);
        $fields = $this->fields_manager->get();

        $errors = $this->validate($input);

        if (count($errors->get_error_messages())) {
            $this->view('auth.register', compact('errors', 'fields'));

            return;
        }

        list($first_name, $last_name) = explode(' ', $input['full-name']);

        $user_id = wp_insert_user([
            'user_login' => $input['email'],
            'user_email' => $input['email'],
            'user_pass' => $input['password'],
            'first_name' => $first_name,
            'last_name' => $last_name
        ]);

        if (is_wp_error($user_id)) {
            $errors->add('registration.failed', __('Sorry! Something went wrong. User could not be registered.', 'lms-plugin'));
            $this->view('auth.register', compact('errors', 'fields'));

            return;
        }

        $user = User::find($user_id);
        $user->remove_role(get_option('default_role'));

        $profile = new Profile($user);

        $profile->setFields(
            array_only(
                $_POST,
                $this->fields_manager->getCustomFieldsSlugs()
            )
        )->save();

        $moderation = $this->plugin->getSettings('account_moderation');
        update_user_meta($user->id, 'lms_status', $moderation ? 'waiting' : 'accepted');
        update_user_meta($user->id, 'lms_last_activity', time());

        // Fire user registered event.
        do_action('lms_event_user_registered', $user);

        $_SESSION['success'] = __('Woohoo! Your account is ready. Please login to access your courses.', 'lms-plugin');

        wp_redirect('/login');
    }

    private function validate($input)
    {
        $allowed_domain = $this->plugin->getSettings('register.restriction');
        $domain = strstr($input['email'], '@');

        $errors = new WP_Error;

        if (empty($input['full-name'])) {
            $errors->add('name.required', __('Full name is required.', 'lms-plugin'));
        }

        if (empty($input['email'])) {
            $errors->add('email.required', __('Email is required.', 'lms-plugin'));
        }

        if (email_exists($input['email'])) {
            $errors->add('email.exists', __('Email already in use.', 'lms-plugin'));
        }

        if ($allowed_domain && $domain != $allowed_domain) {
            $errors->add('email.domain', __('Email is not allowed to be registered.', 'lms-plugin'));
        }

        if (empty($input['password'])) {
            $errors->add('password.exists', __('Password is required.', 'lms-plugin'));
        }

        if (strlen($input['password']) < 6) {
            $errors->add('password.short', __('Password must be at least 6 characters.', 'lms-plugin'));
        }

        if (empty($input['g-recaptcha-response'])) {
            $errors->add('recaptcha.required', __('Please complete reCAPTCHA', 'lms-plugin'));
        } else {
            $response = wp_remote_post('https://www.google.com/recaptcha/api/siteverify', [
                'body' => [
                    'secret' => '6LcpW1AUAAAAANokgh2Yk1cIAzR3kJYPfDirckdd',
                    'response' => $input['g-recaptcha-response']
                ]
            ]);

            if (is_wp_error($response)) {
                $errors->add('recaptcha.required', __('Please complete reCAPTCHA', 'lms-plugin'));
            } else {
                $json = array_get($response, 'body');
                $data = json_decode($json, true);

                if (!array_get($data, 'success')) {
                    $errors->add('recaptcha.required', __('Please complete reCAPTCHA', 'lms-plugin'));
                }
            }
        }

        return $errors;
    }

    private function canUsersRegister()
    {
        return get_option('users_can_register');
    }
}
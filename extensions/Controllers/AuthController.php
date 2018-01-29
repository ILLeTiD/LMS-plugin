<?php

namespace LmsPlugin\Controllers;

class AuthController extends Controller
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            list($first_name, $last_name) = explode(' ', $_POST['name']);

            wp_insert_user([
                'user_login' => $_POST['email'],
                'user_email' => $_POST['email'],
                'user_pass' => $_POST['password'],
                'first_name' => $first_name,
                'last_name' => $last_name
            ]);
        }

        $this->view('auth.register');
    }
}
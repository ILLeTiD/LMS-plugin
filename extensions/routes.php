<?php

$route->get('register', 'Auth/RegisterController@showForm');
$route->post('register', 'Auth/RegisterController@register');

$route->get('request_invite', 'Auth/RequestInviteController@showForm');
$route->post('request_invite', 'Auth/RequestInviteController@requestInvite');

$route->get('login', 'Auth/LoginController@showForm');
$route->post('login', 'Auth/LoginController@login');
$route->get('logout', 'Auth/LoginController@logout');

$route->get('reset_password', 'Auth/ResetPasswordController@showForm');
$route->post('reset_password', 'Auth/ResetPasswordController@resetPassword');

$route->get('accept_invitation', 'Auth/AcceptInvitationController@showForm');
$route->post('accept_invitation', 'Auth/AcceptInvitationController@accept');

$route->get('lms-profile', 'UserProfileController@getUserFields');
$route->post('lms-profile', 'UserProfileController@save');


<?php

$route->get('register', 'Auth/RegisterController@showForm');
$route->post('register', 'Auth/RegisterController@register');

$route->get('request_invite', 'Auth/RequestInviteController@showForm');
$route->post('request_invite', 'Auth/RequestInviteController@requestInvite');


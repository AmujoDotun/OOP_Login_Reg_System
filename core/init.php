<?php
session_start();

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'db' => 'rating_system'

    ),
    'remember' => array(
        'cookies_name' => 'hash',
        'cookies_expiry' => 604800,
    ),
    'session' => array(
        'session_name' => 'user'
    )
);

spl_autoload_register(function($class){
    require_once 'classes/'. $class . '.php';
});
<?php require_once 'core/init.php';

// echo Config::get('mysql/host'); //127.0.0.1
$user = Database::getInstance()->get('user', array('username', '=', 'billy'));

if(!$user->count()){
    echo 'No User';
}else{
    echo 'Ok!';
}
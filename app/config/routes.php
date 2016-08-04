<?php


use framework\Session;

$storage = '/Frameworks';

if (isset($_SESSION[md5(KEY)])) {
    $routes = [
        'afterlogin' => 'User@afterlogin',
        'userlist' => 'User@list',
    ];
} else {
    $routes = [
        'login' => 'User@login'
    ];
}
 

//    header("Location:". BASE_URL ."404.php");
//    die();

<?php

use framework\Session;

$storage = '/Frameworks';

if (isset($_SESSION[md5(KEY)])) {
    $routes = [
        'afterlogin' => 'User@afterlogin',
        'userlist' => 'User@list',
        'adduser' => 'User@add',
        'logout' => 'User@logout',
        'delete' => 'User@delete',
        'update' => 'User@edit',
        'addcomment'=>'Post@addcomment'
    ];
} else {
    $routes = [
        'login' => 'User@login'
    ];
}
 

//    header("Location:". BASE_URL ."404.php");
//    die();

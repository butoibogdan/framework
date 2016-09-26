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
        'addcomment'=>'Post@addcomment',
        'comentarii'=>'Post@list',
        ''=>'Index@index',
        'index'=>'Index@index',
        'about'=>'Index@page'
    ];
} else {
    $routes = [
        'login' => 'User@login',
        'comentarii'=>'Post@list',
        ''=>'Index@index',
        'index'=>'Index@index',
        'about'=>'Index@page'
    ];
}
 

//    header("Location:". BASE_URL ."404.php");
//    die();

<?php

$storage = '/Frameworks';

$auth = new \framework\Auth();

//-------------ruta admin-------------------------//
if ($auth->isauth('users', 'credentials', 0)) {

    $routes = [
        'userlist' => 'User@list',
        'login' => 'User@login'
    ];

//------------ruta user----------------------------//    
} elseif ($auth->isauth('users', 'credentials', 2)) {

    $routes = [
        'userlist' => 'User@list',
        'login' => 'User@login'
    ];
} else {
    header("Location:". BASE_URL ."404.php");
    die();
}
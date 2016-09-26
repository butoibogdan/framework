<?php

// Configurari ce tin de aplicatie - e.g. Blog
return array(
    'charset' => 'utf-8',
    'theme' => 'blog_theme',
    'database' => array(
        'host'=>'localhost',
        'name' => 'frameworks',
        'username' => 'root',
        'password' => '',
        'options' => array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ),
    ),
    'users' => [
        'user_table' => 'users',
        'user_column' => 'users',
        'password_column' => 'password',
        'credetials' => 'credentials'
    ],
    // environment - dev|prod
    'env' => 'dev',
);

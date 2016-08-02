<?php

// Configurari ce tin de aplicatie - e.g. Blog
return array(
	'charset' => 'utf-8',
	'theme' => 'blog_theme',	
	'database' => array(
		'name' => 'frameworks',
		'username' => 'root',
		'password' => '',
		'options' => array(
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			),
		),
);
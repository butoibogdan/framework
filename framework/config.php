<?php

// Configurari generale ce tin de framework

define ('BASE_PATH', dirname(dirname(__FILE__).DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR);
define ('APP_PATH', BASE_PATH.'app'.DIRECTORY_SEPARATOR);
define ('VIEWS_PATH', APP_PATH.'views'.DIRECTORY_SEPARATOR);
define ('PUBLIC_PATH', BASE_PATH.'public'.DIRECTORY_SEPARATOR);
define ('THEME_PATH', PUBLIC_PATH.'theme'.DIRECTORY_SEPARATOR);
define ('BASE_URL', "http://{$_SERVER['SERVER_NAME']}".str_replace($_SERVER['DOCUMENT_ROOT'], '', PUBLIC_PATH));
define ('KEY','5d41402abc4b2a76b9719d911017c592');

<?php

/**
 * Aceasta clasa se ocupa de partea de initializare a aplicatiei:
 * acces la configurari, incarcarea automata a claselor pentru controllers si models,
 * pornirea sesiunii, translatarea URL-ului in clase si metode
 *
 * URL-ul, ca o conventie, o sa fie index.php?c=user&a=delete,
 * unde 'c' este numele controller-ului, iar 'a' este metoda din clasa controller-ului
 */

namespace framework;

use framework\Auth;

class Framework {

    public static $params;

    public static function init() {
        // configurari generale si ale aplicatiei
        session_start();
        include 'framework/config.php';
        self::$params = require APP_PATH . 'config' . DIRECTORY_SEPARATOR . 'main.php';
        self::autoLoadFiles();
        ErrorManager::setErrorHandlers();
        self::translateURL();
    }

    /**
     * Utilizam spl_autoload_register() ca sa incarcam automat
     * clasele pentru controllers, models si altele
     */
    private static function autoLoadFiles() {
        spl_autoload_register(array(__CLASS__, 'loadClasses'));
    }

    /**
     * metoda folosita ca parametru in spl_autoload_register()
     * Conform PSR-4: http://www.php-fig.org/psr/psr-4/
     */
    private static function loadClasses($class) {
        // project-specific namespace prefix
        $prefix = '';

        // base directory for the namespace prefix
        $base_dir = BASE_PATH;

        // does the class use the namespace prefix?
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            // no, move to the next registered autoloader
            return;
        }

        // get the relative class name
        $relative_class = substr($class, $len);

        // replace the namespace prefix with the base directory, replace namespace
        // separators with directory separators in the relative class name, append
        // with .php
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

        // if the file exists, require it
        if (file_exists($file)) {
            require $file;
        }
    }

    /**
     * Utilizam aceasta metoda pentru a transpune parametrii din URL
     * in apeluri catre Controllers si metodele acestora
     * e.g. index.php?c=user&a=delete&param1=9&param2=5 se va transforma intru-un apel
     * al metodei deleteAction din clasa UserController
     */
    private static function translateURL() {
        $translated = FALSE;
        $action = '';
        $controller = '';
        $url = parse_url($_SERVER['REQUEST_URI'])['path'];
        require APP_PATH . '/config/routes.php';
        $str=str_replace($storage, '|', $url);
        //var_dump(str_replace('|/', '', $str));
        if (array_key_exists(str_replace('|/', '', str_replace($storage, '|', $url)), $routes)) {
            foreach ($routes as $key => $route) {
                if ($storage . '/' . $key === $url) {
                    //var_dump(@$key);
                    $array = explode('@', $route);
                    $controller = 'app\\controllers\\' . ucfirst($array[0]) . 'Controller';
                    $action = $array[1] . 'Action';
                }
            }
        } else {
            echo "Eroare 404";
        }
        if (class_exists($controller)) {
            $instance = new $controller;
            if (method_exists($instance, $action)) {
                $instance->$action();
                $translated = TRUE;
            }
        }

        if (!$translated) {
            $instance = new \app\controllers\IndexController;
            $instance->indexAction();
        }
    }

    public static function redirect($url) {
        header("Location: $url");
        exit();
    }

}

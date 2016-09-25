<?php
/**
* Clasa care se ocupa cu managementul erorilor care nu sunt prinse de Exceptii
* Erorile standard ale PHP-ului sunt tratate tot ca Exceptii
*/
namespace framework;

class ErrorManager
{	

    private function __construct()
    {        
                      
    }

    // Setup error and exception handlers
    public static function setErrorHandlers(){
    	set_error_handler(array(__CLASS__, 'errorHandler'));
        set_exception_handler(array(__CLASS__, 'exceptionHandler'));
    }

    // throw Exception also for PHP errors
    public static function errorHandler($error_level, $error_message, $error_file, $error_line)
    {        
        // throw exception for all error types but NOTICE and STRICT
        if ($error_level !== E_NOTICE && $error_level !== E_STRICT) {
            throw new \Exception($error_message);
        }        
    }

    // Log errors and redirect to homepage for production environment
    public static function exceptionHandler($exception)
    {	 
    	if(Framework::$params['env'] == 'prod') {
    		error_log($exception, 3, BASE_PATH.'error_log');
    		// TODO - send mail with Zend mail library    		
        	header('Location: index.php');
    	} else {
    		throw new \Exception($exception);    		
    	}   	        
    }    
}
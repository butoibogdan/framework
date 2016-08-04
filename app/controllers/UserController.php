<?php

namespace app\controllers;

use \framework\BaseController as BaseController;
use app\models\UserModel as UserModel;
use framework\Request;
use framework\Session;
use framework\Auth;

class UserController extends BaseController {

    // o proprietate privata care contine modelul
    private $_model;

    // conectarea la model - daca este cazul
    public function __construct() {
        $this->_model = new UserModel;
    }

    public function loginAction() {
        if (!empty($_POST)) {
            $auth = new Auth();
            if ($auth->check()) {
                $session = new Session(KEY);
                header('Location: afterlogin');
            } else {
                
            }

            // database check				
//			if($_POST['username'] == 'admin'){
//				header('Location: index.php');
//			}
        }
        $this->render('loginForm', array());
    }

    public function listAction() {
        $users = $this->_model->listUser();
        $this->render('list', array('users' => $users));
    }

    public function afterloginAction() {
        $session = new Session(KEY);
        $this->render('afterlogin', ['date' => $session->read('data')]);
    }

}

<?php

namespace app\controllers;

use framework\BaseController as BaseController;
use app\models\UserModel as UserModel;
use framework\Request;
use framework\Session;
use framework\Auth;
use framework\Framework;
use framework\FlashMessages as Mess;

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
            var_dump($auth->check());
            if ($auth->check()) {
                Framework::redirect('afeterlogin');
            } else {
                //Framework::redirect('index');
            }

            // database check				
//			if($_POST['username'] == 'admin'){
//				header('Location: index.php');
//			}
        }
        $this->render('loginForm', array());
    }

    public function addAction() {
        if (!empty($_POST)) {
            $request = new Request();
            $data = $request->method();
            Mess::setMess('flashmessage', 'Inregistrare reusita');
            $v = UserModel::validare($data['users'], ['unique'], 'users');
            if ($v) {
                UserModel::register($request->method());
            }
        }
        $this->render('adduser', []);
    }

    public function listAction() {
        $users = $this->_model->listUser();
        $this->render('list', array('users' => $users));
    }

    public function editAction() {
        // method from parent Model class (must have id parameter in URL)
        $id = $_GET['id'];
        $users = UserModel::findByID($id);
        if (isset($_POST)) {
            $request = new Request();
            UserModel::userUpdate($request->method(), $id);
            Mess::setMess('flashmessage', 'Actualizare reusita');
        }
        return $this->render('update', array('users' => $users));
    }

    public function deleteAction() {
        if (!empty($_POST['user_id'])) {
            UserModel::deleteUser($_POST['user_id']);
        }
        $users = UserModel::listUser();
        $this->renderPartial('list', array('users' => $users));
    }

    public function afterloginAction() {
        $session = new Session(KEY);
        $this->render('afterlogin', ['date' => $session->read('data')]);
    }

    public function logoutAction() {
        Session::destroy();
        return Framework::redirect('index');
    }

}

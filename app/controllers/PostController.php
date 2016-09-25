<?php

namespace app\controllers;

use framework\BaseController as BaseController;
use app\models\UserModel as UserModel;
use app\models\CommentModel as Comentarii;
use framework\Request;
use framework\Session;
use framework\Auth;
use framework\Framework;

class PostController extends BaseController {

    public function __construct() {
        $this->_model = new Comentarii();
    }

    public function addcommentAction() {
        $session = new Session(KEY);
        $user_id=json_decode($session->read('data'))->id;
        $comentarii=  Comentarii::commentsByUser($user_id);
        if (isset($_POST['addcomment'])) {
            $request = new Request();
            $array_post = $request->method();
            $array = [
                'comments' => $array_post['comments'],
                'user_id' => $user_id
            ];
            Comentarii::addComents($array);
            $this->redirect('addcomment');
        }
        $this->render('comment', $comentarii);
    }

}

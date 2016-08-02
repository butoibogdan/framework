<?php
namespace app\controllers;
use \framework\BaseController as BaseController;

class IndexController extends BaseController{
	// Home page
	public function indexAction(){
		// lines of codes
		$this->render('index', array('titlu'=>'IndexPage', 'subtitlu'=>'subtitlu'));		
	}

	// Load static pages - e.g. Despre Noi
	public function pageAction(){
		if(isset($_GET['view'])){
			$view = (string)$_GET['view'];
			$this->render('pages/'.$view);
		}
	}
}
<?php
namespace framework;
use framework\Framework as Framework;
use framework\Request;


class BaseController{
	// Render un array intr-un anumit view
	public function render($view, $vars = array()){
		$view_file = VIEWS_PATH.$this->getViewFolder().DIRECTORY_SEPARATOR.$view.'.php';
		if(is_file($view_file)){
			// returneaza continutul unui fisier intr-o variabila
			ob_start();
	        ob_implicit_flush(false);
	        require $view_file;
	        $content = ob_get_clean();
			// incarca continutul view-ului in tema
			$this->loadTheme($content);
		}else{			
			$this->render('pages/404');
		}		
	}
        
        public function renderPartial($view, $vars = array()){
		$view_file = VIEWS_PATH.$this->getViewFolder().DIRECTORY_SEPARATOR.$view.'.php';	
		if(is_file($view_file)){
			// returneaza continutul unui fisier intr-o variabila
			ob_start();
	        ob_implicit_flush(false);
	        require $view_file;
	        $content = ob_get_clean();
			echo $content;
		}else{			
			$this->renderPartial('pages/404');
		}
	}

	/**
	* Folderul unde se afla view-ul se obtine din numele clasei Controller-ului
	* care a extins BaseController
	*/
	private function getViewFolder(){	
		$child_class = get_called_class();
		$end_pos = strpos($child_class, 'Controller');
		$start_pos = strrpos($child_class, '\\');
		return strtolower(substr($child_class, $start_pos+1, $end_pos-$start_pos-1));
	}	

	/**
	* Incarcarea temei furnizata in fisierul de configurare
	* impreuna cu continutul view-ului
	*/
	private function loadTheme($content){				
		require THEME_PATH.Framework::$params['theme'].DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'main.php';
	}
        
        protected function redirect($url){
		Framework::redirect($url);
	}	
}
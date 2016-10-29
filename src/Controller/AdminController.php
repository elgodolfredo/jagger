<?php
	
	namespace Jagger\Controller;

	class AdminController extends \Framework\Controller
	{

		protected $routes = array(
			array('GET', 'admin', ''),
			array('GET', 'panel')
		);
		protected $middlewares   = array(array('\Jagger\Middleware\AuthenticateMiddleware'));
		//templates
		protected $adminTemplate = 'admin.html';

		public function admin($action)
		{
			$this->render($this->adminTemplate);
		}
	}



?>
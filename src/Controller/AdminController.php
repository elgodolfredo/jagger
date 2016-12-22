<?php
	
	namespace Jagger\Controller;

	class AdminController extends \Framework\Controller
	{

		protected $routes = array(
			array('GET',  'admin'),
			array('GET',  'panel', 'admin/panel'),
			array('POST', 'changePassword', 'admin/change/password'),
		);
		protected $middlewares   = array(array('\Jagger\Middleware\AuthenticateMiddleware'));
		protected $adminTemplate = 'admin.html';
		protected $panelTemplate = 'panel.html';
		protected $redirectChangePassword = 'admin/panel';

		public function admin($action)
		{
			$this->render($this->adminTemplate);
		}

		public function panel($action)
		{
			$this->render($this->panelTemplate);
		}

		public function changePassword($action)
		{
			$service = new \Jagger\Service\UserService();
			$service->changePassword($_SESSION['user']['id'], $action->getInput());
			$this->setFlashMessage('bg-success', 'Se ha cambiado la contraseña correctamente');
			$this->redirect($this->redirectChangePassword);
		}
		
	}



?>
<?php
	
	namespace Jagger\Controller;

	class LoginController extends \Framework\Controller
	{

		protected $routes = array(
			array('GET', 'login'),
			array('GET', 'logout'),
			array('POST', 'authenticate'),
		);
		protected $redirectLogin = 'login';
		protected $redirectAdmin = 'admin';
		protected $templateLogin = 'login.html';

		public function login($action)
		{
			$this->render($this->templateLogin);
		}

		public function authenticate($action)
		{
			$loginService = new \Jagger\Service\LoginService();
			$values = $action->getInput();
			try 
			{
				$loginService->login($values['username'], $values['password']);
				$this->redirect($this->redirectAdmin);
			} 
			catch (\Exception $e)
			{
				$this->redirect($this->redirectLogin);
			}
		}

		public function logout($action)
		{
			$loginService = new \Jagger\Service\LoginService();
			$loginService->logout();
			$this->redirect($this->redirectLogin);
		}

	}

?>

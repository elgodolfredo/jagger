<?php
	
	namespace Jagger\Controller;

	class LoginController extends \Framework\Controller
	{

		protected $routes = array(
			array('GET', 'login'),
			array('GET', 'logout'),
			array('POST', 'authenticate'),
		);

		public function login($action)
		{
			$this->render('login.html');
		}

		public function authenticate($action)
		{
			$loginService = new \Service\LoginService();
			$values = $action->getInput();
			try 
			{
				$loginService->login($values['username'], $values['password']);
				$this->redirect('admin');
			} 
			catch (\Exception $e)
			{
				$this->redirect('login');
			}
		}

		public function logout($action)
		{
			$loginService = new \Service\LoginService();
			$loginService->logout();
			$this->redirect('login');
		}

	}

?>

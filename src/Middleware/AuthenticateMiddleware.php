<?php
	
	namespace Jagger\Middleware;

	class AuthenticateMiddleware extends \Framework\Middleware
	{
		
		public function handle($input)
		{
			$loginService = new \Service\LoginService();

			if ( !$loginService->isLogged() )
			{
				$this->redirect('login');
			}
		}	
	
			
	}

?>
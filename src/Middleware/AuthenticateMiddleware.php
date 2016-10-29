<?php
	
	namespace Jagger\Middleware;

	class AuthenticateMiddleware extends \Framework\Middleware
	{
		
		public function handle($input)
		{
			$loginService = new \Jagger\Service\LoginService();

			if ( !$loginService->isLogged() )
			{
				$this->redirect('login');
			}
		}	
	
			
	}

?>
<?php  
	
	namespace Jagger\Service;

	class LoginService extends Service
	{

		public function login($username, $password)
		{
			$user = \Model\User::where(array('username' => $username, 'password' => $password))->first();
			if ( !$user )
			{
				throw new \Exception("Usuario o contraseña incorrecta", 1);
			}
			$_SESSION['user'] = array('username' => $user->username, 'id' => $user->id);
		}
		
		public function loginAdmin($password, $username='admin')
		{
			$this->login($username, $password);
			$_SESSION['admin'] = true;
		}

		public function isLogged()
		{
			return isset($_SESSION['user']);
		}

		public function isAdminLogged()
		{
			return isset($_SESSION['admin']);
		}

		public function logout()
		{
			unset($_SESSION['user']);
		}

	}


?>
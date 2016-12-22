<?php  
	
	namespace Jagger\Service;

	class UserService extends \Jagger\Service\Service
	{

		public function changePassword($user_id, $values)
		{
			$user = \Jagger\Model\User::find($user_id);
			if ( !$user )
			{
				throw new \Exception("ID Usuario incorrecto", 1);
			}
			$user->password = $values['password'];
			$user->save();
		}
		
	}


?>

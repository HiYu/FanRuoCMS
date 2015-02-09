<?php
	 function isAdmin()
		{
			if(isset($_SESSION['user_id']) && $_SESSION['user_id']!='')
			{
				$user = M("Users");
				$arr = array('user_id' => $_SESSION['user_id']);
				$is_admin = $user->where($arr)->getField('user_role');
				if($is_admin == 0)
				{
					return true;
				}
			}
			return false;
		}
	



?>
	
	
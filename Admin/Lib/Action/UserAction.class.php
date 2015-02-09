<?php
	class UserAction extends Action{
		public function index()
		{
			if(isAdmin() == true)
			{
				$user = M('users');
				$user_data = $user->select();
				$this->assign('user_data',$user_data);
				$this->display();
			}else{
				$this->redirect('login');
			}	
		}
		
		public function login()
		{
			$this->display();
		
		}
		public function logout()
		{
			$_SESSION = array();
			if(isset($_COOKIE[session_name()]))
			{
				setcookie(session_name(),'',time()-1,'/');
			}
			session_destroy();
			$this->redirect('login');
		
		
		}
		public function doLogin()
		{
			$user_name = $_POST['user_name'];
			$user_passwd= md5($_POST['user_passwd']);
			$user = M('users');
			$arr = array('user_name' => $user_name,'user_passwd' => $user_passwd);
			$data = $user->where($arr)->find();
			if($data != null)
			{
				if($data['user_role'] == 0)
				{
					$_SESSION['user_name'] = $user_name;
					$_SESSION['user_id'] = $data['user_id'];
					$this->assign('user_name',$user_name);
					$this->redirect('/index/index');
				}else{
					$this->error($user_name."是普通用户，登陆失败！");
				}
			}else{
				$this->error("登陆失败");
			}
			
	
			//$this->display();
		}
		
		public function userDelete()
		{
			if(isAdmin() == true)
			{
				$user = M("Users");
				$user_id = $_GET['user_id'];
				$user_role = $user->where("user_id = $user_id")->getField('user_role');
				if($user_role == 0)
				{
					$this->error("超级管理员不能被删除");
				}else{
					$is_delete = $user->where("user_id = $user_id")->delete();
					if($is_delete == true)
					{
						$this->redirect('index');
					}else{
						$this->error("删除失败");
					}
				}
			}else{
				$this->error("删除失败");
			}
		}
		public function userSet()
		{
			
		}
		
	}

?>
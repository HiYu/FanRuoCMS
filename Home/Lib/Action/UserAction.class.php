<?php
	class UserAction extends Action{
		public function index()
		{
			$this->display(login);
		}
		
		public function login()
		{
			$this->display();
		
		}
		public function doLogin()
		{
			$user_name = $_POST['user_name'];
			$user_passwd= md5($_POST['user_passwd']);
			$user = M('users');
			$arr = array('user_name' => $user_name,'user_passwd' => $user_passwd);
			$data = $user->where($arr)->find();
			$is_admin = $data['user_role'];
			if($is_admin == 0)
			{
				$this->error("登陆失败，本接口对该用户屏蔽请在地址栏输入其他接口地址");
			}else{
				if($data != null)     
				{
					$_SESSION['user_name'] = $user_name;
					$_SESSION['user_id'] = $data['user_id'];
					$this->assign('user_name',$user_name);
					$this->success("登陆成功");
				}else{
					$this->error("登陆失败");
				}
			}
			//$this->display();
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
		public function regsiter()
		{
			if(isset($_SESSION['user_name']) && $_SESSION['user_name'] != '')
			{
			
			}else{
				$this->display();
			}
		}
		public function doRegister()
		{
			$user = M("Users");
			$has_admin = $user->where("user_role = 0")->count();
			$user_name = $_POST['user_name'];
			$has_user_name = $user->where("user_name = $user_name")->count();
			if($has_user_name == 0)
			{
				$data = array(
					'user_name' => $_POST['user_name'],
					'user_email' => $_POST['user_email'],
					'user_passwd' => md5($_POST['user_passwd']),
				);
				if($has_admin != 0)/*第一次注册为管理员*/
				{
					$data['user_role'] = 1;
				}else{
					$data['user_role'] = 0;
				}
				$add_status = $user->add($data);
				if($add_status != null)
				{
					$user_data = $user->where($data)->find();
					$_SESSION['user_name'] = $user_data['user_name'];
					$_SESSION['user_id'] = $user_data['user_id'];
					$this->redirect('index');
				}else{
					$this->error("注册失败！");
				}
			}else{
			
				$this->error("注册失败，该用户已存在");
				
			}
		}
		
		
	
	
	}


?>
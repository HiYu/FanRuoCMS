<?php
class IndexAction extends Action {
	 
	  public function index()
	  {
		if(isAdmin() == true)
		{
			$this->display();
		}else{
			$this->redirect('User/login');
		}	
	 }
	 public function top()
	 {
		if(isAdmin() == true)
		{
			$this->display();
		}else{
			$this->redirect('User/login');
		}	
		
	 }
	 public function left()
	 {
		if(isAdmin() == true)
		{
			$user_name = $_SESSION['user_name'];
			$this->assign('user_name',$user_name);
			$this->assign('host',$_SERVER['HTTP_HOST']);
			$this->display();
		}else{
			$this->redirect('User/login');
		}	
	 }
	 public function right()
	 {
		if(isAdmin() == true)
		{
			$system_info = array(
				'server_name' => $_SERVER['SERVER_NAME'],
				'server_OS' => php_uname('s'),
				'php_version' => PHP_VERSION,
				
			);
			$this->assign('system_info',$system_info);
			$this->display();
		}else{
			$this->redirect('User/login');
		}	
	 }
	 
	}

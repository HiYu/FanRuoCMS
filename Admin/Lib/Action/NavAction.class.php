<?php
	class NavAction extends Action {
	
		public function index()
		{
			if(isAdmin == true)
			{
				import('ORG.Util.Page');
				$nav = M("Navs");
				$count = $nav->count();
				$Page = new Page($count,10);
				$show = $Page->show();// 分页显示输出
				$nav_list = $nav->order('nav_id')->limit($Page->firstRow.','.$Page->listRows)->select();
				$this->assign('page',$show);// 赋值分页输出
				$this->assign('nav_list',$nav_list);
				$this->display();	
			}else{
				$this->redirect('User/login');
			}
		}
		public function navAdd()
		{
			if(isAdmin == true)
			{
				$this->display();
			}else{
				$this->redirect('User/login');
			}
		}
		public function doNavAdd()
		{	
			if(isAdmin == true)
			{
				$nav = M("Navs");
				$data = array(
					'nav_type' => $_GET['nav_type'],
					'nav_name' => $_GET['nav_name'],
					'nav_url' => $_GET['nav_url'],
					'nav_id' => $_GET['nav_id'],
					
				);	
				// dump($data);
				$is_add = $nav->add($data);
				if($is_add == null)
				{
					$this->error("添加导航项失败");
				}else{
					$this->redirect('index');
				}
			}else{
				$this->redirect('User/login');
			}
		}
		public function navModify()
		{
			if(isAdmin == true)
			{
				
			}else{
				$this->redirect('User/login');
			}
		}
		public function doNavModify()
		{
			if(isAdmin == true)
			{
			}else{
				$this->redirect('User/login');
			}
		}
		public function navDelete()
		{
			if(isAdmin == true)
			{
				$nav = M("Navs");
				$nav_id = $_GET['nav_id'];
				$is_delete = $nav->where("nav_id = $nav_id")->delete();
				if($is_delete != false)
				{
					$this->redirect('index');
				}else{
					$this->error("删除失败");
				}
			}else{
				$this->redirect('User/login');
			}
		}
	}



?>
	
	
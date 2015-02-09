<?php
	class PageAction extends Action{
	
		public function index()
		{	
			if(isAdmin() == true)
			{
				import('ORG.Util.Page');
				$page_DB = M("Pages");
				$count = $page_DB->count();
				$Page = new Page($count,10);
				$show = $Page->show();// 分页显示输出
				$page_list = $page_DB->order('page_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
				$this->assign('page',$show);// 赋值分页输出
				$this->assign('page_list',$page_list);
				$this->display();
			}else{
				$this->redirect('User/login');
			}	
		}
	public function pageDelete()
	{
		if(isAdmin() == true)
		{
			$page = M("Pages");
			$page_id = $_GET['page_id'];
			$page->where("page_id = $page_id")->delete();
			$this->redirect('index');
		}else{
			$this->redirect('User/login');
		}	
	
	}
	
	public function pageModify()
	{	
		if(isAdmin() == true)
		{
			$page_id = $_GET['page_id'];
			$page = M("Pages");
			$page_data = $page->where("page_id = $page_id")->find();
			$this->assign('page_data',$page_data);
			$this->display();
		}else{
			$this->redirect('User/login');
		}	
	}
	public function doPageModify()
	{
		if(isAdmin() == true)
		{
			$page = M("Pages");
			$page_id = $_GET['page_id'];
			$data = array(
				'page_title'=> $_POST['page_title'],
				'content' => $_POST['content'],
			);
			$page->where("page_id = $page_id")->save($data);
			$this->redirect('index');
		}else{
			$this->redirect('User/login');
		}
	
	}
	
	public function pageAdd()
	{
		if(isAdmin() == true)
		{
			$this->display();
		}else{
			$this->redirect('User/login');
		}	
	}
	public function doPageAdd()
	{
		if(isAdmin() == true)
		{
			$page = M("Pages");
			$data = array(
					'page_title'=> $_POST['page_title'],
					'content' => $_POST['content'],
				);
			$is_add = $page->add($data);
			if($is_add != false)
			{
				$this->redirect('index');
			}else{
				$this->error("添加单页失败");
			}	
			
		}else{
			$this->redirect('User/login');
		}
	}
	public function pageRead()
	{
		if(isAdmin() == true)
		{
			$page = M("pages");
			$page_id = $_GET['page_id'];
			if($page_id == null)
			{
				redirect('index');
			}else{
				$page_data = $page->where("page_id = $page_id")->find();
				$this->assign('page_data',$page_data);
				$this->display();	
			}
		}else{
			$this->redirect('User/login');
		}	
	}
}



?>
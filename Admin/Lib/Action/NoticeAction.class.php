<?php
	class NoticeAction extends Action{
	
		public function index()
		{
			if(isAdmin() == true)
			{
				import('ORG.Util.Page');
				$notice = M("Notices");
				$count = $notice->count();
				$Page = new Page($count,10);
				$show = $Page->show();// 分页显示输出
				$notice_list = $notice->order('notice_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
				$this->assign('page',$show);// 赋值分页输出
				$this->assign('notice_list',$notice_list);
				$this->display();
			}else{
				$this->redirect('User/login');
			}	
		}
	public function noticeDelete()
	{
		if(isAdmin() == true)
		{
			$notice = M("Notices");
			$notice_id = $_GET['notice_id'];
			$notice->where("notice_id = $notice_id")->delete();
			$this->redirect('index');
		}else{
			$this->redirect('User/login');
		}
	
	}
	
	public function noticeModify()
	{	
		if(isAdmin() == true)
		{
			$cat = M("Cats");
			$cat_data = $cat->where("cat_author = 1")->select();
			$this->assign('cat_data',$cat_data);
			$notice_id = $_GET['notice_id'];
			$notice = M("Notices");
			$notice_data = $notice->where("notice_id = $notice_id")->find();
			$this->assign('notice_data',$notice_data);
			$this->display();
		}else{
			$this->redirect('User/login');
		}
	}
	public function doNoticeModify()
	{
		if(isAdmin() == true)
		{
			$notice = M("Notices");
			$notice_id = $_GET['notice_id'];
			$data['notice_title']= $_POST['notice_title'];
			$data['content'] = $_POST['content'];
			$data['post_id'] = $_SESSION['user_id'];
			$data['notice_cat'] = $_POST['notice_cat'];
			$notice->where("notice_id = $notice_id")->save($data);
			$this->redirect('index');
		}else{
			$this->redirect('User/login');
		}
	}
	
	public function noticeAdd()
	{
		if(isAdmin() == true)
		{
			$cat = M("Cats");
			$cat_data = $cat->where("cat_author = 1")->select();
			$this->assign('cat_data',$cat_data);
			$this->display();
		}else{
			$this->redirect('User/login');
		}	
	}
	public function doNoticeAdd()
	{
		if(isAdmin() == true)
		{
			$notice = M("Notices");
			$data['notice_title']= $_POST['notice_title'];
			$data['notice_cat'] = $_POST['notice_cat'];
			$data['post_date'] = date("Y-m-d");
			$data['content'] = $_POST['content'];
			$data['post_id'] = $_SESSION['user_id'];
			$notice->add($data);
			$this->redirect('index');
		}else{
			$this->redirect('User/login');
		}
			
	}

	public function noticeRead()
	{
		if(isAdmin() == true)
		{
			$notice = M("Notices");
			$notice_id = $_GET['notice_id'];
			if($notice_id == null)
			{
				redirect('index');
			}else{
				$notice_data = $notice->where("notice_id = $notice_id")->find();
				$this->assign('notice_data',$notice_data);
				$this->display();	
			}
		}else{
			$this->redirect('User/login');
		}	
	}
}



?>
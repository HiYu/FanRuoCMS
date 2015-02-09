<?php
	class DownloadAction extends Action{
	
		public function index()
		{
			if(isAdmin() == true)
			{
				import('ORG.Util.Page');
				$download = M("Downloads");
				$count = $download->count();
				$Page = new Page($count,10);
				$show = $Page->show();// 分页显示输出
				$dl_list = $download->order('dl_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
				$this->assign('page',$show);// 赋值分页输出
				$this->assign('dl_list',$dl_list);
				$this->display();
			}else{
				$this->redirect('User/login');
			}	
		}
	public function downloadDelete()
	{
		if(isAdmin() == true)
		{
			$download = M("Downloads");
			$dl_id = $_GET['dl_id'];
			$download->where("dl_id = $dl_id")->delete();
			$this->redirect('index');
		}else{
			$this->redirect('User/login');
		}
	
	}
	
	public function downloadModify()
	{	
		if(isAdmin() == true)
		{
			$cat = M("Cats");
			$cat_data = $cat->where("cat_author = 4")->select();
			$this->assign('cat_data',$cat_data);
			$dl_id = $_GET['dl_id'];
			$download = M("Downloads");
			$dl_data = $download->where("dl_id = $dl_id")->find();
			$this->assign('dl_data',$dl_data);
			$this->display();
		}else{
			$this->redirect('User/login');
		}
	}
	public function doDownloadModify()
	{
		if(isAdmin() == true)
		{
			$download = M("Downloads");
			$dl_id = $_GET['dl_id'];
			$data['dl_name']= $_POST['dl_name'];
			$data['dl_discrib'] = $_POST['dl_discrib'];
			
			$data['dl_cat'] = $_POST['dl_cat'];
			// dump($data);
			$download->where("dl_id = $dl_id")->save($data);
			$this->redirect('index');
		}else{
			$this->redirect('User/login');
		}
	}
	
	public function downloadAdd()
	{
		if(isAdmin() == true)
		{
			$cat = M("Cats");
			$cat_data = $cat->where("cat_author = 4")->select();
			$this->assign('cat_data',$cat_data);
			$this->display();
		}else{
			$this->redirect('User/login');
		}	
	}
	public function doDownloadAdd()
	{
		if(isAdmin() == true)
		{
			$download = M("Downloads");
			$data['dl_name']= $_POST['dl_name'];
			$data['dl_cat'] = $_POST['dl_cat'];
			$data['dl_discrib'] = $_POST['dl_discrib'];
			$download->add($data);
			$this->redirect('index');
		}else{
			$this->redirect('User/login');
		}
			
	}

	public function downloadRead()
	{
		if(isAdmin() == true)
		{
			$download = M("Downloads");
			$dl_id = $_GET['dl_id'];
			if($dl_id == null)
			{
				redirect('index');
			}else{
				$dl_data = $download->where("dl_id = $dl_id")->find();
				$this->assign('dl_data',$dl_data);
				$this->display();	
			}
		}else{
			$this->redirect('User/login');
		}	
	}
}



?>
<?php
	class NewsAction extends Action{
	
		public function index()
		{	
			if(isAdmin() == true)
			{
				import('ORG.Util.Page');
				$news = M("News");
				$count = $news->count();
				$Page = new Page($count,10);
				$show = $Page->show();// 分页显示输出
				$news_list = $news->order('news_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
				$this->assign('page',$show);// 赋值分页输出
				$this->assign('news_list',$news_list);
				$this->display();
			}else{
				$this->redirect('User/login');
			}	
		}
	public function newsDelete()
	{
		if(isAdmin() == true)
		{
			$news = M("News");
			$news_id = $_GET['news_id'];
			$news->where("news_id = $news_id")->delete();
			$this->redirect('index');
		}else{
			$this->redirect('User/login');
		}	
	
	}
	public function newsCat()
	{
		if(isAdmin() == true)
		{
			import('ORG.Util.Page');
			$news = M("News");
			$news_cat = $_GET['news_cat'];
			$arr = array('news_cat'=> $news_cat);
			$arr['news_cat'] = $news_cat;
			$count = $news->where($arr)->count();
			$Page = new Page($count,10);
			$show = $Page->show();// 分页显示输出
			$news_list = $news->order('news_id desc')->where($arr)->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign('page',$show);// 赋值分页输出
			$this->assign('news_list',$news_list);
			$this->display('index');
		}else{
			$this->redirect('User/login');
		}	
	}
	public function newsModify()
	{	
		if(isAdmin() == true)
		{
			$news_id = $_GET['news_id'];
			$cat = M("Cats");
			$cat_data = $cat->where("cat_author = 0")->select();
			$this->assign('cat_data',$cat_data);
			$news = M("News");
			$news_data = $news->where("news_id = $news_id")->find();
			$this->assign('news_data',$news_data);
			$this->display();
		}else{
			$this->redirect('User/login');
		}	
	}
	public function doNewsModify()
	{
		if(isAdmin() == true)
		{
			$news = M("News");
			$news_id = $_GET['news_id'];
			$data = array(
				'news_title'=> $_POST['news_title'],
				'news_cat' => $_POST['news_cat'],
				'from_name' => $_POST['from_name'],
				'from_url' => $_POST['from_url'],
				'post_date' => date("Y-m-d"),
				'content' => $_POST['content'],
				'post_id' => $_SESSION['user_id'],
			);
			$news->where("news_id = $news_id")->save($data);
			$this->redirect('index');
		}else{
			$this->redirect('User/login');
		}
	
	}
	
	public function newsAdd()
	{
		if(isAdmin() == true)
		{
			$cat = M("Cats");
			$cat_data = $cat->where("cat_author = 0")->select();
			$this->assign('cat_data',$cat_data);
			$this->display();
		}else{
			$this->redirect('User/login');
		}	
	}
	public function doNewsAdd()
	{
		if(isAdmin() == true)
		{
			$news = M("News");
			$data = array(
					'news_title'=> $_POST['news_title'],
					'news_cat' => $_POST['news_cat'],
					'from_name' => $_POST['from_name'],
					'from_url' => $_POST['from_url'],
					'post_date' => date("Y-m-d"),
					'content' => $_POST['content'],
					'post_id' => $_SESSION['user_id'],
				);
			$news->add($data);
			$this->redirect('index');
		}else{
			$this->redirect('User/login');
		}
	}
	public function newsRead()
	{
		if(isAdmin() == true)
		{
			$news = M("News");
			$news_id = $_GET['news_id'];
			if($news_id == null)
			{
				redirect('index');
			}else{
				$news_data = $news->where("news_id = $news_id")->find();
				$this->assign('news_data',$news_data);
				$this->display();	
			}
		}else{
			$this->redirect('User/login');
		}	
	}
}



?>
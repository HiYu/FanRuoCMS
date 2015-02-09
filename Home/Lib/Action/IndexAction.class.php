<?php
class IndexAction extends Action {
    public function index()
	{
		//echo "这里是前台主页";
		
		$nav = M("Navs");
		$nav_list = $nav->order('nav_id')->select();
		$this->assign('nav_list',$nav_list);
		$news = M("News");
		$news_count = $news->count();
		$this->assign('news_count',$news_count);
		$news_data = $news->limit(8)->select();
		$this->assign('news_data',$news_data);
		$notice = M("Notices");
		$notice_count = $notice->count();
		$this->assign('notice_count',$notice_count);
		$notice_data = $notice->limit(8)->select();
		$this->assign('notice_data',$notice_data);
		$download = M("Downloads");
		$dl_data = $download->limit(8)->select();
		$dl_count = $download->count();
		$this->assign('dl_data',$dl_data);
		
		$image = M("Images");
		$image_list = $image->where("is_display = 0")->select();
		$image_count = $image->count();
		$this->assign('image_list',$image_list);
		$this->assign('image_count',$image_count);
		
		$this->display();
    }
	public function newsList()
	{
		$nav = M("Navs");
		$nav_list = $nav->order('nav_id')->select();
		$this->assign('nav_list',$nav_list);
		import('ORG.Util.Page');
		$news = M("News");
		$count = $news->count();
		$Page = new Page($count,20);
		$show = $Page->show();// 分页显示输出
		$list = $news->order('news_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);
		$this->assign('page',$show);// 赋值分页输出
		$cat = M("Cats");
		$contact = M("Contacts");
		$con_list = $contact->select();
		$cat_list = $cat->where("cat_author = 0")->select();
		$this->assign('cat_list',$cat_list);
		$this->assign('con_list',$con_list);
		$this->display(); // 输出模板
	
	}
	public function newsRead()
	{
		$nav = M("Navs");
		$nav_list = $nav->order('nav_id')->select();
		$this->assign('nav_list',$nav_list);
		$news = M("News");
		$news_id = $_GET['news_id'];
		if($news_id == null)
		{
			$this->redirect('newsList');
		}else{
			$news_data = $news->where("news_id = $news_id")->find();
			$this->assign('news_data',$news_data);
			$new_news = $news->order('news_id desc')->limit(5)->select();
			$cat = M("Cats");
			$contact = M("Contacts");
			$con_list = $contact->select();
			$cat_list = $cat->where("cat_author = 0")->select();
			$this->assign('cat_list',$cat_list);
			$this->assign('con_list',$con_list);
			$this->assign('new_news',$new_news);
			$this->display();
		}
	}
	public function noticeList()
	{
		$nav = M("Navs");
		$nav_list = $nav->order('nav_id')->select();
		$this->assign('nav_list',$nav_list);
		import('ORG.Util.Page');
		$notice = M("Notices");
		$count = $notice->count();
		$Page = new Page($count,20);
		$show = $Page->show();// 分页显示输出
		$list = $notice->order('notice_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);
		$this->assign('page',$show);// 赋值分页输出
		$cat = M("Cats");
		$contact = M("Contacts");
		$con_list = $contact->select();
		$cat_list = $cat->where("cat_author = 1")->select();
		$this->assign('cat_list',$cat_list);
		$this->assign('con_list',$con_list);
		$this->display(); // 输出模板
	
	}
	public function noticeRead()
	{
		$nav = M("Navs");
		$nav_list = $nav->order('nav_id')->select();
		$this->assign('nav_list',$nav_list);
		$notice = M("Notices");
		$notice_id = $_GET['notice_id'];
		if($notice_id == null)
		{
			$this->redirect('noticeList');
		}else{
			$notice_data = $notice->where("notice_id = $notice_id")->find();
			$this->assign('notice_data',$notice_data);
			$new_notice = $notice->order('notice_id desc')->limit(5)->select();
			$cat = M("Cats");
			$contact = M("Contacts");
			$con_list = $contact->select();
			$cat_list = $cat->where("cat_author = 1")->select();
			$this->assign('cat_list',$cat_list);
			$this->assign('con_list',$con_list);
			$this->assign('new_notice',$new_notice);
			$this->display();
		}
	}
	public function noticeCat()
	{	
		$nav = M("Navs");
		$cat = M("Cats");
		$contact = M("Contacts");
		$notice = M("Notices");
		$nav_list = $nav->order('nav_id')->select();
		$this->assign('nav_list',$nav_list);
		import('ORG.Util.Page');
		$arr1 = array('cat_id' => $_GET['cat_id'],);
		$notice_cat = $cat->where($arr1)->getField('cat_name');
		$arr = array('notice_cat' => $notice_cat,);
		$count = $notice->where($arr)->count();
		$Page = new Page($count,20);
		$show = $Page->show();// 分页显示输出
		$list = $notice->where($arr)->order('notice_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);
		$this->assign('page',$show);// 赋值分页输出
		
		$con_list = $contact->select();
		$cat_list = $cat->where("cat_author = 1")->select();
		$this->assign('cat_list',$cat_list);
		$this->assign('con_list',$con_list);
		$this->display('noticeList'); // 输出模板
		
	}
	public function newsCat()
	{
		$nav = M("Navs");
		$cat = M("Cats");
		$contact = M("Contacts");
		$news = M("News");
		$nav_list = $nav->order('nav_id')->select();
		$this->assign('nav_list',$nav_list);
		import('ORG.Util.Page');
		$arr1 = array('cat_id' => $_GET['cat_id'],);
		$news_cat = $cat->where($arr1)->getField('cat_name');
		$arr = array('news_cat' => $news_cat,);
		$count = $news->where($arr)->count();
		$Page = new Page($count,20);
		$show = $Page->show();// 分页显示输出
		$list = $news->where($arr)->order('news_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);
		$this->assign('page',$show);// 赋值分页输出
		
		$con_list = $contact->select();
		$cat_list = $cat->where("cat_author = 0")->select();
		$this->assign('cat_list',$cat_list);
		$this->assign('con_list',$con_list);
		$this->display('newsList'); // 输出模板
	
	}
	public function page()
	{
		$nav = M("Navs");
		$nav_list = $nav->order('nav_id')->select();
		$this->assign('nav_list',$nav_list);
		$page = M("Pages");
		$page_id = $_GET['page_id'];
		if($page_id != '')
		{
			$page_data = $page->where("page_id = $page_id")->find();
			$this->assign('page_data',$page_data);
			$this->display();
		}else{
			$this->error("该页面不存在！");
		}
	}
	public function product()
	{
		$nav = M("Navs");
		$nav_list = $nav->order('nav_id')->select();
		$this->assign('nav_list',$nav_list);
		$product = M("Products");
		$pro_id = $_GET['pro_id'];
		if($pro_id != null)
		{
			$pro_data = $product->where("pro_id = $pro_id")->find();
			$new_pro = $product->order('pro_id')->limit(5)->select();
			$this->assign('new_pro',$new_pro);
			$cat = M("Cats");
			$contact = M("Contacts");
			$con_list = $contact->select();
			$cat_list = $cat->where("cat_author = 3")->select();
			$this->assign('cat_list',$cat_list);
			$this->assign('con_list',$con_list);
			
			if($pro_data != null)
			{
				$this->assign('pro_data',$pro_data);
				$this->display();
			}
		}else{
			$this->redirect('proList');
		}
	}
	public function downloadRead()
	{
		$nav = M("Navs");
		$nav_list = $nav->order('nav_id')->select();
		$this->assign('nav_list',$nav_list);
		$download = M("Downloads");
		$dl_id = $_GET['dl_id'];
		if($dl_id == null)
		{
			$this->redirect('downloadList');
		}else{
			$dl_data = $download->where("dl_id = $dl_id")->find();
			$this->assign('dl_data',$dl_data);
			$new_download = $download->order('dl_id desc')->limit(5)->select();
			$cat = M("Cats");
			$contact = M("Contacts");
			$con_list = $contact->select();
			$cat_list = $cat->where("cat_author = 4")->select();
			$this->assign('cat_list',$cat_list);
			$this->assign('con_list',$con_list);
			$this->assign('new_download',$new_download);
			$this->display();
		}
	}
	public function downloadCat()
	{
		$nav = M("Navs");
		$cat = M("Cats");
		$contact = M("Contacts");
		$download = M("Downloads");
		$nav_list = $nav->order('nav_id')->select();
		$this->assign('nav_list',$nav_list);
		import('ORG.Util.Page');
		$arr = array('dl_cat' => $_GET['dl_cat']);
		
		$arr1 = array('cat_id' => $_GET['cat_id'],);
		$dl_cat = $cat->where($arr1)->getField('cat_name');
		$arr = array('dl_cat' => $dl_cat,);
		$count = $download->where($arr)->count();
		$Page = new Page($count,20);
		$show = $Page->show();// 分页显示输出
		$list = $download->where($arr)->order('dl_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);
		$this->assign('page',$show);// 赋值分页输出
		
		$con_list = $contact->select();
		$cat_list = $cat->where("cat_author = 4")->select();
		$this->assign('cat_list',$cat_list);
		$this->assign('con_list',$con_list);
		$this->display('downloadList'); // 输出模板
	
	}
	public function downloadList()
	{
		$nav = M("Navs");
		$nav_list = $nav->order('nav_id')->select();
		$this->assign('nav_list',$nav_list);
		import('ORG.Util.Page');
		$download = M("Downloads");
		$count = $download->count();
		$Page = new Page($count,20);
		$show = $Page->show();// 分页显示输出
		$list = $download->order('dl_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);
		$this->assign('page',$show);// 赋值分页输出
		$cat = M("Cats");
		$contact = M("Contacts");
		$con_list = $contact->select();
		$cat_list = $cat->where("cat_author = 4")->select();
		$this->assign('cat_list',$cat_list);
		$this->assign('con_list',$con_list);
		$this->display(); // 输出模板
	
	}
}

?>
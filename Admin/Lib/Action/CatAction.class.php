<?php

	class CatAction extends Action{
	
		public function index()
		{
			
			if(isAdmin() == true)
			{
				import('ORG.Util.Page');
				$cat = M("Cats");
				$count = $cat->count();
				$Page = new Page($count,10);
				$show = $Page->show();// 分页显示输出
				$cat_list = $cat->order('cat_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
				$this->assign('page',$show);// 赋值分页输出
				$this->assign('cat_list',$cat_list);
				$this->display();	
			}else{
				$this->redirect("User/login");
			}
		}
		public function catAdd()
		{
			if(isAdmin() == true)
			{
				$this->display();
			}else{
			
				$this->redirect("User/login");
			}
		}
		public function doCatAdd()
		{
			if(isAdmin() == true)
			{
				$cat = M("Cats");
				$data = array(
					'cat_name' => $_GET['cat_name'],
					'cat_author' => $_GET['cat_author'],
				);					
				$is_add = $cat->add($data);
				if($is_add == null)
				{
					$this->error("添加分类失败");
				}else{
					$this->redirect('index');
				}
			}else{
				$this->redirect("User/login");
			}
		}
		public function catDelete()
		{
			if(isAdmin() == true)
			{
				$cat = M("Cats");
				$cat_id = $_GET['cat_id'];
				$is_delete = $cat->where("cat_id = $cat_id")->delete();
				if($is_delete == false)
				{
					$this->error("删除失败");
				}else{
					$this->redirect('index');
				}
			}else{
			
				$this->redirect("User/login");
			}
		}

	}


?>
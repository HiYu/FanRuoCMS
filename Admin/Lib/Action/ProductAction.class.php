<?php
	class ProductAction extends Action{		
		public function index()
		{	
			if(isAdmin() == true)
			{
				import('ORG.Util.Page');
				$product = M("products");
				$count = $product->count();
				$Page = new Page($count,10);
				$show = $Page->show();// 分页显示输出
				$product_data = $product->order('pro_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
				$this->assign('page',$show);// 赋值分页输出	
				$this->assign('product_data',$product_data);
				$this->display();
			}else{
				$this->redirect('User/login');
			}	
		
		}
		public function productAdd()
		{
			if(isAdmin() == true)
			{
				$cat = M("Cats");
				$cat_data = $cat->where("cat_author = 3")->select();
				$this->assign('cat_data',$cat_data);
				$this->display();
			}else{
				$this->redirect('User/login');
			}	
		
		}
		public function doProductAdd()
		{
			if(isAdmin() == true)
			{
				$product = M("Products");
				$arr = array(
					'pro_discrib' => $_GET['pro_discrib'],
					'pro_name' => $_GET['pro_name'],
					'pro_price' => $_GET['pro_price'],
					'pro_cat' => $_GET['pro_cat'],	
				);
					
				$is_add = $product->add($arr);
				if( $is_add != false)
				{
					$this->redirect('index');
					
				}
				
			}else{
				$this->redirect('User/login');
			}	
		}
		public function productDelete()
		{
			if(isAdmin() == true)
			{
				$product = M("Products");
				$pro_id = $_GET['pro_id'];
				$is_delete = $product->where("pro_id = $pro_id")->delete();
				if($is_delete == false)
				{
					$this->error("删除失败");
				}else{
					$this->redirect('index');
				}	
			}else{
				$this->redirect('User/login');
			}	
		
		}
		public function productRead()
		{
			if(isAdmin() == true)
			{
				$product = M("Products");
				$pro_id = $_GET['pro_id'];
				$pro_data = $product->where("pro_id = $pro_id")->find();
				if($pro_data != null)
				{
					$this->assign('pro_data',$pro_data);
					$this->display();
				}else{
					$this->error("读取失败");
				}
			}else{
				$this->redirect('User/login');
			}
		}
	}


?>
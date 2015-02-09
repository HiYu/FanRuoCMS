<?PHP
	class ContactAction extends Action{
		public function index()
		{
			if(isAdmin() == true)
			{
				import('ORG.Util.Page');
				$contact = M("Contacts");
				$count = $contact->count();
				$Page = new Page($count,10);
				$show = $Page->show();// 分页显示输出
				$con_list = $contact->order('contact_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
				$this->assign('page',$show);// 赋值分页输出
				$this->assign('con_list',$con_list);
				$this->display();	
			}else{
			
				$this->redirect('User/login');
			}
			
		}
		public function contactAdd()
		{
			if(isAdmin() == true)
			{
				$this->display();
			}else{
			
				$this->redirect('User/login');
			}
		}
		public function doContactAdd()
		{	
			if(isAdmin() == true)
			{
				$contact = M("Contacts");
				$data = array(
					'contact_name' => $_GET['contact_name'],
					'contact_type' => $_GET['contact_type'],
					'contact_num' => $_GET['contact_num'],
				);
				$is_add = $contact->add($data);
				if($is_add != false)
				{
					$this->redirect('index');
				}else{
					$this->error("添加联系人失败！");
				}
			}else{
			
				$this->redirect('User/login');
			}
		}
		
		public function contactDelete()
		{
			if(isAdmin() == true)
			{
				$contact = M("Contacts");
				$contact_id = $_GET['contact_id'];	
				$is_delete = $contact->where("contact_id = $contact_id")->delete();
				if($is_delete != false)
				{
					$this->redirect('index');
				}else{
					$this->error("删除失败！");
				}
			}else{
			
				$this->redirect('User/login');
			}
		}
		public function contactModify()
		{
			if(isAdmin() == true)
			{
			}else{
			
				$this->redirect('User/login');
			}
		}
		public function doContactModify()
		{
			if(isAdmin() == true)
			{
			}else{
			
				$this->redirect('User/login');
			}
		}
		
	
	
	
	
	
	
	}


?>
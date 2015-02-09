<?php
	class JobAction extends Action{
		public function index()
		{
			if(isAdmin() == true)
			{
				import('ORG.Util.Page');
				$job = M("Jobs");
				$count = $job->count();
				$Page = new Page($count,10);
				$show = $Page->show();// 分页显示输出
				$job_list = $job->order('job_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
				$this->assign('page',$show);// 赋值分页输出
				$this->assign('job_list',$job_list);
				$this->display();
			}else{
				$this->redirect('User/login');
			}	
		}
		
		public function jobAdd()
		{
			if(isAdmin() == true)
			{
				$cat = M("Cats");
				$cat_data = $cat->where("cat_author = 2")->select();
				$this->assign('cat_data',$cat_data);
				$this->display();
			}else{
				$this->redirect('User/login');
			}	
		}
		public function doJobAdd()
		{
			if(isAdmin() == true)
			{
				$data = array(
					'post_id' => $_SESSION['user_id'],
					'job_name' => $_GET['job_name'],
					'job_cat' => $_GET['job_cat'],
					'num' => $_GET['num'],
					'work_where' => $_GET['work_where'],
					'wage' => $_GET['wage'],
					'ask_sex' => $_GET['ask_sex'],
					'ask_edu' => $_GET['ask_edu'],
					'exp_require' => $_GET['exp_require'],
					'add_time' => date('Y-m-d'),
					'job_status' => $_GET['job_status'],
					'more_discrib' => $_GET['more_discrib'],
					'contact_email' => $_GET['contact_email'],	
				);
				$job = M("Jobs");
				$job->add($data);
				$this->redirect('index');
			}else{
				$this->redirect('User/login');
			}
		}
		public function jobDelete()
		{
			if(isAdmin() == true)
			{
				$job_id = $_GET['job_id'];
				$job = M("Jobs");
				$job->where("job_id = $job_id")->Delete();
				$this->redirect('index');
			}else{
				$this->redirect('User/login');
			}
		
		}
		public function jobModify()
		{
			if(isAdmin() == true)
			{
				$job = M("Jobs");
				$job_id = $_GET['job_id'];
				$job_data = $job->where("job_id = $job_id")->find();
				$this->assign('job_data',$job_data);
				$this->display();
			}else{
				$this->redirect('User/login');
			}	
		}
		public function doJobModify()
		{
			if(isAdmin() == true)
			{
				$job_id = $_GET['job_id'];
				$data = array(
					'post_id' => $_SESSION['user_id'],
					'job_name' => $_GET['job_name'],
					'job_cat' => $_GET['job_cat'],
					'num' =>$_GET['num'],
					'work_where' =>$_GET['work_where'],
					'wage'=>$_GET['wage'],
					'ask_sex'=>$_GET['ask_sex'],
					'ask_edu'=>$_GET['ask_edu'],
					'exp_require'=>$_GET['exp_require'],
					'more_discrib'=>$_GET['more_discrib'],
					'contact_email'=> $_GET['contact_email'],
					'add_time' => date('Y-m-d'),
					'status' => $_GET['status'],
				);
				$job = M("Jobs");
				$job->where("job_id = $job_id")->save($data);
				$this->redirect('index');
			}else{
				$this->redirect('User/login');
			}
		
		}
		
		public function jobRead()
		{
			if(isAdmin() == true)
			{
				$job = M("Jobs");
				$job_id = $_GET['job_id'];
				$job_data = $job->where("job_id = $job_id")->find();
				$this->assign('job_data',$job_data);
				$this->display();
			}else{
				$this->redirect('User/login');
			}	
		}
		public function jobCat()
		{
			if(isAdmin() == true)
			{
				$job_cat = $_GET['job_cat'];
				import('ORG.Util.Page');
				$job = M("Jobs");
				$arr['job_cat'] = $job_cat;
				$count = $job->where($arr)->count();
				$Page = new Page($count,10);
				$show = $Page->show();// 分页显示输出
				$job_list = $job->where($arr)->order('job_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
				$this->assign('page',$show);// 赋值分页输出
				$this->assign('job_list',$job_list);
				$this->display('index');
			}else{
				$this->redirect('User/login');
			}	
		}
	}

?>
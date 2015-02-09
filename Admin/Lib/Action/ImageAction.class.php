<?php
	class ImageAction extends Action{
	
		public function index()
		{	
			if(isAdmin() == true)
			{
				import('ORG.Util.Page');
				$image = M("Images");
				$count = $image->count();
				$Page = new Page($count,4);
				$show = $Page->show();// 分页显示输出
				$image_list = $image->order('image_id')->limit($Page->firstRow.','.$Page->listRows)->select();
				$this->assign('page',$show);// 赋值分页输出
				$this->assign('image_list',$image_list);
				
				$this->display();
			}else{
				$this->redirect('User/login');
			}	
		}
		public function imageDelete()
		{
			if(isAdmin() == true)
			{
				$image = M("Images");
				$image_id = $_GET['image_id'];
				$image_data = $image->where("image_id = $image_id")->find();
				$is_delete = $image->where("image_id = $image_id")->delete();
				if($is_delete != false)
				{
					// echo $image_data['image_path']."s_".$image_data['image_save_name'];
					unlink($image_data['image_path']."s_".$image_data['image_save_name']);
					unlink($image_data['image_path']."m_".$image_data['image_save_name']);
					$this->redirect('index');
				}
				
			}else{
				$this->redirect('User/login');
			}	
		
		}

		public function imageAdd()
		{
			if(isAdmin() == true)
			{
				$this->display();
			}else{
				$this->redirect('User/login');
			}	
		}
		public function doImageAdd()
		{
			if(isAdmin() == true)
			{
				import("ORG.Net.UploadFile");
				 $upload = new UploadFile();
				 $upload->maxSize = 3292200;
				 $upload->allowExts = explode(',', 'jpg,gif,png,jpeg');
				 $upload->savePath = './upload/show/';			
				 $upload->thumb = true;
				
				 $upload->thumbPrefix = 'm_,s_';  //设置需要生成缩略图的文件后缀,生产2张缩略图
				 $upload->thumbMaxWidth = '960,100';
				 $upload->thumbMaxHeight = '280,100';
				 $upload->saveRule = 'time';//设置上传文件规则
				 $upload->thumbRemoveOrigin = true; //删除原图
				 if (!$upload->upload()) {
					 //捕获上传异常
					 $this->error($upload->getErrorMsg());
					
					
				 } else {
					 //取得成功上传的文件信息
					 $info = $upload->getUploadFileInfo();
					  // dump($info);
					 $image = M("Images");
					 $arr = array(
						'image_name' => $_POST['image_name'],
						'image_id' => $_POST['image_id'],
						'image_path' => $info[0]['savepath'],
						'image_save_name' => $info[0]['savename'],
						'is_display' => $_POST['is_display'],
					 );
				 // dump($arr);
					$is_add = $image->add($arr);
					if($is_add != false)
					{
						$this->redirect('index');
					}else{
						$this->error("上传照片失败");
					}
					 
					
				 }
			}else{
				$this->redirect('User/login');
			}
		}
	
}



?>
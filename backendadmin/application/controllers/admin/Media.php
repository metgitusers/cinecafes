<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Media extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('mcommon');
		
		$this->load->library('imageupload');
	}
	
	public function index() { 
		$this->_load_list_view();		
	}
	
	private function _load_list_view() {
		$data['content'] = 'admin/media/list';
		$data['title']= 'Media';
		$condition['is_delete'] =0;
    	$List = $this->mcommon->getDetails('master_media',$condition);
    	$data['media_all_list']= $List;
		$this->admin_load_view($data);
	}
	
	
	
	public function add(){		
		$condition = array();
		$data['title']= 'Media';
		//$data['cms_list'] = $this->mbanner->getRows('cms',$condition);
		$data['content']='admin/media/add';
		$this->admin_load_view($data);
	}
	
	public function add_content()
	{
	
		if($_POST){			
			//$this->form_validation->set_rules('banner_order','Banner Order','required');			
			
			// if(empty($_FILES['imgInp']['name'])){
			// 	$this->form_validation->set_rules('imgInp','Banner Image','required');
			// }
			
			// if($this->form_validation->run()==FALSE){			
			// 	$this->_load_add_view();
			// }else{	

					if(!empty($_FILES['imgInp']['name'])){
						$image_path = '/public/upload_images/media/';
						$file=$this->imageupload->image_upload($image_path);
						if($file['status']==1){
							$udata['media_image']=$file['result'];
						}else{
							$this->session->set_flashdata('error_msg',$file['result']);
							redirect('admin/media/add/','refersh');
						}
					}				
					
					$udata['media_name']=$this->input->post('media_name');					
					// $udata['date_of_creation']=date('Y-m-d H:i:s');
					
					$udata['status'] = 1;
					
					$this->mcommon->insert("master_media",$udata);
					$this->session->set_flashdata('success_msg','Entertainment media added successfully');
					redirect('admin/media');
			
				
			//}
		}else{
			$this->_load_list_view();
		}
	}
	
	public function edit($id){echo FCPATH;exit;
		$condition = array();
		$condition['media_id']=$id;
		$data['row']=$this->mcommon->getRow("master_media",$condition);	
		$data['content'] = 'admin/media/edit';
		$data['title']= 'Media';
		$this->admin_load_view($data);
	}
	
	
	public function update_content()
	{
		if($this->input->post())
		{
			$id = $this->input->post('id');
			$condition['media_id']=$id;
			$existing_row=$this->mcommon->getRow("master_media",$condition);
		
			//if(!empty($_FILES['imgInp']['name'])){
			//	$image_path = 'public/upload_images/media/';
			//	$file=$this->imageupload->image_upload($image_path);					
			//	if($file['status']==1){
			//		$udata['media_image']=$file['result'];
			//		if($_FILES['imgInp']['name']){
			//			if($existing_row['media_image']){								
			//				unlink('public/upload_images/media/'.$existing_row['media_image']);
			//			}
			//		}						
			//	}else{
			//		$this->session->set_flashdata('error_msg',$file['result']);
			//		redirect('admin/media/edit/'.$id,'refersh');
			//	}
			//}
			
			if($filename = $this->uploadImage('imgInp','public/upload_images/media/'))
			{
				if( !empty($existing_row['media_image']) && file_exists(FCPATH.'public/upload_images/media/'.$existing_row['media_image']) ){							
					unlink('public/upload_images/media/'.$existing_row['media_image']);
				}
				$udata['media_image']=$filename;
			}
			
			$udata['media_name']=$this->input->post('media_name');					
			// $udata['date_of_update']=date('Y-m-d H:i:s');	
		
			if(!empty($udata))
			{
				$this->mcommon->update("master_media",$condition,$udata);
				$this->session->set_flashdata('success_msg','Entertainment media updated successfully');
			}
			
			redirect('admin/media');
		}
		else
		{
			$this->_load_list_view();
		}
	}
}
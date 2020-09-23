<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Banner extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('mcommon');
		$this->load->model('admin/mbanner');
		$this->load->library('imageupload');
	}
	
	public function index() { 
		$this->_load_list_view();		
	}
	
	private function _load_list_view() {
		$data['content'] = 'admin/banner/list';
		$data['title']= 'Banner';
		$condition['is_delete'] =0;
    	$List = $this->mcommon->getDetails('banner',$condition);
    	$data['banner_all_list']= $List;
		$this->admin_load_view($data);
	}
	
	public function all_content_list(){		
		$list = $this->mbanner->get_datatables();
        $data = array();
        $no = $_POST['start'];
		$i=1;
        foreach ($list as $person) {
            $no++;
            $row = array();	
			//$row[] = '<input type="checkbox" class="cstm_view" title="'.$person->banner_id.'">';			
			$row[]=$i;			
			if($person->banner_image != '')
			{
				$banner_image = '<img src="'.base_url().'public/upload_images/banner/'.$person->banner_image.'"style="width:80px;" id="blah">';
			}else{
				$banner_image = '';
			}
			
			$row[] = $banner_image;
			$row[] = ($person->status==1?'<a class="cstm_view_status" id="active" style="color:green" href="javascript:void(0)" title="'.$person->banner_id.'">Approved</a>':'<a class="cstm_view_status" id="inactive" style="color:red" href="javascript:void(0)" title="'.$person->banner_id.'">Disapproved</a>');									
            $row[] = '<a class="cstm_view" href="'.base_url('admin/banner/details/'.$person->banner_id).'" title="Edit"><i class="glyphicon glyphicon-edit"></i></a><a class="cstm_view" id="delete" style="padding-left:5px" href="javascript:void(0)" title="'.$person->banner_id.'"><i class="glyphicon glyphicon-remove"></i></a><a class="cstm_view" id="view" style="padding-left:5px" href="javascript:void(0)" title="'.$person->banner_id.'"><i class="glyphicon glyphicon-eye-open"></i></a>';
            $data[] = $row;
			$i++;
        }
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->mbanner->count_all(),
                        "recordsFiltered" => $this->mbanner->count_filtered(),
                        "data" => $data,
                );
        echo json_encode($output);
	}
	
	public function all_details(){
		$banner_id = $this->input->post('banner_id');		
		$result = $this->mbanner->get_details($banner_id);		
		echo json_encode($result);
	}
	
	public function add(){		
		$this->_load_add_view();
	}
	
	private function _load_add_view(){
		$condition = array();
		$data['title']= 'Banner';
		//$data['cms_list'] = $this->mbanner->getRows('cms',$condition);
		$data['content']='admin/banner/add';
		$this->admin_load_view($data);
	}
	
	public function add_content()
	{
	
		if($_FILES){			
			//$this->form_validation->set_rules('banner_order','Banner Order','required');			
			
			// if(empty($_FILES['imgInp']['name'])){
			// 	$this->form_validation->set_rules('imgInp','Banner Image','required');
			// }
			
			// if($this->form_validation->run()==FALSE){			
			// 	$this->_load_add_view();
			// }else{	

					if(!empty($_FILES['imgInp']['name'])){
						$image_path = '/public/upload_images/banner/';
						$file=$this->imageupload->image_upload($image_path);
						if($file['status']==1){
							$udata['banner_image']=$file['result'];
						}else{
							$this->session->set_flashdata('error_msg',$file['result']);
							redirect('admin/banner/add/','refersh');
						}
					}				
					
					// $udata['banner_order']=$this->input->post('banner_order');					
					// $udata['date_of_creation']=date('Y-m-d H:i:s');
					
					$udata['status'] = 1;
					
					$this->mbanner->add($udata);
					$this->session->set_flashdata('success_msg','Banner added successfully');
					redirect('admin/banner');
			
				
			//}
		}else{
			$this->_load_list_view();
		}
	}
	
	public function edit($banner_id){
		$data['row']=$this->mbanner->get_details($banner_id);	
		if(empty($data['row'])){
			$this->_load_list_view();
		}else{			
			$this->_load_details_view($banner_id);
		}
	}
	
	private function _load_details_view($banner_id){
		$condition = array();
		$data['row']=$this->mbanner->get_details($banner_id);	
		$data['content'] = 'admin/banner/edit';
		$data['title']= 'Banner';
		$this->admin_load_view($data);
	}
	
	public function update_content(){
		if($this->input->post()){
			$banner_id = $this->input->post('id');			
					
			
			// if($this->form_validation->run()==FALSE){
			// 	$data['row']=$this->mbanner->get_details($banner_id);				
			// 	$this->_load_details_view($data);
			// }else{
				
				
				$banner_information = $this->mbanner->get_details($banner_id);
			
						$udata=array();
						if(!empty($_FILES['imgInp']['name'])){
							$image_path = '/public/upload_images/banner/';
							$file=$this->imageupload->image_upload($image_path);					
							if($file['status']==1){
								$udata['banner_image']=$file['result'];
								if($_FILES['imgInp']['name']){
									if($banner_information['banner_image']){								
										unlink('./public/upload_images/banner/'.$banner_information['banner_image']);
									}
								}						
							}else{
								$this->session->set_flashdata('error_msg',$file['result']);
								redirect('admin/banner/edit/'.$banner_id,'refersh');
							}
						}
						
						$condition=array('id'=>$banner_id);						
						// $udata['banner_order']=$this->input->post('banner_order');						
						// $udata['date_of_update']=date('Y-m-d H:i:s');	
					
						if(!empty($udata))
						{
							$this->mbanner->update($condition,$udata);
							$this->session->set_flashdata('success_msg','Banner updated successfully');
						}
						
						
						redirect('admin/banner');				
				
			//}
		}else{
			$this->_load_list_view();
		}
	}
	
	public function delete_content(){
		$condition['banner_id']=$this->input->post('banner_id');	
		$banner_information = $this->mbanner->get_details($this->input->post('banner_id'));
		if($banner_information['banner_image']){
			unlink('./public/upload_images/banner/'.$banner_information['banner_image']);					
		}
		$this->mbanner->delete($condition);
		$response=array('status'=>1,'message'=>'Success');
		echo header('Content-Type: application/json');
		echo json_encode($response);
	}
	
	public function active()
	{
		$condition['banner_id']=$this->input->post('banner_id');
		$udata['status'] = 1;
		$this->mbanner->active($condition,$udata);
		$response=array('status'=>1,'message'=>'Success');		
		echo json_encode($response);
	}
	
	public function inactive()
	{
		$condition['banner_id']=$this->input->post('banner_id');
		$udata['status'] = 0;
		$this->mbanner->active($condition,$udata);
		$response=array('status'=>1,'message'=>'Success');		
		echo json_encode($response);
	}
	
	public function multiple_del()
	{
		$category_ids = explode(',',$this->input->post('category_ids'));
		foreach($category_ids as $category_id)
		{
			$condition['category_id'] = $category_id;
			$category_information = $this->mbanner->get_details($category_id);
			if($category_information['category_image']){
				unlink('./public/images/category/'.$category_information['category_image']);					
			}			
			$this->mbanner->delete($condition);			
			$response=array('status'=>1,'message'=>'Success');
		}		
		echo header('Content-Type: application/json');
		echo json_encode($response);
	}
}
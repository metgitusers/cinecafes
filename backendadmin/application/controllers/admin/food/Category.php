<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->admin=$this->session->userdata('admin');
		$this->load->library('imageupload');
		// if($this->session->userdata('role_id') == '')
		// {
		// 	redirect('admin');
		// 	die();
		// }
	}

	// Default load function for header and footer inculded
	private function _load_view($data) {
		//$this->load->view('admin/layouts/index',$data);
		$this->admin_load_view($data);
	}	

	public function index() { 
		$result = array();
		$result['content']='admin/food/category/index';
		$this->_load_view($result);
	} 

	public function add()
	{	
		$result = array();			
		$result['content']='admin/food/category/add';
		$result['categories']=$this->mcommon->select('food_categories', ['parent_category'=> null, 'status'=> 1], '*', 'category_name', 'ASC');
		$result['is_parent'] = '';
		
		$this->_load_view($result);
	}

	public function store()
	{
		$data 	= array();
		$result =  array();
		$img 	= '';
		$result['content']='admin/food/category/add';		
		$this->form_validation->set_rules('category', 'Category', 'trim|required');
		if($this->form_validation->run()==FALSE){
			$this->_load_view($result);
		}else{
			$where = array('LOWER(category_name)'=> $this->input->post('category'), 'status !='=> 3);
			if(!empty($this->input->post('food_category_id'))){
				$where['food_category_id !='] = $this->input->post('food_category_id');
			}
			$isPresent = $this->mcommon->getRow('food_categories', $where);
			if(!empty($isPresent)){
				$this->session->set_flashdata('error_msg','');
				$this->session->set_flashdata('success_msg','Category is allready exists');
				$this->_load_view($result);
			} 
			else{
				$data = array(
					'category_name' 	=> $this->input->post('category'),
					'parent_category'	=> $this->input->post('parent_category')!=""?$this->input->post('parent_category'):null,
					'status'			=> 1,
				);
				if(empty($this->input->post('food_category_id'))){
					$result = $this->mcommon->insert('food_categories',$data);
					$msg = "Add new Item Category";
				}else{
					$data['status']= $this->input->post('status');
					$result = $this->mcommon->update('food_categories',['food_category_id'=> $this->input->post('food_category_id')], $data);
					$msg = "update Item Category";
					$result =$this->input->post('food_category_id');
				}
				if($result)
				{
					$log_data = array('action' 	=> $msg,
								'statement' 	=> $msg." named - '".$this->input->post('category')."'" ,
								'action_by'	=> $this->admin['user_id'],
								'IP'			=> getClientIP(),
								'id'          => $result,
								'type'        => "Food Category",
								'status'		=> '1'
								);
					$this->mcommon->insert('log',$log_data);
					$this->session->set_flashdata('error_msg','');
					$this->session->set_flashdata('success_msg','Action successfully completed');
					
					redirect('admin/food/category');
				}
				else{
					$this->session->set_flashdata('success_msg','');
					$this->session->set_flashdata('error_msg','Opps!Sorry try again.');				
					redirect('admin/food/category/add');
				}
			}
		}
	}

	public function edit($food_category_id)
	{
		$result = array();
		$result['details'] = $this->mcommon->getRow('food_categories',array('food_category_id'=>$food_category_id));
		$is_parent = '';
		if($result['details']){
			$is_parent = $result['details']['parent_category'];
		}
		$result['is_parent'] = $is_parent;
		$result['categories']=$this->mcommon->select('food_categories', ['parent_category'=> null, 'status'=> 1], '*', 'category_name', 'ASC');
		$result['content']='admin/food/category/add';
		$this->_load_view($result);

	}


}
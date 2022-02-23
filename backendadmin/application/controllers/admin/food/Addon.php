<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Addon extends MY_Controller {
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
		$result['content']='admin/food/addon/index';
		$this->_load_view($result);
	}

	public function add()
	{	
		ini_set('display_errors', 1);
		$result = array();			
		$result['content']='admin/food/addon/add';
		$result['items']=$this->mcommon->select('food_items', ['status'=> 1], '*', 'item_name', 'ASC');
		$this->_load_view($result);
	}

	public function store()
	{
		$data 	= array();
		$result =  array();
		$img 	= '';
		$result['content']='admin/food/addon/add';
		$this->form_validation->set_rules('item_name', 'Item Name', 'trim|required');
		$this->form_validation->set_rules('price', 'Item Price', 'trim|required');
		//$this->form_validation->set_rules('description', 'Item Description', 'trim|required');
		if($this->form_validation->run()==FALSE){
			$this->_load_view($result);
		}else{
			$where = array('LOWER(addon_name)'=> $this->input->post('item_name'), 'status !='=> 3);
			if(!empty($this->input->post('food_item_addon_id'))){
				$where['food_item_addon_id !='] = $this->input->post('food_item_addon_id');
			}
			$isPresent = $this->mcommon->getRow('food_item_addons', $where);
			if(!empty($isPresent)){
				$this->session->set_flashdata('error_msg','');
				$this->session->set_flashdata('success_msg','Item Addon allready exists');
				$this->_load_view($result);
			}
			else{
				$data = array(
					'item_id' 	=> $this->input->post('item'),
					'addon_name' 	=> $this->input->post('item_name'),
					'addon_price'	=> $this->input->post('price'),
					'addon_description'	=> $this->input->post('description'),
					'status'			=> 1
				);
				if(empty($this->input->post('food_item_addon_id'))){
					$result = $this->mcommon->insert('food_item_addons',$data);
					$msg = "Add new Item Addon";
				}else{
					$data['status']= $this->input->post('status');
					$result = $this->mcommon->update('food_item_addons',['food_item_addon_id'=> $this->input->post('food_item_addon_id')], $data);
					$msg = "update Addon";
					$result =$this->input->post('food_item_addon_id');
				}
				//echo $this->db->last_query(); die;
				if($result)
				{
					$log_data = array('action' 	=> $msg,
								'statement' 	=> $msg." named - '".$this->input->post('item_name')."'" ,
								'action_by'	=> $this->admin['user_id'],
								'IP'			=> getClientIP(),
								'id'          => $result,
								'type'        => "Food Item",
								'status'		=> '1'
								);
					$this->mcommon->insert('log',$log_data);
					$this->session->set_flashdata('error_msg','');
					$this->session->set_flashdata('success_msg','Action successfully completed');
					
					redirect('admin/food/addon');
				}
				else{
					$this->session->set_flashdata('success_msg','');
					$this->session->set_flashdata('error_msg','Opps!Sorry try again.');				
					redirect('admin/food/addon/add');
				}
			}
		}
	}

	public function edit($food_item_addon_id)
	{
		$result = array();		
		$result['details'] = $this->mcommon->getRow('food_item_addons',array('food_item_addon_id'=>$food_item_addon_id));
		$result['items']=$this->mcommon->select('food_items', ['status'=> 1], '*', 'item_name', 'ASC');
		$result['content']='admin/food/addon/add';
		$this->_load_view($result);
	}

}
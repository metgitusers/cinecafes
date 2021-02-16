<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends MY_Controller {
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
		$result['content']='admin/food/item/index';
		$this->_load_view($result);
	}

	public function add()
	{	
		ini_set('display_errors', 1);
		$result = array();			
		$result['content']='admin/food/item/add';
		$result['categories']=$this->mcommon->select('food_categories', ['parent_category'=> null, 'status'=> 1], '*', 'category_name', 'ASC');
		$this->_load_view($result);
	}

	public function store()
	{
		// echo '<pre>';
		// print_r($this->input->post()); die;
		$data 	= array();
		$result =  array();
		$img 	= '';
		$result['content']='admin/food/item/add';		
		$this->form_validation->set_rules('parent_category', 'Item Category', 'trim|required');
		$this->form_validation->set_rules('sub_category', 'Sub Category', 'trim|required');
		$this->form_validation->set_rules('item_name', 'Item Name', 'trim|required');
		//$this->form_validation->set_rules('price', 'Item Price', 'trim|required');
		$this->form_validation->set_rules('description', 'Item Description', 'trim|required');
		if($this->form_validation->run()==FALSE){
			$this->_load_view($result);
		}else{
			$isPresent = $this->mcommon->getRow('food_items', ['LOWER(item_name)'=> $this->input->post('item_name'), 'status !='=> 3]);
			if(!empty($isPresent)){
				$this->session->set_flashdata('error_msg','');
				$this->session->set_flashdata('success_msg','Item is allready registered');
				$this->_load_view($result);
			}
			else{
				$data = array(
					'item_name' 	=> $this->input->post('item_name'),
					'category_id'	=> $this->input->post('parent_category'),
					'sub_category_id'	=> $this->input->post('sub_category'),
					//'price'	=> $this->input->post('price'),
					'description'	=> $this->input->post('description'),
					'status'			=> 1,
					'created_at' 		=> date('Y-m-d H:i:s')
				);

				$result = $this->mcommon->insert('food_items',$data);
				if($result)
				{
					$postData = $this->input->post();
					//save item availability
					if($postData['days']){
						$available_day_array = [];
						$available_day_time_array = [];
						foreach ($postData['days'] as $key => $day) {
							$available_day_array = array(
								'food_item_id'=> $result,
								'day'=> $day,
								'price'=> $postData['price'][$key],
								'is_seen'=> in_array($day, isset($postData['visibility'])?$postData['visibility']:array())?1:0
							);
							//insert into available days
							$day_id = $this->mcommon->insert('food_item_available_days', $available_day_array);
							//echo $this->db->last_query();
							if(!empty($postData['change_on'][$key]) && !empty($postData['change_price'][$key])){
								$available_day_time_array = array(
									'food_item_id'=> $result,
									'food_item_available_day_id'=> $day_id,
									'time'=> $postData['change_on'][$key],
									'price'=> $postData['change_price'][$key],
									'is_seen'=> in_array($day, isset($postData['change_visibility'])?$postData['change_visibility']:array())?1:0,
								);
								//insert into day time
								$this->mcommon->insert('food_item_available_day_times',$available_day_time_array );
							}
						}
					}
					$log_data = array('action' 	=> 'Add',
								'statement' 	=> "Added a new Item named - '".$this->input->post('item_name')."'" ,
								'action_by'	=> $this->admin['user_id'],
								'IP'			=> getClientIP(),
								'id'          => $result,
								'type'        => "Food Item",
								'status'		=> '1'
								);
					$this->mcommon->insert('log',$log_data);
					$this->session->set_flashdata('error_msg','');
					$this->session->set_flashdata('success_msg','Item added successfully');
					
					redirect('admin/food/items');
				}
				else{
					$this->session->set_flashdata('success_msg','');
					$this->session->set_flashdata('error_msg','Opps!Sorry try again.');				
					redirect('admin/food/items/add');
				}
			}
		}
	}

	public function edit($food_item_id)
	{
		$result = array();		
		$result['details'] = $this->mcommon->getRow('food_items',array('food_item_id'=>$food_item_id));
		$result['categories']=$this->mcommon->select('food_categories', ['parent_category'=> null, 'status'=> 1], '*', 'category_name', 'ASC');
		$result['sub_categories']=$this->mcommon->select('food_categories', ['parent_category!='=> null, 'status'=> 1], '*', 'category_name', 'ASC');
		$result['content']='admin/food/item/edit';
		$this->_load_view($result);
	}
	public function update($food_item_id)
	{
		// echo '<pre>';
		// print_r($this->input->post()); die;
		$data 	= array();
		$result =  array();
		$img 	= '';
		$result['content']='admin/food/item/edit';
		$this->form_validation->set_rules('parent_category', 'Item Category', 'trim|required');
		$this->form_validation->set_rules('sub_category', 'Sub Category', 'trim|required');
		$this->form_validation->set_rules('item_name', 'Item Name', 'trim|required');
		//$this->form_validation->set_rules('price', 'Item Price', 'trim|required');
		$this->form_validation->set_rules('description', 'Item Description', 'trim|required');
		if($this->form_validation->run()==FALSE){
			$this->edit($food_item_id);
		}else{
			$isPresent = $this->mcommon->getRow('food_items', ['LOWER(item_name)'=> $this->input->post('item_name'), 'status !='=> 3, 'food_item_id !='=> $food_item_id]);
			if(!empty($isPresent)){
				$this->session->set_flashdata('error_msg','');
				$this->session->set_flashdata('success_msg','Item is allready registered');
				$this->_load_view($result);
			}
			else{
				$data = array(
					'item_name' 	=> $this->input->post('item_name'),
					'category_id'	=> $this->input->post('parent_category'),
					'sub_category_id'	=> $this->input->post('sub_category'),
					//'price'	=> $this->input->post('price'),
					'description'	=> $this->input->post('description'),
					'status'			=>  $this->input->post('status'),
					'created_at' 		=> date('Y-m-d H:i:s')
				);

				$result = $this->mcommon->update('food_items', ['food_item_id'=> $food_item_id] ,$data);
				//echo '<pre>';
				if($result)
				{

					$postData = $this->input->post();
					//save item availability
					if($postData['days']){
						//delete update
						$this->db->where('food_item_id', $food_item_id);
						$this->db->delete('food_item_available_days');

						//delete						
						$this->db->where('food_item_id', $food_item_id);
						$this->db->delete('food_item_available_day_times');

						$available_day_array = [];
						$available_day_time_array = [];
						foreach ($postData['days'] as $key => $day) {
							$available_day_array = array(
								'food_item_id'=> $food_item_id,
								'day'=> $day,
								'price'=> $postData['price'][$key],
								'is_seen'=> in_array($day, isset($postData['visibility'])?$postData['visibility']:array())?1:0
							);
							//insert into available days
							$day_id = $this->mcommon->insert('food_item_available_days', $available_day_array);
							//echo $this->db->last_query();
							if(!empty($postData['change_on'][$key]) && !empty($postData['change_price'][$key])){
								$available_day_time_array = array(
									'food_item_id'=> $food_item_id,
									'food_item_available_day_id'=> $day_id,
									'time'=> $postData['change_on'][$key],
									'price'=> $postData['change_price'][$key],
									'is_seen'=> in_array($day, isset($postData['change_visibility'])?$postData['change_visibility']:array())?1:0,
								);
								//insert into day time
								$this->mcommon->insert('food_item_available_day_times',$available_day_time_array );
								//echo $this->db->last_query();
							}
						}
					}
					$log_data = array('action' 	=> 'Update',
								'statement' 	=> "Update Item named - '".$this->input->post('item_name')."'" ,
								'action_by'	=> $this->admin['user_id'],
								'IP'			=> getClientIP(),
								'id'          => $result,
								'type'        => "Food Item",
								'status'		=> '1'
								);
					$this->mcommon->insert('log',$log_data);
					$this->session->set_flashdata('error_msg','');
					$this->session->set_flashdata('success_msg','Item updated successfully');
					
					redirect('admin/food/items');
				}
				else{
					$this->session->set_flashdata('success_msg','');
					$this->session->set_flashdata('error_msg','Opps!Sorry try again.');				
					redirect('admin/food/items/add');
				}
			}
		}
	}

}
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends MY_Controller {
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
		$result['content']='admin/food/orders/index';
		$this->_load_view($result);
	}
	public function orderDetails($food_order_id) { 
		$result = array();
		$where = array(
			'foi.food_order_id'=> $food_order_id,
			'foi.item_addon_id'=> null
		);
		$result['content']='admin/food/orders/details';
		//$result['details']='admin/food/orders/index';
		$join[] = ['table' => 'food_items fi', 'on' => 'fi.food_item_id = foi.item_id', 'type' => 'left'];
		$details= $this->mcommon->select('food_order_items foi', $where, 'foi.*, fi.*, foi.price ordered_price', 'foi.food_order_item_id', 'ASC', $join);
		$order_details_array = [];
		if(!empty($details)){
			$join2[] = ['table' => 'food_item_addons fi', 'on' => 'fi.food_item_addon_id = food_order_items.item_addon_id', 'type' => 'left'];
			foreach ($details as $key => $value) {
				$value->addons = $this->mcommon->select('food_order_items', ['food_order_items.food_order_id'=>$food_order_id, 'food_order_items.item_id'=>$value->item_id, 'food_order_items.item_addon_id !='=> null], 'food_order_items.*, fi.*', '', '', $join2);
				$order_details_array[] = $value;
			}
		}
		$result['details'] = $order_details_array;
		// echo '<pre>';
		// print_r($result['details']); die;
		$where = array(
			'fo.food_order_id'=> $food_order_id
		);
		$join = [];
		$join[] = ['table' => 'master_member mm', 'on' => 'mm.member_id = fo.user_id', 'type' => 'left'];
		$join[] = ['table' => 'food_ordered_address oa', 'on' => 'oa.order_id = fo.food_order_id', 'type' => 'left'];
        $result['order_user'] = $this->mcommon->select('food_orders fo', $where, 'fo.*, mm.first_name, mm.last_name, oa.*', 'fo.food_order_id', 'DESC', $join);
        $result['order_address'] = $this->mcommon->select('food_ordered_address foa', ['foa.order_id'=> $food_order_id], 'foa.*');
        $result['order_coupon'] = $this->mcommon->select('food_apply_coupon fac', ['fac.food_order_id'=> $food_order_id], 'fac.*');
		$result['food_order_id']= $food_order_id;
		$this->_load_view($result);
	}

	/**
	 * Common function to manage status
	 * */
	public function updateBookingStatus(){
		$postData = json_decode(file_get_contents('php://input'), true);
		if (!empty($postData)) {
				$isUpdate = $this->mcommon->update($postData['table'], [$postData['indexKey'] => $postData['id']], ['food_order_status_id' => $postData['status']]);
				if($isUpdate){
					//insert into order status log
					$this->data = array(
						'order_id'=> $postData['id'],
						'order_status'=> $postData['status_text'],
						'created_by'=> $this->admin['user_id'],
					);
					$this->mcommon->insert('food_ordered_logs', $this->data);
					$response = array('status' => array('error_code' => 0, 'message' => 'Request successfully done'), 'result' => array('data' =>array()));
				}else{
					$response = array('status' => array('error_code' => 1, 'message' => 'Unable to perform request'), 'result' => array('data' => array()));
				}
		}  else {
			$response = array('status' => array('error_code' => 1, 'message' => 'BAD REQUEST'), 'result' => array('data' => array()));
		}

		header('Content-Type: application/json');
		echo json_encode($response);
		exit(0);
  }
	
	
}
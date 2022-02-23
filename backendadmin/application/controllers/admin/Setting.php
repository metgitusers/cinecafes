<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Setting extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('mcommon');
				
	}


	
	public function price(){
		$condition = array();
		$condition['id']=1;
		$data['row']=$this->mcommon->getRow("price_settings",$condition);	
		$data['content'] = 'admin/setting/price';
		$data['title']= 'Price Setting';
		$this->admin_load_view($data);
	}
	
	
	public function update_content(){
		if($this->input->post()){
			$id = 1;			
					

				
			
						$udata=array();
						
						
						$condition=array('id'=>$id);						
						$udata['cafe_price']=$this->input->post('cafe_price');					
						$udata['date_of_update']=date('Y-m-d H:i:s');	
					
						
							$this->mcommon->update("price_settings",$condition,$udata);

							///update to all existing cafe price
							$cafe_udata=array();
							$cafe_udata['price']=$this->input->post('cafe_price');
							$condition_cafe=array();	
							$this->mcommon->update("master_cafe",$condition_cafe,$cafe_udata);
							$this->session->set_flashdata('success_msg','Hourly price updated successfully');
					
						
						
						redirect('admin/setting/price');				
				
			//}
		}else{
			$this->_load_list_view();
		}
	}
	
	
}
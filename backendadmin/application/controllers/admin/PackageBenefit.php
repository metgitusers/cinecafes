<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PackageBenefit extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('admin/Mpackage');
		
	}	
	public function index() { 
		$data 									= array();
		$data['content'] 							= 'admin/package_benefite/list';
		$data['package_benefit_active_list'] 		= $this->Mpackage->all_package_benefit_list('1');
		$data['package_benefit_inactive_list'] 	= $this->Mpackage->all_package_benefit_list('0');
		$data['list'] 		= $this->Mpackage->all_package_benefit_list();
		//pr($data);		
		
		$this->admin_load_view($data);	
	}
	/*
		AUTHOR NAME: Sreela Biswas Kundu
		Date: 28/8/19
		purpose: Edit member  
	*/
	public function edit($package_benefit_id){
		$data			= array();
		$condition 			= array('package_benefit_id'=>$package_benefit_id);
		$data['pck_benefit_data']	= $this->mcommon->getRow('package_benefits',$condition);
		//pr($data['pck_benefit_data']);
		$data['content'] 	= 'admin/package_benefite/add_edit_benefit';
		if(empty($data['pck_benefit_data'])){
			redirect('admin/PackageBenefit');
		}else{
			$this->admin_load_view($data);
		}
	}
	public function UpdateBenefit($package_benefit_id){
		//pr($_POST);
		$data		= array();		
    	if($this->input->post()){	
							
			$update_data['benefit_name']		= $this->input->post('benefit_name');
			$update_data['benefit_description']	= $this->input->post('benefit_description');
			$update_data['modified_on']			= date('Y-m-d');
			$benifit_cond						= array('package_benefit_id' => $package_benefit_id);
			$update_id	=	$this->mcommon->update('package_benefits',$benifit_cond,$update_data);
			
			if($update_id){
				$log_data = array('action' 		=> 'Edit',
								  'statement' 	=> "Edited details of package benefits named -'".$this->input->post('benefit_name')."'",
								  'action_by'	=> $this->session->userdata('user_data'),
								  'IP'			=> getClientIP(),
								  'id'          => $package_benefit_id,
					  	  		  'type'        =>"Package Benefit",
								  'status'		=> '1'
								);
				//$this->mcommon->insert('log',$log_data);
				$this->session->set_flashdata('success_msg','A package benefit updated successfully');
				redirect(base_url('admin/PackageBenefit'));
			}
			else{
					
				$this->session->set_flashdata('error_msg','Oops!Something went wrong...');
				redirect(base_url('admin/PackageBenefit'));				
			}
		}
		else{

			$this->admin_load_view($data);	
		}
	}
	/*
		AUTHOR NAME: Sreela Biswas Kundu
		Date: 28/8/19
		purpose: ADD NEW member  
	*/
	public function add(){
		$data						= array();
		$data['pck_benefit_data']		= '';
		$data['content'] 			 	= 'admin/package_benefite/add_edit_benefit';		
		$this->admin_load_view($data);
	}
	public function Save(){
		
		$data					= array();		
		if($this->input->post()){			
			$this->form_validation->set_rules('benefit_name','Benefit Name','trim|required');
			$this->form_validation->set_rules('benefit_description','Benefit Description','trim|required');
			if($this->form_validation->run()==FALSE){
				$data['pck_benefit_data']	= '';
				$data['content'] 			= 'admin/package_benefite/add_edit_benefit';
				$this->admin_load_view($data);
			
			}else{
				//echo '<pre>'; print_r($this->input->post());die;
				$this->db->where('LOWER(benefit_name)', $this->input->post('benefit_name'));
				$this->db->where('is_delete',0);
				$d = $this->db->get('package_benefits')->row();
				//echo $this->db->last_query();
				if(!empty($d)){
					//echo 'if';
					$this->session->set_flashdata('error_message', 'The Benifit name is already exists');
					$data['pck_benefit_data']	= '';
					$data['content'] 			= 'admin/package_benefite/add_edit_benefit';
					$this->admin_load_view($data);
				}else{
					//echo 'else';
					$insert_data['benefit_name']		= $this->input->post('benefit_name');
					$insert_data['benefit_description']	= $this->input->post('benefit_description');
					$insert_data['created_on']			= date('Y-m-d');
					$insert_data['status'] 				= 1;
					$insert_id	=	$this->mcommon->insert('package_benefits',$insert_data);
					//echo $this->db->last_query();
					if($insert_id){
						$log_data = array('action' 		=> 'Add',
										'statement' 	=> "Added a new package benefits named-'".$this->input->post('benefit_name')."'",
										'action_by'	=> $this->session->userdata('user_data'),
										'IP'			=> getClientIP(),
										'id'          => $insert_id,
										'type'        =>"Package Benefit",
										'status'		=> '1'
										);
						//$this->mcommon->insert('log',$log_data);
						$this->session->set_flashdata('success_msg','A new package benefit added successfully');
						redirect(base_url('admin/PackageBenefit'));

					}
					else{
							
						$this->session->set_flashdata('error_msg','Oops!Something went wrong...');
						redirect(base_url('admin/PackageBenefit'));				
					}
				}	
			}
		}
		else{

			$this->_load_view();
		}
	}
	/*
		AUTHOR NAME: Sreela Biswas Kundu
		Date: 28/8/19
		purpose: DELETE member Permanently   
	*/
	private function _load_view($data) {
		   // FUNCTION WRIITTEN IN COMMON HELPER
		$this->load->view('admin/layouts/index', $data);
		
	}		
	public function DeleteBenefit($package_benefit_id){
		$response				= array();
		$return_response		= '';
		$benefit_name			= '';		
		$tbl_column_name		= 'package_benefit_id';
		$chng_status_colm		= 'is_delete';
		$status     	 		= '1';
		$table 					= 'package_benefits';
		$return_response		= getStatusCahnge($package_benefit_id,$table,$tbl_column_name,$chng_status_colm,$status);//function definein commonhelper
		if($return_response){
			$benefit_data 		= $this->mcommon->getRow('package_benefits', array('package_benefit_id' => $package_benefit_id));
			if(!empty($benefit_data)){
				$benefit_name   = $benefitr_data['benefit_name'];
			}
			$log_data = array('action' 		=> 'Delete',
							  'statement' 	=> "Deleted a package benefit named -'".$benefit_name."'",
							  'action_by'	=> $this->session->userdata('user_data'),
							  'IP'			=> getClientIP(),
							  'id'          => $package_benefit_id,
					  	  	  'type'        =>"Package Benefit",
							  'status'		=> '1'
							);
			//$this->mcommon->insert('log',$log_data);
			$this->session->set_flashdata('error_msg','');
			$this->session->set_flashdata('success_msg','package benefit successfully deleted');
		}
		else{
			$this->session->set_flashdata('success_msg','');
			$this->session->set_flashdata('error_msg','Opp! Some problem,Try again.');
		}				
		redirect('admin/PackageBenefit');
	}
	public function changeStatus()
	{
		$response				= array();
		$return_response		= '';
		$id						= $this->input->post('id');
		$tbl_column_name		= 'package_benefit_id';
		$status     	 		= $this->input->post('change_status');
		$chng_status_colm		= 'status';
		$table 					= 'package_benefits';
		$return_response		= getStatusCahnge($id,$table,$tbl_column_name,$chng_status_colm,$status);//function definein commonhelper
		if($return_response){
			$benefit_data 		= $this->mcommon->getRow('package_benefits', array('package_benefit_id' => $id));
			if(!empty($benefit_data)){
				$benefit_name   = $benefit_data['benefit_name'];
			}
			if($status == '0'){
				$changed_status 	= 'inactive';
			}
			else{
				$changed_status 	= 'active';
			}
			$log_data = array('action' 		=> 'Edit',
							  'statement' 	=> "Made package benefit named - '".$benefit_name."' ".$changed_status,
							  'action_by'	=> $this->session->userdata('user_data'),
							  'IP'			=> getClientIP(),
							  'id'          => $id,
					  	  	  'type'        =>"Package Benefit",
							  'status'		=> '1'
							);
			//$this->mcommon->insert('log',$log_data);
			echo 1;exit;
		}				
		else{
			echo 0 ;exit;
		}
	}
	public function PackageMemberList() { 
		//echo $this->session->userdata('email');die;
		$data						= array();
		$data['content'] 				= 'admin/package/package_mem_list';
		$pck_cond 			= array('status' => '1','is_delete'=>'0');
		$pkg_list			= $this->mcommon->getDetails('membership_package_master',$pck_cond);
		if(!empty($pkg_list)){
			$data['pkg_list']	= $pkg_list;
		}
		else{
			$data['pkg_list']	= '';
		}
		$data['premium_mem_list'] 	= $this->Mpackage->get_pck_member_list('2');
		$data['normal_mem_list'] 		= $this->Mpackage->get_pck_member_list('1');
		//pr($data);		
		
		$this->_load_view_member($data);		
	}
}
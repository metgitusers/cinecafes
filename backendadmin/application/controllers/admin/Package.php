<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('admin/Mpackage');
	}	
	public function index() { 
		//echo $this->session->userdata('email');die;
		$data 					= array();
		$benifit_list 				= array();
		$data['content'] 			= 'admin/package/list';
		$pkg_actv_data  			= $this->Mpackage->get_package_list();
		if(!empty($pkg_actv_data)){
			foreach($pkg_actv_data as $pkg_list){
				$benifit_list[$pkg_list['package_id']]  	= $this->Mpackage->get_package_benefit_list($pkg_list['package_id']);
				//$voucher_list[$pkg_list['package_id']]  	= $this->Mpackage->get_package_voucher_list($pkg_list['package_id']);
				//$price_list[$pkg_list['package_id']]  		= $this->Mpackage->get_package_price_list($pkg_list['package_id']);
				$image_list[$pkg_list['package_id']]  		= $this->Mpackage->get_package_image_list($pkg_list['package_id']);

			}
			$data['package_active_list']['pkg_actv_data']	= $pkg_actv_data;
			$data['package_active_list']['benifit_list']	= $benifit_list;
			//$data['package_active_list']['voucher_list']	= $voucher_list;
			//$data['package_active_list']['price_list']	= $price_list;
			$data['package_active_list']['image_list']	= $image_list;	
		}		
		
		//$data['package_inactive_list'] 	= $this->Mpackage->get_package_list('0');
		//pr($data);		
		
		$this->admin_load_view($data);		
	}
	/*
		AUTHOR NAME: Sreela Biswas Kundu
		Date: 28/8/19
		purpose: Edit member  
	*/
	public function edit($package_id){
		$data 					= array();
		$benifit_list_data 			= array();
		$voucher_list_data 			= array();
		$data['package']			= $this->mcommon->getRow('master_package',array('package_id'=>$package_id));
		$data['package_type']		= $this->mcommon->getDetails('package_type',array());
		//$data['package_vouchers']	= $this->mcommon->getDetails('package_vouchers',array('status'=>'1'));
		$data['package_benefits']	= $this->mcommon->getDetails('package_benefits',array('status'=>'1','is_delete'=>0));
		$benifit_list  				= $this->Mpackage->get_package_benefit_list($package_id);
		if(!empty($benifit_list)){
			foreach($benifit_list as $blist){
				$benifit_list_data[] = $blist['package_benefit_id'];
			}
			$data['benifit_list'] = $benifit_list_data;
		}
		// $voucher_list 				= $this->Mpackage->get_package_voucher_list($package_id);
		// if(!empty($voucher_list)){
		// 	foreach($voucher_list as $vlist){
		// 		$voucher_list_data[] = $vlist['package_voucher_id'];
		// 	}
		// 	$data['voucher_list'] = $voucher_list_data;
		// }
		//$data['price_list'][$package_id]  	= $this->Mpackage->get_package_price_list($package_id);
		$data['image_list'][$package_id]  	= $this->Mpackage->get_package_image_list($package_id);
			
		
		//pr($data['voucher_list']);
		$data['content'] 	= 'admin/package/add';
		if(empty($data['package'])){
			redirect('admin/package');
		}else{
			$this->admin_load_view($data);
		}
	}
	public function UpdatePackge($package_id){
		//pr($_POST);
		$data					= array();
		$edit_pckage_data		= $this->input->post();
    	if($this->input->post( 'status') ==''){
    		$status ='0';
    	}
    	else{
    		$status ='1';
    	}
		$data = array(
		'package_name' 			=> $this->input->post( 'package_name' ),
		'package_title' 		=> $this->input->post( 'package_title' ),			
		'package_description' 	=> $this->input->post( 'package_description' ),
		'package_terms' 	=> $this->input->post( 'package_terms' ),
		'package_type_id' 	=> $this->input->post( 'package_type_id' ),
		'package_price' 	=> $this->input->post( 'package_price' ),
		'discount_percent' 	=> $this->input->post( 'discount_percent' ),
		'status'				=> $status,
		'update_on' 			=> date('Y-m-d H:i:s'),				
		);
		$condition	= array('package_id'=>$package_id);
		$data = $this->mcommon->update('master_package',$condition,$data);

    	if($data)
    	{
    		if(!empty($edit_pckage_data['benefit_id'])){
    			$this->db->delete('package_benefits_mapping', array('package_id' => $package_id));
    			for($i=0; $i<count($edit_pckage_data['benefit_id']); $i++){
					$batch_benefits_inst[] = array( 
													'package_id'			=> $package_id,
					                        		'package_benefit_id'  	=> $edit_pckage_data['benefit_id'][$i]
					                        
				    );
		    	}
		    	$benefits_inst	= $this->db->insert_batch('package_benefits_mapping', $batch_benefits_inst);
    		}
    	// 	if(!empty($edit_pckage_data['voucher_id'])){
    	// 		$this->db->delete('package_vouchers_mapping', array('package_id' => $package_id));
    	// 		for($i=0; $i<count($edit_pckage_data['voucher_id']); $i++){
					// $batch_voucher_inst[] = array( 
					// 								'package_id'		  => $package_id,
					//                         		'package_voucher_id'  => $edit_pckage_data['voucher_id'][$i]
					                        
				 //    );
		   //  	}
		   //  	$benefits_inst	= $this->db->insert_batch('package_vouchers_mapping', $batch_voucher_inst);
    	// 	}
    	// 	if(!empty($edit_pckage_data['package_type'])){
    	// 		$this->db->delete('package_price_mapping', array('package_id' => $package_id));
    	// 		for($t=0; $t<count($edit_pckage_data['package_type']); $t++){
					// $batch_package_type_inst[] = array( 'package_id'	  => $package_id,
					//                         	   		'package_type_id' => $edit_pckage_data['package_type'][$t],
					//                         	   		'price'  		  => $edit_pckage_data['package_type_price'][$t],
					//                         	   		'number'  		  => $edit_pckage_data['package_type_number'][$t],
					                        
				 //    );
		   //  	}
		   //  	$package_type	= $this->db->insert_batch('package_price_mapping', $batch_package_type_inst);
    	// 	}
   //  		if(!empty($_FILES["pkg_image"]["name"][0])){
	  //   		$imageDetailArray 		= array();
			// 	//echo  "58947";exit;
			// 	$config = array(
			// 		'upload_path'   => './public/upload_image/package_image/',
			// 		'allowed_types' => '*',
			// 		'overwrite'     => 1,  
			// 		'max_size'      => 0
			// 	);
			// 	$this->load->library('upload', $config);				
			// 	$images = array();
			// 	foreach ($_FILES["pkg_image"]["name"] as $key => $image_list) {
			// 		$_FILES['images[]']['name']		= $_FILES["pkg_image"]["name"][$key];
			// 		$_FILES['images[]']['type']		= $_FILES["pkg_image"]["type"][$key];
			// 		$_FILES['images[]']['tmp_name']	= $_FILES["pkg_image"]["tmp_name"][$key];
			// 		$_FILES['images[]']['error']	= $_FILES["pkg_image"]['error'][$key];
			// 		$_FILES['images[]']['size']		= $_FILES["pkg_image"]['size'][$key];
			// 		$this->upload->initialize($config);

			// 		if ($this->upload->do_upload('images[]')) {
			// 			$imageDetailArray 		= $this->upload->data();
			// 			$imgArry[]				= $imageDetailArray['file_name'];
						
			// 		} else {
			// 			//echo "kjdfh";exit;								
			// 			$error = $this->upload->display_errors();	
			// 			$this->session->set_flashdata('success_msg','');					
			// 			$this->session->set_flashdata('error_msg', $error);
			// 			redirect('admin/package/add');
			// 		}
			// 	}
			// 	//pr($imgArry);
			// 	if(!empty($imgArry)){
			// 		foreach($imgArry as $img){	
			// 			$instdata_pkg_media	= array('package_id'=>$package_id,'images'  => $img);
			// 			$this->mcommon->insert('package_images',$instdata_pkg_media);
			// 		}
					
			// 		$this->session->set_flashdata('error_msg','');
			// 		$this->session->set_flashdata('success_msg','Package image added successfully');				
					
			// 	}
			// }
			$log_data = array('action' 		=> 'Edit',
							  'statement' 	=> "Edited details of membership package named-'".$this->input->post( 'package_name' )."'",
							  'action_by'	=> $this->session->userdata('user_data'),
							  'IP'			=> getClientIP(),
							  'id'          => $package_id,
					  	  	  'type'        =>"Package",
							  'status'		=> '1'
							);
			//$this->mcommon->insert('log',$log_data);
    		$this->session->set_flashdata('success_msg','Package updated successfully');
    		redirect('admin/package');
    	}
		$this->session->set_flashdata('error_msg','Opp! Sorry try again');
		redirect('admin/package/edit/'.$package_id);
	}
	/*
		AUTHOR NAME: Sreela Biswas Kundu
		Date: 28/8/19
		purpose: ADD NEW member  
	*/
	public function add(){
		$data 					= array();
		$data['package_type']		= $this->mcommon->getDetails('package_type',array());
		//$data['package_vouchers']	= $this->mcommon->getDetails('package_vouchers',array('status'=>'1'));
		$data['package_benefits']	= $this->mcommon->getDetails('package_benefits',array('status'=>'1','is_delete'=>0));
		//pr($data);
		$data['content'] 	= 'admin/package/add';
		$this->admin_load_view($data);
	}
	public function addMember(){
		//pr($_FILES);
		//pr($_POST);
		$data =  array();
		$data =  array();

		$this->form_validation->set_rules('package_name', 'package name', 'trim|required|is_unique[master_package.package_name]',array('is_unique'=>'This %s already exists.'));
		$this->form_validation->set_rules('package_description','package Description');
		$this->form_validation->set_rules('package_title','package Title');
		$this->form_validation->set_rules('benefit_id[]','benefit','required');
		//$this->form_validation->set_rules('voucher_id[]','voucher','required');
		if($this->form_validation->run()==FALSE){
			//echo "fgjdf";exit;
			$data['content'] 	= 'admin/package/add';
			$data['package_type']		= $this->mcommon->getDetails('package_type',array());
			//$data['package_vouchers']	= $this->mcommon->getDetails('package_vouchers',array('status'=>'1'));
			$data['package_benefits']	= $this->mcommon->getDetails('package_benefits',array('status'=>'1'));
			$this->admin_load_view($data);
		
		}
		else{
			$pckage_data			= $this->input->post();
			if($this->input->post( 'status') ==''){
	    		$status ='0';
	    	}
	    	else{
	    		$status ='1';
	    	}			
        	$data = array(
			'package_name' 			=> $this->input->post( 'package_name' ),
			'package_title' 		=> $this->input->post( 'package_title' ),
			'package_description' 	=> $this->input->post( 'package_description' ),
			'package_terms' 	=> $this->input->post( 'package_terms' ),
			'package_type_id' 	=> $this->input->post( 'package_type_id' ),
			'package_price' 	=> $this->input->post( 'package_price' ),
			'discount_percent' 	=> $this->input->post( 'discount_percent' ),
			'status' 				=> $status,			
			'created_on' 			=> date('Y-m-d H:i:s'),				
			);
			$package_id = $this->mcommon->insert('master_package',$data);
			if(!empty($package_id)){
				for($i=0; $i<count($pckage_data['benefit_id']); $i++){
					$batch_benefits_inst[] = array( 'package_id'          => $package_id,
					                        		'package_benefit_id'  => $pckage_data['benefit_id'][$i],
					                        
				    );
		    	}
		    	$benefits_inst	= $this->db->insert_batch('package_benefits_mapping', $batch_benefits_inst);

		  //   	for($v=0; $v<count($pckage_data['voucher_id']); $v++){
				// 	$batch_voucher_inst[] = array( 'package_id'     	=> $package_id,
				// 	                        	   'package_voucher_id' => $pckage_data['voucher_id'][$v],
					                        
				//     );
		  //   	}
		  //   	$voucher_inst	= $this->db->insert_batch('package_vouchers_mapping', $batch_voucher_inst);

		  //   	for($t=0; $t<count($pckage_data['package_type']); $t++){
				// 	$batch_package_type_inst[] = array( 'package_id'      => $package_id,
				// 	                        	   		'package_type_id' => $pckage_data['package_type'][$t],
				// 	                        	   		'price'  		  => $pckage_data['package_type_price'][$t],
				// 	                        	   		'number'  		  => $pckage_data['package_type_number'][$t],
					                        
				//     );
		  //   	}
		  //   	$package_type	= $this->db->insert_batch('package_price_mapping', $batch_package_type_inst);

		  //   	if(!empty($_FILES["pkg_image"]["name"][0])){
		  //   		$imageDetailArray 		= array();
				// 	//echo  "58947";exit;
				// 	$config = array(
				// 		'upload_path'   => './public/upload_image/package_image/',
				// 		'allowed_types' => '*',
				// 		'overwrite'     => 1,  
				// 		'max_size'      => 0
				// 	);
				// 	$this->load->library('upload', $config);				
				// 	$images = array();
				// 	foreach ($_FILES["pkg_image"]["name"] as $key => $image_list) {
				// 		$_FILES['images[]']['name']		= $_FILES["pkg_image"]["name"][$key];
				// 		$_FILES['images[]']['type']		= $_FILES["pkg_image"]["type"][$key];
				// 		$_FILES['images[]']['tmp_name']	= $_FILES["pkg_image"]["tmp_name"][$key];
				// 		$_FILES['images[]']['error']	= $_FILES["pkg_image"]['error'][$key];
				// 		$_FILES['images[]']['size']		= $_FILES["pkg_image"]['size'][$key];
				// 		$this->upload->initialize($config);

				// 		if ($this->upload->do_upload('images[]')) {
				// 			$imageDetailArray 		= $this->upload->data();
				// 			$imgArry[]				= $imageDetailArray['file_name'];
							
				// 		} else {
				// 			//echo "kjdfh";exit;								
				// 			$error = $this->upload->display_errors();	
				// 			$this->session->set_flashdata('success_msg','');					
				// 			$this->session->set_flashdata('error_msg', $error);
				// 			redirect('admin/package/add');
				// 		}
				// 	}
				// 	//pr($imgArry);
				// 	if(!empty($imgArry)){
				// 		foreach($imgArry as $img){	
				// 			$instdata_pkg_media	= array('package_id'=>$package_id,'images'  => $img);
				// 			$this->mcommon->insert('package_images',$instdata_pkg_media);
				// 		}						
				// 		$this->session->set_flashdata('error_msg','');
				// 		$this->session->set_flashdata('success_msg','Package image added successfully');				
						
				// 	}
				// }
			}
        	if($package_id)
        	{
        		$log_data = array('action' 		=> 'Add',
								  'statement' 	=> "Added new membership package named -'".$this->input->post( 'package_name' )."'",
								  'action_by'	=> $this->session->userdata('user_data'),
								  'IP'			=> getClientIP(),
								  'id'          => $package_id,
					  	  	  	  'type'        =>"Package",
								  'status'		=> '1'
								);
				//$this->mcommon->insert('log',$log_data);
        		$this->session->set_flashdata('error_msg','');
        		$this->session->set_flashdata('success_msg','New package added successfully');
        		redirect('admin/package');
        	}
	        else{
	        	$this->session->set_flashdata('success_msg','');
	        	$this->session->set_flashdata('error_msg','Opp! Some problem,Try again.');
        		redirect('admin/package/add');
	        }	
    	}
	}
	public function ajaxAddmorePackageType(){
		$dataarr 				= array();
		$data 					= array();
		$data['package_type']	= $this->mcommon->getDetails('package_type',array());		
		$dataarr['html'] 		= $this->load->view('admin/package/ajax_price_type', $data, true);

		echo json_encode($dataarr);exit;
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
	public function DeletePackage($package_id){
		$response				= array();
		$return_response		= '';		
		$tbl_column_name		= 'package_id';
		$chng_status_colm		= 'is_delete';
		$status     	 		= '1';
		$table 					= 'master_package';
		$return_response		= getStatusCahnge($package_id,$table,$tbl_column_name,$chng_status_colm,$status);//function definein commonhelper
		if($return_response){
			$package_data 		= $this->mcommon->getRow('master_package', array('package_id' => $package_id));
			if(!empty($package_data)){
				$package_name   = $package_data['package_name'];
			}
			$log_data = array('action' 		=> 'Delete',
							  'statement' 	=> "Deleted '".$package_name."' membership package",
							  'action_by'	=> $this->session->userdata('user_data'),
							  'IP'			=> getClientIP(),
							  'id'          => $package_id,
					  	  	  'type'        =>"Package",
							  'status'		=> '1'
							);
			$this->mcommon->insert('log',$log_data);
			$this->session->set_flashdata('error_msg','');
			$this->session->set_flashdata('success_msg','package successfully deleted');
		}
		else{
			$this->session->set_flashdata('success_msg','');
			$this->session->set_flashdata('error_msg','Opp! Some problem,Try again.');
		}				
		redirect('admin/package');
	}
	public function changeStatus()
	{
		//pr($_POST);
		$response				= array();
		$return_response		= '';
		$id						= $this->input->post('id');
		$tbl_column_name		= 'package_id';
		$status     	 		= $this->input->post('change_status');
		$chng_status_colm		= 'status';
		$table 					= 'master_package';
		$return_response		= getStatusCahnge($id,$table,$tbl_column_name,$chng_status_colm,$status);//function definein commonhelper
		if($return_response){
			$package_data 		= $this->mcommon->getRow('master_package', array('package_id' => $id));
			if(!empty($package_data)){
				$package_name   = $package_data['package_name'];
			}
			if($status == '0'){
				$changed_status 	= 'inactive';
			}
			else{
				$changed_status 	= 'active';
			}
			$log_data = array('action' 		=> 'Edit',
							  'statement' 	=> "Made '".$package_name."' package ".$changed_status,
							  'action_by'	=> $this->session->userdata('user_data'),
							  'IP'			=> getClientIP(),
							  'id'          => $id,
					  	  	  'type'        =>"Package",
							  'status'		=> '1'
							);
			$this->mcommon->insert('log',$log_data);
			echo 1;exit;
		}				
		else{
			echo 0 ;exit;
		}
	}
	public function DeleteImage() {
		$image_id		= $this->input->post('package_img_id');
		$package_id 	= '';
		$package_data  	= $this->mcommon->getRow('package_images',array('package_img_id' =>$image_id));
		if(!empty($package_data)){
			$package_id = $package_data['package_id'];
		}
		$package_name  	= $this->Mpackage->getPackageDataByImgId($image_id);		
		$this->db-> where('package_img_id', $image_id);
   		$this->db-> delete('package_images');
   		$log_data 	= array('action' 		=> 'Delete',
							'statement' 	=> "Deleted image of the package named -'".$package_name."'",
							'action_by'		=> $this->session->userdata('user_data'),
							'IP'			=> getClientIP(),
							'id'          	=> $package_id,
					  	  	'type'        	=>"Package",
							'status'		=> '1'
						);
		$this->mcommon->insert('log',$log_data);
   		echo 1;exit;
	}
	public function PackageMemberList() { 
		//echo $this->session->userdata('email');die;
		$data 			= array();
		$data['content'] 	= 'admin/package/package_mem_list';
		$pck_cond 			= array('status' => '1','is_delete'=>'0');
		$pkg_list			= $this->mcommon->getDetails('master_package',$pck_cond);
		if(!empty($pkg_list)){
			$data['pkg_list']	= $pkg_list;
		}
		else{
			$data['pkg_list']	= '';
		}
		$data['premium_mem_list'] 	= $this->Mpackage->get_pck_member_list('2');
		$data['normal_mem_list'] 		= $this->Mpackage->get_pck_member_list('1');
		//pr($data);		
		
		$this->admin_load_view($data);		
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends MY_Controller {

	public function __construct() {
		parent::__construct();
		//$this->admin=$this->session->userdata('admin');
		//$this->load->library('imageupload');
		$this->load->library('imageupload');
		$this->load->model('admin/Madd');
		$this->load->model('admin/Mlist');
	}
	
	public function add_user(){
		$data 	=  array();
		$result =  array();
		
	    	if($this->input->post('add_sub')){
        	$data = array(			
			'name' 							    => $this->input->post( 'cafe_name' ),
			'address'							=> $this->input->post( 'address' ),	
            'desp'                              => $this->input->post( 'description' )		
			);
				
			if(!empty($_FILES['profile_image']['name'])){
            $image_path = 'public/photo_gallery/';
            $file     = $this->imageupload->image_upload2($image_path,'profile_image');
            if($file['status'] == 1){
               $img = $file['result'];
			   $this->Madd->add_user_image($img);
            }
            else{
              $img = '';
            } 
            }	
			$result = $this->Madd->add_user($data);		
            //$this->data['users'] = $this->Mlist->get_user_list();
		    //$this->load->view('admin/listing_admin', $this->data);			

        	if($result)
        	{
        		//$this->session->set_flashdata('success_msg','New sub administrator added successfully');
        		redirect('add-page');
        	}else{
				redirect('admin');
			}
			
			}
 	}
}
?>
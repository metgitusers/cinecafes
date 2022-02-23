<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct() {
		parent::__construct();
		//$this->admin=$this->session->userdata('admin');
		//$this->load->library('imageupload');
		$this->load->model('admin/Mlogin');
	}
	
	public function login_user(){
		//pr($_POST);
		$data 	=  array();
		$result =  array();
		
	    	if($this->input->post('save')){
        	$data = array(			
			'email' 							=> $this->input->post( 'email' ),
			'password'							=> md5($this->input->post( 'password' ))		
			);

        	$result = $this->Mlogin->submit_login_user($data);			
        	if($result)
        	{
        		//$this->session->set_flashdata('success_msg','New sub administrator added successfully');
        		redirect('index');

        	}else{
                $this->session->set_flashdata('item',1);
				redirect('admin');
				
			}
			}
 	}
}
?>
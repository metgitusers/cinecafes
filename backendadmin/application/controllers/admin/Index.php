<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('mcommon');
	
	}
	public function index()
	{
		if($this->session->userdata('admin') && !empty($this->session->userdata('admin'))){
			redirect('admin/dashboard', 'refresh');
		}else{
			$this->load->view('admin/login_admin');
		}
	}
	// Check for user login process
	public function admin_login() { 
		
			
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		//$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			echo "validation error";die;
			$this->index();
		} else {
	

			$email = $this->input->post('email', true);
			$password = md5($this->input->post('password', true));
			$role_id=1;
			$userdata = $this->mcommon->admin_login_check($email, $password,$role_id); 
			//print_r($userdata); 
			//echo $userdata['status'];die;
			//echo $userdata['is_delete'];die;
			if (empty($userdata)) {
				$this->session->set_flashdata('error_msg', 'Please check your email or password');
				$this->index();
			} else {
				if($userdata['status']==0)
				{
					//echo 1;
					$this->session->set_flashdata('error_msg', 'Your account is deactivated');
					$this->index();
				}
				else if($userdata['is_delete']==1)
				{
					//echo 2;
					$this->session->set_flashdata('error_msg', 'Your account is deleted');
					$this->index();
				}
				else
				{
					$this->session->set_userdata('admin', $userdata);
					redirect('admin/dashboard','refresh');
				}
				//$udata['login_status'] = 1;
				//$udata['date_of_lastlogin'] = date('Y-m-d H:i:s');
				//$condition = array('user_id'=>$userdata['user_id']);
				//$this->mcommon->update('user',$condition,$udata);	
				//die;
				
				
			}	

		}
		
	}
}


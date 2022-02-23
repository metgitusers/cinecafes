<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller {


	public function __construct() {		
		parent::__construct();

		//$this->redirect_guest_user();
		
		$this->load->model('mcommon');	
		
		/*if($this->session->userdata('user_id') == '')
		{
			redirect('commission/login');
			die();
		}*/
				
	}

	public function index()
	{
	   
	   	$data['title']='cinecafe2 | Home';
		$data['content']='front/pages/index';
		$this->front_load_view($data);
	}


}
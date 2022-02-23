<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Logout extends MY_Controller {



	public function __construct() {

		parent::__construct();

		//$this->load->model('admin/madmin');

	}



	public function index() {

		$this->admin=$this->session->userdata('admin');		

		//$udata['login_status'] = 0;		

		//$condition = array('user_id'=>$this->admin['user_id']);

		///$this->mcommon->update('user_master',$condition,$udata);

		$this->session->sess_destroy();

		redirect('admin/index','refresh');

	}

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listing extends MY_Controller {

	public function __construct() {
		parent::__construct();
		//$this->admin=$this->session->userdata('admin');
		//$this->load->library('imageupload');
		$this->load->model('admin/Mlist');
	}
	
	public function list_user(){
		$this->data['users'] = $this->Mlist->get_user_list();
		$this->load->view('listing', $this->data);
	}
}
?>
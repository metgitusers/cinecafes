<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cdelete extends MY_Controller {

	public function __construct() {
		parent::__construct();
		//$this->admin=$this->session->userdata('admin');
		//$this->load->library('imageupload');
		$this->load->model('admin/Mdel');
	}
	
	public function list_user_del($id){
		$res = $this->Mdel->del_user($id);
		if($res){
			redirect('list');
		}
	}
	
	public function list_user_upd($id){
		$res = $this->Mdel->list_user($id);
	}
}
?>
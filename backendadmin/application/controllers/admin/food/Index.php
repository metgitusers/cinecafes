<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->admin=$this->session->userdata('admin');
	}

    public function index()
    {
        //call basic index if required;
        die('Sorry!! Permission denied');
    }
    private function _load_view($data) {
		//$this->load->view('admin/layouts/index',$data);
		$this->admin_load_view($data);
	}	

    public function getAppAccess()
    {
        $result = array();
        $result['details']  =   $this->mcommon->select('food_access', ['id'=> 1], 'is_active');
		$result['content']='admin/food/app-access';
		$this->_load_view($result);
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
		AUTHOR NAME: Soma Nandi Dutta
		DATE: 21/8/20
	    PURPOSE: Subadmin listing ,add , delete,status change and update
*/
class RolePermission extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
	}
	public function index()
	{
		$data['title']='Role Wise Permission List';
		$data['content']='admin/rolePermission/list';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
}
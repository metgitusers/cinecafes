<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminPortal_Controller extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
        $this->load->model('admin/Mlist');
	}

	
	public function login()
	{
		$data['content']='admin/login_admin';
		$this->admin_login_load_view($data);
	}
	
	public function index()
	{
		$data['content']='admin/index_admin';
		$this->admin_load_view($data);
	}
	
	public function view()
	{
		$data['content']='admin/view_page_admin';
		$this->admin_load_view($data);
	}
	
	public function add_page()
	{
		$data['content']='admin/add_page_admin';
		$this->admin_load_view($data);
	}
	
	public function listing()
	{
		$data['content']='admin/listing_admin';
		$this->admin_load_view($data);

	}
	
	public function cafes_edit($id)
	{
		$data['id'] = $id;
		$data['content']='admin/add_page_admin';
		$this->admin_load_view($data);
	}
}
?>
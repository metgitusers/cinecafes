<?php
defined('BASEPATH') or exit('No direct script access allowed');
//require_once APPPATH.'third_party/dompdf/dompdf/autoload.inc.php';
		// Reference the Dompdf namespace 
//use Dompdf\Dompdf; 
class Commoncontroller extends MY_Controller
{
	protected $response = array();
	//private $ap = array();
	protected $data = array();
	private $logo = '';
    private $url = '';
	public function __construct()
	{
		parent::__construct();
		$this->obj = new stdClass();
		$this->logo = base_url('assets/frontend/img/logo_main.png');
        $this->url = base_url();
        $this->load->model('mcommon');
	}
	public function index()
	{
		redirect('/');
	}
	public function outputJson($response)
	{
		header('Content-Type: application/json');
		echo json_encode($response);
		exit;
	}

	public function changeStatus()
	{
		$id						= $this->input->post('id');
		$tbl_column_name		= $this->input->post('column_name');
		$status     	 		= $this->input->post('status');
		$chng_status_colm		= 'status';
		$table 					= $this->input->post('table');;
		$return_response		= getStatusCahnge($id,$table,$tbl_column_name,$chng_status_colm,$status);
		echo 1;
		exit;
	}

	public function changeStatusDelete()
	{
		$id						= $this->input->post('id');
		$tbl_column_name		= $this->input->post('column_name');
		$status     	 		= 1;
		$chng_status_colm		= 'is_delete';
		$table 					= $this->input->post('table');;
		$return_response		= getStatusCahnge($id,$table,$tbl_column_name,$chng_status_colm,$status);
		echo 1;
		exit;
	}
}
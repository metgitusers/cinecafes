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
	/**
	 * 	Migrate by split name into name & last_name
	*/
	public function migrateNameIntoLastname()
	{
		$data = $this->mcommon->select('user', ['name !='=> null, 'last_name'=> null], 'name, user_id');
		if($data){
			foreach($data as $value){
				$name_array = explode(" ", $value->name);
				if(!empty($name_array) && count($name_array) > 1){
					$c = count($name_array);
					$lname = $name_array[$c-1];
					unset($name_array[$c-1]);
					$insert = array(
						'last_name'=> ucwords($lname),
						'name'=> ucwords(implode(" ", $name_array))
					);
					$this->mcommon->update('user', ['user_id'=> $value->user_id], $insert);
				}
			}
		}
	}
}
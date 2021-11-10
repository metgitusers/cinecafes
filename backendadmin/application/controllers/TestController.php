<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestController extends MY_Controller {

	public function __construct() {
		parent::__construct();
		
	}
	
	public function index(){
		echo $_SERVER['HTTP_HOST'];
 	}
}
?>
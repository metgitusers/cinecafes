<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('mcommon');
		$this->load->model('admin/mcms');
		$this->load->library('imageupload');

	}
	public function index(){
		$data['list']=$this->mcms->getCmsList();
		$data['title']='Cms List';
		$data['content']='admin/cms/list';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	public function add()
	{
		$data['title']='Cms Add';
		$data['content']='admin/cms/add';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	public function edit($page_id)
	{
		$condition=array('page_id'=>$page_id);
		$data['row'] =$this->mcommon->getRow('cms',$condition);
		//echo $this->db->last_query();die;
		$data['title']='Cms Edit';
		$data['content']='admin/cms/edit';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	public function add_content(){
		//print_r($_POST);
		if($this->input->post()){
			
			$this->form_validation->set_rules('page_name','Page Name','required');
			$this->form_validation->set_rules('cms_description','Description','required');
			
			if($this->form_validation->run()==FALSE){
				$this->session->set_flashdata('error_message','Please fill up all mandatory field.');
				//$this->session->set_flashdata('error_message','Something went wrong.');
				$this->add();
			
			}else{
				//echo '<pre>'; print_r($this->input->post());die;
				
				$idata['page_name']=$this->input->post('page_name');				
				$idata['cms_slug'] = strtolower(url_title($this->input->post('page_name'), 'dash'));
				$idata['description']=$this->input->post('cms_description');
				//$idata['short_desc']=$this->input->post('short_description');
				$idata['date_of_creation']=date('Y-m-d H:i:s');
				$idata['status'] = 1;
				$page_id=$this->mcommon->insert('cms',$idata);
				$this->session->set_flashdata('success_message','Cms added successfully.');
			 	redirect('admin/cms');
				
					
			}

		}
		else{

			$this->add();
		}
			
	}

	public function update_content(){
		$page_id=$this->input->post('page_id');
		
		if($this->input->post()){
			
			//$this->form_validation->set_rules('page_name','Page Name','required');
			$this->form_validation->set_rules('cms_description','Description','required');
			
			if($this->form_validation->run()==FALSE){
				//$this->session->set_flashdata('error_message','Something went wrong.');
				$this->session->set_flashdata('error_message','Please fill up all mandatory field.');
				$this->edit($page_id);
			
			}else{
				
				//$udata['page_name']=$this->input->post('page_name');				
				//$udata['cms_slug'] = url_title($this->input->post('page_name'), 'underscore');
				$udata['description']=$this->input->post('cms_description');
				//$udata['date_of_update']=date('Y-m-d H:i:s');
				$condition=array('page_id'=>$page_id);
				$this->mcommon->update('cms',$condition,$udata);
				$this->session->set_flashdata('success_message','Cms Updated successfully.');
				redirect('admin/cms');
               }

			}
			else{

				$this->edit($page_id);
			}
			
		}

		

	
	
}
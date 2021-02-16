<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
		AUTHOR NAME: Soma Nandi Dutta
		DATE: 21/8/20
	    PURPOSE: Subadmin listing ,add , delete,status change and update
*/
class Subadmin extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('mcommon');
		$this->load->model('admin/msubadmin');
		$this->load->library('imageupload');
	}
	public function index()
	{
		$data['list']=$this->msubadmin->getsubadminList();
		$data['title']='Subadmin List';
		$data['content']='admin/subadmin/list';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	public function add()
	{
		$condition=array('role_id!='=>1,'status'=>1,'is_delete='=>0);
		$data['role_list'] =$this->mcommon->getDetails('master_role',$condition);
		//echo $this->db->last_query();die;
		$data['title']='Subadmin Add';
		$data['content']='admin/subadmin/add';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	public function edit($user_id)
	{
		$condition=array('role_id!='=>1,'status'=>1,'is_delete='=>0);
		$data['role_list'] =$this->mcommon->getDetails('master_role',$condition);
		//echo $this->db->last_query();die;
		$condition=array('user_id'=>$user_id);
		$data['row'] =$this->mcommon->getRow('user',$condition);
		//echo $this->db->last_query();die;
		$data['title']='Subadmin Edit';
		$data['content']='admin/subadmin/edit';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}

		
	public function add_content()
	{  
		//echo "<pre>"; print_r($this->input->post());die;
		
	    $this->form_validation->set_rules('name','Name','trim|required');
	    $this->form_validation->set_rules('role_id','Role','trim|required');
	    $this->form_validation->set_rules('email','email','trim|required|valid_email|callback_check_email',array('check_email'=>'This %s already exists.'));
	    //$this->form_validation->set_rules('email','Email','trim|required|is_unique[user.email]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]|max_length[12]');
	    $this->form_validation->set_rules('mobile','Mobile','required');
	    
	    if ($this->form_validation->run() == FALSE) {
		//echo "val error";die;
	    //echo "email exits";die;
		$this->session->set_flashdata('sub_error_message','Something went wrong.Please try again');
		$this->add();
		} else if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $this->input->post('email'))) {
                $this->session->set_flashdata('email_error_msg','Please enter a valid email id');   
                $this->add();
                }


		else{

			$idata = array(
		 		'name'   => $this->input->post('name'),
		        'role_id' => $this->input->post('role_id'),
		        'email' => $this->input->post('email'),
		        'mobile' => $this->input->post('mobile'),
		        'original_password' => $this->input->post('password'),
		        'password' => md5($this->input->post('password')),
		        'status' => 1,
		        'added_form' => 'Admin',
		        'created_by' =>$this->session->userdata('user_data'),
		        'created_date' => date('Y-m-d H:i:s'),
            );

		 	$movie_id=$this->mcommon->insert('user', $idata);
		 	$this->session->set_flashdata('sub_success_message','Subadmin added successfully.');
		 	redirect('admin/subadmin');
		 	
	   }
    }
    public  function check_email() {
       $email = $this->input->post('email');
       $user_id = $this->input->post('user_id');
      // $role_id = '1';
       $result = $this->mcommon->check_email_id_exist($email,$user_id);
       return $result;
    }
     public function update_content()
	{   
	    //echo "<pre>"; print_r($this->input->post());die;
	    $user_id=$this->input->post('user_id');  
		  
	    $this->form_validation->set_rules('name','Name','trim|required');
	    $this->form_validation->set_rules('role_id','Role','trim|required');
	    $this->form_validation->set_rules('email','email','trim|required|valid_email|callback_check_email',array('check_email'=>'This %s already exists.'));
	    //$this->form_validation->set_rules('email','Email','trim|required|is_unique[user.email]');
		$this->form_validation->set_rules('mobile','Mobile','trim|required');
	   
	
		if ($this->form_validation->run() == FALSE) {
		//echo "validation error";die;
		$this->session->set_flashdata('sub_error_message','Not updated.Something went wrong');
		//echo "valida error";die;
	    $this->edit($user_id);
		} else if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $this->input->post('email'))) {
                $this->session->set_flashdata('email_error_msg','Please enter a valid email id');   
                $this->edit($user_id);
                }
		else{
		 	$udata = array(
		 	    'name'   => $this->input->post('name'),
		        'role_id' => $this->input->post('role_id'),
		        'email' => $this->input->post('email'),
		        'mobile' => $this->input->post('mobile'),
		        'updated_by' =>$this->session->userdata('user_data'),
		        'updated_date' => date('Y-m-d H:i:s'),
            );
            
            $condition=array('user_id' => $user_id);
            $this->mcommon->update('user',$condition, $udata);
		 	//echo $this->db->last_query();die;
		 		
		 	$this->session->set_flashdata('sub_success_message','Subadmin Updated successfully.');
		 	redirect('admin/subadmin');
		 	
	   }
    }
   
	/*public function approval_status()
	{
		if ($_POST['key'] == "activeInactive"){
		$status = $_POST['status'];
	    $movie_id = $_POST['recordId'];
	    $condition=array('movie_id' => $movie_id);
			    		$udata=array(
						'status' => $status,
	                 	);
		$result = $this->mcommon->update('movie',$condition, $udata);
		//echo $this->db->last_query();die;
		if ($result){
	        echo "success";
	    }
    }
    }*/
   /* public function delete_img() 
	{
    	$movie_id= $this->input->post('movie_id');
		$condition=array('movie_id' =>$movie_id);
		$row=$this->mcommon->getRow('movie',$condition);
		$condition=array('movie_id'=>$movie_id);
		$udata['is_delete'] = 1;
		$this->mcommon->update('movie',$condition,$udata);
		$path="public/upload_images/movie_images/".$row['image'];
        unlink($path); 
	    //echo 1;exit;
	    echo 1;
	}*/
  
	
   
	
	


	

}
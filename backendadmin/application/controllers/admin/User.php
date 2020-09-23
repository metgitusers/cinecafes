<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
		AUTHOR NAME: Soma Nandi Dutta
		DATE: 24/08/20
	    PURPOSE: user change password,profile
*/
class User extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('mcommon');
		$this->load->model('admin/mcoupon');
		$this->load->library('imageupload');
	}
	public function index()
	{
	
	}
	
	
	public function change_password()
	{
		$data['title']='Change password';
		$data['content']='admin/change_password';
		$this->admin_load_view($data);
	}
	public function update_password()
	{

		$user_id=$this->session->userdata('admin')['user_id'];
		//echo $user_id;die;
          
       
     	if($this->input->post()){
            $this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|required|min_length[6]');
            $this->form_validation->set_rules('password', 'New Password', 'trim|required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
           
      		if($this->form_validation->run() == FALSE){
               $this->change_password();
          
      		}else{
	           
      			//$condition=array('user_id'=>$user_id,'role_id'=>1);	
      			$condition=array('user_id'=>$user_id);	
	            $data['user'] = $this->mcommon->getRow('user',$condition);
	
	            
	            if(md5($this->input->post('oldpassword')) == $data['user']['password']) {
	                    $condition=array('user_id'=>$user_id);	
				        $data=array(
				        	'original_password'=>$this->input->post('password'),
		                    'password'=>md5($this->input->post('password')),
		                    'updated_by' =>$user_id,
		                    'updated_date'=>date('Y-m-d H:i:s')
	                     );
	                $this->mcommon->update('user',$condition,$data);

	                $this->session->set_flashdata('success_message','Password has been changed successfully');
	                redirect('admin/change-password','refersh'); 
	              
	            }else{
	                $this->session->set_flashdata('error_message','Old password is not correct');
	                redirect('admin/change-password','refersh'); 
	            }
            } 

        }else{
           
        	 redirect('admin/change-password','refersh'); 
        }
    }
    public function profile()
	{
		//$condition=array('role_id!='=>1,'status'=>1,'is_delete='=>0);
		//$data['role_list'] =$this->mcommon->getDetails('master_role',$condition);
		$user_id=$this->session->userdata('admin')['user_id']; 
		//$condition=array('user_id'=>$user_id,'role_id'=>1);
		$condition1=array('user_id'=>$user_id);
		$data['row']=$this->mcommon->getRow('user',$condition1);
		$data['title']='Profile';
		$data['content']='admin/profile';
		$this->admin_load_view($data);
	}
	public  function check_email() {
       $email = $this->input->post('email');
      // $user_id = $this->input->post('user_id');
       $user_id=$this->session->userdata('admin')['user_id']; 
      // $role_id = '1';
       $result = $this->mcommon->check_email_id_exist($email,$user_id);
       return $result;
    }

   
    public function update_content()
	{   
	    //echo "<pre>"; print_r($this->input->post());die;
	    $user_id=$this->input->post('user_id'); 
	    //$role_id=$this->input->post('role_id');  
		  
	    $this->form_validation->set_rules('name','Name','trim|required');
	    //$this->form_validation->set_rules('role_id','Role','trim|required');
	    $this->form_validation->set_rules('email','email','trim|required|valid_email|callback_check_email',array('check_email'=>'This %s already exists.'));
	    //$this->form_validation->set_rules('email','Email','trim|required|is_unique[user.email]');
		$this->form_validation->set_rules('mobile','Mobile','trim|required');
	   
	
		if ($this->form_validation->run() == FALSE) {
		//echo "validation error";die;
		$this->session->set_flashdata('profile_error_message','Not updated.Something went wrong');
		//echo "valida error";die;
	    $this->profile();
		} else if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $this->input->post('email'))) {
                $this->session->set_flashdata('email_error_msg','Please enter a valid email id');   
                $this->profile();
                }
		else{
		 	$udata = array(
		 	    'name'   => $this->input->post('name'),
		        //'role_id' => $this->input->post('role_id'),
		        'email' => $this->input->post('email'),
		        'mobile' => $this->input->post('mobile'),
		        'updated_by' =>$this->session->userdata('admin')['user_id'], 
		        'updated_date' => date('Y-m-d H:i:s'),
            );
            
           // $condition=array('user_id' => $user_id,'role_id' => $role_id);
            $condition=array('user_id' => $user_id);
            $this->mcommon->update('user',$condition, $udata);
		 	//echo $this->db->last_query();die;
		 		
		 	$this->session->set_flashdata('profile_success_message','Profile Updated successfully.');
		 	redirect('admin/user/profile');
		 	
	   }
    }
   
	
  


	

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
		AUTHOR NAME: Soma Nandi Dutta
		DATE: 06/8/20
	    PURPOSE: Reservation listing and details
*/
class Reservation extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('mcommon');
		$this->load->model('admin/mreservation');
		$this->load->model('admin/Mmembership');
		$this->load->model('mapi');
		

		$this->load->library('imageupload');
	}
	public function index()
	{
		$start_date="";
		$end_date="";
		$cafe_id="";
		if(!empty($_POST['start_date'])){
       		$start_date= $this->input->post('start_date');
        }else{
        	//$start_date=" ";
        }
        if(!empty($_POST['end_date'])){
       		$end_date= $this->input->post('end_date');
        }else{
        	//$end_date=" ";
        }
        if(!empty($_POST['cafe_id'])){
       		$cafe_id= $this->input->post('cafe_id');
        }
        $data['start_date']= $start_date;
        $data['end_date']= $end_date;
        $data['cafe_id']= $cafe_id;
        //$data['list']=$this->mreservation->getreservationList();
		$data['list']=$this->mreservation->getreservationList($start_date,$end_date,$cafe_id);
		$condition=array('status'=>1,'is_delete='=>0);
		$data['cafe_list'] =$this->mcommon->getDetails('master_cafe',$condition);
		$data['title']='Reservation List';
		$data['content']='admin/reservation/list';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	
	public function detail($reservation_id)
	{
		$data['row'] =$this->mreservation->getreservationById($reservation_id);
		//echo "<pre>";print_r($data['row']);die;
		//echo $data['row']['movie_id'];die;
		$movie_id= $data['row']['movie_id'];
		$cafe_id=$data['row']['cafe_id'];
		//echo $data['row']['cafe_id'];die;
		//echo $movie_id;die;
		if($cafe_id!=0){
			$data['cafe_img']=$this->mreservation->getCafeImgById($cafe_id);
			//print_r( $data['cafe_img']);die;
	    }
		if($movie_id!=0){
			$data['movie_list']=$this->mreservation->getMovieById($movie_id);
	    }
	    
		$data['food_list']=$this->mreservation->getFoodById($reservation_id);
		$data['addon_list']=$this->mreservation->getAddonById($reservation_id);
	    
		$coupon_code= $data['row']['coupon_code'];
		//echo $coupon_code;die;
		if(!empty($coupon_code)){
		$data['coupon_list']=$this->mreservation->getCouponById($coupon_code);
	    }
		$data['title']='Reservation Details';
		$data['content']='admin/reservation/detail';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	
	public function approval_status()
	{
		if ($_POST['key'] == "activeInactive"){
		$status = $_POST['status'];
	    $reservation_id = $_POST['recordId'];
	    $condition=array('reservation_id' => $reservation_id);
			    		$udata=array(
						'reservation_status' => $status,
	                 	);
		$result = $this->mcommon->update('reservation',$condition, $udata);
		//echo $this->db->last_query();die;
		if ($result){
	        echo "success";
	    }
    }
    }
	

    ///add new reservation////////////////////////////////
    public function add(){
		$result 					= array();
		
		$result['cafe_list']		= $this->mcommon->getDetails('master_cafe',array('status' => '1','is_delete' => '0'));

		$result['media_list']		= $this->mcommon->getDetails('master_media',array('status' => '1','is_delete' => '0'));

		$result['member_list']		= $this->Mmembership->getMembershipDetails('1');
		
		$result['content'] 			= 'admin/reservation/add';
		//pr($result);
		$this->admin_load_view($result);
	}

	public function get_member_data()
	{
		$user_id=$this->input->post('user_id');
		$user_details	= $this->mcommon->getRow('user',array('user_id' => $user_id));
		$response=array();
		$response['email']=$user_details['email'];
		$response['name']=$user_details['name'];
		$response['mobile']=$user_details['mobile'];
		echo json_encode($response);
		die;
	}

	public function get_available_room()
	{
		$cafe_id=$this->input->post('cafe_id');
		$reservation_date=$this->input->post('reservation_date');
		$reservation_time=$this->input->post('reservation_time');
		$duration=$this->input->post('duration');
		$condition['cafe_id']=$cafe_id;
		$List=$this->mcommon->getDetails("room",$condition);
		$html="";
		///chk available room
		if(!empty($List)){
            ///checking available status
            for($i=0;$i<count($List);$i++){  
            // echo '<pre>';
            // print_r($List[$i]);
            // die;     
              $booked_status=0;
              $room_id=$List[$i]['room_id'];
              //////////////////////////wishlist & cart checking/////////////////////
              $availability_status=$this->is_available($reservation_date,$room_id,$reservation_time,$duration);
         
              if($availability_status==0){
                $html.="<option value='".$List[$i]['room_id']."'>".$List[$i]['room_no']."</option>";
              }
             
             }
            
            echo $html; die;
            
          }
	}
	
	  ///////////////////////////////if available///////////////////////////
	  public function is_available($reservation_date,$room_id,$reservation_time,$duration)
	  {
	    $availability_status=0;
	    

	    if($reservation_date!=''&&$room_id!=''&&$reservation_time!=''&&$duration!='')
	    {
	           $selectedTime             = $reservation_time;
	          $start_time_range         = date('H:i:s',strtotime($selectedTime));
	          $end_time_range           = date('H:i:s',strtotime("+".$duration." hours", strtotime($selectedTime)));

	         //         $start_time_range         = date('H:i:s',strtotime("-90 minutes", strtotime($selectedTime)));
	         //         $end_time_range           = date('H:i:s',strtotime("+90 minutes", strtotime($selectedTime)));

	          $availability_status        = $this->mapi->is_available($reservation_date,$room_id,$start_time_range,$end_time_range);
	          

	    }

	    return $availability_status;
	  }

	  ////////add reservation /////////////////////////////////////////////////
	  public function add_content()
	{  
		//echo "<pre>"; print_r($this->input->post());
	    $this->form_validation->set_rules('mobile','mobile','required');
	    $this->form_validation->set_rules('no_of_guests','no of guests','trim|required');
	    $this->form_validation->set_rules('reservation_date','reservation date','trim|required');
	    $this->form_validation->set_rules('reservation_time','reservation time','required');
	    $this->form_validation->set_rules('duration','duration','trim|required');
	    $this->form_validation->set_rules('cafe_id','Cafe','trim|required');
	    $this->form_validation->set_rules('room_id','Room','trim|required');
	  	$this->form_validation->set_rules('reservation_type','Type','trim|required');
	  	$this->form_validation->set_rules('media_type','Media Type','trim|required');
	  	$this->form_validation->set_rules('reservation_for','Reservation For','trim|required');
	
		if ($this->form_validation->run() == FALSE) {
		//echo "val error";die;
		$this->session->set_flashdata('error_message','Validation error');
		$this->add();
		} else {

			///availability chk
			$reservation_date=$this->input->post('reservation_date');
			$room_id=$this->input->post('room_id');
			$duration=$this->input->post('duration');
             $reservation_time=DATE('H:i:s',strtotime($this->input->post('reservation_time')));
             $end_time_range           = date('H:i:s',strtotime("+".$duration." hours", strtotime($reservation_time)));
			$availability_status=$this->is_available($reservation_date,$room_id,$reservation_time,$duration);
         
             if($availability_status!=0){
             	$this->session->set_flashdata('error_message','This time this room is not available');
				$this->add();
             }
             else
             {
             	if($this->input->post('user_id')>0)
             	{
             		$user_id=$this->input->post('user_id');
             	}
             	else
             	{
             		$user_id=0;
             	}

             	////////user details:
             	$name="";
             	$email="";
             	$mobile="";
             	$message="";
             	if($this->input->post('name')!="")
             	{
             		$name=$this->input->post('name');
             	}
             	if($this->input->post('email')!="")
             	{
             		$email=$this->input->post('email');
             	}
             	if($this->input->post('mobile')!="")
             	{
             		$mobile=$this->input->post('mobile');
             	}

             	if($this->input->post('message')!="")
             	{
             		$message=$this->input->post('message');
             	}

             	$condition_default_price['id']=1;
				$defult_price_row=$this->mcommon->getRow("price_settings",$condition_default_price);
				$defult_price=$defult_price_row['cafe_price'];
             	
             	
             	$total_price=$defult_price*$duration;

                  //////////////////////////
             	$admin=$this->session->userdata('admin');
                    $insrtarry    = array('reservation_date'    => $this->input->post('reservation_date'),
                                          'reservation_time'    => $reservation_time,
                                          'reservation_end_time' =>$end_time_range,
                                          'duration'=>$this->input->post('duration'),
                                          'cafe_id'             => $this->input->post('cafe_id'),
                                          'no_of_guests'        => $this->input->post('no_of_guests'),
                                          'total_price'          => $total_price,
                                          'room_id'     =>       $this->input->post('room_id'),
                                          'user_id'           => $user_id,
                                          'name'          => $name,
                                          'email'               => $email,
                                          'country_code'        =>"91",
                                          'mobile'       => $mobile,
                                         // 'movie_id'     =>$movie_id,
                                          'add_from'            => 'admin',
                                          'message'             => $message,
                                          
                                          'media_type'             => $this->input->post('media_type'),
                                          'status'              => '1',
                                          'reservation_type'    => $this->input->post('reservation_type'),
                                          'created_by'          => $admin['user_id'],
                                          'created_on'          => date('Y-m-d')
                                        );
                    $reservation_id     = $this->mapi->insert('reservation',$insrtarry);

                    /** added by ishani on 18.09.2020 */
                    //fn defined in common helper
                    $user_data['name']=$name;
                    $user_data['email']=$email;
                    $user_data['mobile']=$mobile;
                    insert_all_user($user_data);

                    /*****************/
		 			 /********************************** Send reservation details in sms *************************************************/
		 			 $condition_cafe['cafe_id']=$this->input->post('cafe_id');
                      $cafe_row=$this->mapi->getRow("master_cafe",$condition_cafe);
		 			 	 $reservation_date=$this->input->post('reservation_date');
                          $message  = "Thank you for confirming your Reservation at ".ORGANIZATION_NAME.". Your reservation details are: \n";
                          $message .= "Cafe: ".$cafe_row['cafe_name']."-".$cafe_row['cafe_place']."\n Date: ".$reservation_date."\n Time: ".$reservation_time."\n No. of Guests: ".$this->input->post('no_of_guests');
                          $message .= " We would be holding your reservation for 15 minutes from the time of reservation and it will be released without any prior information.";
                          smsSend($mobile,$message);
                     /******************************************************************/
		 			$this->session->set_flashdata('success_message','Booking confirmed.');
             }
			
			
		 	redirect('admin/reservation');
		 	
	   }
    }
    
     ////////add reservation /////////////////////////////////////////////////
	  public function test_mail()
	{ 
	    $data=array();
	    $data['to']="05duttaisha@gmail.com";
	   $data['subject']="test mail";
	   $data['message']="test msg";
	   sendmail($data);
	}
}
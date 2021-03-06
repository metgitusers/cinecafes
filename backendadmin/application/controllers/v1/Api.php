<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Api extends CI_Controller
{
  var $arr;
  var $obj;
  var $request_day = '';
  var $request_time = '';
  function __construct()
  {
    parent::__construct();
    $this->load->library('PushNotification');
    $this->load->library('imageupload');
    $this->load->model('mapi');
    $this->arr = array();
    $this->obj = new stdClass();
    $this->request_day = strtolower(date("l"));
    $this->request_time = date("h:i A");
    $this->http_methods = array('POST', 'GET', 'PUT', 'DELETE');
    $this->logo = base_url() . 'public/images/logo_new.jpg';
    //$this->load->library('notification');
  }

  private function displayOutput($response)
  {
    header('Content-Type: application/json');
    echo json_encode($response);
    exit(0);
  }

  private function checkHttpMethods($http_method_type){
    if ($_SERVER['REQUEST_METHOD'] == $http_method_type) {
      return 1;
    }
  }
 /////availability checking api
   public function availablility_chk()
  {
    $result  = array();
    $ap=json_decode(file_get_contents('php://input'), true);
    //print_r($ap); die;
    if($this->checkHttpMethods($this->http_methods[0])){
      if(sizeof($ap)) {
        if (empty($ap['no_of_guests'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'No. of guests is required';
          //$response['response']   = $this->obj;          
          $this->displayOutput($response);
        }        
        if (empty($ap['reservation_date'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Reservation date is required';
          //$response['response']   = $this->obj;          
          $this->displayOutput($response);
        }
        if (empty($ap['reservation_time'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Reservation time  is required';
          //$response['response']   = $this->obj;          
          $this->displayOutput($response);
        }       
        
        if (empty($ap['duration'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'duration is required';
          //$response['response']   = $this->obj;          
          $this->displayOutput($response);
        } 
        if (empty($ap['cafe_id'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Cafe id is required';
          //$response['response']   = $this->obj;          
          $this->displayOutput($response);
        }

        if(!empty($ap['reservation_date'])) {
          $date=$ap['reservation_date'];
          $format="d/m/Y";
          //chk if its past date then reject request
          $curDateTime = date("Y-m-d H:i");
          //$reservation_date_time = date("Y-m-d H:i:s", strtotime($reservation_date." ".$ap['reservation_time']));
          $reservation_date = date("Y-m-d", strtotime(str_replace('/', '-', $date)));
          $reservation_date_time = $reservation_date." ".date('H:i', strtotime($ap['reservation_time']));
          //echo $curDateTime.'>='.$reservation_date_time; die;
          if($curDateTime>=$reservation_date_time)
            {
              $response['status']['error_code'] = 1;
              $response['status']['message']    = 'Please select some date time in future';
              $this->displayOutput($response);
            }
        }

        //$room_id=$ap['room_id'];
        $cafe_id=$ap['cafe_id'];
        //get cafe details for cafe charge
        $cafeDetails = $this->mcommon->select('master_cafe', ['cafe_id'=> $cafe_id, 'status'=>1, 'is_delete'=> 0], '*');
        if(empty($cafeDetails)){
          $response['status']['error_code']           = 1;
          $response['status']['message']              = 'OOPs! Sorry the room is not available for the given date & time';
        }

        $reservation_time=date('H:i',strtotime($ap["reservation_time"]));
        $duration=explode(' hr', strtolower($ap['duration']))[0];
        $selectedTime             = $reservation_time;
        $start_time_range         = date('H:i',strtotime($selectedTime));
        $end_time_range           = date('H:i',strtotime("+".$duration." hours", strtotime($selectedTime)));

        //$availability_status=$this->isAvailable($reservation_date, $cafe_id, $reservation_time, $duration);
        //$availability_status=$this->is_available($reservation_date,$room_id,$reservation_time,$duration);
        //total reserved room for a cafe
        //$reservation_condition    = "reservation_date= '".$reservation_date."' and cafe_id = '".$cafe_id."' and ((reservation_time between '".$start_time_range."' and '".$end_time_range."') or (reservation_end_time between '".$start_time_range."' and '".$end_time_range."')) and status!=2";
        $reservation_condition    = "reservation_date= '".$reservation_date."' and cafe_id = '".$cafe_id."' and (('".$start_time_range."' between `reservation_time` AND `reservation_end_time`) OR ('".$end_time_range."' between `reservation_time` AND `reservation_end_time`)) and status!=2";
        $this->db->where($reservation_condition); 
        $total_reservation= count($q = $this->db->get("reservation")->result());
        $reserved_room_ids = array_column($q, 'room_id');

        //get all unreserved rooms for admin booking only
        if(!empty($reserved_room_ids)){
          $this->db->where_not_in('room_id', $reserved_room_ids);
        }        
        $this->db->where('cafe_id', $cafe_id);
        $this->db->where('status', 1);
        $room_list = $this->db->get('room')->result();

        //echo $this->db->last_query();
        if($total_reservation > 0){
          //total rooms for a cafe
          //get all rooms based on cafe id
          $roomsList = count($this->mcommon->select('room', ['cafe_id'=> $cafe_id, 'is_delete'=> 0], '*', 'room_id'));
          if($roomsList <= $total_reservation ){
            $response['status']['error_code']           = 1;
            $response['status']['message']              = 'OOPs! Sorry the room is already reserved for the given date & time';
            $this->displayOutput($response);
          }else{
            //calculate total price            
            $calculatedPrice = $ap['no_of_guests'] * $duration * $cafeDetails[0]->price;
            $response['status']['error_code']   = 0;
            $response['status']['message']      = 'Room is available for date time';
            $response['result']['data']         = array(
                                                      'no_of_guests'=> $ap['no_of_guests'],
                                                      'duration'=> $duration.' Hr.',
                                                      'amount'=> $calculatedPrice,
                                                    );
            $response['result']['rooms']= $room_list;
          }
        }
        else
        {
          //calculate total price
            $calculatedPrice = $ap['no_of_guests'] * $duration * $cafeDetails[0]->price;
            $response['status']['error_code']   = 0;
            $response['status']['message']      = 'Room is available for date time';
            $response['result']['data']         = array(
                                                      'no_of_guests'=> $ap['no_of_guests'],
                                                      'duration'=> $duration.' Hr.',
                                                      'amount'=> $calculatedPrice,
                                                    );
            $response['result']['rooms']= $room_list;
          $this->displayOutput($response);
        }
      }
      else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Please fill up all required fields.';
      }
    } else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Wrong http method type.';
        //$response['response']   = $this->obj;      
    }
    $this->displayOutput($response);
  }
    ///////////////////////////////if available///////////////////////////
  private function isAvailable($reservation_date = '', $cafe_id = '', $reservation_time ='', $duration ='')
  {
    $availability_status=[];
    if($reservation_date!='' && $cafe_id!='' && $reservation_time!='' && $duration!='')
    {
      //get details of cafe
      //get all rooms based on cafe id
      $roomsList = $this->mcommon->select('room', ['cafe_id'=> $cafe_id, 'is_delete'=> 0], '*', 'room_id');
      if($roomsList){
        $selectedTime             = $reservation_time;
        $start_time_range         = date('H:i:s',strtotime($selectedTime));
        $end_time_range           = date('H:i:s',strtotime("+".$duration." hours", strtotime($selectedTime)));
        //total rooms
        $total_rooms = count($roomsList);

        //total reservation based on cafe
        $reservation_condition    = "reservation_date= '".$reservation_date."' and cafe_id = '".$cafe_id."' and ((reservation_time between '".$start_time_range."' and '".$end_time_range."') or (reservation_end_time between '".$start_time_range."' and '".$end_time_range."')) and status!=2";
        $this->db->where($reservation_condition);    
        $query=$this->db->get("reservation");
        //echo $this->db->last_query(); die();
        $total_reservation = $query->num_rows();


        foreach($roomsList as $value){
          $availability_status = $this->mapi->is_available($reservation_date, $value->room_id, $start_time_range, $end_time_range);
          
          if($availability_status == 1){
            return 1;
          }
        }
      }
      //echo $this->db->last_query(); die;
    }

    return $availability_status;
  }


 /////////////////////////version control/////////////////////////////
  /*
    Version update
  */
  //////////////////update version////////////////////////
	public function versionUpdate()
	{
	  $result  = array();
	  $ap      = json_decode(file_get_contents('php://input'), true);
	  $version_ios="";
	  $version_android="";
	  $version_data   = array();
	  if ($this->checkHttpMethods($this->http_methods[0])) {    
	    if (sizeof($ap)) {
	      if(!empty($ap['version_ios'])) {
          		$version_ios = $ap['version_ios'];
          		$version_data['version_ios']=$version_ios;
          		if(isset($ap['is_mandatory']) && !empty($ap['is_mandatory'])) {
                $version_data['is_mandatory_ios'] = $ap['is_mandatory'];
            }	
        	}
        	if(!empty($ap['version_android'])) {
          		$version_android = $ap['version_android'];
          		$version_data['version_app']=$version_android;
              if(isset($ap['is_mandatory']) && !empty($ap['is_mandatory'])) {
                $version_data['is_mandatory'] = $ap['is_mandatory'];
            }	
        	}	    
        	    
          $update_version_where    = array('id' => '1');
          $this->mcommon->update('version_control',$update_version_where,$version_data);
            
          $response['status']['error_code']         = 0;
          $response['status']['message']            = 'Version successfully updated.';
	    }
	    else {
	      $response['status']['error_code'] = 1;
	      $response['status']['message']    = 'Please fill up all required fields.';
	    }
	  } else {
	      $response['status']['error_code'] = 1;
	      $response['status']['message']    = 'Wrong http method type.';
	      //$response['response']   = $this->obj;      
	  }
	  $this->displayOutput($response);
	}
  public function version_control()
  {
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
        if (empty($ap['version'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Version is required.';
         
          $this->displayOutput($response);
        }
        
        $check_version_condition = array('id' => 1);
        $versiondetails          = $this->mapi->getRow('version_control', $check_version_condition);
        $updateResponseArr=array();
        if($versiondetails['version_app']<=$ap['version'])
        {
          $response['status']['error_code'] = 0;
            $response['status']['message']    = '';
            $updateResponseArr['updateRequired']='no';
            $updateResponseArr['severity']='';
            $updateResponseArr['dialog_message']='';
        }
        else
        {
          $response['status']['error_code'] = 0;
            $response['status']['message']    = '';
            $updateResponseArr['updateRequired']="Yes";
            if($versiondetails['is_mandatory']==1)
          {
            $updateResponseArr['severity']="critical";
              $updateResponseArr['dialog_message']=$versiondetails['msg_mandatory'];
          }
          else
          {
            $updateResponseArr['severity']="nonCritical";
              $updateResponseArr['dialog_message']=$versiondetails['msg_not_mandatory'];
          }
        }
     
         $response['response']['updateResponse']    = $updateResponseArr;
         $this->displayOutput($response);
             
      }
      else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Please fill up all required fields';        
      }
    }
    else{
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Wrong http method type.';        
    }
    $this->displayOutput($response);
  }
  /////////////////////////version control IOS/////////////////////////////
  
  public function version_control_ios()
  {
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
        if (empty($ap['version'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Version is required.';
         
          $this->displayOutput($response);
        }
        
        $check_version_condition = array('id' => 1);
        $versiondetails          = $this->mapi->getRow('version_control', $check_version_condition);
        $updateResponseArr=array();
         // 1.0 >= 1.2
        if($versiondetails['version_ios'] > $ap['version'])
        {
          $response['status']['error_code'] = 0;
            $response['status']['message']    = '';
            $updateResponseArr['updateRequired']='no';
            $updateResponseArr['severity']='';
            $updateResponseArr['dialog_message']='';
        }
        else
        {
          $response['status']['error_code'] = 0;
            $response['status']['message']    = '';
            $updateResponseArr['updateRequired']="Yes";
            if($versiondetails['is_mandatory_ios']==1)
            {
              $updateResponseArr['severity']="critical";
              $updateResponseArr['dialog_message']=$versiondetails['msg_mandatory'];
            }
            else
            {
              $updateResponseArr['severity']="nonCritical";
              $updateResponseArr['dialog_message']=$versiondetails['msg_not_mandatory'];
            }
        }
     
         $response['response']['updateResponse']    = $updateResponseArr;
         $this->displayOutput($response);
             
      }
      else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Please fill up all required fields';        
      }
    }
    else{
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Wrong http method type.';        
    }
    $this->displayOutput($response);
  }
  
  public function add_notification($user_id,$notification_title,$notification_des,$reservation_id=null)
	{
	  if($reservation_id==null)
	  {
		$reservation_id=0;
	  }
	  $notification_arr = array(      'user_id' => $user_id,
									  'notification_title'        => $notification_title,
									  'notification_description'  => $notification_des,
									  'reservation_id'  => $reservation_id,
									  'status'                    => '1',
									  'created_on'                => date('Y-m-d H:i:s')
									  );
	  $insert_data      = $this->mcommon->insert('notification', $notification_arr);
	}
 
}
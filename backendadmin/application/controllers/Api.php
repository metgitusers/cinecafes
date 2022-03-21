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
    $this->load->model('common_model');
    $this->arr = array();
    $this->obj = new stdClass();
    $this->request_day = strtolower(date("l"));
    $this->request_time = date("h:i A");
    $this->http_methods = array('POST', 'GET', 'PUT', 'DELETE');
    $this->logo = base_url() . 'public/img/website-logo.png';
    //$this->load->library('notification');
  }

  private function displayOutput($response)
  {
    header('Content-Type: application/json');
    echo json_encode($response);
    exit(0);
  }

  private function checkHttpMethods($http_method_type){
    /**
     * Commented on 24-09-21 as per instructions to pass all http request
    */
    if ($_SERVER['REQUEST_METHOD'] == $http_method_type) {
      return 1;
    }

    //return 1;
  } 
  public function test()
  {
    $response['status']['error_code'] = 0;
    $response['status']['methods']    = $this->http_methods[0];

          $this->displayOutput($response);
  }

  //////////////////added for cinecafe///////////////////////////////////
  //registration only
  public function signup()
  {
    //pr($_POST); 
    $ap=$_POST;
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if(sizeof($ap)){
        /*
          Sign up using apple id
        */
        if(isset($ap['apple_id']) && !empty($ap['apple_id'])){
          $memberDetails= $this->mapi->getMemberDetailsRow(array('user.apple_id' => $ap['apple_id']));
          // echo $this->db->last_query();
          //print_r($memberDetails);
          if(!empty($memberDetails)){
            //$memberProfileDetails= $this->mapi->getMemberDetailsRow(['user.email' => $ap['email'], 'user.mobile'=> $ap['email']]);
            $profile_status = 0;
            if(!empty($memberDetails[0]['email'])){
              $profile_status = 1;
            }
            $user_id      = $memberDetails[0]['user_id'];
          }else{
            //echo 'else';
            $profile_status = 0;
            $insert_array = array(
                                  'apple_id'=> $ap['apple_id'],
                                  'status'                => '1',
                                  'added_form'            => 'App',
                                  'created_date'            => date('Y-m-d H:i:s')
                                );
            $user_id      = $this->mapi->insert('user', $insert_array);
            //update user_profile
            $profile_arr=array();
            $profile_arr['user_id']           = $user_id;         
            $profile_arr['created_by']       = $user_id;
            $profile_arr['created_date']       = date('Y-m-d H:i:s');
            
            $this->mcommon->insert('user_profile',$profile_arr);
            
            $memberDetails= $this->mapi->getMemberDetailsRow(array('user.user_id' => $user_id));
            // echo $this->db->last_query();
            // print_r($memberDetails);
          }
          //echo '$user_id'.$user_id; die;
          //create auth token for login user
          $condition      = array('user_id' =>$user_id);
            $update_arr     = array('login_status' =>'1');
            $update_result  = $this->mapi->update('user',$condition,$update_arr);
            if($update_result){
                $api_token_details                = $this->mapi->getRow('api_token', $condition);
                $device_token_details             = $this->mapi->getRow('device_token', $condition);
                //echo $api_token_details."%%%".$device_token_details;exit;
                if (empty($api_token_details) && empty($device_token_details)) {
                  $device_token_data['user_id']          = $user_id;
                  $device_token_data['device_type']        = $ap['device_type'];
                  $device_token_data['device_token']       = '';
                  $device_token_data['fcm_token']          = $ap['device_token'];
                  $device_token_data['login_status']       = '1';
                  $device_token_data['date_of_creation']   = date('Y-m-d H:i:s');
                  $device_token_data['session_start_time'] = date('Y-m-d H:i:s');
                  $device_token_data['session_end_time']   = '';

                  $insert_data          = $this->mapi->insert('device_token', $device_token_data);

                  $api_token_data['user_id']          = $user_id;
                  $api_token_data['device_type']        = $ap['device_type'];
                  $api_token_data['access_token']       = md5(mt_rand() . '_' . $user_id);
                  $api_token_data['date_of_creation']   = date('Y-m-d H:i:s');
                  $api_token_data['session_start_time'] = date('Y-m-d H:i:s');
                  $api_token_data['session_end_time']   = '';
                  $insert_data      = $this->mapi->insert('api_token', $api_token_data);
                } else {
                  $condition_token                    = array('user_id' =>$user_id);

                  $api_token_updata['device_type']    = $ap['device_type'];
                  $api_token_updata['access_token']   = $api_token_details['access_token'];
                  $update_data  = $this->mapi->update('api_token', $condition_token, $api_token_updata);

                  $device_token_updata['device_type']     = $ap['device_type'];
                  $device_token_updata['fcm_token']       = $ap['device_token'];
                  $update_data  = $this->mapi->update('device_token', $condition_token, $device_token_updata);                  
                }
            }
          //end auth gen
          // response for apple_id
          $response['status']['error_code'] = 0;
          $response['status']['message']    = 'Login Successfully';
          $response['response']['user']   = $memberDetails;
          $response['response']['profile_status']   = $profile_status;

          $this->displayOutput($response);
        }
        //-----------------------------------end apple login----------------------------------------------
        if (empty($ap['name'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Name is required';
          //$response['response']   = $this->obj;
          $this->displayOutput($response);
        }
        
        if (empty($ap['email'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Email is required';
          //$response['response']   = $this->obj;
          
          $this->displayOutput($response);
        }
        if (!empty($ap['email'])) {

          $existing_row_count = $this->mcommon->getNumRows("user",array('email' => $ap['email']));
          if ($existing_row_count>0) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Email Already registered';
            //$response['response']   = $this->obj;
            $this->displayOutput($response);
          }
        }
        if (empty($ap['mobile'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Mobile is required';
          //$response['response']   = $this->obj;
          $this->displayOutput($response);
        }
        if (!empty($ap['mobile'])) {

          $existing_row_count = $this->mcommon->getNumRows("user",array('mobile' => $this->input->post( 'mobile' )));
          if ($existing_row_count>0) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Mobile Already registered';
            //$response['response']   = $this->obj;
            
            $this->displayOutput($response);
          }
        }

        if (empty($ap['device_type'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Device type is required.';
         
          $this->displayOutput($response);
        }
        if (!empty($ap['device_type'])) {
          if($ap['device_type']!=1 && $ap['device_type']!=2)
          {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Device type invalid.It should be 1-IOS or 2-Android.';
            $this->displayOutput($response);
          }          
        }
        
        if (empty($ap['device_token'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Device token is required.';
          $this->displayOutput($response);
        }
        $fb_id="";
          if(isset($ap['fb_id']) && (!empty($ap['fb_id'])))
          {
              $fb_id=$ap['fb_id'];
          }
        if(empty($fb_id)){
          $registration_type  = '2';
          if (empty($ap['password'])) {
              $response['status']['error_code'] = 1;
              $response['status']['message']    = 'password is required';
              //$response['response']   = $this->obj;
              
              $this->displayOutput($response);
            }

            if (!empty($ap['password'])) {
              $password=$ap['password'];
              // Validate password strength
              // $uppercase = preg_match('@[A-Z]@', $password);
              // $lowercase = preg_match('@[a-z]@', $password);
              // $number    = preg_match('@[0-9]@', $password);
              // $specialChars = preg_match('@[^\w]@', $password);

              // if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
              if(strlen($password)<4)
              {
                $response['status']['error_code'] = 1;
                $response['status']['message']    = 'password must be atleast 4 characters long';
                $this->displayOutput($response);
              }         
            }
          if(!empty($_FILES['profile_image']['name'])){
            $image_path = 'public/upload_images/profile_photo/';
            $file     = $this->imageupload->image_upload2($image_path,'profile_image');
            //print_r($file); die;
            if($file['status'] == 1){
               $img = $file['result'];
            }
            else{
              $img = '';
            } 
          }
          else{
              $img = '';
          }
        }       
        else{
          $registration_type  = '3';
          $img = $this->input->post('profile_image');
          $password  =rand(10000,99999);
        }
        
        //add apple id for apple user
        $apple_id = "";
        if(isset($ap['apple_id']) && !empty($ap['apple_id']) ){
          $registration_type  = '3';
          $apple_id = $ap['apple_id'];
        }

        //profile fields
        if (empty($ap['dob'])) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Date of birth field is required';
            //$response['response']   = $this->obj;
            
            $this->displayOutput($response);
          }
          if (empty($ap['gender'])) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Gender is required';
            //$response['response']   = $this->obj;
            
            $this->displayOutput($response);
          }  
          if (!empty($ap['gender'])) {
            if($ap['gender']!='M' && $ap['gender']!='F')
            {
              $response['status']['error_code'] = 1;
              $response['status']['message']    = 'Gender will be either M - Male or F - Female';
              $this->displayOutput($response);
            }
            
            //$response['response']   = $this->obj;
            
           
          }  
          if (empty($ap['address'])) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Address is required';
            //$response['response']   = $this->obj;
            
            $this->displayOutput($response);
          }
          $lat="";
          $lng="";
          if(!empty($ap['lat']))  
          {
            $lat=$ap['lat'];
          } 
          if(!empty($ap['lng']))  
          {
            $lng=$ap['lng'];
          }       
          
          
          if(!empty($ap['dob'])) {
            $date=$ap['dob'];
            $format="d/m/Y";

            if(!validateDate($date,$format))
            {
              $response['status']['error_code'] = 1;
                    $response['status']['message']    = 'Date format is wrong.It should be d/m/y';
             
                    $this->displayOutput($response);
            } 
            else {
                $dateArr=explode("/",$date) ;
                $dob=$dateArr[2]."-".$dateArr[1]."-".$dateArr[0];  
                  }              
          }
          else
          {
            $dob="";
          }    
        
        $data = array(
          'name'                  => $ap['name'],
          'mobile'                => $ap['mobile'],
          'password'              => md5($password),
          'original_password'     => $password,
          'email'                 => $ap['email'], 
          'registration_type'     => $registration_type,
          'fb_id'     => $fb_id,
          'apple_id'     => $apple_id,
          'status'                => '1',
          'added_form'            => 'App',
          'created_date'            => date('Y-m-d H:i:s'),       
        );

        //options middle & last name as discussed
        $middle_name = '';
        if(isset($ap['middle_name']) && !empty('middle_name')){
          $data['middle_name']  = $ap['middle_name'];
          $middle_name = $ap['middle_name'];
        }
        $last_name = '';
        if(isset($ap['last_name']) && !empty('last_name')){
          $data['last_name']  = $ap['last_name'];
          $last_name = $ap['last_name'];
        }
        
        $user_id = $this->mcommon->insert('user', $data);        
        if($user_id)
          {

            /** added by ishani on 18.09.2020 */
            //fn defined in common helper
            $user_data['name']=$ap['name'].' '.$middle_name.' '.$last_name;
            $user_data['email']=$ap['email'];
            $user_data['mobile']=$ap['mobile'];
            insert_all_user($user_data);

                    /*****************/
            
            $profile_arr=array();
            $profile_arr['user_id']           = $user_id;
            $profile_arr['gender']           = $ap['gender'];
            $profile_arr['profile_img']      =$img;
            $profile_arr['dob']              =$dob; 
            $profile_arr['address']           = $ap['address'];
            $profile_arr['lat']            = $lat;
            $profile_arr['lng']           = $lng;         
            $profile_arr['created_by']       = $user_id;
            $profile_arr['created_date']       = date('Y-m-d H:i:s');
            
            $this->mcommon->insert('user_profile',$profile_arr);
            //echo $user_id;

            ///insert into device token
            $device_token_data['user_id']            = $user_id;
            $device_token_data['device_type']        = $ap['device_type'];
            $device_token_data['device_token']       = '';
            $device_token_data['fcm_token']          = $ap['device_token'];
            $device_token_data['login_status']       = '1';
            $device_token_data['date_of_creation']   = date('Y-m-d H:i:s');
            $device_token_data['session_start_time'] = date('Y-m-d H:i:s');
            $device_token_data['session_end_time']   = '';

            $insert_data          = $this->mapi->insert('device_token', $device_token_data);

            $api_token_data['user_id']            = $user_id;
            $api_token_data['device_type']        = $ap['device_type'];
            $api_token_data['access_token']       = md5(mt_rand() . '_' .$user_id);
            $api_token_data['date_of_creation']   = date('Y-m-d H:i:s');
            $api_token_data['session_start_time'] = date('Y-m-d H:i:s');
            $api_token_data['session_end_time']   = '';

            $insert_data      = $this->mapi->insert('api_token', $api_token_data);

            $member_all_details= $this->mapi->getMemberDetailsRow(array('user.user_id' => $user_id));
            //echo $this->db->last_query();
            //print_r($member_all_details); die;

            /************************* mail to the member ****************************/
            //$link               = base_url('api/member_activation/'.$user_id);
            //$logo               = base_url('public/images/logo.png');
            $name=$ap['name'].' '.$middle_name.' '.$last_name;
            $email=$ap['email'];
            $mail['name']       = $name;
            $mail['to']         = $email;    
            //$params['to']     = 'sreelabiswas.kundu@met-technologies.com';
            $details            = "Login User ID: ".$email;
            $mail['subject']    = ORGANIZATION_NAME.' - Registration Successful';                             
            $mail_temp          = file_get_contents('./global/mail/registration_template.html');
            $mail_temp          = str_replace("{web_url}", base_url(), $mail_temp);
            $mail_temp          = str_replace("{logo}", LOGOURL, $mail_temp);
            $mail_temp          = str_replace("{shop_name}", ORGANIZATION_NAME, $mail_temp);  
            $mail_temp          = str_replace("{name}", $mail['name'], $mail_temp);
            $mail_temp          = str_replace("{details}", $details, $mail_temp);         
            $mail_temp          = str_replace("{current_year}", date('Y'), $mail_temp);           
            $mail['message']    = $mail_temp;
            $mail['from_email']    = FROM_EMAIL;
            $mail['from_name']    = ORGANIZATION_NAME;
  
            sendmail($mail); 

             /********push notification fr registration ************************/
              $title="Registration ".ORGANIZATION_NAME;
              $message   = "Thank you for your registration. Your profile has been created.";
              $message_data = array('to'=> $ap['device_token'],'title' => $title,'message' => $message);
              
              if($ap['device_type'] == 1){
                $this->pushnotification->send_ios_notification($message_data);
                //$this->pushnotification->send_ios_notification($ap['device_token'], $message_data);
              }
              else{
                $this->pushnotification->send_android_notification($message_data);
                //$this->pushnotification->send_android_notification($ap['device_token'], $message_data);
              }
              /* sms */
            $mobile_no=$ap['mobile'];
           
            //$message =  "Welcome to ".ORGANIZATION_NAME. "\n Thank you for your registration. Your profile has been created.\n Team \n".ORGANIZATION_NAME;
            
            //$message = "Dear ".$name." \n";
            //$message .= "Welcome to Cinecafes .Thank you for your registration. Your profile has been created. \n";
            //$message .= ORGANIZATION_NAME;
            
            $template_id = '1207163653382438936';
            $message = "Dear ".$name."\n";
            $message .= "Welcome to Cine Cafes .Thank you for your registration. Your profile has been created.\n";
            $message .= "CINE CAFES";

            smsSend($mobile_no,$message,$template_id);


            $response['status']['error_code'] = 0;
            $response['status']['message']    = 'Registration succesful';
            $response['response']['user']  = $member_all_details;
          }
          else
          {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'User not added.Please try again';
          }
      }
      else {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Please fill up all required fields.';
         //$response['response']   = $this->obj;        
      }
    } else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Wrong http method type.';
        //$response['response']   = $this->obj;      
    }
    $this->displayOutput($response);      
  }

  //login with email pw
  public function login()
  {
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
        if (empty($ap['device_type'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Device type is required.';
         
          $this->displayOutput($response);
        }
        if (!empty($ap['device_type'])) {
          if($ap['device_type']!=1 && $ap['device_type']!=2)
          {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Device type invalid.It should be 1-IOS or 2-Android.';
            $this->displayOutput($response);
          }          
        }
        
        if (empty($ap['device_token'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Device token is required.';
          $this->displayOutput($response);
        }
        if (empty($ap['email'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Email is required.';
          $this->displayOutput($response);
        }
        if (empty($ap['password'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Password is required';
          
          $this->displayOutput($response);
        }
        $ap['password']         = md5($ap['password']);
        $check_member_condition = array('email' => $ap['email'], 'password' => $ap['password']);
        $memberdetails          = $this->mcommon->getRow('user', $check_member_condition);
        //echo $this->db->last_query(); die;
        if(empty($memberdetails)){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Invalid username or password.';
            $this->displayOutput($response);
        }
        elseif($memberdetails['is_delete'] != '0'){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Member account is removed by admin';
            $this->displayOutput($response);
        }
        elseif($memberdetails['status'] == '0'){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Member account is not in active status';
            $this->displayOutput($response);
        }
        else{
            $user_id      = $memberdetails['user_id'];
            $condition      = array('user_id' =>$user_id);
            $update_arr     = array('login_status' =>'1');
            $update_result  = $this->mapi->update('user',$condition,$update_arr);
            if($update_result){
                $response['status']['error_code'] = 0;
                $response['status']['message']    = 'Login Successfully';
                $response['response']['user']   = $memberdetails;
                $api_token_details                = $this->mapi->getRow('api_token', $condition);
                $device_token_details             = $this->mapi->getRow('device_token', $condition);
                //echo $api_token_details."%%%".$device_token_details;exit;
                if (empty($api_token_details) && empty($device_token_details)) {

                  $device_token_data['user_id']          = $user_id;
                  $device_token_data['device_type']        = $ap['device_type'];
                  $device_token_data['device_token']       = '';
                  $device_token_data['fcm_token']          = $ap['device_token'];
                  $device_token_data['login_status']       = '1';
                  $device_token_data['date_of_creation']   = date('Y-m-d H:i:s');
                  $device_token_data['session_start_time'] = date('Y-m-d H:i:s');
                  $device_token_data['session_end_time']   = '';

                  $insert_data          = $this->mapi->insert('device_token', $device_token_data);

                  $api_token_data['user_id']          = $user_id;
                  $api_token_data['device_type']        = $ap['device_type'];
                  $api_token_data['access_token']       = md5(mt_rand() . '_' . $memberdetails['user_id']);
                  $api_token_data['date_of_creation']   = date('Y-m-d H:i:s');
                  $api_token_data['session_start_time'] = date('Y-m-d H:i:s');
                  $api_token_data['session_end_time']   = '';

                  $insert_data      = $this->mapi->insert('api_token', $api_token_data);
                  // $all_member    = $this->mapi->getMemberDetailsRow(array('mm.user_id' => $user_id));
                  // //pr($all_member);
                  // if(!empty($all_member)){
                  //   if($all_member[0]['membership_id'] ==''){
                  //     $all_member_details = $all_member[0];
                  //   }
                  //   else{
                  //     foreach($all_member as $val){
                  //         $all_member_datas   = $this->mapi->getMemberDetailsRow(array('mm.user_id' => $val['user_id'],'package_membership_mapping.status' => '1'));
                  //         if(!empty($all_member_datas)){
                  //             $all_member_details = $all_member_datas[0];
                  //         }
                  //         else{
                  //            $all_member_details = $all_member[0];
                  //            $all_member_details['membership_id'] = null;
                  //         }
                  //     }
                  //   }                       
                  // }
                  // else {
                  //   $response['status']['error_code'] = 1;
                  //   $response['status']['message']    = 'Unable to generate access token';                    
                  // } 
                  
                } else {
                  $condition_token                    = array('user_id' =>$user_id);

                  $api_token_updata['device_type']    = $ap['device_type'];
                  $api_token_updata['access_token']   = $api_token_details['access_token'];
                  $update_data  = $this->mapi->update('api_token', $condition_token, $api_token_updata);

                  $device_token_updata['device_type']     = $ap['device_type'];
                  $device_token_updata['fcm_token']       = $ap['device_token'];
                  $update_data  = $this->mapi->update('device_token', $condition_token, $device_token_updata);

                  
                }

                $member_all_details= $this->mapi->getMemberDetailsRow(array('user.user_id' => $user_id));               
                  if ($member_all_details) {
                    // if($all_member_details['profile_img'] !='' ){
                    //   $all_member_details['profile_pic_updated'] = '1';
                    // }
                    // else{
                    //   $all_member_details['profile_pic_updated'] = '0';
                    // }
                    $response['status']['error_code'] = 0;
                    $response['status']['message']    = 'Login Successfully';
                    $response['response']['user']   = $member_all_details;
                    
                  } else {
                    $response['status']['error_code'] = 1;
                    $response['status']['message']    = 'Unable to get user data';                    
                  }
            }
            else {
              $response['status']['error_code'] = 1;
              $response['status']['message']    = 'Oops!something went wrong...';
            }          
        }        
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

  //fb login
  public function fbLogin()
  {
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
        if (empty($ap['device_type'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Device type is required.';
         
          $this->displayOutput($response);
        }
        if (!empty($ap['device_type'])) {
          if($ap['device_type']!=1 && $ap['device_type']!=2)
          {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Device type invalid.It should be 1-IOS or 2-Android.';
            $this->displayOutput($response);
          }          
        }
        
        if (empty($ap['device_token'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Device token is required.';
          $this->displayOutput($response);
        }
        if (empty($ap['fb_id'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Fb id is required.';
          $this->displayOutput($response);
        }
      
        $check_member_condition = array('fb_id' => $ap['fb_id']);
        $memberdetails          = $this->mcommon->getRow('user', $check_member_condition);
        //echo $this->db->last_query(); die;
        if(empty($memberdetails)){
            $response['status']['error_code'] = 0;
            $response['status']['message']    = 'Invalid Fb id';
            $this->displayOutput($response);
        }
        elseif($memberdetails['is_delete'] != '0'){
            $response['status']['error_code'] = 0;
            $response['status']['message']    = 'Member account is removed by admin';
            $this->displayOutput($response);
        }
        elseif($memberdetails['status'] == '0'){
            $response['status']['error_code'] = 0;
            $response['status']['message']    = 'Member account is not in active status';
            $this->displayOutput($response);
        }
        else{
            $user_id      = $memberdetails['user_id'];
            $condition      = array('user_id' =>$user_id);
            $update_arr     = array('login_status' =>'1');
            $update_result  = $this->mapi->update('user',$condition,$update_arr);
            if($update_result){
                $response['status']['error_code'] = 0;
                $response['status']['message']    = 'Login Successfully';
                $response['response']['user']   = $memberdetails;
                $api_token_details                = $this->mapi->getRow('api_token', $condition);
                $device_token_details             = $this->mapi->getRow('device_token', $condition);
                //echo $api_token_details."%%%".$device_token_details;exit;
                if (empty($api_token_details) && empty($device_token_details)) {

                  $device_token_data['user_id']          = $user_id;
                  $device_token_data['device_type']        = $ap['device_type'];
                  $device_token_data['device_token']       = '';
                  $device_token_data['fcm_token']          = $ap['device_token'];
                  $device_token_data['login_status']       = '1';
                  $device_token_data['date_of_creation']   = date('Y-m-d H:i:s');
                  $device_token_data['session_start_time'] = date('Y-m-d H:i:s');
                  $device_token_data['session_end_time']   = '';

                  $insert_data          = $this->mapi->insert('device_token', $device_token_data);

                  $api_token_data['user_id']          = $user_id;
                  $api_token_data['device_type']        = $ap['device_type'];
                  $api_token_data['access_token']       = md5(mt_rand() . '_' . $memberdetails['user_id']);
                  $api_token_data['date_of_creation']   = date('Y-m-d H:i:s');
                  $api_token_data['session_start_time'] = date('Y-m-d H:i:s');
                  $api_token_data['session_end_time']   = '';

                  $insert_data      = $this->mapi->insert('api_token', $api_token_data);
                  // $all_member    = $this->mapi->getMemberDetailsRow(array('mm.user_id' => $user_id));
                  // //pr($all_member);
                  // if(!empty($all_member)){
                  //   if($all_member[0]['membership_id'] ==''){
                  //     $all_member_details = $all_member[0];
                  //   }
                  //   else{
                  //     foreach($all_member as $val){
                  //         $all_member_datas   = $this->mapi->getMemberDetailsRow(array('mm.user_id' => $val['user_id'],'package_membership_mapping.status' => '1'));
                  //         if(!empty($all_member_datas)){
                  //             $all_member_details = $all_member_datas[0];
                  //         }
                  //         else{
                  //            $all_member_details = $all_member[0];
                  //            $all_member_details['membership_id'] = null;
                  //         }
                  //     }
                  //   }                       
                  // }
                  // else {
                  //   $response['status']['error_code'] = 1;
                  //   $response['status']['message']    = 'Unable to generate access token';                    
                  // } 
                  
                } else {
                  $condition_token                    = array('user_id' =>$user_id);

                  $api_token_updata['device_type']    = $ap['device_type'];
                  $api_token_updata['access_token']   = $api_token_details['access_token'];
                  $update_data  = $this->mapi->update('api_token', $condition_token, $api_token_updata);

                  $device_token_updata['device_type']     = $ap['device_type'];
                  $device_token_updata['fcm_token']       = $ap['device_token'];
                  $update_data  = $this->mapi->update('device_token', $condition_token, $device_token_updata);

                  
                }

                $member_all_details= $this->mapi->getMemberDetailsRow(array('user.user_id' => $user_id));               
                  if ($member_all_details) {
                    // if($all_member_details['profile_img'] !='' ){
                    //   $all_member_details['profile_pic_updated'] = '1';
                    // }
                    // else{
                    //   $all_member_details['profile_pic_updated'] = '0';
                    // }
                    $response['status']['error_code'] = 0;
                    $response['status']['message']    = 'Login Successfully';
                    $response['response']['user']   = $member_all_details;
                    
                  } else {
                    $response['status']['error_code'] = 1;
                    $response['status']['message']    = 'Unable to get user data';                    
                  }
            }
            else {
              $response['status']['error_code'] = 1;
              $response['status']['message']    = 'Oops!something went wrong...';
            }          
        }        
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

  //
  //fb login
  public function appleLogin()
  {
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
        if (empty($ap['device_type'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Device type is required.';
         
          $this->displayOutput($response);
        }
        if (!empty($ap['device_type'])) {
          if($ap['device_type']!=1 && $ap['device_type']!=1)
          {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Device type invalid.It should be 1-IOS or 2-Android.';
            $this->displayOutput($response);
          }          
        }
        
        if (empty($ap['device_token'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Device token is required.';
          $this->displayOutput($response);
        }
        if (empty($ap['apple_id'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Apple id is required.';
          $this->displayOutput($response);
        }
      
        $check_member_condition = array('apple_id' => $ap['apple_id']);
        $memberdetails          = $this->mcommon->getRow('user', $check_member_condition);
        //echo $this->db->last_query(); die;
        if(empty($memberdetails)){
            $response['status']['error_code'] = 0;
            $response['status']['message']    = 'Invalid Apple id';
            $this->displayOutput($response);
        }
        elseif($memberdetails['is_delete'] != '0'){
            $response['status']['error_code'] = 0;
            $response['status']['message']    = 'Member account is removed by admin';
            $this->displayOutput($response);
        }
        elseif($memberdetails['status'] == '0'){
            $response['status']['error_code'] = 0;
            $response['status']['message']    = 'Member account is not in active status';
            $this->displayOutput($response);
        }
        else{
            $user_id      = $memberdetails['user_id'];
            $condition      = array('user_id' =>$user_id);
            $update_arr     = array('login_status' =>'1');
            $update_result  = $this->mapi->update('user',$condition,$update_arr);
            if($update_result){
                $response['status']['error_code'] = 0;
                $response['status']['message']    = 'Login Successfully';
                $response['response']['user']   = $memberdetails;
                $api_token_details                = $this->mapi->getRow('api_token', $condition);
                $device_token_details             = $this->mapi->getRow('device_token', $condition);
                //echo $api_token_details."%%%".$device_token_details;exit;
                if (empty($api_token_details) && empty($device_token_details)) {

                  $device_token_data['user_id']          = $user_id;
                  $device_token_data['device_type']        = $ap['device_type'];
                  $device_token_data['device_token']       = '';
                  $device_token_data['fcm_token']          = $ap['device_token'];
                  $device_token_data['login_status']       = '1';
                  $device_token_data['date_of_creation']   = date('Y-m-d H:i:s');
                  $device_token_data['session_start_time'] = date('Y-m-d H:i:s');
                  $device_token_data['session_end_time']   = '';

                  $insert_data          = $this->mapi->insert('device_token', $device_token_data);

                  $api_token_data['user_id']          = $user_id;
                  $api_token_data['device_type']        = $ap['device_type'];
                  $api_token_data['access_token']       = md5(mt_rand() . '_' . $memberdetails['user_id']);
                  $api_token_data['date_of_creation']   = date('Y-m-d H:i:s');
                  $api_token_data['session_start_time'] = date('Y-m-d H:i:s');
                  $api_token_data['session_end_time']   = '';

                  $insert_data      = $this->mapi->insert('api_token', $api_token_data);
                  
                } else {
                  $condition_token                    = array('user_id' =>$user_id);

                  $api_token_updata['device_type']    = $ap['device_type'];
                  $api_token_updata['access_token']   = $api_token_details['access_token'];
                  $update_data  = $this->mapi->update('api_token', $condition_token, $api_token_updata);

                  $device_token_updata['device_type']     = $ap['device_type'];
                  $device_token_updata['fcm_token']       = $ap['device_token'];
                  $update_data  = $this->mapi->update('device_token', $condition_token, $device_token_updata);

                  
                }

                $member_all_details= $this->mapi->getMemberDetailsRow(array('user.user_id' => $user_id));               
                  if ($member_all_details) {
                    // if($all_member_details['profile_img'] !='' ){
                    //   $all_member_details['profile_pic_updated'] = '1';
                    // }
                    // else{
                    //   $all_member_details['profile_pic_updated'] = '0';
                    // }
                    $response['status']['error_code'] = 0;
                    $response['status']['message']    = 'Login Successfully';
                    $response['response']['user']   = $member_all_details;
                    
                  } else {
                    $response['status']['error_code'] = 1;
                    $response['status']['message']    = 'Unable to get user data';                    
                  }
            }
            else {
              $response['status']['error_code'] = 1;
              $response['status']['message']    = 'Oops!something went wrong...';
            }          
        }        
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

  
  ///send otp to mobile no
  public function mobileOtpGenerate()
  {
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
        if (empty($ap['mobile'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Mobile no is required.';
         
          $this->displayOutput($response);
        }
        
        $mobile   = $ap['mobile'];
        $otp      = mt_rand(1000,9999);
        
        $member_data = $this->mapi->getRow('user',array('mobile' => $ap['mobile']));
        if(!empty($member_data)){
          if($member_data['status']==0)
          {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Your account is deactivated.";
            $this->displayOutput($response);
          }
          if($member_data['is_delete']==1)
          {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Your account is removed by admin.";
            $this->displayOutput($response);
          }
          $template_id = '1207163697491581491';
          $message = $otp." is the OTP.\n";
          $message .= "CINE CAFES";
          $response_sms = smsSend($ap['mobile'],$message,$template_id);

          $update_arr = array('otp' =>$otp,'otp_generating_datetime' =>date('Y-m-d H:i'));
          $this->mapi->update('user',array('user_id' => $member_data['user_id']),$update_arr);
          //echo $response_sms;exit;
          $response['status']['error_code'] = 0;
          $response['status']['message']    = "OTP send successfully.";
          $response['response']['otp']      = $otp;
        }
        else{
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'This mobile no. is not registered with us';
        }
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
  
  ///login wd mobile/ otp verification
  public function loginMobileNoWithOtp()
  {
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
        if (empty($ap['device_type'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Device type is required.';
         
          $this->displayOutput($response);
        }

        if (!empty($ap['device_type'])) {
          if($ap['device_type']!=1 && $ap['device_type']!=2)
          {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Device type invalid.It should be 1-IOS or 2-Android.';
            $this->displayOutput($response);
          }          
        }
        
        if (empty($ap['device_token'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Device token is required.';
          $this->displayOutput($response);
        }
        
        if (empty($ap['mobile'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'phoneNo field required.';
          
          $this->displayOutput($response);
        }
        if (empty($ap['otp'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Otp required.';
          
          $this->displayOutput($response);
        }
        
        $check_member_condition = array('otp' => $ap['otp'],'mobile'=>$ap['mobile']);
        $memberdetails          = $this->mcommon->getRow('user', $check_member_condition);
        //pr($memberdetails);
        if(empty($memberdetails)){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Invalid Otp';
            $this->displayOutput($response);
        }
        else{
            $otp_generating_time =  $memberdetails['otp_generating_datetime'];          
            $current_time = date('Y-m-d H:i');
            //echo date('Y-m-d H:i',strtotime($otp_generating_time. '+30 minutes'));exit;
            if(strtotime($current_time) > strtotime($otp_generating_time. '+30 minutes')){              
              $response['status']['error_code'] = 1;
              $response['status']['message']    = 'Otp expired';
              $this->displayOutput($response);
            } 
            elseif($memberdetails['is_delete'] != '0'){
              $response['status']['error_code'] = 1;
              $response['status']['message']    = 'Member account is removed by admin';
              $this->displayOutput($response);
            }
            elseif($memberdetails['status'] == '0'){
              $response['status']['error_code'] = 1;
              $response['status']['message']    = 'Member account is not in active status';
              $this->displayOutput($response);
            }
            else{
              $user_id      = $memberdetails['user_id'];
              $condition      = array('user_id' =>$user_id);
              $update_arr     = array('login_status' =>'1');
              $update_result  = $this->mapi->update('user',$condition,$update_arr);
              if($update_result){
                  $response['status']['error_code'] = 0;
                  $response['status']['message']    = 'Login Successfully';
                  $response['response']['user']   = $memberdetails;
                  $api_token_details                = $this->mapi->getRow('api_token', $condition);
                  $device_token_details             = $this->mapi->getRow('device_token', $condition);
                  //echo $api_token_details."%%%".$device_token_details;exit;
                  if (empty($api_token_details) && empty($device_token_details)) {

                    $device_token_data['user_id']          = $user_id;
                    $device_token_data['device_type']        = $ap['device_type'];
                    $device_token_data['device_token']       = '';
                    $device_token_data['fcm_token']          = $ap['device_token'];
                    $device_token_data['login_status']       = '1';
                    $device_token_data['date_of_creation']   = date('Y-m-d H:i:s');
                    $device_token_data['session_start_time'] = date('Y-m-d H:i:s');
                    $device_token_data['session_end_time']   = '';

                    $insert_data          = $this->mapi->insert('device_token', $device_token_data);

                    $api_token_data['user_id']          = $user_id;
                    $api_token_data['device_type']        = $ap['device_type'];
                    $api_token_data['access_token']       = md5(mt_rand() . '_' . $memberdetails['user_id']);
                    $api_token_data['date_of_creation']   = date('Y-m-d H:i:s');
                    $api_token_data['session_start_time'] = date('Y-m-d H:i:s');
                    $api_token_data['session_end_time']   = '';

                    $insert_data      = $this->mapi->insert('api_token', $api_token_data);
                    // $all_member    = $this->mapi->getMemberDetailsRow(array('mm.user_id' => $user_id));
                    // //pr($all_member);
                    // if(!empty($all_member)){
                    //   if($all_member[0]['membership_id'] ==''){
                    //     $all_member_details = $all_member[0];
                    //   }
                    //   else{
                    //     foreach($all_member as $val){
                    //         $all_member_datas   = $this->mapi->getMemberDetailsRow(array('mm.user_id' => $val['user_id'],'package_membership_mapping.status' => '1'));
                    //         if(!empty($all_member_datas)){
                    //             $all_member_details = $all_member_datas[0];
                    //         }
                    //         else{
                    //            $all_member_details = $all_member[0];
                    //            $all_member_details['membership_id'] = null;
                    //         }
                    //     }
                    //   }                       
                    // }
                    // else {
                    //   $response['status']['error_code'] = 1;
                    //   $response['status']['message']    = 'Unable to generate access token';                    
                    // } 
                    
                  } else {
                    $condition_token                    = array('user_id' =>$user_id);

                    $api_token_updata['device_type']    = $ap['device_type'];
                    $api_token_updata['access_token']   = $api_token_details['access_token'];
                    $update_data  = $this->mapi->update('api_token', $condition_token, $api_token_updata);

                    $device_token_updata['device_type']     = $ap['device_type'];
                    $device_token_updata['fcm_token']       = $ap['device_token'];
                    $update_data  = $this->mapi->update('device_token', $condition_token, $device_token_updata);
                  }

                  $member_all_details= $this->mapi->getMemberDetailsRow(array('user.user_id' => $user_id));               
                    if ($member_all_details) {
                      // if($all_member_details['profile_img'] !='' ){
                      //   $all_member_details['profile_pic_updated'] = '1';
                      // }
                      // else{
                      //   $all_member_details['profile_pic_updated'] = '0';
                      // }
                      $response['status']['error_code'] = 0;
                      $response['status']['message']    = 'Login Successfully';
                      $response['response']['user']   = $member_all_details;
                      
                    } else {
                      $response['status']['error_code'] = 1;
                      $response['status']['message']    = 'Unable to get user data';                    
                    }
              }
              else {
                $response['status']['error_code'] = 1;
                $response['status']['message']    = 'Oops!something went wrong...';
              }          
          } 
        }        
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

  // forgot password

   public function forgotPassword()
  {
    $ap = json_decode(file_get_contents('php://input'), true);

    if ($this->checkHttpMethods($this->http_methods[0])) {

      if (sizeof($ap)) {
       
        if (empty($ap['email'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Registered email is required';
          $this->displayOutput($response);
        }

        $condition['email'] = $ap['email'];
        $member_details = $this->mcommon->getRow('user', $condition);

        if (empty($member_details)) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Sorry! email does not exist with us';
          $this->displayOutput($response);
        } 
        else {
          $encoded_key = base64_encode(rand());
          $member_details['recovery_key']   = $encoded_key;
          $condition_member = array('user_id' => $member_details['user_id']);
          $this->mapi->update('user', $condition_member, $member_details);

          
          $mail['name']     = $member_details['name'].' '.$member_details['middle_name'].' '.$member_details['last_name'];
          $mail['to']       = $member_details['email'];
          $mail['subject']  = ORGANIZATION_NAME.' Password Reset';

          $link = base_url('recoverPasswordUser/' . $encoded_key);
          $mail_temp = file_get_contents('./global/mail/forgotpassword_template.html');
          $mail_temp          = str_replace("{web_url}", 'https://cinecafes.com/', $mail_temp);
          $mail_temp          = str_replace("{logo}", LOGOURL, $mail_temp);
          $mail_temp          = str_replace("{shop_name}", ORGANIZATION_NAME, $mail_temp);  
          $mail_temp          = str_replace("{name}", $mail['name'], $mail_temp);
          $mail_temp          = str_replace("{link}", $link, $mail_temp);         
          $mail_temp          = str_replace("{current_year}", date('Y'), $mail_temp);
          
          $mail_temp          = str_replace("{playstore_img}", base_url('public/assets/img/googleplaylink.png'), $mail_temp);
          $mail_temp          = str_replace("{appstore_img}", base_url('public/assets/img/appstorelink.png'), $mail_temp);
          
          $mail_temp          = str_replace("{facebook_img}", base_url('public/assets/img/facebook_icon.jpg'), $mail_temp);
          $mail_temp          = str_replace("{twitter_img}", base_url('public/assets/img/twitter_icon.jpg'), $mail_temp);
          $mail_temp          = str_replace("{insta_img}", base_url('public/assets/img/ins_icon.jpg'), $mail_temp);
          
          $mail['message']    = $mail_temp;
          $mail['from_email']    = FROM_EMAIL;
          $mail['from_name']    = ORGANIZATION_NAME;
  
          //sendmail($mail); 
          //echo '<pre>';print_r($mail);die;
          if (sendmail($mail)) {
            $response['status']['error_code'] = 0;
            $response['status']['message']    = 'Password recovery mail has been sent to your email';
          } 
          else {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Uanble to send recovery mail.';
          }
        }
      } 
      else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Please fill up all required fields.';
      }
    } else {
      $response['status']['error_code'] = 1;
      $response['status']['message']    = 'Wrong http method type.';      
    }
    $this->displayOutput($response);
  }
  
  public function getMenuPdfLink()
  {
    $pdf = base_url('public/upload_images/media/Cine_cafe_menu_1.pdf');
    $response=array('status'=>array('error_code'=>0,'message'=>'success'),'result'=>array('data'=>$pdf));
    $this->displayOutput($response);
  }

  public function updateProfile()
{
    if ($this->checkHttpMethods($this->http_methods[0])) {
        if (!empty($this->input->post())) {
                  //pr($_POST); 
          $ap=$_POST;
           if (empty($ap['user_id'])) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'User id is required';
            //$response['response']   = $this->obj;
            $this->displayOutput($response);
          }        
          if (empty($ap['name'])) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Name field is required';
            //$response['response']   = $this->obj;
            $this->displayOutput($response);
          }
          
          if (empty($ap['email'])) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Email field is required';
            //$response['response']   = $this->obj;
            
            $this->displayOutput($response);
          }
          $user_id=$ap['user_id'];
          if (!empty($ap['email'])) {
             
             $existing_row_count = $this->mcommon->getNumRows("user",array('email' => $ap['email'],'user_id!='=>$user_id));
            if ($existing_row_count>0) {
              $response['status']['error_code'] = 1;
              $response['status']['message']    = 'Email Already registered with another user';
              //$response['response']   = $this->obj;
              $this->displayOutput($response);
            }
          }
          if (empty($ap['mobile'])) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Mobile field is required';
            //$response['response']   = $this->obj;
            $this->displayOutput($response);
          }
          if (!empty($ap['mobile'])) {

            $existing_row_count = $this->mcommon->getNumRows("user",array('mobile' => $ap['mobile'],'user_id!='=>$user_id));

            if (!empty($existing_row_count)) {
              $response['status']['error_code'] = 1;
              $response['status']['message']    = 'Mobile Already registered with another user';
              $this->displayOutput($response);
            }
          }
          if (empty($ap['dob'])) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Date of birth field is required';
            //$response['response']   = $this->obj;
            
            $this->displayOutput($response);
          }
          if (empty($ap['gender'])) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Gender is required';
            //$response['response']   = $this->obj;
            
            $this->displayOutput($response);
          }  
          if (!empty($ap['gender'])) {
            if($ap['gender']!='M' && $ap['gender']!='F')
            {
              $response['status']['error_code'] = 1;
              $response['status']['message']    = 'Gender will be either M - Male or F - Female';
              $this->displayOutput($response);
            }
            
            //$response['response']   = $this->obj;
            
           
          }  
          if (empty($ap['address'])) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Address is required';
            //$response['response']   = $this->obj;
            
            $this->displayOutput($response);
          }
          $lat="";
          $lng="";
          if(!empty($ap['lat']))  
          {
            $lat=$ap['lat'];
          } 
          if(!empty($ap['lng']))  
          {
            $lng=$ap['lng'];
          }       
          if(!empty($_FILES['profile_image']['name'])){
            $image_path = 'public/upload_images/profile_photo/';
            $file     = $this->imageupload->image_upload2($image_path,'profile_image');
            if($file['status'] == 1){
               $img = $file['result'];
            }
            else{
              $img = '';
            } 
          }
          else{
              $img = '';
          }
          
          if(!empty($ap['dob'])) {
            $date=$ap['dob'];
            $format="d/m/Y";

            if(!validateDate($date,$format))
            {
              $response['status']['error_code'] = 1;
                    $response['status']['message']    = 'Date format is wrong.It should be d/m/y';
             
                    $this->displayOutput($response);
            } 
            else {
                $dateArr=explode("/",$date) ;
                $dob=$dateArr[2]."-".$dateArr[1]."-".$dateArr[0];  
                  }                
          }
          else
          {
            $dob="";
          }     
            $user_id          = $ap['user_id'];
           $condition['user_id']=$user_id;
            $data = array(
              'name'            => $ap['name'],
              'mobile'          => $ap['mobile'],
              'email'           => $ap['email'],
              'updated_by'      => $user_id,
              'updated_date'    => date('Y-m-d H:i:s'),     
            );

            //options middle & last name as discussed
            if(isset($ap['middle_name']) && !empty('middle_name')){
              $data['middle_name']  = $ap['middle_name'];
            }
            if(isset($ap['last_name']) && !empty('last_name')){
              $data['last_name']  = $ap['last_name'];
            }
        
            //update user
            $this->mcommon->update('user',$condition, $data);        
        
            $profile_arr=array();

            $profile_arr['gender']           = $ap['gender'];
            $profile_arr['dob']              =$dob; 
            if(!empty($img)){
              $profile_arr['profile_img']    = $img;
            }   
            $profile_arr['address']           = $ap['address'];
            $profile_arr['lat']            = $lat;
            $profile_arr['lng']           = $lng;         
            $profile_arr['created_by']       = $user_id;
            $profile_arr['created_date']       = date('Y-m-d H:i:s');
           //update user profile 
            $this->mcommon->update('user_profile',$condition,$profile_arr);
            $member_all_details= $this->mapi->getMemberDetailsRow(array('user.user_id' => $user_id));
            $response['status']['error_code'] = 0;
            $response['status']['message']    = 'Profile updated successfully.';
            $response['response']['user']   = $member_all_details;
                  
      }
      else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Please fill up all required fields.';
      }
    } else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Wrong http method type.';
        //$response['response']   = $this->obj;5656
    }
    $this->displayOutput($response);      
}

//Reset  pw
  public function reset_password()
  {
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0]))
    {
      if (sizeof($ap))
      {
        if (empty($ap['old_password']))
        {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Old Password is required.';
          $this->displayOutput($response);
        }
        if (empty($ap['new_password']))
        {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'New Password is required.';
          $this->displayOutput($response);
        }
        if (empty($ap['user_id']))
        {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'User id is required';
          $this->displayOutput($response);
        }
        
        $chkOldPassword = $this->common_model->get('user',array('*'),array('password'=>md5($ap['old_password']),'user_id' => $ap['user_id']));
        if(empty($chkOldPassword))
        {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Old password mismatch';
          $this->displayOutput($response);
        }
        
        $update_arr['password']           = md5($ap['new_password']);
        $update_arr['original_password']  = $ap['new_password'];
        $update_result  = $this->mapi->update('user',array('user_id' => $ap['user_id']),$update_arr);
        
        if($update_result)
        {
          $response['status']['error_code'] = 0;
          $response['status']['message']    = 'Password updated successfully';
        }
        else
        {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Oops!something went wrong...';
        }
      }
      else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Please fill up all required fields';        
      }
    }
    else
    {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Wrong http method type.';        
    }
    $this->displayOutput($response);
  }

  //Banner List
  public function bannerList(){
    $condition['status'] =1;
    $condition['is_delete'] =0;
    $List = $this->mcommon->getDetails('banner',$condition);
    if(!empty($List)){
      for($i=0;$i<count($List);$i++)
      {
        if(!empty($List[$i]['banner_image']))
        {
        $List[$i]['banner_image']=base_url()."public/upload_images/banner/".$List[$i]['banner_image'];
        }
        else
        {
        $List[$i]['banner_image']=''; 
        }
      }
      $response=array('status'=>array('error_code'=>0,'message'=>'success'),'result'=>array('list'=>$List));
    }else{
      $response=array('status'=>array('error_code'=>0,'message'=>'No data found'),'result'=>array('list'=>$this->arr));
    }
    
    $this->displayOutput($response);
  } 

  //recommended list + single 
  public function recommendedCafeList(){
    $ap=json_decode(file_get_contents('php://input'), true);
    if($this->checkHttpMethods($this->http_methods[0])){
      //if(sizeof($ap)){

      ////////////////////////////////////////////////////////////////////////
          $order_col='avg_rating';
          $order_type='DESC';
          $fromlat="";
          $fromlng="";
          $sort_by="";
          $start=0;
          $limit="";
          if(isset($ap['sort_by'])&&$ap['sort_by']!='')
          {
            $sort_by=$ap['sort_by'];
            if($sort_by=="rating")
            {
              $order_col='avg_rating';
              $order_type='DESC';
            }
            elseif($sort_by=="price")
            {
              $order_col='price';
              $order_type='ASC';
            }
            elseif($sort_by=="distance")
            {
              if(isset($ap['fromlat'])&&isset($ap['fromlng']))
              {
                $fromlat=$ap['fromlat'];
                $fromlng=$ap['fromlng'];
                $order_col='distance';
                $order_type='ASC';
              }
              else
              {
                $response['status']['error_code'] = 1;
                $response['status']['message']    = 'user location lat long required.';
         
                $this->displayOutput($response);
              }
              
            }
          }
          ////////////////////////////for pagination params/////////////////////////////
          if(isset($ap['page_number'])&&$ap['page_number']>0&&isset($ap['number_of_data'])&&$ap['number_of_data']>0)
          {
             $page = $ap['page_number'];
             $page_no=$page-1;
             $limit=$ap['number_of_data'];
             $start=$page_no*$limit;
          }
          //////////////////////////////////////////////////////////////////////////////
          $condition['master_cafe.status']=1;
          $condition['master_cafe.is_delete']=0;

          if(isset($ap['user_id'])&&$ap['user_id']>0)
          {
            $user_id=$ap['user_id'];
          }
          else
          {
            $user_id="";
          }

          ///for details data of single item
          $cafe_id="";
          if(isset($ap['cafe_id'])&&$ap['cafe_id']>0)
          {
            $cafe_id=$ap['cafe_id'];
            $condition['master_cafe.cafe_id']=$cafe_id;
          }

          $searchText="";
          $searchCol="cafe_place";
          if(isset($ap['searchText'])&&$ap['searchText']!="")
          {
            $searchText=trim(str_replace("cinecafe","",strtolower($ap['searchText'])));
            $searchText=str_replace("-","",$searchText);
          }
          //echo $searchText;
          ////////////////////////get total count///////////////////////////////////////
          $table="master_cafe";
          $total_count=0;
          $total_count=$this->mapi->get_data_total_count($table,$condition,$user_id);
         if($cafe_id>0||$sort_by!='distance')
          {
            $List = $this->mapi->get_data_limit($table,$condition,$order_col,$order_type,$start,$limit,$user_id,$searchText,$searchCol);

          }
          else
          {
            if($sort_by=='distance'&&$fromlat!=''&&$fromlng!='')
            {

              $List = $this->mapi->get_data_limit_by_distance($table,$condition,$order_col,$order_type,$start,$limit,$user_id,$fromlat,$fromlng);
              // echo $this->db->last_query();
              // die;
            }
          }

      /////////////////////////////////////////////////////////////////////////////////
      //echo $this->db->last_query();die;
      if(!empty($List)){

        //////////////////////////////check for purchased or my uploaded////////.
        // if(isset($ap['user_id'])&&$ap['user_id']>0)
        //  {
        //       $ListModified=$List;
        //     for($i=0;$i<count($ListModified);$i++){ 
        //       $video_id="";
        //       $video_id=$List[$i]['video_id'];
        //       $is_purchased=0;
        //       $is_uploaded_by_me=0;
              
        //         if($video_id>0)
        //         {
        //           $is_purchased=$this->is_purchased($video_id,$ap['user_id']);
        //           $is_uploaded_by_me=$this->is_uploaded_by_me($video_id,$ap['user_id']);
        //           if($is_purchased>0||$is_uploaded_by_me>0)
        //           {
        //             unset($ListModified[$i]);
        //           }
        //         }
        //     }
        //     $List=array_values($ListModified); 
        //   }

        for($i=0;$i<count($List);$i++){  
          //$List[$i]['cafe_name'] = $List[$i]['cafe_name'].'-'.$List[$i]['cafe_place'];
        //review avg round off
        $List[$i]['avg_rating']=round($List[$i]['avg_rating']);    
          if(!empty($List[$i]['images']))
          {
            for($k=0;$k<count($List[$i]['images']);$k++){
              $List[$i]['images'][$k]['image']=base_url()."public/upload_images/cafe_images/".$List[$i]['images'][$k]['image'];
            }
          }


          //////////////////////////wishlist & cart checking/////////////////////
          if(isset($ap['user_id'])&&$ap['user_id']>0)
          {
            ///////////////////////wishlist checking////////////////////
            $item_id=$List[$i]['cafe_id'];
            $List[$i]['isfavorite ']=$this->mapi->is_wishlisted($item_id,$user_id);  
            ///////////////////////cart checking////////////////////
            //$List[$i]['cart']=$this->is_cart($List[$i]['video_id'],$ap['user_id']);   
          }
         }
        $response=array('status'=>array('error_code'=>0,'message'=>'success'),'result'=>array('total_count'=>$total_count,'list'=>$List));
      }else{
        $response=array('status'=>array('error_code'=>0,'message'=>'No data found'),'result'=>array('list'=>$this->arr));
      }
     // }else{
    //        $response=array('status'=>array('error_code'=>1,'message'=>'Please fill up all required fields'),'result'=>array('details'=>$this->obj));
    //       }
    }else{
      $response=array('status'=>array('error_code'=>1,'message'=>'Wrong http method type'),'result'=>array('details'=>$this->obj));
    }
    
    $this->displayOutput($response);
  }

  //filter +sort by +list + single 
  public function CafeListFilter(){
    $ap=json_decode(file_get_contents('php://input'), true);
    if($this->checkHttpMethods($this->http_methods[0])){
      //if(sizeof($ap)){

      ////////////////////////////////////////////////////////////////////////
          $order_col='avg_rating';
          $order_type='DESC';
          $fromlat="";
          $fromlng="";
          $sort_by="";
          if(isset($ap['sort_by'])&&$ap['sort_by']!='')
          {
            $sort_by=$ap['sort_by'];
            if($sort_by=="rating")
            {
              $order_col='avg_rating';
              $order_type='DESC';
            }
            elseif($sort_by=="price")
            {
              $order_col='price';
              $order_type='ASC';
            }
            elseif($sort_by=="distance")
            {
              if(isset($ap['fromlat'])&&isset($ap['fromlng']))
              {
                $fromlat=$ap['fromlat'];
                $fromlng=$ap['fromlng'];
                $order_col='distance';
                $order_type='ASC';
              }
              else
              {
                $response['status']['error_code'] = 1;
                $response['status']['message']    = 'user location lat long required.';
         
                $this->displayOutput($response);
              }
              
            }
          }
       
          
          $start="";
          $limit="";
          ////////////////////////////for pagination params/////////////////////////////
          if(isset($ap['page_number'])&&$ap['page_number']>0&&isset($ap['number_of_data'])&&$ap['number_of_data']>0)
          {
             $page = $ap['page_number'];
             $page_no=$page-1;
             $limit=$ap['number_of_data'];
             $start=$page_no*$limit;
          }
          //////////////////////////////////////////////////////////////////////////////
          $condition['master_cafe.status']=1;
          $condition['master_cafe.is_delete']=0;

          if(isset($ap['user_id'])&&$ap['user_id']>0)
          {
            $user_id=$ap['user_id'];
          }
          else
          {
            $user_id="";
          }

          ///for details data of single item
          $cafe_id="";
          if(isset($ap['cafe_id'])&&$ap['cafe_id']>0)
          {
            $cafe_id=$ap['cafe_id'];
            $condition['master_cafe.cafe_id']=$cafe_id;
          }

          ////////////////////////get total count///////////////////////////////////////
          $table="master_cafe";
          $total_count=0;
          $total_count=$this->mapi->get_data_total_count($table,$condition,$user_id);

          if($cafe_id>0||$sort_by!='distance')
          {
            $List = $this->mapi->get_data_limit($table,$condition,$order_col,$order_type,$start,$limit,$user_id);
          }
          else
          {
            if($sort_by=='distance'&&$fromlat!=''&&$fromlng!='')
            {

              $List = $this->mapi->get_data_limit_by_distance($table,$condition,$order_col,$order_type,$start,$limit,$user_id,$fromlat,$fromlng);
              // echo $this->db->last_query();
              // die;
            }
          }

      /////////////////////////////////////////////////////////////////////////////////
      //echo $this->db->last_query();die;
      if(!empty($List)){

        //////////////////////////////check for purchased or my uploaded////////.
        // if(isset($ap['user_id'])&&$ap['user_id']>0)
        //  {
        //       $ListModified=$List;
        //     for($i=0;$i<count($ListModified);$i++){ 
        //       $video_id="";
        //       $video_id=$List[$i]['video_id'];
        //       $is_purchased=0;
        //       $is_uploaded_by_me=0;
              
        //         if($video_id>0)
        //         {
        //           $is_purchased=$this->is_purchased($video_id,$ap['user_id']);
        //           $is_uploaded_by_me=$this->is_uploaded_by_me($video_id,$ap['user_id']);
        //           if($is_purchased>0||$is_uploaded_by_me>0)
        //           {
        //             unset($ListModified[$i]);
        //           }
        //         }
        //     }
        //     $List=array_values($ListModified); 
        //   }

        for($i=0;$i<count($List);$i++){  
        // echo '<pre>';
        // print_r($List[$i]);
        // die;     
          if(!empty($List[$i]['images']))
          {
            for($k=0;$k<count($List[$i]['images']);$k++){
              $List[$i]['images'][$k]['image']=base_url()."public/upload_images/cafe_images/".$List[$i]['images'][$k]['image'];
            }
          }


          //////////////////////////wishlist & cart checking/////////////////////
          // if(isset($ap['user_id'])&&$ap['user_id']>0)
          // {
          //   ///////////////////////wishlist checking////////////////////
          //   $List[$i]['wishlist']=$this->is_wishlisted($List[$i]['video_id'],$ap['user_id']);  
          //   ///////////////////////cart checking////////////////////
          //   $List[$i]['cart']=$this->is_cart($List[$i]['video_id'],$ap['user_id']);   
          // }
         }
        $response=array('status'=>array('error_code'=>0,'message'=>'success'),'result'=>array('total_count'=>$total_count,'list'=>$List));
      }else{
        $response=array('status'=>array('error_code'=>0,'message'=>'No data found'),'result'=>array('list'=>$this->arr));
      }
     // }else{
    //        $response=array('status'=>array('error_code'=>1,'message'=>'Please fill up all required fields'),'result'=>array('details'=>$this->obj));
    //       }
    }else{
      $response=array('status'=>array('error_code'=>1,'message'=>'Wrong http method type'),'result'=>array('details'=>$this->obj));
    }
    
    $this->displayOutput($response);
  }
  
  // favourite .................................................
  // add fav
  public function addtoWishlist(){ 
    $data=array();
    $udata=array();
    $mail=array();
    $header=array();
    $ap=json_decode(file_get_contents('php://input'), true);
    if($this->checkHttpMethods($this->http_methods[0])){
      if(sizeof($ap)){
              if(empty($ap['user_id'])){
                $response=array('status'=>array('error_code'=>1,'message'=>'User Id is required'),'result'=>array('details'=>$this->obj));
                $this->displayOutput($response);
              }
            
              if(empty($ap['cafe_id'])){
                $response=array('status'=>array('error_code'=>1,'message'=>'Cafe Id is required'),'result'=>array('details'=>$this->obj));
                $this->displayOutput($response);
              }
            
              
              $condition2['user_id']=$ap['user_id'];
              $condition2['cafe_id']=$ap['cafe_id'];
              $existing_data=$this->mapi->getRow('wishlist',$condition2);
              // print_r($existing_data); die;
              if(!empty($existing_data))
              {
                $response=array('status'=>array('error_code'=>1,'message'=>'This cafe already added to your wishlist'),'result'=>array('details'=>''));
                  $this->displayOutput($response);
              }
              else{         
                  $udata['user_id']=$ap['user_id'];
                  $udata['cafe_id']=$ap['cafe_id'];
                  $wishlist_id=$this->mapi->insert('wishlist',$udata);

                  if($wishlist_id>0)
                  {
                
                    $msg="Added to wishlist successfully";
                    $response=array('status'=>array('error_code'=>0,'message'=>$msg),'result'=>array('details'=>''));
                  }
                  else
                  {
                  $msg="Please try again";
                  $response=array('status'=>array('error_code'=>1,'message'=>$msg),'result'=>array('details'=>$this->obj));
                  }
                 }
          }   
          else{
            $response=array('status'=>array('error_code'=>1,'message'=>'Please fill up all required fields'),'result'=>array('details'=>$this->obj));
                }
    }else{
      $response=array('status'=>array('error_code'=>1,'message'=>'Wrong http method type'),'result'=>array('details'=>$this->obj));
    }
    $this->displayOutput($response);
  }

  //remove fav
  public function removeWishlist(){ 
    $data=array();
    $udata=array();
    $mail=array();
    $header=array();
    $ap=json_decode(file_get_contents('php://input'), true);
    if($this->checkHttpMethods($this->http_methods[0])){
      if(sizeof($ap)){
              if(empty($ap['user_id'])){
                $response=array('status'=>array('error_code'=>1,'message'=>'User Id is required'),'result'=>array('details'=>$this->obj));
                $this->displayOutput($response);
              }
            
              if(empty($ap['cafe_id'])){
                $response=array('status'=>array('error_code'=>1,'message'=>'Cafe Id is required'),'result'=>array('details'=>$this->obj));
                $this->displayOutput($response);
              }
            
              
              $condition2['user_id']=$ap['user_id'];
              $condition2['cafe_id']=$ap['cafe_id'];
              $existing_data=$this->mapi->getRow('wishlist',$condition2);
              // print_r($existing_data); die;
              if(empty($existing_data))
              {
                $response=array('status'=>array('error_code'=>1,'message'=>'This cafe does not exist in your wishlist'),'result'=>array('details'=>''));
                  $this->displayOutput($response);
              }
              else{         
                  $udata['user_id']=$ap['user_id'];
                  $udata['cafe_id']=$ap['cafe_id'];
                  $response_query=$this->mapi->delete('wishlist',$udata);

                  if($response_query)
                  {
                
                    $msg="Removed from wishlist successfully";
                    $response=array('status'=>array('error_code'=>0,'message'=>$msg),'result'=>array('details'=>''));
                  }
                  else
                  {
                    $msg="Please try again";
                    $response=array('status'=>array('error_code'=>1,'message'=>$msg),'result'=>array('details'=>$this->obj));
                  }
                 }
          }   
          else{
            $response=array('status'=>array('error_code'=>1,'message'=>'Please fill up all required fields'),'result'=>array('details'=>$this->obj));
                }
    }else{
      $response=array('status'=>array('error_code'=>1,'message'=>'Wrong http method type'),'result'=>array('details'=>$this->obj));
    }
    $this->displayOutput($response);
  }

  //fav list
  public function myWishlist(){
    $ap=json_decode(file_get_contents('php://input'), true);
    if($this->checkHttpMethods($this->http_methods[0])){
      if(sizeof($ap)){
          if(empty($ap['user_id'])){
            $response=array('status'=>array('error_code'=>1,'message'=>'User id is required'),'result'=>array('details'=>$this->obj));
            $this->displayOutput($response);
          }

          ////////////////////////////////////////////////////////////////////////
          $order_col='id';
          $order_type='DESC';
          $start="";
          $limit="";
          ////////////////////////////for pagination params/////////////////////////////
          if(isset($ap['page_number'])&&$ap['page_number']>0&&isset($ap['number_of_data'])&&$ap['number_of_data']>0)
          {
             $page = $ap['page_number'];
             $page_no=$page-1;
             $limit=$ap['number_of_data'];
             $start=$page_no*$limit;
          }
          //////////////////////////////////////////////////////////////////////////////
          $condition['user_id']=$ap['user_id'];
          ////////////////////////get total count///////////////////////////////////////
          $total_count=0;
          $total_count=$this->mapi->get_data_total_count('wishlist',$condition);
          $wishList = $this->mapi->getRows('wishlist',$condition,$order_col,$order_type,$start,$limit);

      /////////////////////////////////////////////////////////////////////////////////
      $List=array();
       for($i=0;$i<count($wishList);$i++)
       {
          $condition=array();
          $condition['cafe_id']=$wishList[$i]['cafe_id'];
          //check is deleted cafe or active
          $condition['is_delete']=0;
          $condition['status']=1;
          
          $table="master_cafe";
          $user_id=$ap['user_id'];
          $wishlistArr= $this->mapi->get_data_row($table,$condition,$user_id);
          if(!empty($wishlistArr)){   
            $List[$i]=$wishlistArr;
          }
        }
       // print_r($List);
       $result = [];
       if($List){
        foreach ($List as $key => $value) {
          $result[] = $value;
        }
       }
       $List =  $result;
      if(count($List) > 0){
        $c = 0;
        for($i=0;$i<count($List);$i++){
          if(isset($List[$i])){
          $tr = round($List[$i]['avg_rating'], 0);
          $List[$i]['cafe_name']= $List[$i]['cafe_name']."-".$List[$i]['cafe_place'] ; 
          $List[$i]['avg_rating']= $tr;  
            if(!empty($List[$i]['images']))
            {
              for($k=0;$k<count($List[$i]['images']);$k++){
                $List[$i]['images'][$k]['image']=base_url()."public/upload_images/cafe_images/".$List[$i]['images'][$k]['image'];
              }
            }
          }
         }
        
        $response=array('status'=>array('error_code'=>0,'message'=>'success'),'result'=>array('total_count'=>count($List),'list'=>$List));
      }else{
        $response=array('status'=>array('error_code'=>0,'message'=>'No data found'),'result'=>array('list'=>$this->arr));
      }
     }else{
            $response=array('status'=>array('error_code'=>1,'message'=>'Please fill up all required fields'),'result'=>array('details'=>$this->obj));
          }
    }else{
      $response=array('status'=>array('error_code'=>1,'message'=>'Wrong http method type'),'result'=>array('details'=>$this->obj));
    }
    
    $this->displayOutput($response);
  }

  //movie cat list
  public function movieCategoryList(){
    $ap=json_decode(file_get_contents('php://input'), true);
    // if($this->checkHttpMethods($this->http_methods[0])){
    //   if(sizeof($ap)){
    //           if(empty($ap['user_id'])){
    //             $response=array('status'=>array('error_code'=>1,'message'=>'User id is required'),'result'=>array('details'=>$this->obj));
    //             $this->displayOutput($response);
    //           }

          ////////////////////////////////////////////////////////////////////////
          $order_col='category_id';
          $order_type='DESC';
          $start="";
          $limit="";
          ////////////////////////////for pagination params/////////////////////////////
          if(isset($ap['page_number'])&&$ap['page_number']>0&&isset($ap['number_of_data'])&&$ap['number_of_data']>0)
          {
             $page = $ap['page_number'];
             $page_no=$page-1;
             $limit=$ap['number_of_data'];
             $start=$page_no*$limit;
          }
          //////////////////////////////////////////////////////////////////////////////
          $condition['status']=1;
          $condition['is_delete']=0;
          ////////////////////////get total count///////////////////////////////////////
          $total_count=0;
          $table="movie_category";
          $total_count=$this->mapi->get_data_total_count($table,$condition);
          $List = $this->mapi->getRows($table,$condition,$order_col,$order_type,$start,$limit);

      /////////////////////////////////////////////////////////////////////////////////
      
      //echo $this->db->last_query();die;
      if(!empty($List)){

        $response=array('status'=>array('error_code'=>0,'message'=>'success'),'result'=>array('total_count'=>$total_count,'list'=>$List));
      }else{
        $response=array('status'=>array('error_code'=>0,'message'=>'No data found'),'result'=>array('list'=>$this->arr));
      }
     
    
    $this->displayOutput($response);
  }

  //movie list
  public function movieList(){
    $ap=json_decode(file_get_contents('php://input'), true);
    if($this->checkHttpMethods($this->http_methods[0])){
      if(sizeof($ap)){
    //           if(empty($ap['user_id'])){
    //             $response=array('status'=>array('error_code'=>1,'message'=>'User id is required'),'result'=>array('details'=>$this->obj));
    //             $this->displayOutput($response);
    //           }

          ////////////////////////////////////////////////////////////////////////
          $order_col='movie_id';
          $order_type='DESC';
          $start="";
          $limit="";
          ////////////////////////////for pagination params/////////////////////////////
          if(isset($ap['page_number'])&&$ap['page_number']>0&&isset($ap['number_of_data'])&&$ap['number_of_data']>0)
          {
             $page = $ap['page_number'];
             $page_no=$page-1;
             $limit=$ap['number_of_data'];
             $start=$page_no*$limit;
          }
          //////////////////////////////////////////////////////////////////////////////
          $condition['movie.status']=1;
          $condition['movie.is_delete']=0;
          ///category id
          if(isset($ap['category_id'])&&$ap['category_id']>0)
          {
            $condition['movie.category_id']=$ap['category_id'];
          }

          ///movie id
          if(isset($ap['movie_id'])&&$ap['movie_id']>0)
          {
            $condition['movie.movie_id']=$ap['movie_id'];
          }
          $cafe_id="";
          if(isset($ap['cafe_id'])&&$ap['cafe_id']>0)
          {
            $cafe_id=$ap['cafe_id'];
          }
          $user_id="";
          ////////////////////////get total count///////////////////////////////////////
          $total_count=0;
          $table="movie";
          $total_count=$this->mapi->get_data_total_count($table,$condition);
          $List = $this->mapi->getMovieList($table,$condition,$order_col,$order_type,$start,$limit,$user_id,$cafe_id);

          //echo $this->db->last_query(); die;
          if(!empty($List)){
            for($i=0;$i<count($List);$i++){  
              $movie_id=$List[$i]['movie_id'];
              /*
                get room tagged images
              */
              $select = "(IF(mi.image !='',CONCAT('".base_url()."public/upload_images/movie_images/',mi.image),'".base_url()."public/upload_images/No_Image_Available.jpg')) as image";
              $movie_images = $this->mcommon->select('movie_images mi', ['mi.movie_id'=> $movie_id], $select);
              if($movie_images){
                $List[$i]['image'] = $movie_images[0]->image;
              }else{
                $List[$i]['image'] = base_url('public/upload_images/No_Image_Available.jpg');
              }
              $List[$i]['images'] = $movie_images;
              }
            $response=array('status'=>array('error_code'=>0,'message'=>'success'),'result'=>array('total_count'=>$total_count,'list'=>$List));
          }else{
            $response=array('status'=>array('error_code'=>0,'message'=>'No data found'),'result'=>array('list'=>$this->arr));
          }
      /////////////////////////////////////////////////////////////////////////////////
      }else{
            $response=array('status'=>array('error_code'=>1,'message'=>'Please fill up all required fields'),'result'=>array('details'=>$this->obj));
          }
    }else{
      $response=array('status'=>array('error_code'=>1,'message'=>'Wrong http method type'),'result'=>array('details'=>$this->obj));
    }
      
     
    
    $this->displayOutput($response);
  }

  ////food 

  //food category list
  public function foodCategoryList(){
    $ap=json_decode(file_get_contents('php://input'), true);
    // if($this->checkHttpMethods($this->http_methods[0])){
    //   if(sizeof($ap)){
    //           if(empty($ap['user_id'])){
    //             $response=array('status'=>array('error_code'=>1,'message'=>'User id is required'),'result'=>array('details'=>$this->obj));
    //             $this->displayOutput($response);
    //           }

          ////////////////////////////////////////////////////////////////////////
          $order_col='category_id';
          $order_type='DESC';
          $start="";
          $limit="";
          ////////////////////////////for pagination params/////////////////////////////
          if(isset($ap['page_number'])&&$ap['page_number']>0&&isset($ap['number_of_data'])&&$ap['number_of_data']>0)
          {
             $page = $ap['page_number'];
             $page_no=$page-1;
             $limit=$ap['number_of_data'];
             $start=$page_no*$limit;
          }
          //////////////////////////////////////////////////////////////////////////////
          $condition['status']=1;
          $condition['is_delete']=0;
          ////////////////////////get total count///////////////////////////////////////
          $total_count=0;
          $table="food_category";
          $total_count=$this->mapi->get_data_total_count($table,$condition);
          $List = $this->mapi->getRows($table,$condition,$order_col,$order_type,$start,$limit);

      /////////////////////////////////////////////////////////////////////////////////
      
      //echo $this->db->last_query();die;
      if(!empty($List)){

        $response=array('status'=>array('error_code'=>0,'message'=>'success'),'result'=>array('total_count'=>$total_count,'list'=>$List));
      }else{
        $response=array('status'=>array('error_code'=>0,'message'=>'No data found'),'result'=>array('list'=>$this->arr));
      }
     
    
    $this->displayOutput($response);
  }

  //foodt list
  public function foodList(){
    $ap=json_decode(file_get_contents('php://input'), true);
    if($this->checkHttpMethods($this->http_methods[0])){
      if(sizeof($ap)){
    //           if(empty($ap['user_id'])){
    //             $response=array('status'=>array('error_code'=>1,'message'=>'User id is required'),'result'=>array('details'=>$this->obj));
    //             $this->displayOutput($response);
    //           }

          ////////////////////////////////////////////////////////////////////////
          $order_col='food_id';
          $order_type='DESC';
          $start="";
          $limit="";
          ////////////////////////////for pagination params/////////////////////////////
          if(isset($ap['page_number'])&&$ap['page_number']>0&&isset($ap['number_of_data'])&&$ap['number_of_data']>0)
          {
             $page = $ap['page_number'];
             $page_no=$page-1;
             $limit=$ap['number_of_data'];
             $start=$page_no*$limit;
          }
          //////////////////////////////////////////////////////////////////////////////
          $condition['food.status']=1;
          $condition['food.is_delete']=0;
          ///category id
          if(isset($ap['category_id'])&&$ap['category_id']>0)
          {
            $condition['food.category_id']=$ap['category_id'];
          }

          ///movie id
          if(isset($ap['food_id'])&&$ap['food_id']>0)
          {
            $condition['food.food_id']=$ap['food_id'];
          }
          ////////////////////////get total count///////////////////////////////////////
          $total_count=0;
          $table="food";
          $total_count=$this->mapi->get_data_total_count($table,$condition);
          $List = $this->mapi->getFoodList($table,$condition,$order_col,$order_type,$start,$limit);

          //echo $this->db->last_query();die;
          if(!empty($List)){

            $response=array('status'=>array('error_code'=>0,'message'=>'success'),'result'=>array('total_count'=>$total_count,'list'=>$List));
          }else{
            $response=array('status'=>array('error_code'=>0,'message'=>'No data found'),'result'=>array('list'=>$this->arr));
          }
      /////////////////////////////////////////////////////////////////////////////////
      }else{
            $response=array('status'=>array('error_code'=>1,'message'=>'Please fill up all required fields'),'result'=>array('details'=>$this->obj));
          }
    }else{
      $response=array('status'=>array('error_code'=>1,'message'=>'Wrong http method type'),'result'=>array('details'=>$this->obj));
    }
      
     
    
    $this->displayOutput($response);
  }

  //room list
  public function roomList(){
    $ap=json_decode(file_get_contents('php://input'), true);
    if($this->checkHttpMethods($this->http_methods[0])){
      if(sizeof($ap)){
              // if(empty($ap['user_id'])){
              //   $response=array('status'=>array('error_code'=>1,'message'=>'User id is required'),'result'=>array('details'=>$this->obj));
              //   $this->displayOutput($response);
              // }
        if(empty($ap['cafe_id'])){
                $response=array('status'=>array('error_code'=>1,'message'=>'Cafe id is required'),'result'=>array('details'=>$this->obj));
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
            //added on 22-12
        if (empty($ap['no_of_people'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Room capacity is required';
          //$response['response']   = $this->obj;          
          $this->displayOutput($response);
        } 
            if(!empty($ap['reservation_date'])) {
            $date=$ap['reservation_date'];
            $format="d/m/Y";

            // if(!validateDate($date,$format))
            // {
            //   $response['status']['error_code'] = 1;
            //         $response['status']['message']    = 'Date format is wrong.It should be d/m/y';
             
            //         $this->displayOutput($response);
            // } 
            //else {
                $dateArr=explode("/",$date) ;
                $reservation_date=$dateArr[2]."-".$dateArr[1]."-".$dateArr[0];  
                 // }              
          }       
          ////////////////////////////////////////////////////////////////////////
          $order_col='room_id';
          $order_type='DESC';
          $start="";
          $limit="";
          ////////////////////////////for pagination params/////////////////////////////
          if(isset($ap['page_number'])&&$ap['page_number']>0&&isset($ap['number_of_data'])&&$ap['number_of_data']>0)
          {
             $page = $ap['page_number'];
             $page_no=$page-1;
             $limit=$ap['number_of_data'];
             $start=$page_no*$limit;
          }
          //////////////////////////////////////////////////////////////////////////////
          $condition['room.status']=1;
          $condition['room.is_delete']=0;
          //added to filter member capacity for a room
          $condition['room.no_of_people >=']= (int)$ap['no_of_people'];

          ///category id
          if(isset($ap['cafe_id'])&&$ap['cafe_id']>0)
          {
            $condition['room.cafe_id']=$ap['cafe_id'];
          }

          
          ////////////////////////get total count///////////////////////////////////////
          $total_count=0;
          $table="room";
          $total_count=$this->mapi->get_data_total_count($table,$condition);
          $List = $this->mapi->getAvailableRoomList($table,$condition,$order_col,$order_type,$start,$limit);
          //echo $this->db->last_query(); die;
        
          $reservation_time=DATE('H:i:s',strtotime($ap["reservation_time"]));
          $duration=$ap['duration'];

          $selectedTime             = $reservation_time;
          $start_time_range         = date('H:i:s',strtotime($selectedTime));
          $end_time_range           = date('H:i:s',strtotime("+".$duration." hours", strtotime($selectedTime)));
          
          //echo $this->db->last_query();die;
          if(!empty($List)){
            $list_array = array();
            ///checking available status
            for($i=0;$i<count($List);$i++){
              $room_id=$List[$i]['room_id'];
              //check availability
              // $reservation_date = date("Y-m-d", strtotime(str_replace('/', '-', $date)));
              // $reservation_time=DATE('H:i:s',strtotime($ap["reservation_time"]));
              //$availability_status=$this->is_available($reservation_date,$room_id,$reservation_time,$duration);

              /*
                get room tagged images
              */
              $select = "(IF(ri.image !='',CONCAT('".base_url()."public/upload_images/room_images/',ri.image),'".base_url()."public/upload_images/No_Image_Available.jpg')) as image";
              $room_images = $this->mcommon->select('room_images ri', ['ri.room_id'=> $room_id], $select);
              if($room_images){
                $List[$i]['image'] = $room_images[0]->image;
              }else{
                $List[$i]['image'] = base_url('public/upload_images/No_Image_Available.jpg');
              }
              $List[$i]['images'] = $room_images;
              $booked_status=0;
              //////////////////////////wishlist & cart checking/////////////////////
              $availability_status=$this->is_available($reservation_date,$room_id,$reservation_time,$duration);
         
              if($availability_status!=0){
                $booked_status=1;
              }
              $List[$i]['booked_status']=$booked_status;
              if($booked_status == 0){
                $list_array[] = $List[$i];
              }
             }
            

            /////////////////////////////
            $response=array('status'=>array('error_code'=>0,'message'=>'success'),'result'=>array('total_count'=>count($list_array),'list'=>$list_array));
          }else{
            $response=array('status'=>array('error_code'=>0,'message'=>'No data found'),'result'=>array('list'=>$this->arr));
          }
      /////////////////////////////////////////////////////////////////////////////////
      }else{
            $response=array('status'=>array('error_code'=>1,'message'=>'Please fill up all required fields'),'result'=>array('details'=>$this->obj));
          }
    }else{
      $response=array('status'=>array('error_code'=>1,'message'=>'Wrong http method type'),'result'=>array('details'=>$this->obj));
    }
      
     
    
    $this->displayOutput($response);
  }

  // do reservation
//   public function doReservation_bk()
//   {
//     $result  = array();
//     $ap=json_decode(file_get_contents('php://input'), true);
//     //print_r($ap); die;
//     if($this->checkHttpMethods($this->http_methods[0])){
//       if(sizeof($ap)) {
//         if (empty($ap['name'])) {
//           $response['status']['error_code'] = 1;
//           $response['status']['message']    = 'Name is required';
//           //$response['response']   = $this->obj;
//           $this->displayOutput($response);
//         }
   
//         if (empty($ap['email'])) {
//           $response['status']['error_code'] = 1;
//           $response['status']['message']    = 'Email field is required';
//           //$response['response']   = $this->obj;
          
//           $this->displayOutput($response);
//         }

//         if (empty($ap['mobile'])) {
//           $response['status']['error_code'] = 1;
//           $response['status']['message']    = 'Phone no. is required';
//           //$response['response']   = $this->obj;          
//           $this->displayOutput($response);
//         }

//         if (empty($ap['no_of_guests'])) {
//           $response['status']['error_code'] = 1;
//           $response['status']['message']    = 'No. of guests is required';
//           //$response['response']   = $this->obj;          
//           $this->displayOutput($response);
//         }      

//         if (empty($ap['reservation_date'])) {
//           $response['status']['error_code'] = 1;
//           $response['status']['message']    = 'Reservation date is required';
//           //$response['response']   = $this->obj;          
//           $this->displayOutput($response);
//         }

//         if (empty($ap['reservation_time'])) {
//           $response['status']['error_code'] = 1;
//           $response['status']['message']    = 'Reservation time  is required';
//           //$response['response']   = $this->obj;          
//           $this->displayOutput($response);
//         }   

//         if (empty($ap['cafe_id'])) {
//           $response['status']['error_code'] = 1;
//           $response['status']['message']    = 'cafe id is required';
//           //$response['response']   = $this->obj;          
//           $this->displayOutput($response);
//         }

//         if (empty($ap['duration'])) {
//           $response['status']['error_code'] = 1;
//           $response['status']['message']    = 'duration is required';
//           //$response['response']   = $this->obj;          
//           $this->displayOutput($response);
//         } 

//         /*
//           ***************** make room_is as potional as discussed *********************
//           if (empty($ap['room_id'])) {
//             $response['status']['error_code'] = 1;
//             $response['status']['message']    = 'Room id is required';
//             //$response['response']   = $this->obj;          
//             $this->displayOutput($response);
//           }
//         */
//         //if(!empty($ap['reservation_date'])) {
//             // $date=$ap['reservation_date'];
//             // $format="d/m/Y";

//             // if(!validateDate($date,$format))
//             // {
//             //   $response['status']['error_code'] = 1;
//             //         $response['status']['message']    = 'Date format is wrong.It should be d/m/y';
            
//             //         $this->displayOutput($response);
//             // } 
//             //else {
//               // $dateArr=explode("/",$date) ;
//               // $reservation_date=$dateArr[2]."-".$dateArr[1]."-".$dateArr[0]; 

//               // //chk if its past date then reject request
//               // $curDateTime = date("Y-m-d H:i");
//               // $reservation_date_time = date("Y-m-d H:i", strtotime($reservation_date." ".$ap['reservation_time']));
//               //   if($curDateTime>=$reservation_date_time)
//               //   {
//               //     $response['status']['error_code'] = 1;
//               //     $response['status']['message']    = 'Please select some date time in future';
              
//               //     $this->displayOutput($response);
//               //   }
//                 // }              
//               //}
//         //}  

//         if (empty($ap['user_id'])) {
//           $response['status']['error_code'] = 1;
//           $response['status']['message']    = 'user id is required';
//           //$response['response']   = $this->obj;          
//           $this->displayOutput($response);
//         }

//         if (empty($ap['total_amount'])) {
//               $response['status']['error_code'] = 1;
//               $response['status']['message']    = 'Total amount is required';
//               //$response['response']   = $this->obj;          
//               $this->displayOutput($response);
//             }

//           if (empty($ap['transaction_id'])) {
//           $response['status']['error_code'] = 1;
//           $response['status']['message']    = 'Transaction id is required';
//           //$response['response']   = $this->obj;          
//           $this->displayOutput($response);
//         }

//         if (empty($ap['payment_mode'])) {
//           $response['status']['error_code'] = 1;
//           $response['status']['message']    = 'Payment mode is required wallet or paytm';
//           //$response['response']   = $this->obj;          
//           $this->displayOutput($response);
//         }
//         $user_id = $ap['user_id'];

//         //$access_token         = $ap['access_token'];  
//         //$device_type          = $ap['device_type'];

//         // $access_token_result  = $this->check_access_token($access_token, $device_type,$user_id);

//         // if (empty($access_token_result)) {
//         //   $response['status']['error_code'] = 1;
//         //   $response['status']['message']    = 'Unauthorize Token';        
//         //   $this->displayOutput($response);
//         // }
//         //else{

//         /////set the booking duration
//         $movie_id="";
//         if(isset($ap['movie_id'])&&$ap['movie_id']>0)
//         {
//           $movie_id=$ap['movie_id'];
//           // if($ap['duration'] < 3)
//           // {
//           //   $response['status']['error_code'] = 1;
//           //   $response['status']['message']    = 'Duration should be atleast 3 hour for movie';         
//           //   $this->displayOutput($response);
//           // }
//         }
            
//                 $roomsList = $this->mcommon->select('room', ['cafe_id'=> $ap['cafe_id'], 'is_delete'=> 0], '*', 'room_id');
//                 if(empty($roomsList)){
//                   $response['status']['error_code']  = 1;
//                    $response['status']['message']    = 'Opp!Sorry the Cafe is already reserved for the given date & time';
//                    $this->displayOutput($response);
//                 }

//                 $isAvailable = false;
//                 foreach($roomsList as $value){
//                   $reservation_time=date('H:i',strtotime($ap["reservation_time"]));
//                   $duration=$ap['duration'];

//                   $selectedTime             = $reservation_time;
//                   $start_time_range         = date('H:i',strtotime($selectedTime));
//                   $end_time_range           = date('H:i',strtotime("+".$duration." hours", strtotime($selectedTime)));

//                   $availability_status=$this->is_available($reservation_date, $value->room_id, $reservation_time, $duration);
//                   if($availability_status == 0){
//                     $isAvailable = true;
//                   }
//                 }
//                  if(!$isAvailable){
//                    $response['status']['error_code']           = 1;
//                    $response['status']['message']              = 'Opp!Sorry the room is already reserved for the given date & time';
//                    $this->displayOutput($response);
//                  }
//                  else
//                 {
//                     $each_price="100";
//                     //$total_price=$each_price*$ap['no_of_guests']*$ap['duration'];
//                     $total_price=$ap['total_amount'];
//                     $message="";
//                     if(isset($ap['message'])&&$ap['message']!="")
//                     {
//                       $message=$ap['message'];
//                     }
//                     $media_type="";
//                     if(isset($ap['media_type'])&&$ap['media_type']!="")
//                     {
//                       $media_type=$ap['media_type'];
//                     }
//                    //  if(intval($total_price)!=intval($ap['total_amount'])){
                    
//                    //   $response['status']['error_code']           = 1;
//                    //   $response['status']['message']              = 'Total amount is not matching with guest and duration';

//                    //   $this->displayOutput($response);
//                    // }
//                    $discount_amount="0.00";
//                    $payable_amount="";
//                    $coupon_code="";
//                    if(isset($ap['discount_amount'])&&$ap['discount_amount']!="")
//                     {
//                       $discount_amount=$ap['discount_amount'];
//                     }
//                     if(isset($ap['payable_amount'])&&$ap['payable_amount']!="")
//                     {
//                       $payable_amount=$ap['payable_amount'];
//                     }
//                     if(isset($ap['coupon_code'])&&$ap['coupon_code']!="")
//                     {
//                       $coupon_code=$ap['coupon_code'];
//                     }
//                     if($payable_amount=="")
//                     {
//                       $payable_amount=$total_price;
//                     }

//                     //for memebership discount 
//                     $membership_discount_amount="";
//                     $membership_discount_percent="";
//                     $membership_package_id="";
//                     if(isset($ap['membership_discount_amount'])&&$ap['membership_discount_amount']!="")
//                     {
//                       $membership_discount_amount=$ap['membership_discount_amount'];
//                     }
//                     if(isset($ap['membership_discount_percent'])&&$ap['membership_discount_percent']!="")
//                     {
//                       $membership_discount_percent=$ap['membership_discount_percent'];
//                     }
//                     if(isset($ap['membership_package_id'])&&$ap['membership_package_id']!="")
//                     {
//                       $membership_package_id=$ap['membership_package_id'];
//                     }

//                   ////wallet balance check
//                   if($ap['payment_mode']=="wallet")
//                   {
//                     $wallet_response_status=$this->deductWalllet($user_id,$payable_amount);
//                   }
                  
//                   //reservation_no creation 
//                   $counter_details  = $this->mcommon->getRow("reservation", array('cafe_id'=>$ap['cafe_id']), 'reservation_id desc');
//                   $cafe_place       = $this->mcommon->getRow("master_cafe", array('cafe_id'=>$ap['cafe_id']))['cafe_place'];
//                   $final_cafe_place = substr($cafe_place, 0, 5);
                  
//                   // if($counter_details['cafe_id_serial_no']==''){
//                   //     $counter = 1;
//                   // }else{
//                   //     $counter = $counter_details['cafe_id_serial_no'] + 1;            
//                   // }
//                   // $final_counter = str_pad($counter, 4, '0', STR_PAD_LEFT);        
//                   // $reservation_no = $final_cafe_place.'/'.date('m').'/'.date('Y').'/'.$final_counter;
//                   //echo $reservation_no;exit;
                  
//                   $created_on_arr = explode('-', $counter_details['created_on']);
//                   $created_on_month = $created_on_arr[1];
//                   if($created_on_month != date('m')){
//                       $counter = 1;
//                   }elseif($counter_details['cafe_id_serial_no']==''){
//                       $counter = 1;
//                   }else{
//                       $counter = $counter_details['cafe_id_serial_no'] + 1;            
//                   }
//                   $final_counter = str_pad($counter, 4, '0', STR_PAD_LEFT);        
//                   $reservation_no = $final_cafe_place.'/'.date('m').'/'.date('Y').'/'.$final_counter; 

//                   //////////////////////////
//                     $insrtarry    = array('reservation_date'      =>  $reservation_date,
//                                           'reservation_time'      =>  $reservation_time,
//                                           'reservation_end_time'  =>  $end_time_range,
//                                           'duration'              =>  $duration,
//                                           'cafe_id'               =>  $ap['cafe_id'],
//                                           'no_of_guests'          =>  $ap['no_of_guests'],
//                                           'total_price'           =>  $total_price,
//                                           'room_id'               =>  0,  //room is is removed from list as discussed
//                                           'user_id'               =>  $user_id,
//                                           'name'                  =>  $ap['name'],
//                                           'email'                 =>  $ap['email'],
//                                           'country_code'          =>  $ap['country_code'],
//                                           'mobile'                =>  $ap['mobile'],
//                                           'movie_id'              =>  $movie_id,
//                                           'add_from'              => 'front',
//                                           'message'               =>  $message,
//                                           'coupon_code'           =>  $coupon_code,
//                                           'discount_amount'       =>  $discount_amount,
//                                           'membership_package_id'  => $membership_package_id,
//                                           'membership_discount_amount'  =>$membership_discount_amount,
//                                           'membership_discount_percent'  =>$membership_discount_percent,
//                                           'payable_amount'        =>$payable_amount,
//                                           'payment_mode'          =>$ap['payment_mode'],    //added after discussion
//                                           'media_type'            => $media_type,
//                                           'status'                => '1',
//                                           'reservation_type'      => 'App',
//                                           'created_by'            => $user_id,
//                                           'created_on'            => date('Y-m-d'),
                                          
//                                           'cafe_id_serial_no' => $final_counter,
//                                           'reservation_no' => $reservation_no
                                          
//                                         );
//                     /**
//                      *  Add cafe price while saving as discussed
//                      * on 10-02-2021
//                     */
//                     if(isset($ap['cafe_price'])){
//                       $insrtarry['cafe_price'] = $ap['cafe_price'];
//                     }

//                     $reservation_id     = $this->mapi->insert('reservation',$insrtarry);
                    
//                     if($reservation_id)
//                     {
//                       /**
//                        * Food app option with reservation
//                       */
//                       if(isset($ap['order_id']) && !empty($ap['order_id'])){
//                         $invoice = '';
//                         $order_array = [];
//                         $order_array['food_order_status_id']= 1;   // Paid
//                         $order_array['order_status']= 1;   // Paid
//                         $order_array['status']= 1;   // Paid
//                         $order_array['invoice_url']= $invoice!=""?$invoice:null;   // Paid

//                         $this->mcommon->update('food_orders', ['food_order_id'=> $ap['order_id']],  $order_array);

//                         //insert into reservation order
//                         $this->mcommon->insert('reservation_orders', ['reservation_id'=> $reservation_id, 'order_id'=> $ap['order_id'], 'user_id'=> $user_id]);
//                         //remove hide items from list
//                         $order_items = $this->mcommon->select('food_order_items', ['food_order_id'=> $ap['order_id']], '*');
//                         foreach($order_items as $item){
//                           $availability = $this->mapi->getItemAvailabilityDetails($this->request_day, $this->request_time, $item->item_id);
//                           // $availability->price;
//                           // $availability->is_seen;
//                           if(!empty(!$availability)){
//                             if($availability->is_seen == 0){
//                               $this->db->where('food_order_item_id', $item->food_order_item_id);
//                               $this->db->delete('food_order_items');
//                             }
//                           }
//                         }
//                         //update coupon
//                         $this->mcommon->update('food_apply_coupon', ['user_id'=> $ap['user_id'], 'applied_status'=> 0], ['applied_status'=> 1, 'food_order_id'=> $ap['order_id']]);

//                         $trans_array = array(
//                           'food_order_id'=> $ap['order_id'],
//                           'transaction_id'=> $ap['transaction_id'],
//                           'source'=> 'App',
//                         );

//                         $this->mcommon->insert('food_order_transactions', $trans_array);

//                         //clear cart after check functionality
//                         $this->db->where(['user_id'=> $ap['user_id']]);
//                         $this->db->delete('food_cart_items');
//                       }

//                         ///insert to transaction table//////////////////////////////////
//                           $pck_trans_array_data   = array('transaction_id'    => $ap['transaction_id'],
//                                         'reservation_id'  => $reservation_id,
//                                         'user_id'         => $user_id,
//                                         'added_form'        => 'front',
//                                         'amount'            => $payable_amount,                  
//                                         'payment_mode'      => $ap['payment_mode'],
//                                         'payment_status'    => '1',
//                                         'transaction_type'  =>'Reservation'
//                                         );
//                       $this->mcommon->insert('transaction_history',$pck_trans_array_data);
//                         ///////////////////////////////////////////////////////////////
//                       ////Notification////////////////////////////////////////////
//                       //get cafe 
//                       $condition_cafe['cafe_id']=$ap['cafe_id'];
//                       $cafe_row=$this->mapi->getRow("master_cafe",$condition_cafe);
//                         $notification_title="Reservation Confirmed";
//                         $notification_des= $ap['name'].' reservation request for '.$cafe_row['cafe_name']."-".$cafe_row['cafe_place'].' on '.$reservation_date.' at '.$reservation_time.' is approved';
//                         $this->add_notification($user_id,$notification_title,$notification_des,$reservation_id);
//                       /** Notification ends here.............................**/

//                       /********************************** Send reservation details in sms *************************************************/

//                           // $message  = "Thank you for confirming your Reservation at ".ORGANIZATION_NAME.". Your reservation details are: \n";
//                           // $message .= "Cafe: ".$cafe_row['cafe_name']."-".$cafe_row['cafe_place']."\n Date: ".$reservation_date."\n Time: ".$reservation_time."\n No. of Guests: ".$ap['no_of_guests'];
//                           // $message .= " We would be holding your reservation for 15 minutes from the time of reservation and it will be released without any prior information.";
                          
//                           //$message  = "Dear ".$ap['name']." \n";
//                           //$message  .= "Thank you for confirming your Reservation at Cinecafes.".". \n"; 
//                           //$message  .= "Your reservation details are: \n";
//                           //$message  .="Cafe: ".$cafe_row['cafe_name']."-".$cafe_row['cafe_place']." \n";
//                           //$message  .="Date: ".$reservation_date." \n";
//                           //$message  .="Time: ".$reservation_time." \n";
//                           //$message  .="No. of Guests: ".$ap['no_of_guests'].". \n";
//                           //$message  .= "We would be holding your reservation for 15 minutes from the time of reservation and it will be released without any prior information.\n";
//                           //$message  .=ORGANIZATION_NAME;
//                           //smsSend($ap['mobile'],$message);
                          
//                           $template_id = '1207163653375517655';
//                           $message = "Dear ".$ap['name']."\n";
//                           $message .= "Thank you for confirming your Reservation at Cinecafes.\n";
//                           $message .= "Your reservation details are:\n";
//                           $message .= "Cafe: ".$cafe_row['cafe_name']."-".$cafe_row['cafe_place']."\n";
//                           $message .= "Date: ".$reservation_date."\n";
//                           $message .= "Time: ".$reservation_time."\n";
//                           $message .= "No. of Guests: ".$ap['no_of_guests']."\n";
//                           $message .= "CINE CAFES";
                          
//                           smsSend($ap['mobile'], $message, $template_id);
//                           if(ENVIRONMENT=='production')
//                           {
//                             smsSend(NANDINIMOBILE, $message, $template_id);
//                             smsSend(SUMNANMOBILE, $message, $template_id);
//                           }

//                         /********push notification fr reservation ************************/
//                         $title=$notification_title;
//                         $message   = "Your request for reservation is Confirmed.";
//                         $message_data = array('title' => $title,'message' => $message);
//                         $user_fcm_token_data  = $this->mcommon->getRow('device_token',array('user_id' => $user_id));
//                         //pr($user_fcm_token_data);
//                         if(!empty($user_fcm_token_data)){
//                           $member_datas  = $this->mcommon->getRow('user',array('user_id' => $user_id));
//                             if($member_datas['notification_allow_type'] == '1'){
//                                 if($user_fcm_token_data['device_type'] == 1){
//                                   $this->pushnotification->send_ios_notification($user_fcm_token_data['fcm_token'], $message_data);
//                                 }
//                                 else{
//                                   $this->pushnotification->send_android_notification($user_fcm_token_data['fcm_token'], $message_data);
//                                 }
//                             }

//                           }

//                           /*********Mail fn ...************************************************/
//                           $name=$ap['name'];
//                           $email=$ap['email'];
//                           $mail['name']       = $name;
//                           $mail['to']         = $email;    
//                           //$params['to']     = 'sreelabiswas.kundu@met-technologies.com';
                          
//                           $mail['subject']    = ORGANIZATION_NAME.' - Reservation request received';                             
//                           $mail_temp          = file_get_contents('./global/mail/reservation_template.html');
//                           $mail_temp          = str_replace("{web_url}", base_url(), $mail_temp);
//                           $mail_temp          = str_replace("{logo}", LOGOURL, $mail_temp);
//                           $mail_temp          = str_replace("{shop_name}", ORGANIZATION_NAME, $mail_temp);  
//                           $mail_temp          = str_replace("{name}", $mail['name'], $mail_temp);
                                  
//                           $mail_temp          = str_replace("{current_year}", date('Y'), $mail_temp); 

                          
//                           $mail_temp                = str_replace("{cafe_name}", $cafe_row['cafe_name']."-".$cafe_row['cafe_place'], $mail_temp);
//                           $mail_temp                = str_replace("{reservation_date}", $ap['reservation_date'], $mail_temp);
//                           $mail_temp                = str_replace("{reservation_time}", $ap['reservation_time'], $mail_temp);
//                           $mail_temp                = str_replace("{no_of_guests}", $ap['no_of_guests'], $mail_temp);
//                           $mail_temp                = str_replace("{reservation_status}", "Confirmed", $mail_temp);
//                           //echo $mail_temp; die;
//                           $mail['message']    = $mail_temp;
//                           $mail['from_email']    = FROM_EMAIL;
//                           $mail['from_name']    = ORGANIZATION_NAME;
//                           sendmail($mail); 

//                           if(ENVIRONMENT=='production')
//                           {
//                             // /************* Send Reservation details to the Admin ***************/
//                             $admin_cond               = array('role_id' => '1','status' =>'1');
//                             $admin_data               = $this->mcommon->getRow('user',$admin_cond);
//                             if(!empty($admin_data)){
//                               $admin_email            = $admin_data['email'];
//                               $admin_name             = $admin_data['name'];
//                             }
//                             else{
//                               $admin_email            = 'support@cinecafe.in';
//                               $admin_name             = 'admin';
//                             }     
//                             $mail['name']             = $admin_name;
//                             $mail['to']               = $admin_email;      
//                             $mail_temp                = str_replace("{name}", $mail['name'], $mail_temp);
//                             sendmail($mail);
                            
//                             // /************ Send Reservation details to NANDINI  ***************/
                            
//                             $mail['name']             = NANDININAME;
//                             $mail['to']               = NANDINIEMAIL;      
//                             $mail_temp                = str_replace("{name}", $mail['name'], $mail_temp);
//                             sendmail($mail);
                            
//                             // /************ Send Reservation details to Sharad ***************/
                
//                             $mail['name']             = 'Sharad';
//                             $mail['to']               = 'sharad@cinecafes.com';      
//                             $mail_temp                = str_replace("{name}", $mail['name'], $mail_temp);
//                             sendmail($mail);
                            
//                             // /************ Send Reservation details to respective cafe managers  ***************/
//                             if($ap['cafe_id']==57)
//                             {
//                               $mail['name']             = 'Manager Sec5';
//                               $mail['to']               = 'sec5@cinecafes.com';   
//                             }
                               
//                             $mail_temp                = str_replace("{name}", $mail['name'], $mail_temp);
//                             sendmail($mail);
//                           }
//                           /*************** mail ends*******************************************/ 
//                           /////////////////////////////////////////////////////////////////////////////
//                           $response['status']['error_code']           = 0;
//                           $response['status']['message']              = 'Your booking is confirmed.';
//                           $response['result']['reservation_id']       = $reservation_id;
//                       }
//                       else{
//                         $response['status']['error_code']           = 1;
//                         $response['status']['message']              = 'reservation cannot be saved';
//                       }                
//             }
//         //}
//       }
//       else {
//         $response['status']['error_code'] = 1;
//         $response['status']['message']    = 'Please fill up all required fields.';
//       }
//     } else {
//         $response['status']['error_code'] = 1;
//         $response['status']['message']    = 'Wrong http method type.';
//         //$response['response']   = $this->obj;      
//     }
//     $this->displayOutput($response);

//   }

//   // do reservation
//   public function doReservation_final()
//   {
//     $result  = array();
//     $ap=json_decode(file_get_contents('php://input'), true);
    
//     if($this->checkHttpMethods($this->http_methods[0])){
//       if(sizeof($ap)) {
//         if (empty($ap['name'])) {
//           $response['status']['error_code'] = 1;
//           $response['status']['message']    = 'Name is required';          
//           $this->displayOutput($response);
//         }
   
//         if (empty($ap['email'])) {
//           $response['status']['error_code'] = 1;
//           $response['status']['message']    = 'Email field is required';                    
//           $this->displayOutput($response);
//         }

//         if (empty($ap['mobile'])) {
//           $response['status']['error_code'] = 1;
//           $response['status']['message']    = 'Phone no. is required';          
//           $this->displayOutput($response);
//         }

//         if (empty($ap['no_of_guests'])) {
//           $response['status']['error_code'] = 1;
//           $response['status']['message']    = 'No. of guests is required';          
//           $this->displayOutput($response);
//         }      

//         if (empty($ap['reservation_date'])) {
//           $response['status']['error_code'] = 1;
//           $response['status']['message']    = 'Reservation date is required';          
//           $this->displayOutput($response);
//         }

//         if (empty($ap['reservation_time'])) {
//           $response['status']['error_code'] = 1;
//           $response['status']['message']    = 'Reservation time  is required';          
//           $this->displayOutput($response);
//         }   

//         if (empty($ap['cafe_id'])) {
//           $response['status']['error_code'] = 1;
//           $response['status']['message']    = 'cafe id is required';          
//           $this->displayOutput($response);
//         }

//         if (empty($ap['duration'])) {
//           $response['status']['error_code'] = 1;
//           $response['status']['message']    = 'duration is required';          
//           $this->displayOutput($response);
//         }               

//         if (empty($ap['user_id'])) {
//           $response['status']['error_code'] = 1;
//           $response['status']['message']    = 'user id is required';          
//           $this->displayOutput($response);
//         }

//         if (empty($ap['total_amount'])) {
//           $response['status']['error_code'] = 1;
//           $response['status']['message']    = 'Total amount is required';              
//           $this->displayOutput($response);
//         }

//         if (empty($ap['transaction_id'])) {
//           $response['status']['error_code'] = 1;
//           $response['status']['message']    = 'Transaction id is required';        
//           $this->displayOutput($response);
//         }

//         if (empty($ap['payment_mode'])) {
//           $response['status']['error_code'] = 1;
//           $response['status']['message']    = 'Payment mode is required wallet or paytm';          
//           $this->displayOutput($response);
//         }

//         $user_id = $ap['user_id'];

//         //set the booking duration
//         $movie_id="";
//         if(isset($ap['movie_id'])&&$ap['movie_id']>0)
//         {
//           $movie_id=$ap['movie_id'];          
//         }
            
//         $roomsList = $this->mcommon->select('room', ['cafe_id'=> $ap['cafe_id'], 'is_delete'=> 0], '*', 'room_id');
//         if(empty($roomsList)){
//           $response['status']['error_code']  = 1;
//           $response['status']['message']    = 'Opp!Sorry the Cafe is already reserved for the given date & time';
//           $this->displayOutput($response);
//         }

//         $isAvailable = false;
//         foreach($roomsList as $value){
//           $reservation_time=date('H:i',strtotime($ap["reservation_time"]));
//           $duration=$ap['duration'];

//           $selectedTime             = $reservation_time;
//           $start_time_range         = date('H:i',strtotime($selectedTime));
//           $end_time_range           = date('H:i',strtotime("+".$duration." hours", strtotime($selectedTime)));

//           $availability_status=$this->is_available($reservation_date, $value->room_id, $reservation_time, $duration);
//           if($availability_status == 0){
//             $isAvailable = true;
//           }
//         }
//         if(!$isAvailable){
//           $response['status']['error_code']           = 1;
//           $response['status']['message']              = 'Opp!Sorry the room is already reserved for the given date & time';
//           $this->displayOutput($response);
//         }
//         else
//         {
//             $each_price="100";            
//             $total_price=$ap['total_amount'];
//             $message="";
//             if(isset($ap['message'])&&$ap['message']!="")
//             {
//               $message=$ap['message'];
//             }
//             $media_type="";
//             if(isset($ap['media_type'])&&$ap['media_type']!="")
//             {
//               $media_type=$ap['media_type'];
//             }

//             $discount_amount="0.00";
//             $payable_amount="";
//             $coupon_code="";
//             if(isset($ap['discount_amount'])&&$ap['discount_amount']!="")
//             {
//               $discount_amount=$ap['discount_amount'];
//             }
//             if(isset($ap['payable_amount'])&&$ap['payable_amount']!="")
//             {
//               $payable_amount=$ap['payable_amount'];
//             }
//             if(isset($ap['coupon_code'])&&$ap['coupon_code']!="")
//             {
//               $coupon_code=$ap['coupon_code'];
//             }
//             if($payable_amount=="")
//             {
//               $payable_amount=$total_price;
//             }

//             //for memebership discount 
//             $membership_discount_amount="";
//             $membership_discount_percent="";
//             $membership_package_id="";
//             if(isset($ap['membership_discount_amount'])&&$ap['membership_discount_amount']!="")
//             {
//               $membership_discount_amount=$ap['membership_discount_amount'];
//             }
//             if(isset($ap['membership_discount_percent'])&&$ap['membership_discount_percent']!="")
//             {
//               $membership_discount_percent=$ap['membership_discount_percent'];
//             }
//             if(isset($ap['membership_package_id'])&&$ap['membership_package_id']!="")
//             {
//               $membership_package_id=$ap['membership_package_id'];
//             }

//             //wallet balance check
//             if($ap['payment_mode']=="wallet")
//             {
//               $wallet_response_status=$this->deductWalllet($user_id,$payable_amount);
//             }
          
//             //reservation_no creation 
//             $counter_details  = $this->mcommon->getRow("reservation", array('cafe_id'=>$ap['cafe_id']), 'reservation_id desc');
//             $cafe_place       = $this->mcommon->getRow("master_cafe", array('cafe_id'=>$ap['cafe_id']))['cafe_place'];
//             $final_cafe_place = substr($cafe_place, 0, 5);
                        
//             $created_on_arr = explode('-', $counter_details['created_on']);
//             $created_on_month = $created_on_arr[1];
//             if($created_on_month != date('m')){
//                 $counter = 1;
//             }elseif($counter_details['cafe_id_serial_no']==''){
//                 $counter = 1;
//             }else{
//                 $counter = $counter_details['cafe_id_serial_no'] + 1;            
//             }
//             $final_counter = str_pad($counter, 4, '0', STR_PAD_LEFT);        
//             $reservation_no = $final_cafe_place.'/'.date('m').'/'.date('Y').'/'.$final_counter; 

//             //////////////////////////
//             $insrtarry    = array('reservation_date'      =>  $reservation_date,
//                                   'reservation_time'      =>  $reservation_time,
//                                   'reservation_end_time'  =>  $end_time_range,
//                                   'duration'              =>  $duration,
//                                   'cafe_id'               =>  $ap['cafe_id'],
//                                   'no_of_guests'          =>  $ap['no_of_guests'],
//                                   'total_price'           =>  $total_price,
//                                   'room_id'               =>  0,  //room is is removed from list as discussed
//                                   'user_id'               =>  $user_id,
//                                   'name'                  =>  $ap['name'],
//                                   'email'                 =>  $ap['email'],
//                                   'country_code'          =>  $ap['country_code'],
//                                   'mobile'                =>  $ap['mobile'],
//                                   'movie_id'              =>  $movie_id,
//                                   'add_from'              => 'front',
//                                   'message'               =>  $message,
//                                   'coupon_code'           =>  $coupon_code,
//                                   'discount_amount'       =>  $discount_amount,
//                                   'membership_package_id'  => $membership_package_id,
//                                   'membership_discount_amount'  =>$membership_discount_amount,
//                                   'membership_discount_percent'  =>$membership_discount_percent,
//                                   'payable_amount'        =>$payable_amount,
//                                   'payment_mode'          =>$ap['payment_mode'],    //added after discussion
//                                   'media_type'            => $media_type,
//                                   'status'                => '1',
//                                   'reservation_type'      => 'App',
//                                   'created_by'            => $user_id,
//                                   'created_on'            => date('Y-m-d'),
                                  
//                                   'cafe_id_serial_no' => $final_counter,
//                                   'reservation_no' => $reservation_no
                                  
//                                 );
//             /**
//              *  Add cafe price while saving as discussed
//              * on 10-02-2021
//             */
//             if(isset($ap['cafe_price'])){
//               $insrtarry['cafe_price'] = $ap['cafe_price'];
//             }

//             $reservation_id     = $this->mapi->insert('reservation',$insrtarry);
            
//             if($reservation_id)
//             {
//               /**
//                * Food app option with reservation
//               */
//               if(isset($ap['order_id']) && !empty($ap['order_id'])){
//                 $invoice = '';
//                 $order_array = [];
//                 $order_array['food_order_status_id']= 1;   // Paid
//                 $order_array['order_status']= 1;   // Paid
//                 $order_array['status']= 1;   // Paid
//                 $order_array['invoice_url']= $invoice!=""?$invoice:null;   // Paid

//                 $this->mcommon->update('food_orders', ['food_order_id'=> $ap['order_id']],  $order_array);

//                 //insert into reservation order
//                 $this->mcommon->insert('reservation_orders', ['reservation_id'=> $reservation_id, 'order_id'=> $ap['order_id'], 'user_id'=> $user_id]);
//                 //remove hide items from list
//                 $order_items = $this->mcommon->select('food_order_items', ['food_order_id'=> $ap['order_id']], '*');
//                 foreach($order_items as $item){
//                   $availability = $this->mapi->getItemAvailabilityDetails($this->request_day, $this->request_time, $item->item_id);
//                   // $availability->price;
//                   // $availability->is_seen;
//                   if(!empty(!$availability)){
//                     if($availability->is_seen == 0){
//                       $this->db->where('food_order_item_id', $item->food_order_item_id);
//                       $this->db->delete('food_order_items');
//                     }
//                   }
//                 }
//                 //update coupon
//                 $this->mcommon->update('food_apply_coupon', ['user_id'=> $ap['user_id'], 'applied_status'=> 0], ['applied_status'=> 1, 'food_order_id'=> $ap['order_id']]);

//                 $trans_array = array(
//                   'food_order_id'=> $ap['order_id'],
//                   'transaction_id'=> $ap['transaction_id'],
//                   'source'=> 'App',
//                 );

//                 $this->mcommon->insert('food_order_transactions', $trans_array);

//                 //clear cart after check functionality
//                 $this->db->where(['user_id'=> $ap['user_id']]);
//                 $this->db->delete('food_cart_items');
//               }

//               ///insert to transaction table//////////////////////////////////
//               $pck_trans_array_data   = array('transaction_id'    => $ap['transaction_id'],
//                               'reservation_id'  => $reservation_id,
//                               'user_id'         => $user_id,
//                               'added_form'        => 'front',
//                               'amount'            => $payable_amount,                  
//                               'payment_mode'      => $ap['payment_mode'],
//                               'payment_status'    => '1',
//                               'transaction_type'  =>'Reservation'
//                               );
//               $this->mcommon->insert('transaction_history',$pck_trans_array_data);
              
//               ///////////////////////////////////////////////////////////////
//               ////Notification////////////////////////////////////////////
//               //get cafe 
//               $condition_cafe['cafe_id']=$ap['cafe_id'];
//               $cafe_row=$this->mapi->getRow("master_cafe",$condition_cafe);
//               $notification_title="Reservation Confirmed";
//               $notification_des= $ap['name'].' reservation request for '.$cafe_row['cafe_name']."-".$cafe_row['cafe_place'].' on '.$reservation_date.' at '.$reservation_time.' is approved';
//               $this->add_notification($user_id,$notification_title,$notification_des,$reservation_id);
//               /** Notification ends here.............................**/
                
//               $template_id = '1207163653375517655';
//               $message = "Dear ".$ap['name']."\n";
//               $message .= "Thank you for confirming your Reservation at Cinecafes.\n";
//               $message .= "Your reservation details are:\n";
//               $message .= "Cafe: ".$cafe_row['cafe_name']."-".$cafe_row['cafe_place']."\n";
//               $message .= "Date: ".$reservation_date."\n";
//               $message .= "Time: ".$reservation_time."\n";
//               $message .= "No. of Guests: ".$ap['no_of_guests']."\n";
//               $message .= "CINE CAFES";
              
//               smsSend($ap['mobile'], $message, $template_id);
//               if(ENVIRONMENT=='production')
//               {
//                 smsSend(NANDINIMOBILE, $message, $template_id);
//                 smsSend(SUMNANMOBILE, $message, $template_id);
//               }

//               /********push notification fr reservation ************************/
//               $title=$notification_title;
//               $message   = "Your request for reservation is Confirmed.";
//               $message_data = array('title' => $title,'message' => $message);
//               $user_fcm_token_data  = $this->mcommon->getRow('device_token',array('user_id' => $user_id));
//               //pr($user_fcm_token_data);
//               if(!empty($user_fcm_token_data)){
//                 $member_datas  = $this->mcommon->getRow('user',array('user_id' => $user_id));
//                   if($member_datas['notification_allow_type'] == '1'){
//                       if($user_fcm_token_data['device_type'] == 1){
//                         $this->pushnotification->send_ios_notification($user_fcm_token_data['fcm_token'], $message_data);
//                       }
//                       else{
//                         $this->pushnotification->send_android_notification($user_fcm_token_data['fcm_token'], $message_data);
//                       }
//                   }

//               }

//               /*********Mail fn ...************************************************/
//               $name=$ap['name'];
//               $email=$ap['email'];
//               $mail['name']       = $name;
//               $mail['to']         = $email;    
//               //$params['to']     = 'sreelabiswas.kundu@met-technologies.com';
              
//               $mail['subject']    = ORGANIZATION_NAME.' - Reservation request received';                             
//               $mail_temp          = file_get_contents('./global/mail/reservation_template.html');
//               $mail_temp          = str_replace("{web_url}", base_url(), $mail_temp);
//               $mail_temp          = str_replace("{logo}", LOGOURL, $mail_temp);
//               $mail_temp          = str_replace("{shop_name}", ORGANIZATION_NAME, $mail_temp);  
//               $mail_temp          = str_replace("{name}", $mail['name'], $mail_temp);
                      
//               $mail_temp          = str_replace("{current_year}", date('Y'), $mail_temp); 

              
//               $mail_temp                = str_replace("{cafe_name}", $cafe_row['cafe_name']."-".$cafe_row['cafe_place'], $mail_temp);
//               $mail_temp                = str_replace("{reservation_date}", $ap['reservation_date'], $mail_temp);
//               $mail_temp                = str_replace("{reservation_time}", $ap['reservation_time'], $mail_temp);
//               $mail_temp                = str_replace("{no_of_guests}", $ap['no_of_guests'], $mail_temp);
//               $mail_temp                = str_replace("{reservation_status}", "Confirmed", $mail_temp);
//               //echo $mail_temp; die;
//               $mail['message']    = $mail_temp;
//               $mail['from_email']    = FROM_EMAIL;
//               $mail['from_name']    = ORGANIZATION_NAME;
//               sendmail($mail); 

//               if(ENVIRONMENT=='production')
//               {
//                 // /************* Send Reservation details to the Admin ***************/
//                 $admin_cond               = array('role_id' => '1','status' =>'1');
//                 $admin_data               = $this->mcommon->getRow('user',$admin_cond);
//                 if(!empty($admin_data)){
//                   $admin_email            = $admin_data['email'];
//                   $admin_name             = $admin_data['name'];
//                 }
//                 else{
//                   $admin_email            = 'support@cinecafe.in';
//                   $admin_name             = 'admin';
//                 }     
//                 $mail['name']             = $admin_name;
//                 $mail['to']               = $admin_email;      
//                 $mail_temp                = str_replace("{name}", $mail['name'], $mail_temp);
//                 sendmail($mail);
                
//                 // /************ Send Reservation details to NANDINI  ***************/
                
//                 $mail['name']             = NANDININAME;
//                 $mail['to']               = NANDINIEMAIL;      
//                 $mail_temp                = str_replace("{name}", $mail['name'], $mail_temp);
//                 sendmail($mail);
                
//                 // /************ Send Reservation details to Sharad ***************/
    
//                 $mail['name']             = 'Sharad';
//                 $mail['to']               = 'sharad@cinecafes.com';      
//                 $mail_temp                = str_replace("{name}", $mail['name'], $mail_temp);
//                 sendmail($mail);
                
//                 // /************ Send Reservation details to respective cafe managers  ***************/
//                 if($ap['cafe_id']==57)
//                 {
//                   $mail['name']             = 'Manager Sec5';
//                   $mail['to']               = 'sec5@cinecafes.com';   
//                 }
                    
//                 $mail_temp                = str_replace("{name}", $mail['name'], $mail_temp);
//                 sendmail($mail);
//               }
//               /*************** mail ends*******************************************/ 
//               /////////////////////////////////////////////////////////////////////////////
//               $response['status']['error_code']           = 0;
//               $response['status']['message']              = 'Your booking is confirmed.';
//               $response['result']['reservation_id']       = $reservation_id;
//             }
//             else{
//               $response['status']['error_code']           = 1;
//               $response['status']['message']              = 'reservation cannot be saved';
//             }                
//         }

//       }
//       else {
//         $response['status']['error_code'] = 1;
//         $response['status']['message']    = 'Please fill up all required fields.';
//       }
//     } else {
//         $response['status']['error_code'] = 1;
//         $response['status']['message']    = 'Wrong http method type.';        
//     }
//     $this->displayOutput($response);
//   }

//  /////availability checking api
//   public function availablility_chk_bk()
//   {
//     $result  = array();
//     $ap=json_decode(file_get_contents('php://input'), true);
//     //print_r($ap); die;
//     if($this->checkHttpMethods($this->http_methods[0])){
//       if(sizeof($ap)) {
        
//         if (empty($ap['no_of_guests'])) {
//           $response['status']['error_code'] = 1;
//           $response['status']['message']    = 'No. of guests is required';
//           //$response['response']   = $this->obj;          
//           $this->displayOutput($response);
//         }        
//         if (empty($ap['reservation_date'])) {
//           $response['status']['error_code'] = 1;
//           $response['status']['message']    = 'Reservation date is required';
//           //$response['response']   = $this->obj;          
//           $this->displayOutput($response);
//         }
//         if (empty($ap['reservation_time'])) {
//           $response['status']['error_code'] = 1;
//           $response['status']['message']    = 'Reservation time  is required';
//           //$response['response']   = $this->obj;          
//           $this->displayOutput($response);
//         }       
        
//         if (empty($ap['duration'])) {
//               $response['status']['error_code'] = 1;
//               $response['status']['message']    = 'duration is required';
//               //$response['response']   = $this->obj;          
//               $this->displayOutput($response);
//             } 
            
//             if (empty($ap['room_id'])) {
//               $response['status']['error_code'] = 1;
//               $response['status']['message']    = 'Room id is required';
//               //$response['response']   = $this->obj;          
//               $this->displayOutput($response);
//             }

//             if(!empty($ap['reservation_date'])) {
//             $date=$ap['reservation_date'];
//             $format="d/m/Y";

//             // if(!validateDate($date,$format))
//             // {
//             //   $response['status']['error_code'] = 1;
//             //         $response['status']['message']    = 'Date format is wrong.It should be d/m/y';
             
//             //         $this->displayOutput($response);
//             // } 
//             //else {
//               //   $dateArr=explode("/",$date) ;
//               //  echo $reservation_date=$dateArr[2]."-".$dateArr[1]."-".$dateArr[0]; 
                
//                 //chk if its past date then reject request
//                 $curDateTime = date("Y-m-d H:i:s");
//                 //$reservation_date_time = date("Y-m-d H:i:s", strtotime($reservation_date." ".$ap['reservation_time']));
//                 $reservation_date = date("Y-m-d", strtotime(str_replace('/', '-', $date)));
//                 $reservation_date_time = $reservation_date." ".date('H:i:s', strtotime($ap['reservation_time']));
//                 //echo $curDateTime.'>='.$reservation_date_time; die;
//                 if($curDateTime>=$reservation_date_time)
//                   {
//                     $response['status']['error_code'] = 1;
//                        $response['status']['message']    = 'Please select some date time in future';
               
//                        $this->displayOutput($response);
//                   }
//                  // }              
//                 //}
//           }       
     
       
//                 $room_id=$ap['room_id'];
//                 $reservation_time=DATE('H:i:s',strtotime($ap["reservation_time"]));
//                 $duration=$ap['duration'];

//                 $selectedTime             = $reservation_time;
//                 $start_time_range         = date('H:i:s',strtotime($selectedTime));
//                 $end_time_range           = date('H:i:s',strtotime("+".$duration." hours", strtotime($selectedTime)));
//                 $availability_status=$this->is_available($reservation_date,$room_id,$reservation_time,$duration);
               
//                  if($availability_status!=0){
                    
//                    $response['status']['error_code']           = 1;
//                    $response['status']['message']              = 'OOPs! Sorry the room is already reserved for the given date & time';

//                    $this->displayOutput($response);
//                  }
//                  else
//                  {
//                     $response['status']['error_code']           = 0;
//                     $response['status']['message']              = 'Room is available for date time';

//                    $this->displayOutput($response);
//                  }
               
//       }
//       else {
//         $response['status']['error_code'] = 1;
//         $response['status']['message']    = 'Please fill up all required fields.';
//       }
//     } else {
//         $response['status']['error_code'] = 1;
//         $response['status']['message']    = 'Wrong http method type.';
//         //$response['response']   = $this->obj;      
//     }
//     $this->displayOutput($response);

//   }



  // do reservation
  public function doReservation()
  {
    $result  = array();
    $ap=json_decode(file_get_contents('php://input'), true);
    
    if($this->checkHttpMethods($this->http_methods[0])){
      if(sizeof($ap)) {
      //  if (empty($ap['name'])) {
      //    $response['status']['error_code'] = 1;
      //    $response['status']['message']    = 'Name is required';          
      //    $this->displayOutput($response);
      //  }
    
      //  if (empty($ap['email'])) {
      //    $response['status']['error_code'] = 1;
      //    $response['status']['message']    = 'Email field is required';                    
      //    $this->displayOutput($response);
      //  }

      //  if (empty($ap['mobile'])) {
      //    $response['status']['error_code'] = 1;
      //    $response['status']['message']    = 'Phone no. is required';          
      //    $this->displayOutput($response);
      //  }

      //  if (empty($ap['no_of_guests'])) {
      //    $response['status']['error_code'] = 1;
      //    $response['status']['message']    = 'No. of guests is required';          
      //    $this->displayOutput($response);
      //  }      

      //  if (empty($ap['reservation_date'])) {
      //    $response['status']['error_code'] = 1;
      //    $response['status']['message']    = 'Reservation date is required';          
      //    $this->displayOutput($response);
      //  }

      //  if (empty($ap['reservation_time'])) {
      //    $response['status']['error_code'] = 1;
      //    $response['status']['message']    = 'Reservation time  is required';          
      //    $this->displayOutput($response);
      //  }   

      //  if (empty($ap['cafe_id'])) {
      //    $response['status']['error_code'] = 1;
      //    $response['status']['message']    = 'cafe id is required';          
      //    $this->displayOutput($response);
      //  }

      //  if (empty($ap['duration'])) {
      //    $response['status']['error_code'] = 1;
      //    $response['status']['message']    = 'duration is required';          
      //    $this->displayOutput($response);
      //  }               

      //  if (empty($ap['user_id'])) {
      //    $response['status']['error_code'] = 1;
      //    $response['status']['message']    = 'user id is required';          
      //    $this->displayOutput($response);
      //  }

      //  if (empty($ap['total_amount'])) {
      //    $response['status']['error_code'] = 1;
      //    $response['status']['message']    = 'Total amount is required';              
      //    $this->displayOutput($response);
      //  }

      //  if (empty($ap['transaction_id'])) {
      //    $response['status']['error_code'] = 1;
      //    $response['status']['message']    = 'Transaction id is required';        
      //    $this->displayOutput($response);
      //  }

      //  if (empty($ap['payment_mode'])) {
      //    $response['status']['error_code'] = 1;
      //    $response['status']['message']    = 'Payment mode is required wallet or paytm';          
      //    $this->displayOutput($response);
      //  }

      if(!empty($ap['reservation_date'])) {
          $date=$ap['reservation_date'];
          $format="d/m/Y";
          $dateArr=explode("/",$date) ;
          $reservation_date=$dateArr[2]."-".$dateArr[1]."-".$dateArr[0]; 

          //chk if its past date then reject request
          $curDateTime = date("Y-m-d H:i");
          $reservation_date_time = date("Y-m-d H:i", strtotime($reservation_date." ".$ap['reservation_time']));
      }    

      $user_id = $ap['user_id'];

      //set the booking duration
      $movie_id="";
      if(isset($ap['movie_id'])&&$ap['movie_id']>0)
      {
        $movie_id=$ap['movie_id'];          
      }
          
      $roomsList = $this->mcommon->select('room', ['cafe_id'=> $ap['cafe_id'], 'is_delete'=> 0], '*', 'room_id');
      //  if(empty($roomsList)){
      //    $response['status']['error_code']  = 1;
      //    $response['status']['message']    = 'Opp!Sorry the Cafe is already reserved for the given date & time';
      //    $this->displayOutput($response);
      //  }

        $isAvailable = false;
        foreach($roomsList as $value){
          $reservation_time=date('H:i',strtotime($ap["reservation_time"]));
          $duration=$ap['duration'];

          $selectedTime             = $reservation_time;
          $start_time_range         = date('H:i',strtotime($selectedTime));
          $end_time_range           = date('H:i',strtotime("+".$duration." hours", strtotime($selectedTime)));

          $availability_status=$this->is_available($reservation_date, $value->room_id, $reservation_time, $duration);
          if($availability_status == 0){
            $isAvailable = true;
          }
        }

      //$isAvailable = true;

      // if(!$isAvailable){
      //   $response['status']['error_code']           = 1;
      //   $response['status']['message']              = 'Opp!Sorry the room is already reserved for the given date & time';
      //   $this->displayOutput($response);
      // }
      // else
      //{
          $each_price="100";            
          $total_price=$ap['total_amount'];
          $message="";
          if(isset($ap['message'])&&$ap['message']!="")
          {
            $message=$ap['message'];
          }
          $media_type="";
          if(isset($ap['media_type'])&&$ap['media_type']!="")
          {
            $media_type=$ap['media_type'];
          }

          $discount_amount="0.00";
          $payable_amount="";
          $coupon_code="";
          if(isset($ap['discount_amount'])&&$ap['discount_amount']!="")
          {
            $discount_amount=$ap['discount_amount'];
          }
          if(isset($ap['payable_amount'])&&$ap['payable_amount']!="")
          {
            $payable_amount=$ap['payable_amount'];
          }
          if(isset($ap['coupon_code'])&&$ap['coupon_code']!="")
          {
            $coupon_code=$ap['coupon_code'];
          }
          if($payable_amount=="")
          {
            $payable_amount=$total_price;
          }

          //for memebership discount 
          $membership_discount_amount="";
          $membership_discount_percent="";
          $membership_package_id="";
          if(isset($ap['membership_discount_amount'])&&$ap['membership_discount_amount']!="")
          {
            $membership_discount_amount=$ap['membership_discount_amount'];
          }
          if(isset($ap['membership_discount_percent'])&&$ap['membership_discount_percent']!="")
          {
            $membership_discount_percent=$ap['membership_discount_percent'];
          }
          if(isset($ap['membership_package_id'])&&$ap['membership_package_id']!="")
          {
            $membership_package_id=$ap['membership_package_id'];
          }

          //wallet balance check
          if($ap['payment_mode']=="wallet")
          {
            $wallet_response_status=$this->deductWalllet($user_id,$payable_amount);
          }
        
          //reservation_no creation 
          $counter_details  = $this->mcommon->getRow("reservation", array('cafe_id'=>$ap['cafe_id']), 'reservation_id desc');
          $cafe_place       = $this->mcommon->getRow("master_cafe", array('cafe_id'=>$ap['cafe_id']))['cafe_place'];
          $final_cafe_place = substr($cafe_place, 0, 5);
                      
          $created_on_arr = explode('-', $counter_details['created_on']);
          $created_on_month = $created_on_arr[1];
          if($created_on_month != date('m')){
              $counter = 1;
          }elseif($counter_details['cafe_id_serial_no']==''){
              $counter = 1;
          }else{
              $counter = $counter_details['cafe_id_serial_no'] + 1;            
          }
          $final_counter = str_pad($counter, 4, '0', STR_PAD_LEFT);        
          $reservation_no = $final_cafe_place.'/'.date('m').'/'.date('Y').'/'.$final_counter; 

          //////////////////////////
          $insrtarry    = array('reservation_date'      =>  $reservation_date,
                                'reservation_time'      =>  $reservation_time,
                                'reservation_end_time'  =>  $end_time_range,
                                'duration'              =>  $duration,
                                'cafe_id'               =>  $ap['cafe_id'],
                                'no_of_guests'          =>  $ap['no_of_guests'],
                                'total_price'           =>  $total_price,
                                'room_id'               =>  0,  //room is is removed from list as discussed
                                'user_id'               =>  $user_id,
                                'name'                  =>  $ap['name'],
                                'email'                 =>  $ap['email'],
                                'country_code'          =>  $ap['country_code'],
                                'mobile'                =>  $ap['mobile'],
                                'movie_id'              =>  $movie_id,
                                'add_from'              => 'front',
                                'message'               =>  $message,
                                'coupon_code'           =>  $coupon_code,
                                'discount_amount'       =>  $discount_amount,
                                'membership_package_id'  => $membership_package_id,
                                'membership_discount_amount'  =>$membership_discount_amount,
                                'membership_discount_percent'  =>$membership_discount_percent,
                                'payable_amount'        =>$payable_amount,
                                'payment_mode'          =>$ap['payment_mode'],    //added after discussion
                                'media_type'            => $media_type,
                                'status'                => '1',
                                'reservation_type'      => 'App',
                                'created_by'            => $user_id,
                                'created_on'            => date('Y-m-d'),
                                
                                'cafe_id_serial_no' => $final_counter,
                                'reservation_no' => $reservation_no
                                
                              );
          /**
          *  Add cafe price while saving as discussed
          * on 10-02-2021
          */
          if(isset($ap['cafe_price'])){
            $insrtarry['cafe_price'] = $ap['cafe_price'];
          }

          $reservation_id     = $this->mapi->insert('reservation',$insrtarry);
          
          if($reservation_id)
          {
            /**
            * Food app option with reservation
            */
            if(isset($ap['order_id']) && !empty($ap['order_id'])){
              $invoice = '';
              $order_array = [];
              $order_array['food_order_status_id']= 1;   // Paid
              $order_array['order_status']= 1;   // Paid
              $order_array['status']= 1;   // Paid
              $order_array['invoice_url']= $invoice!=""?$invoice:null;   // Paid

              $this->mcommon->update('food_orders', ['food_order_id'=> $ap['order_id']],  $order_array);

              //insert into reservation order
              $this->mcommon->insert('reservation_orders', ['reservation_id'=> $reservation_id, 'order_id'=> $ap['order_id'], 'user_id'=> $user_id]);
              //remove hide items from list
              $order_items = $this->mcommon->select('food_order_items', ['food_order_id'=> $ap['order_id']], '*');
              foreach($order_items as $item){
                $availability = $this->mapi->getItemAvailabilityDetails($this->request_day, $this->request_time, $item->item_id);
                // $availability->price;
                // $availability->is_seen;
                if(!empty(!$availability)){
                  if($availability->is_seen == 0){
                    $this->db->where('food_order_item_id', $item->food_order_item_id);
                    $this->db->delete('food_order_items');
                  }
                }
              }
              //update coupon
              $this->mcommon->update('food_apply_coupon', ['user_id'=> $ap['user_id'], 'applied_status'=> 0], ['applied_status'=> 1, 'food_order_id'=> $ap['order_id']]);

              $trans_array = array(
                'food_order_id'=> $ap['order_id'],
                'transaction_id'=> $ap['transaction_id'],
                'source'=> 'App',
              );

              $this->mcommon->insert('food_order_transactions', $trans_array);

              //clear cart after check functionality
              $this->db->where(['user_id'=> $ap['user_id']]);
              $this->db->delete('food_cart_items');
            }

            ///insert to transaction table//////////////////////////////////
            $pck_trans_array_data   = array('transaction_id'    => $ap['transaction_id'],
                            'reservation_id'  => $reservation_id,
                            'user_id'         => $user_id,
                            'added_form'        => 'front',
                            'amount'            => $payable_amount,                  
                            'payment_mode'      => $ap['payment_mode'],
                            'payment_status'    => '1',
                            'transaction_type'  =>'Reservation'
                            );
            $this->mcommon->insert('transaction_history',$pck_trans_array_data);
            
            ///////////////////////////////////////////////////////////////
            ////Notification////////////////////////////////////////////
            //get cafe 
            $condition_cafe['cafe_id']=$ap['cafe_id'];
            $cafe_row=$this->mapi->getRow("master_cafe",$condition_cafe);
            $notification_title="Reservation Confirmed";
            $notification_des= $ap['name'].' reservation request for '.$cafe_row['cafe_name']."-".$cafe_row['cafe_place'].' on '.$reservation_date.' at '.$reservation_time.' is approved';
            $this->add_notification($user_id,$notification_title,$notification_des,$reservation_id);
            /** Notification ends here.............................**/
              

            //gst calculation
            $no_of_guests = $ap['no_of_guests'];
            $total_price  = $payable_amount;              
            $item_price = round($total_price*100/(100+18));
            $gst = $total_price-$item_price;

            $template_id = '1207163653375517655';
            $message = "Dear ".$ap['name']."\n";
            $message .= "Thank you for confirming your Reservation at Cinecafes.\n";
            $message .= "Your reservation details are:\n";
            $message .= "Cafe: ".$cafe_row['cafe_name']."-".$cafe_row['cafe_place']."\n";
            $message .= "Date: ".$reservation_date."\n";
            $message .= "Time: ".$reservation_time."\n";
            $message .= "No. of Guests: ".$ap['no_of_guests']."\n";
            $message .= "Item Amount : INR ".$item_price."\n"; $message .= "No. of Guests: ".$this->input->post('no_of_guests')."\n";             
            $message .= "No. of Hours: ".$ap['duration']."\n";             
            $message .= "Total Amount Inclusive of GST (18%): INR ".$total_price."\n";
            $message .= "Item Amount : INR ".$item_price."\n";
            $message .= "GST Amount: INR ".$gst."\n";
            $message .= "CGST Amount: INR ".($gst/2)."\n";
            $message .= "SGST Amount: INR ".($gst/2)."\n";
            $message .= "CINE CAFES";
            
            smsSend($ap['mobile'], $message, $template_id);
            if(ENVIRONMENT=='production')
            {
              smsSend(NANDINIMOBILE, $message, $template_id);
              smsSend(SUMNANMOBILE, $message, $template_id);
            }

            /********push notification fr reservation ************************/
            $title=$notification_title;
            $message   = "Your request for reservation is Confirmed.";
            $message_data = array('title' => $title,'message' => $message);
            $user_fcm_token_data  = $this->mcommon->getRow('device_token',array('user_id' => $user_id));
            //pr($user_fcm_token_data);
            if(!empty($user_fcm_token_data)){
              $member_datas  = $this->mcommon->getRow('user',array('user_id' => $user_id));
                if($member_datas['notification_allow_type'] == '1'){
                    if($user_fcm_token_data['device_type'] == 1){
                      $this->pushnotification->send_ios_notification($user_fcm_token_data['fcm_token'], $message_data);
                    }
                    else{
                      $this->pushnotification->send_android_notification($user_fcm_token_data['fcm_token'], $message_data);
                    }
                }

            }

            /*********Mail fn ...************************************************/
            $name=$ap['name'];
            $email=$ap['email'];
            $mail['name']       = $name;
            $mail['to']         = $email;    
            //$params['to']     = 'sreelabiswas.kundu@met-technologies.com';
            
            $mail['subject']    = ORGANIZATION_NAME.' - Reservation request received';                             
            $mail_temp          = file_get_contents('./global/mail/reservation_template.html');
            $mail_temp          = str_replace("{web_url}", base_url(), $mail_temp);
            $mail_temp          = str_replace("{logo}", LOGOURL, $mail_temp);
            $mail_temp          = str_replace("{shop_name}", ORGANIZATION_NAME, $mail_temp);  
            $mail_temp          = str_replace("{name}", $mail['name'], $mail_temp);

            $mail_temp          = str_replace("{duration}", $ap['duration'], $mail_temp);
            $mail_temp          = str_replace("{total_price}", number_format((float)$total_price, 2, '.', ''), $mail_temp);
            $mail_temp          = str_replace("{item_price}", number_format((float)$item_price, 2, '.', ''), $mail_temp);
            $mail_temp          = str_replace("{gst}", number_format((float)$gst, 2, '.', ''), $mail_temp);
            $mail_temp          = str_replace("{cgst}", number_format((float)($gst/2), 2, '.', ''), $mail_temp);
            $mail_temp          = str_replace("{sgst}", number_format((float)($gst/2), 2, '.', ''), $mail_temp);
                              
            $mail_temp          = str_replace("{current_year}", date('Y'), $mail_temp); 
            
            $mail_temp                = str_replace("{cafe_name}", $cafe_row['cafe_name']."-".$cafe_row['cafe_place'], $mail_temp);
            $mail_temp                = str_replace("{reservation_date}", $ap['reservation_date'], $mail_temp);
            $mail_temp                = str_replace("{reservation_time}", $ap['reservation_time'], $mail_temp);
            $mail_temp                = str_replace("{no_of_guests}", $ap['no_of_guests'], $mail_temp);
            $mail_temp                = str_replace("{reservation_status}", "Confirmed", $mail_temp);
            //echo $mail_temp; die;
            $mail['message']    = $mail_temp;
            $mail['from_email']    = FROM_EMAIL;
            $mail['from_name']    = ORGANIZATION_NAME;
            sendmail($mail); 

            if(ENVIRONMENT=='production')
            {
              // /************* Send Reservation details to the Admin ***************/
              $admin_cond               = array('role_id' => '1','status' =>'1');
              $admin_data               = $this->mcommon->getRow('user',$admin_cond);
              if(!empty($admin_data)){
                $admin_email            = $admin_data['email'];
                $admin_name             = $admin_data['name'];
              }
              else{
                $admin_email            = 'support@cinecafe.in';
                $admin_name             = 'admin';
              }     
              $mail['name']             = $admin_name;
              $mail['to']               = $admin_email;      
              $mail_temp                = str_replace("{name}", $mail['name'], $mail_temp);
              sendmail($mail);
              
              // /************ Send Reservation details to NANDINI  ***************/
              
              $mail['name']             = NANDININAME;
              $mail['to']               = NANDINIEMAIL;      
              $mail_temp                = str_replace("{name}", $mail['name'], $mail_temp);
              sendmail($mail);
              
              // /************ Send Reservation details to Sharad ***************/
  
              $mail['name']             = 'Sharad';
              $mail['to']               = 'sharad@cinecafes.com';      
              $mail_temp                = str_replace("{name}", $mail['name'], $mail_temp);
              sendmail($mail);
              
              // /************ Send Reservation details to respective cafe managers  ***************/
              if($ap['cafe_id']==57)
              {
                $mail['name']             = 'Manager Sec5';
                $mail['to']               = 'sec5@cinecafes.com';   
              }
                  
              $mail_temp                = str_replace("{name}", $mail['name'], $mail_temp);
              sendmail($mail);
            }
            /*************** mail ends*******************************************/ 
            /////////////////////////////////////////////////////////////////////////////
            $response['status']['error_code']           = 0;
            $response['status']['message']              = 'Your booking is confirmed.';
            $response['result']['reservation_id']       = $reservation_id;
          }
          else{
            $response['status']['error_code']           = 1;
            $response['status']['message']              = 'reservation cannot be saved';
          }                
      //}

      }
      else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Please fill up all required fields.';
      }
    } else {
      $response['status']['error_code'] = 1;
      $response['status']['message']    = 'Wrong http method type.';        
    }
    $this->displayOutput($response);
  }

  /////availability checking api  
  public function availablility_chk()
  {
    $result  = array();
    $ap=json_decode(file_get_contents('php://input'), true);
    //print_r($ap); die;
    if($this->checkHttpMethods($this->http_methods[0])){
      if(sizeof($ap)) {
        
        //if cafe_id 62 means sec 2
        if ($ap['cafe_id']==62) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Booking option will be comming soon for this Cafe';          
          $this->displayOutput($response);
        } 

        if (empty($ap['reservation_date'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Reservation date is required';          
          $this->displayOutput($response);
        }

        if (empty($ap['reservation_time'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Reservation time  is required';        
          $this->displayOutput($response);
        }       
        
        if (empty($ap['duration'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'duration is required';          
          $this->displayOutput($response);
        } 
            
        if (empty($ap['room_id'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Room id is required';          
          $this->displayOutput($response);
        }

        if(!empty($ap['reservation_date'])) {
            $date=$ap['reservation_date'];
            $format="d/m/Y";
         
            //chk if its past date then reject request
            $curDateTime = date("Y-m-d H:i:s");
            //$reservation_date_time = date("Y-m-d H:i:s", strtotime($reservation_date." ".$ap['reservation_time']));
            $reservation_date = date("Y-m-d", strtotime(str_replace('/', '-', $date)));
            $reservation_date_time = $reservation_date." ".date('H:i:s', strtotime($ap['reservation_time']));
            //echo $curDateTime.'>='.$reservation_date_time; die;
            if($curDateTime>=$reservation_date_time)
            {
              $response['status']['error_code'] = 1;
              $response['status']['message']    = 'Please select some date time in future';
      
              $this->displayOutput($response);
            }               
        }       
            
        $room_id=$ap['room_id'];
        $reservation_time=DATE('H:i:s',strtotime($ap["reservation_time"]));
        $duration=$ap['duration'];

        $selectedTime             = $reservation_time;
        $start_time_range         = date('H:i:s',strtotime($selectedTime));
        $end_time_range           = date('H:i:s',strtotime("+".$duration." hours", strtotime($selectedTime)));
        $availability_status=$this->is_available($reservation_date,$room_id,$reservation_time,$duration);
        
          if($availability_status!=0){
            
            $response['status']['error_code']           = 1;
            $response['status']['message']              = 'OOPs! Sorry the room is already reserved for the given date & time';

            $this->displayOutput($response);
          }
          else
          {
            $response['status']['error_code']           = 0;
            $response['status']['message']              = 'Room is available for date time';

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
          //echo $this->db->last_query(); die;
    }
    return $availability_status;
  }

  //reservation list
  public function reservationList(){
    $ap=json_decode(file_get_contents('php://input'), true);
    if($this->checkHttpMethods($this->http_methods[0])){
      if(sizeof($ap)){
              if(empty($ap['user_id'])){
                $response=array('status'=>array('error_code'=>1,'message'=>'User id is required'));
                $this->displayOutput($response);
              }

          ////////////////////////////////////////////////////////////////////////
          $order_col='reservation_id';
          $order_type='DESC';
          $start="";
          $limit="";
          ////////////////////////////for pagination params/////////////////////////////
          if(isset($ap['page_number'])&&$ap['page_number']>0&&isset($ap['number_of_data'])&&$ap['number_of_data']>0)
          {
             $page = $ap['page_number'];
             $page_no=$page-1;
             $limit=$ap['number_of_data'];
             $start=$page_no*$limit;
          }
          //////////////////////////////////////////////////////////////////////////////
          // $condition['food.status']=1;
           $condition['reservation.user_id']=$ap['user_id'];
          ///category id
          $status="";
          if(isset($ap['status'])&&!empty($ap['status']))
          {
            $status=$ap['status'];
            if($status=="past"||$status=="upcoming"||$status=="cancelled")
            {

            }
            else
            {
              $response=array('status'=>array('error_code'=>1,'message'=>'Invalid status requested'));
                 $this->displayOutput($response);
            }
          }

          ///movie id
          if(isset($ap['reservation_id'])&&$ap['reservation_id']>0)
          {
            $condition['reservation.reservation_id']=$ap['reservation_id'];
          }
          ////////////////////////get total count///////////////////////////////////////
          $total_count=0;
          $table="reservation";
          //$total_count=$this->mapi->get_data_total_count($table,$condition);
          $List = $this->mapi->getReservationList($table,$condition,$order_col,$order_type,$start,$limit,$status);

          //echo $this->db->last_query();die;
          if(!empty($List)){
             for($i=0;$i<count($List);$i++){  
              $List[$i]['cafe_name']=$List[$i]['cafe_name']."-".$List[$i]['cafe_place'];
             }  
            $response=array('status'=>array('error_code'=>0,'message'=>'success'),'result'=>array('list'=>$List));
          }else{
            $response=array('status'=>array('error_code'=>0,'message'=>'No data found'),'result'=>array('list'=>$this->arr));
          }
      /////////////////////////////////////////////////////////////////////////////////
      }else{
            $response=array('status'=>array('error_code'=>1,'message'=>'Please fill up all required fields'),'result'=>array('details'=>$this->obj));
          }
    }else{
      $response=array('status'=>array('error_code'=>1,'message'=>'Wrong http method type'),'result'=>array('details'=>$this->obj));
    }
      
     
    
    $this->displayOutput($response);
  }

  ///cancel reservation
  public function cancel_reservation()
  {
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
        if (empty($ap['reservation_id'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Booking id is required.';
         
          $this->displayOutput($response);
        }

        if (empty($ap['cancellation_reason'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Cancellation Reason is required.';
         
          $this->displayOutput($response);
        }
        
        $reservation_data = $this->mapi->getRow('reservation',array('reservation_id' => $ap['reservation_id']));
        if(!empty($reservation_data)){

          $update_arr = array('cancellation_reason' =>$ap['cancellation_reason'],'status' =>2);
          $this->mapi->update('reservation',array('reservation_id' => $ap['reservation_id']),$update_arr);

          ///////////////////////////////////////////////////////////////
                      ////Notification////////////////////////////////////////////
                      //get cafe 
                      $user_id=$reservation_data['user_id'];
                      $reservation_date=$reservation_data['reservation_date'];
                      $reservation_time=$reservation_data['reservation_time'];
                      $reservation_id=$ap['reservation_id'];
                      $no_of_guests=$reservation_data['no_of_guests'];
                      $mobile=$reservation_data['mobile'];
                      $condition_cafe['cafe_id']=$reservation_data['cafe_id'];
                      $cafe_row=$this->mapi->getRow("master_cafe",$condition_cafe);
                        $notification_title="Reservation Cancelled";
                        $notification_des= $reservation_data['name'].' reservation for '.$cafe_row['cafe_name']."-".$cafe_row['cafe_place'].' on '.$reservation_date.' at '.$reservation_time.' is cancelled';
                        $this->add_notification($user_id,$notification_title,$notification_des,$reservation_id);
                      /** Notification ends here.............................**/

                      /********************************** Send reservation details in sms *************************************************/

                          $message  = "Your request for reservation at Cinecafes is cancelled. Your reservation details are: \n";
                          $message .= "Cafe: ".$cafe_row['cafe_name']."-".$cafe_row['cafe_place']."\n Date: ".$reservation_date."\n Time: ".$reservation_time."\n No. of Guests: ".$no_of_guests;
                         
                          smsSend($mobile,$message);

                        /********push notification fr reservation ************************/
                        $title=$notification_title;
                        $message   = "Your request for reservation is Cancelled.";
                        $message_data = array('title' => $title,'message' => $message);
                        $user_fcm_token_data  = $this->mcommon->getRow('device_token',array('user_id' => $user_id));
                        //pr($user_fcm_token_data);
                        if(!empty($user_fcm_token_data)){
                          $member_datas  = $this->mcommon->getRow('user',array('user_id' => $user_id));
                            if($member_datas['notification_allow_type'] == '1'){
                                if($user_fcm_token_data['device_type'] == 1){
                                  $this->pushnotification->send_ios_notification($user_fcm_token_data['fcm_token'], $message_data);
                                }
                                else{
                                  $this->pushnotification->send_android_notification($user_fcm_token_data['fcm_token'], $message_data);
                                }
                            }

                          }

                          /*********Mail fn ...************************************************/
                          $name=$reservation_data['name'];
                          $email=$reservation_data['email'];
                          $mail['name']       = $name;
                          $mail['to']         = $email;    
                          //$params['to']     = 'sreelabiswas.kundu@met-technologies.com';
                          
                          $mail['subject']    = ORGANIZATION_NAME." ".$message;                             
                          $mail_temp          = file_get_contents('./global/mail/reservation_status_template.html');
                          $mail_temp          = str_replace("{web_url}", base_url(), $mail_temp);
                          $mail_temp          = str_replace("{logo}", LOGOURL, $mail_temp);
                          $mail_temp          = str_replace("{shop_name}", ORGANIZATION_NAME, $mail_temp);  
                          $mail_temp          = str_replace("{name}", $mail['name'], $mail_temp);
                                  
                          $mail_temp          = str_replace("{current_year}", date('Y'), $mail_temp); 

                          $mail_temp                 =   str_replace("{body_msg}", $message, $mail_temp);
                          $mail_temp                = str_replace("{cafe_name}", $cafe_row['cafe_name']."-".$cafe_row['cafe_place'], $mail_temp);
                          $mail_temp                = str_replace("{reservation_date}", $reservation_data['reservation_date'], $mail_temp);
                          $mail_temp                = str_replace("{reservation_time}", $reservation_data['reservation_time'], $mail_temp);
                          $mail_temp                = str_replace("{no_of_guests}", $reservation_data['no_of_guests'], $mail_temp);
                          $mail_temp                = str_replace("{reservation_status}", "Cancelled", $mail_temp);

                          $mail['message']    = $mail_temp;
                          $mail['from_email']    = FROM_EMAIL;
                          $mail['from_name']    = ORGANIZATION_NAME;
                          sendmail($mail); 

                          // /****************** Send Reservation details to the Admin ****************************/
                          $admin_cond               = array('role_id' => '1','status' =>'1');
                          $admin_data               = $this->mcommon->getRow('user',$admin_cond);
                          if(!empty($admin_data)){
                            $admin_email            = $admin_data['email'];
                            $admin_name             = $admin_data['name'];
                          }
                          else{
                            $admin_email            = 'support@fenicia.in';
                            $admin_name             = 'admin';
                          }     
                          $mail['name']             = $admin_name;
                          $mail['to']               = $admin_email;      
                          $mail_temp          = str_replace("{name}", $mail['name'], $mail_temp);
                          sendmail($mail); 

                          
                          /****************mail ends*******************************************/ 
                        /////////////////////////////////////////////////////////////////////////////
          //echo $response_sms;exit;
          $response['status']['error_code'] = 0;
          $response['status']['message']    = "Booking cancelled";
        }
        else{
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Invalid Booking Id';
        }
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

  ///apply coupon
  public function apply_promo()
  {
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
        if (empty($ap['coupon_code'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Coupon code is required.';
         
          $this->displayOutput($response);
        }

        if (empty($ap['total_amount'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Total amount is required.';
         
          $this->displayOutput($response);
        }
        
        $coupon_data = $this->mapi->getRow('coupon',array('coupon_code' => $ap['coupon_code'], 'is_delete'=> 0));
        if(!empty($coupon_data)){
          if($coupon_data['is_delete']==1)
          {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "This coupon is removed by admin";
            $this->displayOutput($response);
          }
          if($coupon_data['status']==0)
          {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "This coupon is deactivated by admin";
            $this->displayOutput($response);
          }
          //echo $coupon_data['min_price'] .'<'. $ap['total_amount'];

          if($coupon_data['min_price'] >= $ap['total_amount']){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "You total amount must be minimum ".(int)$coupon_data['min_price']." to avail coupon discount.";
            $this->displayOutput($response);
          }
          $today=date("Y-m-d");
          if(strtotime($coupon_data['start_on'])>strtotime($today))
          {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "This coupon is not yet started.It will starts on ".$coupon_data['start_on'];
            $this->displayOutput($response);
          }
          if(strtotime($coupon_data['end_on'])<strtotime($today))
          {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "This coupon activation period is over.It ends on ".$coupon_data['end_on'];
            $this->displayOutput($response);
          }
          
          // if($ap['total_amount']<$coupon_data['min_price'])
          // {
          //   $response['status']['error_code'] = 1;
          //   $response['status']['message']    = "This coupon can be applied with minimum purchase of ". $coupon_data['min_price'];
          // }
          
          //calculate discount
          $coupon_amount=$coupon_data['amount'];
          $coupon_type=$coupon_data['coupon_type'];
          $discount_amount= 0;
          $payable_amount= 0;
          if($coupon_type==0) // fixed discount
          {
            $discount_amount=$coupon_amount;
          }
          else  //percentage discount
          {
            $discount_amount=(($ap['total_amount']*$coupon_amount)/100);
            $discount_amount = !empty($coupon_data['max_discount_amount']) && $discount_amount > $coupon_data['max_discount_amount']?$coupon_data['max_discount_amount']:$discount_amount;
          }
          
          $payable_amount=$ap['total_amount']-$discount_amount;
          if($payable_amount<0)
          {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Coupon discount amount is invalid';
             $this->displayOutput($response);
          }
          /////////////////////
          $response['status']['error_code'] = 0;
          $response['status']['message']    = "coupon applied";
          $response['result']['discount_amount']    = round($discount_amount, 0);
          $response['result']['payable_amount']    = round($payable_amount, 0);
        }
        else{
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Invalid Coupon Code';
        }
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
  
  /** Membership starts..................................................... ***/
  public function buyMembership()
  {
    $package_type_name  = '';
    $package_name       = '';
    $package_price      = '';
    $result  = array();
    $ap      = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {  
        if (empty($ap['package_id'])) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Package id is required.';
           
            $this->displayOutput($response);
          }

          if (empty($ap['user_id'])) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'User id is required.';
           
            $this->displayOutput($response);
          }
        $user_id                   = $ap['user_id'];
        //$access_token                = $ap['access_token'];  
        //$device_type                 = $ap['device_type'];
        $package_id                  = $ap['package_id'];
        $package_price               = $ap['package_price'];
        $membership_transaction_id   = $ap['membership_transaction_id'];
        $payment_mode                = $ap['payment_mode'];
          //$access_token_result    = $this->check_access_token($access_token, $device_type,$user_id);
          //pr($member_details);

          $package_row_condition  = array('package_id'=>$package_id);
          $package_row   = $this->mcommon->getRow('master_package',$package_row_condition);
          if (empty($package_row)) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Invalid package id.';
           
            $this->displayOutput($response);
          }

           ////wallet balance check
            if($ap['payment_mode']=="wallet")
            {
              $wallet_response_status=$this->deductWalllet($user_id,$package_price);
            }
            //////////////////////////
          $pkg_condition  = array('user_id'=>$user_id,'status' =>'1');
          $package_data   = $this->mcommon->getRow('package_membership_mapping',$pkg_condition);
          //pr($package_data);
          if(!empty($package_data)){
            $update_data  = array('status'=> '0');
            $this->mcommon->update('package_membership_mapping',$pkg_condition,$update_data);
          }
          $package_type=$package_row['package_type_id'];
        if($package_type =='1'){  //yearly.................
          $expiry_date  = date('Y-m-d', strtotime(' +1 year'));
          $package_type_name='Yearly';
        }
        elseif($package_type =='2'){  //monthly.........................
          $expiry_date = date('Y-m-d', strtotime(' +1 month'));
          $package_type_name='Monthly';
        } 
        else   ///custom
        {
          $no_of_days=$package_row['no_of_days'];
          $expiry_date = date('Y-m-d', strtotime(' +'.$no_of_days.' days'));
          $package_type_name='Other';
        }
        $membership_no  = rand();            
        $pck_array_data   = array('package_id'    => $package_id,
                          'package_type_id'      => $package_type,
                          'package_price'      => $package_price,
                          'user_id'             => $user_id,
                          'added_from'            => 'front',
                          'buy_on'                => date('Y-m-d'),
                          'expiry_date'           => $expiry_date,
                          'status'                => '1',
                          'membership_no'         =>$membership_no
                        );
        $membership_subscription_id  = $this->mcommon->insert('package_membership_mapping',$pck_array_data);
        if(!empty($membership_transaction_id)){
          $pck_trans_array_data   = array('transaction_id'    => $membership_transaction_id,
                                          'package_id'        => $package_id,
                                          'user_id'         => $user_id,
                                          'added_form'        => 'front',
                                          'amount'            => $package_price,                   
                                          'payment_mode'      => $payment_mode,
                                          'payment_status'    => '1',
                                          'transaction_type'  =>'Membership'
                                          );
          $this->mcommon->insert('transaction_history',$pck_trans_array_data);
        }
      //pr($package_membership_list);
        if(!empty($membership_subscription_id)){
          $package_name=$package_row['package_name'];
         ///////////////////////////////////////////////////////////////
          ////Notification////////////////////////////////////////////
          //get user info
          $condition_user['user_id']=$user_id;
          $user_row=$this->mapi->getRow("user",$condition_user); 
          
            $notification_title="Membership purchased";
            $notification_des= "Your membership is active";
            $this->add_notification($user_id,$notification_title,$notification_des);
          /** Notification ends here.............................**/

          /********************************** Send reservation details in sms *************************************************/

              // $message  = "Membership is at".ORGANIZATION_NAME." is in active status. Your membership details are: \n";
              // $message .= "Membership name: ".$package_name."\n Membership type: ".$package_type_name."\n Membership Price: ".$package_price;

              //$message  = "Dear ".$user_row['name'].' '.$user_row['last_name'].". \n";
              //$message  .= "Your Membership at Cinecafes is Active. Membership details are:\n";
              //$message  .= "Membership name: ".$package_name.". \n";
              //$message  .= "Membership type: ".$package_type_name.". \n";
              //$message  .= "Membership Price: ".$package_price.". \n";
              //$message  .= ORGANIZATION_NAME;
              
              $template_id = '1207163653356833332';
              $message  = "Dear ".$user_row['name'].' '.$user_row['last_name']."\n";
              $message  .= "Your Membership at CineCafes is Active. Membership details are mentioned below:\n";
              $message  .= "Membership name: ".$package_name."\n";
              $message  .= "Membership type: ".$package_type_name."\n";
              $message  .= "Membership Price: ".$package_price."\n";
              $message .= "CINE CAFES";
              
              smsSend($user_row['mobile'], $message, $template_id);

            /********push notification fr membership ************************/
            $title=$notification_title;
            $message   = $notification_des;
            $message_data = array('title' => $title,'message' => $message);
            $user_fcm_token_data  = $this->mcommon->getRow('device_token',array('user_id' => $user_id));
            //pr($user_fcm_token_data);
            if(!empty($user_fcm_token_data)){
              $member_datas  = $this->mcommon->getRow('user',array('user_id' => $user_id));
                if($member_datas['notification_allow_type'] == '1'){
                    if($user_fcm_token_data['device_type'] == 1){
                      $this->pushnotification->send_ios_notification($user_fcm_token_data['fcm_token'], $message_data);
                    }
                    else{
                      $this->pushnotification->send_android_notification($user_fcm_token_data['fcm_token'], $message_data);
                    }
                }

              }

                          /*********Mail fn ...************************************************/
                          $details            =   "Membership name: ".$package_name."<br>"."Membership type: ".$package_type_name."<br>"."Membership Price:(₹) ".$package_price."<br>"."Membership Status: Your Club Membership is active";  
                          $name=$user_row['name'];
                          $email=$user_row['email'];
                          $mail['name']       = $name;
                          $mail['to']         = $email;    
                          //$params['to']     = 'sreelabiswas.kundu@met-technologies.com';
                          
                          $mail['subject']    = ORGANIZATION_NAME." Membership subscription ";                             
                          $mail_temp          = file_get_contents('./global/mail/membership_subscription.html');
                          $mail_temp          = str_replace("{web_url}", base_url(), $mail_temp);
                          $mail_temp          = str_replace("{logo}", LOGOURL, $mail_temp);
                          $mail_temp          = str_replace("{shop_name}", ORGANIZATION_NAME, $mail_temp);  
                          $mail_temp          = str_replace("{name}", $mail['name'], $mail_temp);
                                  
                          $mail_temp          = str_replace("{current_year}", date('Y'), $mail_temp); 

                          $mail_temp          =   str_replace("{membership_name}", $package_name, $mail_temp);
                          $mail_temp                 =   str_replace("{details}", $details, $mail_temp);
                          
                         

                          $mail['message']    = $mail_temp;
                          $mail['from_email']    = FROM_EMAIL;
                          $mail['from_name']    = ORGANIZATION_NAME;
                          sendmail($mail); 

                         
                          
                          /****************mail ends*******************************************/ 
                        /////////////////////////////////////////////////////////////////////////////
        
           $response['status']['error_code']            = 0;
           $response['status']['message']               = 'Your membership purchase is successful.';
                           
        

        }
        else{
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Sorry! buy membership is unsuccessful.';
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

//membership package list and details 
public function membershipPackageList()
{
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
        if (sizeof($ap)) {  
            $user_id        = $ap['user_id'];
            $package_id="";
            if(isset($ap['package_id'])&&$ap['package_id']!="")
            {
              $package_id=$ap['package_id'];
            }
            //$membship_cond      = "and pmm.user_id ='".$user_id."'";
            $membship_cond        = " ";
            $membership_data      = $this->mapi->getMembershipData($package_id);
            //pr($membership_data);
            if(!empty($membership_data)){
              foreach($membership_data as $key => $val){
                 $package_id=$val['package_id'];
                 $benefits_list = $this->mapi->get_package_benefit_list($package_id);
                  $membership_data[$key]['benefits_list']  = $benefits_list; 
                  $membership_data[$key]['package_image']     = $this->mapi->get_package_image_list($package_id);

              }
              $response['status']['error_code']       = 0;
              $response['status']['message']          = 'success';
              $response['response']['package_list']  = $membership_data;
            }
            else{
              $response['status']['error_code'] = 1;
                $response['status']['message']    = 'No package available';
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

public function checkMembership(){

  $result  = array();
  $ap      = json_decode(file_get_contents('php://input'), true);
  if ($this->checkHttpMethods($this->http_methods[0])) {
    if (sizeof($ap)) {  
        $user_id            = $ap['user_id'];          
        $package_membership_list  = $this->mapi->getMembershipDetails($user_id);  
        //pr($package_membership_list);
        if(!empty($package_membership_list)){
            ///chk expired////////
            $tomorrow = date("Y-m-d");
            if(strtotime($tomorrow)>strtotime($package_membership_list['expiry_date']))
            {
              $response['status']['error_code'] = 1;
              $response['status']['message']    = 'Your Membership has expired.';        
              $this->displayOutput($response);
            }
            $response['status']['error_code']                                   = 0;
            $response['status']['message']                                      = 'Success';
            $response['response']['membership_details']                         = $package_membership_list;
            $benefits_list                                                      = $this->mapi->get_package_benefit_list($package_membership_list['package_id']);
            $response['response']['membership_details']['benefits']             = $benefits_list; 
            $response['response']['membership_details']['membership_image']     = $this->mapi->get_package_image_list($package_membership_list['package_id'] );
            
          }
        else{
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Sorry you do not have any active subscription.';
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

//chk subscription and discount
  public function chkSubscriptionDiscount()
  {
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
        if (empty($ap['user_id'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'User id is required.';
         
          $this->displayOutput($response);
        }

        if (empty($ap['total_amount'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Total amount is required.';
         
          $this->displayOutput($response);
        }
        
        $user_id            = $ap['user_id'];          
        $package_membership_list  = $this->mapi->getMembershipDetails($user_id);  
        //pr($package_membership_list);
        if(!empty($package_membership_list)){
            ///chk expired////////
            $tomorrow = date("Y-m-d");
            if(strtotime($tomorrow)>strtotime($package_membership_list['expiry_date']))
            {
              $response['status']['error_code'] = 1;
              $response['status']['message']    = 'Your Membership has expired.';        
              $this->displayOutput($response);
            }
          //calculate discount
          $discount_amount = 0;
          $payable_amount = 0;
         
          $discount_amount=round((($ap['total_amount']*$package_membership_list['discount_percent'])/100), 0);
          
          $payable_amount=$ap['total_amount']-$discount_amount;
          /////////////////////
          $response['status']['error_code'] = 0;
          $response['status']['message']    = "subscription discount applied";
          $response['result']['membership_package_id']    = $package_membership_list['package_id'];
          $response['result']['membership_discount_amount']    = round($discount_amount, 0);
          $response['result']['membership_payable_amount']    = round($payable_amount, 0);
          $response['result']['membership_discount_percent']    = $package_membership_list['discount_percent'];
        }
        else{
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'No subscription available';
        }
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

  /////////////////////Membership ends//////////////////////////

  /////////////////////Wallet starts////////////////////////////

  //add wallet
  public function addWallet()
  {
    $result  = array();
    $ap      = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {  
          if (empty($ap['user_id'])) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'User id is required.';
           
            $this->displayOutput($response);
          }
          if (empty($ap['transaction_id'])) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Transaction id is required.';
           
            $this->displayOutput($response);
          }
          if (empty($ap['amount'])) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Amount is required.';
           
            $this->displayOutput($response);
          }
          if (empty($ap['payment_mode'])) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Payment_mode is required.';
           
            $this->displayOutput($response);
          }
         $user_id                   = $ap['user_id'];
         $payment_mode                = $ap['payment_mode'];
          //$access_token_result    = $this->check_access_token($access_token, $device_type,$user_id);
          //pr($member_details);

          $condition  = array('user_id'=>$user_id);
          $user_row   = $this->mcommon->getRow('user',$condition);
          if (empty($user_row)) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Invalid user id.';
           
            $this->displayOutput($response);
          }

          $pck_trans_array_data   = array('transaction_id'    => $ap['transaction_id'],
                                          'user_id'         => $user_id,
                                          'added_form'        => 'front',
                                          'amount'            => $ap['amount'],                   
                                          'payment_mode'      => $ap['payment_mode'],
                                          'payment_status'    => '1',
                                          'transaction_type'  =>'Wallet Recharge',
                                          'add_wallet'        => 1
                                          );
          $transaction_insert_id=$this->mcommon->insert('transaction_history',$pck_trans_array_data);
      
        if(!empty($transaction_insert_id)){

            //update to wallet user table//////////////////////////
          $present_amount=$user_row['wallet'];
          $updated_amount=$present_amount+$ap['amount'];
          $user_data=array();
          $user_data['wallet']=$updated_amount;
          $this->mcommon->update('user',$condition,$user_data);
          //////////////////////////////////////////////////////////
          ///////////////////////////////////////////////////////////////
          ////Notification////////////////////////////////////////////
          //get user info
          $condition_user['user_id']=$user_id;
          $user_row=$this->mapi->getRow("user",$condition_user); 
          
            $notification_title="Point added to wallet";
            $notification_des= $ap['amount']." point added to your wallet";
            $this->add_notification($user_id,$notification_title,$notification_des);
          /** Notification ends here.............................**/

          /********************************** Send reservation details in sms *************************************************/
            
              // $message  = $notification_des." at ".ORGANIZATION_NAME.". \n";
              // $message .= "Present wallet balance is : ".$updated_amount;
            //Update sms text based on mail instructions
              //$message = 'Dear '.$user_row['name'].' '.$user_row['last_name'].". \n";
              //$message .= $ap['amount']." point added to your wallet at Cinecafes. Present wallet balance is : ".$updated_amount."\n";
              //$message .= ORGANIZATION_NAME;
              
              $template_id = '1207163653337268173';
              $message = 'Dear '.$user_row['name'].' '.$user_row['last_name']."\n";
              $message .= $ap['amount']." points added to your wallet at Cinecafes. Present wallet balance is : ".$updated_amount."\n";
              $message .= "CINE CAFES";
              
              smsSend($user_row['mobile'],$message,$template_id);

            /********push notification fr membership ************************/
            $title=$notification_title;
            //$message   = $notification_des;
            $message_data = array('title' => $title,'message' => $notification_des);
            $user_fcm_token_data  = $this->mcommon->getRow('device_token',array('user_id' => $user_id));
            //pr($user_fcm_token_data);
            if(!empty($user_fcm_token_data)){
              $member_datas  = $this->mcommon->getRow('user',array('user_id' => $user_id));
                if($member_datas['notification_allow_type'] == '1'){
                    if($user_fcm_token_data['device_type'] == 1){
                      $this->pushnotification->send_ios_notification($user_fcm_token_data['fcm_token'], $message_data);
                    }
                    else{
                      $this->pushnotification->send_android_notification($user_fcm_token_data['fcm_token'], $message_data);
                    }
                }

              }

              /*********Mail fn ...************************************************/
              $details            =  $message;  
              $name=$user_row['name'];
              $email=$user_row['email'];
              $mail['name']       = $name;
              $mail['to']         = $email;    
              //$params['to']     = 'sreelabiswas.kundu@met-technologies.com';
              
              $mail['subject']    = ORGANIZATION_NAME." wallet point added";                             
              $mail_temp          = file_get_contents('./global/mail/wallet_template.html');
              $mail_temp          = str_replace("{web_url}", base_url(), $mail_temp);
              $mail_temp          = str_replace("{logo}", LOGOURL, $mail_temp);
              $mail_temp          = str_replace("{shop_name}", ORGANIZATION_NAME, $mail_temp);  
              $mail_temp          = str_replace("{name}", $mail['name'], $mail_temp);
                      
              $mail_temp          = str_replace("{current_year}", date('Y'), $mail_temp);                         
              $mail_temp                 =   str_replace("{details}", $details, $mail_temp);
              
              

              $mail['message']    = $mail_temp;
              $mail['from_email']    = FROM_EMAIL;
              $mail['from_name']    = ORGANIZATION_NAME;
              sendmail($mail); 

              
              
              /****************mail ends*******************************************/ 
            /////////////////////////////////////////////////////////////////////////////
        
           $response['status']['error_code']            = 0;
           $response['status']['message']               = 'Money added to your wallet.';
         

        }
        else{
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Sorry! add to wallet is unsuccessful.';
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

  //chk wallet balance
  public function walletBalance()
  {
    $result  = array();
    $ap      = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {  
          if (empty($ap['user_id'])) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'User id is required.';
           
            $this->displayOutput($response);
          }
          
         $user_id                   = $ap['user_id'];
          $condition  = array('user_id'=>$user_id);
          $user_row   = $this->mcommon->getRow('user',$condition);
          if (empty($user_row)) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Invalid user id.';
           
            $this->displayOutput($response);
          }

           $response['status']['error_code']            = 0;
           $response['status']['message']               = 'Wallet balance';
           $response['result']['wallet_amount']         = $user_row['wallet'];
         
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

  //transaction history
  public function transactionHistory()
  {
    $result  = array();
    $ap      = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {  
          if (empty($ap['user_id'])) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'User id is required.';
           
            $this->displayOutput($response);
          }
          $user_id=$ap['user_id'];
          $condition  = array('user_id'=>$user_id);
          $List      = $this->mapi->getRows("transaction_history",$condition,"transaction_history_id","DESC");
          //echo $this->db->last_query(); die;
          if(!empty($List)){

            $response=array('status'=>array('error_code'=>0,'message'=>'success'),'result'=>array('list'=>$List));
          }else{
            $response=array('status'=>array('error_code'=>0,'message'=>'No data found'),'result'=>array('list'=>$this->arr));
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

  ////deduct money from wallet
    // moved to my_controller
  // public function deductWalllet($user_id,$amount)
  // {
    
  //       if(empty($user_id)||empty($amount))
  //       {
  //         $response['status']['error_code'] = 1;
  //         $response['status']['message']    = 'Invalid user id or amount';
           
  //           $this->displayOutput($response);
  //       }

  //         $condition  = array('user_id'=>$user_id);
  //         $user_row   = $this->mcommon->getRow('user',$condition);
  //         if (empty($user_row)) {
  //           $response['status']['error_code'] = 1;
  //           $response['status']['message']    = 'Invalid user id.';
           
  //           $this->displayOutput($response);
  //         }

  //         if($user_row['wallet']<$amount)
  //         {
  //            $response['status']['error_code'] = 1;
  //           $response['status']['message']    = 'Insuffivient amount in wallet. Present balance is '.$user_row['wallet'];
           
  //           $this->displayOutput($response);
  //         }
  //         //update to wallet user table//////////////////////////
  //         $present_amount=$user_row['wallet'];
  //         $updated_amount=$present_amount-$amount;
  //         $user_data=array();
  //         $user_data['wallet']=$updated_amount;
  //         $this->mcommon->update('user',$condition,$user_data);

  //         ///////////////////////////////////////////////////////////////
  //                     ////Notification////////////////////////////////////////////
  //                     //get user info
  //                     $condition_user['user_id']=$user_id;
  //                     $user_row=$this->mapi->getRow("user",$condition_user); 
                     
  //                       $notification_title="Point deducted from wallet";
  //                       $notification_des= $amount." point deducted from your wallet";
  //                       $this->add_notification($user_id,$notification_title,$notification_des);
  //                     /** Notification ends here.............................**/

  //                     /********************************** Send reservation details in sms *************************************************/

  //                         $message  = $notification_des." at ".ORGANIZATION_NAME.". \n";
  //                         $message .= "Present wallet balance is : ".$updated_amount;
                          
  //                         smsSend($user_row['mobile'],$message);

  //                       /********push notification fr membership ************************/
  //                       $title=$notification_title;
  //                       //$message   = $notification_des;
  //                       $message_data = array('title' => $title,'message' => $notification_des);
  //                       $user_fcm_token_data  = $this->mcommon->getRow('device_token',array('user_id' => $user_id));
  //                       //pr($user_fcm_token_data);
  //                       if(!empty($user_fcm_token_data)){
  //                         $member_datas  = $this->mcommon->getRow('user',array('user_id' => $user_id));
  //                           if($member_datas['notification_allow_type'] == '1'){
  //                               if($user_fcm_token_data['device_type'] == 1){
  //                                 $this->pushnotification->send_ios_notification($user_fcm_token_data['fcm_token'], $message_data);
  //                               }
  //                               else{
  //                                 $this->pushnotification->send_android_notification($user_fcm_token_data['fcm_token'], $message_data);
  //                               }
  //                           }

  //                         }

  //                         /*********Mail fn ...************************************************/
  //                         $details            =  $message;  
  //                         $name=$user_row['name'];
  //                         $email=$user_row['email'];
  //                         $mail['name']       = $name;
  //                         $mail['to']         = $email;    
  //                         //$params['to']     = 'sreelabiswas.kundu@met-technologies.com';
                          
  //                         $mail['subject']    = ORGANIZATION_NAME." wallet point deducted";                             
  //                         $mail_temp          = file_get_contents('./global/mail/wallet_template.html');
  //                         $mail_temp          = str_replace("{web_url}", base_url(), $mail_temp);
  //                         $mail_temp          = str_replace("{logo}", LOGOURL, $mail_temp);
  //                         $mail_temp          = str_replace("{shop_name}", ORGANIZATION_NAME, $mail_temp);  
  //                         $mail_temp          = str_replace("{name}", $mail['name'], $mail_temp);
                                  
  //                         $mail_temp          = str_replace("{current_year}", date('Y'), $mail_temp);                         
  //                         $mail_temp                 =   str_replace("{details}", $details, $mail_temp);
                          
                         

  //                         $mail['message']    = $mail_temp;
  //                         $mail['from_email']    = FROM_EMAIL;
  //                         $mail['from_name']    = ORGANIZATION_NAME;
  //                         sendmail($mail); 

                         
                          
  //                         /****************mail ends*******************************************/ 
  //                       /////////////////////////////////////////////////////////////////////////////
  //         return 1;
  // }
  ////////////////////Wallet ends///////////////////////////////////
    //rating review list
  public function ratingReviewList(){
    $ap=json_decode(file_get_contents('php://input'), true);
    // if($this->checkHttpMethods($this->http_methods[0])){
    //   if(sizeof($ap)){
    //           if(empty($ap['user_id'])){
    //             $response=array('status'=>array('error_code'=>1,'message'=>'User id is required'),'result'=>array('details'=>$this->obj));
    //             $this->displayOutput($response);
    //           }

          ////////////////////////////////////////////////////////////////////////
          $order_col='rating_id';
          $order_type='DESC';
          $start="";
          $limit="";
          ////////////////////////////for pagination params/////////////////////////////
          if(isset($ap['page_number'])&&$ap['page_number']>0&&isset($ap['number_of_data'])&&$ap['number_of_data']>0)
          {
             $page = $ap['page_number'];
             $page_no=$page-1;
             $limit=$ap['number_of_data'];
             $start=$page_no*$limit;
          }
          //////////////////////////////////////////////////////////////////////////////
          $condition['status']=1;
          //$condition['is_delete']=0;
          ////////////////////////get total count///////////////////////////////////////
          $total_count=0;
          $table="rating_review";
          $total_count=$this->mapi->get_data_total_count($table,$condition);
          $List = $this->mapi->getRows($table,$condition,$order_col,$order_type,$start,$limit);

      /////////////////////////////////////////////////////////////////////////////////
      
      //echo $this->db->last_query();die;
      if(!empty($List)){

        $response=array('status'=>array('error_code'=>0,'message'=>'success'),'result'=>array('total_count'=>$total_count,'list'=>$List));
      }else{
        $response=array('status'=>array('error_code'=>0,'message'=>'No data found'),'result'=>array('list'=>$this->arr));
      }
     
    
    $this->displayOutput($response);
  }

   public function ratingReviewListBycafeId(){
    $ap=json_decode(file_get_contents('php://input'), true);
    if($this->checkHttpMethods($this->http_methods[0])){
      //if(sizeof($ap)){

      ////////////////////////////////////////////////////////////////////////
          $order_col='rating_id';
          $order_type='DESC';
          $start="";
          $limit="";
          ////////////////////////////for pagination params/////////////////////////////
          if(isset($ap['page_number'])&&$ap['page_number']>0&&isset($ap['number_of_data'])&&$ap['number_of_data']>0)
          {
             $page = $ap['page_number'];
             $page_no=$page-1;
             $limit=$ap['number_of_data'];
             $start=$page_no*$limit;
          }
          //////////////////////////////////////////////////////////////////////////////
         //

          /*if(isset($ap['user_id'])&&$ap['user_id']>0)
          {
            $user_id=$ap['user_id'];
          }
          else
          {
            $user_id="";
          }*/

          ///for details data of single item
          //$cafe_id="";
          $condition['rating_review.status']=1;
          if(isset($ap['cafe_id'])&&$ap['cafe_id']>0)
          {
            $cafe_id=$ap['cafe_id'];
            $condition['rating_review.cafe_id']=$cafe_id;
          }

          ////////////////////////get total count///////////////////////////////////////
          $total_count=0;
          $table="rating_review";
          $total_count=$this->mapi->get_data_total_count($table,$condition);
         // $List = $this->mapi->getRows($table,$condition,$order_col,$order_type,$start,$limit);
          	$List = $this->mapi->geReviewList($table,$condition,$order_col,$order_type,$start,$limit);
         

      /////////////////////////////////////////////////////////////////////////////////
       //echo $this->db->last_query();die;
      if(!empty($List)){

        $response=array('status'=>array('error_code'=>0,'message'=>'success'),'result'=>array('total_count'=>$total_count,'list'=>$List));
      }else{
        $response=array('status'=>array('error_code'=>0,'message'=>'No data found'),'result'=>array('list'=>$this->arr));
      }
    }else{

      $response=array('status'=>array('error_code'=>1,'message'=>'Wrong http method type'),'result'=>array('details'=>$this->obj));
    }
    
    $this->displayOutput($response);
  }
  //rating review form 
  public function addReview()
  {
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {

        if (empty($ap['user_id'])) {
         
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'User id is required';
            $this->displayOutput($response);
                   
        }
        if (empty($ap['cafe_id'])) {
         
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Cafe id is required';
            $this->displayOutput($response);
                   
        }
        if (empty($ap['service_rating'])) {
         
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Service rating is required';
            $this->displayOutput($response);
                   
        }
        if (empty($ap['quality_rating'])) {
         
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Quality rating id is required';
            $this->displayOutput($response);
                   
        }
        // if (empty($ap['review_content'])) {
         
        //     $response['status']['error_code'] = 1;
        //     $response['status']['message']    = 'review content id is required';
        //     $this->displayOutput($response);
                   
        // }
        $review_content="";
          if(isset($ap['review_content'])&& $ap['review_content'] !="")
          {
            $review_content=$ap['review_content'];
          }
            $cafe_id=$ap['cafe_id'];
            $insert_arr['user_id']     = $ap['user_id'];
            $insert_arr['cafe_id']     = $ap['cafe_id'];
            //$insert_arr['rating_start']     = $ap['rating_start'];
            $insert_arr['service_rating']     = $ap['service_rating'];
            $insert_arr['quality_rating']     = $ap['quality_rating'];
            $insert_arr['review_content']     = $review_content;
            $insert_arr['created_on']         = date('Y-m-d H:i:s');
            $result  = $this->mapi->insert('rating_review',$insert_arr);
            if($result){

              ////update it to cafe table
              $condition  = array('cafe_id'=>$cafe_id);
              $cafe_row   = $this->mcommon->getRow('master_cafe',$condition);
              $existing_review_count= $cafe_row['review_count'];
              $updated_review_count=$existing_review_count+1;

              $avg_rating  = $this->mapi->calculate_rating($cafe_id);


            $update_arr     = array('avg_rating' =>$avg_rating,'review_count'=>$updated_review_count);
            $update_result  = $this->mapi->update('master_cafe',$condition,$update_arr);
              /////////////////////////////////
                
                    $response['status']['error_code'] = 0;
                    $response['status']['message']    = 'Rating Added Successfully';

            }
            else {
              $response['status']['error_code'] = 1;
              $response['status']['message']    = 'Oops!something went wrong...';
            }          
               
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

  //chk wallet balance
  public function page_content()
  {
    $result  = array();
    $ap      = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {  
          if (empty($ap['page_slug'])) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Page slug is required.';
           
            $this->displayOutput($response);
          }
          
          $cms_slug                   = $ap['page_slug'];
          $condition  = array('cms_slug'=>$cms_slug);
          $cms_row   = $this->mcommon->getRow('cms',$condition);
          if (empty($cms_row)) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Invalid page slug.';
           
            $this->displayOutput($response);
          }

           $response['status']['error_code']            = 0;
           $response['status']['message']               = 'success';
           $response['result']         = $cms_row;
         
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

  public function notificationList()
  {
    $ap = json_decode(file_get_contents('php://input'), true);
      if ($this->checkHttpMethods($this->http_methods[0])) {
          if (sizeof($ap)) {  
                  $user_id            = $ap['user_id'];
                  //$access_token         = $ap['access_token'];  
                  //$device_type          = $ap['device_type'];
                  //$access_token_result  = $this->check_access_token($access_token, $device_type,$member_id);
                  //pr($member_details);
                //   if (empty($access_token_result)) {
                //   $response['status']['error_code'] = 1;
                //   $response['status']['message']    = 'Unauthorize Token';        
                //   $this->displayOutput($response);
                // }
                // else{
                  // $notif_cond   = array('notification.user_id' =>$user_id,'notification.status' =>'1','created_on >=' => date('Y-m-d'));  
                  $notif_cond   = array('notification.user_id' =>$user_id,'notification.status' =>'1');            
                  $notification_data     = $this->mapi->getNotificationList($notif_cond);
                  //echo $this->db->last_query(); die;
                  //pr($notification_data);
                  if(!empty($notification_data)){
                    $response['status']['error_code']       = 0;
                    $response['status']['message']          = ' ';
                    $response['response']['notification_list']  = $notification_data;
                  }
                  else{
                    $response['status']['error_code'] = 1;
                      $response['status']['message']    = 'No data available.';       
                
                  }
               // }

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

  /*
    ** Moved to my_controller
  */
  // public function add_notification($user_id,$notification_title,$notification_des,$reservation_id=null)
	// {
	//   if($reservation_id==null)
	//   {
	// 	$reservation_id=0;
	//   }
	//   $notification_arr = array(      'user_id' => $user_id,
	// 								  'notification_title'        => $notification_title,
	// 								  'notification_description'  => $notification_des,
	// 								  'reservation_id'  => $reservation_id,
	// 								  'status'                    => '1',
	// 								  'created_on'                => date('Y-m-d H:i:s')
	// 								  );
	//   $insert_data      = $this->mcommon->insert('notification', $notification_arr);
	// }

  /** media list **/

  
  public function mediaList(){
    $ap=json_decode(file_get_contents('php://input'), true);
    // if($this->checkHttpMethods($this->http_methods[0])){
    //   if(sizeof($ap)){
    //           if(empty($ap['user_id'])){
    //             $response=array('status'=>array('error_code'=>1,'message'=>'User id is required'),'result'=>array('details'=>$this->obj));
    //             $this->displayOutput($response);
    //           }

          ////////////////////////////////////////////////////////////////////////
          $order_col='media_order';
          $order_type='ASC';
          $start="";
          $limit="";
          ////////////////////////////for pagination params/////////////////////////////
          if(isset($ap['page_number'])&&$ap['page_number']>0&&isset($ap['number_of_data'])&&$ap['number_of_data']>0)
          {
             $page = $ap['page_number'];
             $page_no=$page-1;
             $limit=$ap['number_of_data'];
             $start=$page_no*$limit;
          }
          //////////////////////////////////////////////////////////////////////////////
          $condition['status']=1;
          $condition['is_delete']=0;
          ////////////////////////get total count///////////////////////////////////////
          $total_count=0;
          $table="master_media";
          $total_count=$this->mapi->get_data_total_count($table,$condition);
          $List = $this->mapi->getRows($table,$condition,$order_col,$order_type,$start,$limit);

      /////////////////////////////////////////////////////////////////////////////////
      
      //echo $this->db->last_query();die;
      if(!empty($List)){
        for($i=0;$i<count($List);$i++)
        {
          $List[$i]['media_image']=base_url()."public/upload_images/media/".$List[$i]['media_image'];
        }
        $response=array('status'=>array('error_code'=>0,'message'=>'success'),'result'=>array('total_count'=>$total_count,'list'=>$List));
      }else{
        $response=array('status'=>array('error_code'=>0,'message'=>'No data found'),'result'=>array('list'=>$this->arr));
      }
     
    
    $this->displayOutput($response);
  }

  /** added for duplicate email checking **/
   //chk email only
  public function chkEmailPhone()
  {

    $ap=json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if(sizeof($ap)){
        
        /////email chk
        if (empty($ap['email'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Email is required';
          //$response['response']   = $this->obj;
          
          $this->displayOutput($response);
        }
        if (!empty($ap['email'])) {

          $existing_row_count = $this->mcommon->getNumRows("user",array('email' => $ap['email']));
          if ($existing_row_count>0) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Email Already registered';
            //$response['response']   = $this->obj;
            $this->displayOutput($response);
          }
          else
          {
            $response['status']['error_code'] = 0;
            $response['status']['message']    = 'Success';
            //$response['response']   = $this->obj;
            
          }
        }


        /////mobile 
         if(empty($ap['mobile'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Mobile is required';
          //$response['response']   = $this->obj;
          $this->displayOutput($response);
        }
        if(!empty($ap['mobile'])) {
          
          $existing_row_count = $this->mcommon->getNumRows("user",array('mobile' => $ap['mobile']));
          if ($existing_row_count>0) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Mobile Already registered';
            //$response['response']   = $this->obj;
            
            $this->displayOutput($response);
          }
          else
          {
            $response['status']['error_code'] = 0;
            $response['status']['message']    = 'Success';
            //$response['response']   = $this->obj;
            
          }
        }
        
      }
      else {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Please fill up all required fields.';
         //$response['response']   = $this->obj;        
      }
    } else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Wrong http method type.';
        //$response['response']   = $this->obj;      
    }
    $this->displayOutput($response);      
  }

  ///change mobile no with otp generate
  
  public function changemobileOtpGenerate()
  {
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
        if (empty($ap['mobile'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Mobile no is required.';
         
          $this->displayOutput($response);
        }

        if(!empty($ap['mobile'])) {
          
          $existing_row_count = $this->mcommon->getNumRows("user",array('mobile' => $ap['mobile']));
          if ($existing_row_count>0) {
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Mobile Already registered.Please give some unique mobile no';
            //$response['response']   = $this->obj;
            
            $this->displayOutput($response);
          }
          
        }

        if (empty($ap['user_id'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'User id is required.';
         
          $this->displayOutput($response);
        }
        
          $mobile   = $ap['mobile'];
          $otp      = mt_rand(1000,9999);
          
          $template_id = '1207163697491581491';
          $message = $otp." is the OTP.\n";
          $message .= "CINE CAFES";
          $response_sms = smsSend($ap['mobile'],$message,$template_id);

          $update_arr = array('otp_updatephone' =>$otp,'otp_datetime_updatephone' =>date('Y-m-d H:i'));
          $this->mapi->update('user',array('user_id' => $ap['user_id']),$update_arr);
          //echo $response_sms;exit;
          $response['status']['error_code'] = 0;
          $response['status']['message']    = "OTP send successfully.";
          $response['response']['otp']      = $otp;
       
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
  
  ///change mobile with otp verification
  public function updateMobileNoWithOtp()
  {
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
      
        if (empty($ap['mobile'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'phoneNo field required.';
          
          $this->displayOutput($response);
        }
        if (empty($ap['otp'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'Otp required.';
          
          $this->displayOutput($response);
        }

        if (empty($ap['user_id'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'User id field required.';
          
          $this->displayOutput($response);
        }
        
        $check_member_condition = array('otp_updatephone' => $ap['otp'],'user_id'=>$ap['user_id']);
        $memberdetails          = $this->mcommon->getRow('user', $check_member_condition);
        //pr($memberdetails);
        if(empty($memberdetails)){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = 'Invalid Otp';
            $this->displayOutput($response);
        }
        else{
            $otp_generating_time =  $memberdetails['otp_datetime_updatephone'];          
            $current_time = date('Y-m-d H:i');
            //echo date('Y-m-d H:i',strtotime($otp_generating_time. '+30 minutes'));exit;
            if(strtotime($current_time) > strtotime($otp_generating_time. '+30 minutes')){              
              $response['status']['error_code'] = 1;
              $response['status']['message']    = 'Otp expired';
              $this->displayOutput($response);
            } 
            elseif($memberdetails['is_delete'] != '0'){
              $response['status']['error_code'] = 1;
              $response['status']['message']    = 'Member account is removed by admin';
              $this->displayOutput($response);
            }
            elseif($memberdetails['status'] == '0'){
              $response['status']['error_code'] = 1;
              $response['status']['message']    = 'Member account is not in active status';
              $this->displayOutput($response);
            }
            else{
              $user_id      = $memberdetails['user_id'];
              $condition      = array('user_id' =>$user_id);
              $update_arr     = array('mobile' =>$ap['mobile']);
              $update_result  = $this->mapi->update('user',$condition,$update_arr);
              if($update_result){
                  $response['status']['error_code'] = 0;
                  $response['status']['message']    = 'Mobile no updated successfully';
                  
                  
              }
              else {
                $response['status']['error_code'] = 1;
                $response['status']['message']    = 'Oops!something went wrong...';
              }          
          } 
        }        
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

  /**---------------------------API By Chayan */
  /*
    ** @request user_id
  */
  public function getProfile()
  {
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
        if (empty($ap['user_id'])) {
          $response['status']['error_code'] = 1;
          $response['status']['message']    = 'unauthenticated request.';
         
          $this->displayOutput($response);
        }
         $member_all_details= $this->mapi->getMemberDetailsRow(array('user.user_id' => $ap['user_id']));               
          if ($member_all_details) {
                foreach($member_all_details as $key => $value){
                  if($member_all_details[$key]['fb_id'] == null){
                    $member_all_details[$key]['fb_id'] = "";
                  }
                  if($member_all_details[$key]['apple_id'] == null){
                    $member_all_details[$key]['apple_id'] = "";
                  }
                }
                $response['status']['error_code'] = 0;
                $response['status']['message']    = 'Success';
                $response['response']['user']   = $member_all_details;
                
              } else {
                $response['status']['error_code'] = 1;
                $response['status']['message']    = 'unauthenticated request.';                    
              }  
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

  /**
   * Check available rom list for backend
  */
  public function getRoomList()
  {
    $cafe_id = $this->input->post('cafe_id');
    $id = $this->input->post('id');
    $room_list = array();
    $reservationDetails = $this->mcommon->select('reservation', ['reservation_id'=> $id], '*');
    if(!empty($reservationDetails)){
      $roomsList = $this->mcommon->select('room', ['cafe_id'=> $cafe_id, 'status'=>1, 'is_delete'=> 0], '*', 'room_id');
      if(!empty($roomsList)){
        $isAvailable = false;
        foreach($roomsList as $value){
          $availability_status=$this->is_available(
                                                  $reservationDetails[0]->reservation_date, 
                                                  $value->room_id, 
                                                  $reservationDetails[0]->reservation_time, 
                                                  $reservationDetails[0]->duration
                                                );
          if($availability_status == 0){
            $room_list[] = $value;
          }
        }
      }
    }
    if(!empty($room_list)){
      $response['status']['error_code'] = 0;
      $response['status']['message']    = 'Success';
      $response['result']['data']    = $room_list;
    }else{
      $response['status']['error_code'] = 1;
      $response['status']['message']    = 'Sorry no room available';
    }
      $this->displayOutput($response); 
  }

  //update 
  public function updateReservation()
  {
    $reservation_id = $this->input->post('id');
    $room_id = $this->input->post('room_id');

    if($this->mcommon->update('reservation', ['reservation_id'=> $reservation_id], ['room_id'=> $room_id])){
      
      $response['status']['error_code'] = 0;
      $response['status']['message']    = 'Success';
    }else{
      $response['status']['error_code'] = 1;
      $response['status']['message']    = 'Sorry! unable to assign room';
    }
      $this->displayOutput($response); 
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
        //print_r($versiondetails);
        $updateResponseArr=array();
         // 1.0 >= 1.2
        if($versiondetails['version_ios'] < $ap['version'])
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
            if($versiondetails['is_mandatory_ios'] == 1)
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
  ////////////////////////Cinecafe Api ends///////////////////////////////////////////
  
  //wallet deduction while purchasing
	public function deductWalllet($user_id,$amount)
	{
			if(empty($user_id))
			{
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Invalid user id or amount';
				$this->displayOutput($response);
			}

			$condition  = array('user_id'=>$user_id);
			$user_row   = $this->mcommon->getRow('user',$condition);
			if (empty($user_row)) {
				$response['status']['error_code'] = 1;
				$response['status']['message']    = 'Invalid user id.';
			
				$this->displayOutput($response);
			}

			if($user_row['wallet']<$amount)
			{
				$response['status']['error_code'] = 1;
				$response['status']['message']    = 'Insuffivient amount in wallet. Present balance is '.$user_row['wallet'];
			
				$this->displayOutput($response);
			}
			//update to wallet user table//////////////////////////
			$present_amount=$user_row['wallet'];
			$updated_amount=$present_amount-$amount;
			$user_data=array();
			$user_data['wallet']=$updated_amount;
			$this->mcommon->update('user',$condition,$user_data);

			///////////////////////////////////////////////////////////////
						////Notification////////////////////////////////////////////
						//get user info
						$condition_user['user_id']=$user_id;
						$user_row=$this->mapi->getRow("user",$condition_user); 
						
							$notification_title="Point deducted from wallet";
							$notification_des= $amount." point deducted from your wallet";
							$this->add_notification($user_id,$notification_title,$notification_des);
						/** Notification ends here.............................**/

						/********************************** Send reservation details in sms *************************************************/

            $message  = $notification_des." at Cinecafes \n";
            $message .= "Present wallet balance is : ".$updated_amount.". \n";
            $message .= ORGANIZATION_NAME;
							
							smsSend($user_row['mobile'],$message);

							/********push notification fr membership ************************/
							$title=$notification_title;
							//$message   = $notification_des;
							$message_data = array('title' => $title,'message' => $notification_des);
							$user_fcm_token_data  = $this->mcommon->getRow('device_token',array('user_id' => $user_id));
							//pr($user_fcm_token_data);
							if(!empty($user_fcm_token_data)){
							$member_datas  = $this->mcommon->getRow('user',array('user_id' => $user_id));
								if($member_datas['notification_allow_type'] == '1'){
									if($user_fcm_token_data['device_type'] == 1){
									$this->pushnotification->send_ios_notification($user_fcm_token_data['fcm_token'], $message_data);
									}
									else{
									$this->pushnotification->send_android_notification($user_fcm_token_data['fcm_token'], $message_data);
									}
								}

							}

							/*********Mail fn ...************************************************/
							$details            =  $message;  
							$name=$user_row['name'];
							$email=$user_row['email'];
							$mail['name']       = $name;
							$mail['to']         = $email;    
							//$params['to']     = 'sreelabiswas.kundu@met-technologies.com';
							
							$mail['subject']    = ORGANIZATION_NAME." wallet point deducted";                             
							$mail_temp          = file_get_contents('./global/mail/wallet_template.html');
							$mail_temp          = str_replace("{web_url}", base_url(), $mail_temp);
							$mail_temp          = str_replace("{logo}", LOGOURL, $mail_temp);
							$mail_temp          = str_replace("{shop_name}", ORGANIZATION_NAME, $mail_temp);  
							$mail_temp          = str_replace("{name}", $mail['name'], $mail_temp);
									
							$mail_temp          = str_replace("{current_year}", date('Y'), $mail_temp);                         
							$mail_temp                 =   str_replace("{details}", $details, $mail_temp);
							
							

							$mail['message']    = $mail_temp;
							$mail['from_email']    = FROM_EMAIL;
							$mail['from_name']    = ORGANIZATION_NAME;
							sendmail($mail); 

							
							
							/****************mail ends*******************************************/ 
							/////////////////////////////////////////////////////////////////////////////
			return 1;
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
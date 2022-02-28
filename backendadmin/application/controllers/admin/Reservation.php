<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
AUTHOR NAME: Soma Nandi Dutta
DATE: 06/8/20
PURPOSE: Reservation listing and details
 */
class Reservation extends MY_Controller
{

    public function __construct()
    {
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
        $start_date = "";
        $end_date = "";
        $cafe_id = "";
        if (!empty($_POST['start_date'])) {
            $start_date = date('Y-m-d', strtotime($this->input->post('start_date')));
        } else {
            //$start_date=" ";
        }
        if (!empty($_POST['end_date'])) {
            $end_date = date('Y-m-d', strtotime($this->input->post('end_date')));
        } else {
            //$end_date=" ";
        }
        if (!empty($_POST['cafe_id'])) {
            $cafe_id = $this->input->post('cafe_id');
        }
        
        if( $this->check_valid_admin()['role_id'] !=1)
        {
			$cafe_id = $this->check_valid_admin()['cafe_id'];
        }
        
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['cafe_id'] = $cafe_id;
        //$data['list']=$this->mreservation->getreservationList();
        $data['list'] = $this->mreservation->getreservationList($start_date, $end_date, $cafe_id);
        //echo $this->db->last_query(); die;
        $condition = array('status' => 1, 'is_delete=' => 0);
        $data['cafe_list'] = $this->mcommon->getDetails('master_cafe', $condition);
        $data['title'] = 'Reservation List';
        $data['content'] = 'admin/reservation/list';
        $this->admin_load_view($data);
        //$this->load->view('admin/layouts/index', $data);
    }

    public function detail($reservation_id)
    {
        $data['row'] = $this->mreservation->getreservationById($reservation_id);
        //echo "<pre>";print_r($data['row']);die;
        //echo $data['row']['movie_id'];die;
        $movie_id = $data['row']['movie_id'];
        $cafe_id = $data['row']['cafe_id'];
        //echo $data['row']['cafe_id'];die;
        //echo $movie_id;die;
        if ($cafe_id != 0) {
            $data['cafe_img'] = $this->mreservation->getCafeImgById($cafe_id);
            //print_r( $data['cafe_img']);die;
        }
        if ($movie_id != 0) {
            $data['movie_list'] = $this->mreservation->getMovieById($movie_id);
        }

        $join[] = ['table' => 'food_order_items foi', 'on' => 'foi.food_order_id = rf.order_id', 'type' => 'left'];
        $join[] = ['table' => 'food_items fi', 'on' => 'fi.food_item_id = foi.item_id', 'type' => 'left'];
        $details = $this->mcommon->select('reservation_orders rf', ['rf.reservation_id' => $reservation_id], 'foi.*, fi.*, foi.price ordered_price', 'foi.food_order_item_id', 'ASC', $join);
        $order_details_array = [];
        if (!empty($details)) {
            $join2[] = ['table' => 'food_order_items foi', 'on' => 'foi.food_order_id = rf.order_id', 'type' => 'left'];
            $join2[] = ['table' => 'food_item_addons fi', 'on' => 'fi.food_item_addon_id = foi.item_addon_id', 'type' => 'left'];
            foreach ($details as $key => $value) {
                $value->addons = $this->mcommon->select('reservation_orders rf', ['rf.reservation_id' => $reservation_id, 'foi.item_addon_id !=' => null], 'foi.*, fi.*', '', '', $join2);
                $order_details_array[] = $value;
            }
        }
        $data['details'] = $order_details_array;
        //print_r($data['food_list']); die;
        $coupon_code = $data['row']['coupon_code'];
        //echo $coupon_code;die;
        if (!empty($coupon_code)) {
            $data['coupon_list'] = $this->mreservation->getCouponById($coupon_code);
        }
        $data['title'] = 'Reservation Details';
        $data['content'] = 'admin/reservation/detail';
        $this->admin_load_view($data);
        //$this->load->view('admin/layouts/index', $data);
    }

    public function approval_status()
    {
        if ($_POST['key'] == "activeInactive") {
            $status = $_POST['status'];
            $reservation_id = $_POST['recordId'];
            $condition = array('reservation_id' => $reservation_id);
            $udata = array(
                'reservation_status' => $status,
            );
            $result = $this->mcommon->update('reservation', $condition, $udata);
            //echo $this->db->last_query();die;
            if ($result) {
                echo "success";
            }
        }
    }

    ///add new reservation////////////////////////////////
    public function add()
    {
        $result = array();

        $result['cafe_list'] = $this->mcommon->getDetails('master_cafe', array('status' => '1', 'is_delete' => '0'));

        $result['media_list'] = $this->mcommon->getDetails('master_media', array('status' => '1', 'is_delete' => '0'));
        $result['member_list'] = $this->Mmembership->getMembershipDetails('1');

        $result['user_list'] = $this->mcommon->select('user', ['status' => 1, 'is_delete' => 0, 'role_id !=' => 1], '*');

        $result['content'] = 'admin/reservation/add';
        //pr($result);
        $this->admin_load_view($result);
    }

    public function get_member_data()
    {
        $user_id = $this->input->post('user_id');
        $user_details = $this->mcommon->getRow('user', array('user_id' => $user_id));
        $response = array();
        $response['email'] = $user_details['email'];
        $response['name'] = $user_details['name'];
        $response['mobile'] = $user_details['mobile'];
        echo json_encode($response);
        die;
    }

    public function get_available_room()
    {
        $cafe_id = $this->input->post('cafe_id');
        $reservation_date = $this->input->post('reservation_date');
        $reservation_time = $this->input->post('reservation_time');
        $duration = $this->input->post('duration');
        $condition['cafe_id'] = $cafe_id;
        $List = $this->mcommon->getDetails("room", $condition);
        $html = "";
        ///chk available room
        if (!empty($List)) {
            ///checking available status
            for ($i = 0; $i < count($List); $i++) {
                // echo '<pre>';
                // print_r($List[$i]);
                // die;
                $booked_status = 0;
                $room_id = $List[$i]['room_id'];
                //////////////////////////wishlist & cart checking/////////////////////
                $availability_status = $this->is_available($reservation_date, $room_id, $reservation_time, $duration);

                if ($availability_status == 0) {
                    $html .= "<option value='" . $List[$i]['room_id'] . "'>" . $List[$i]['room_no'] . "</option>";
                }

            }

            echo $html;die;

        }
    }

    ///////////////////////////////if available///////////////////////////
    //   public function is_available($reservation_date,$room_id,$reservation_time,$duration)
    //   {
    //     $availability_status=0;
    //     if($reservation_date!=''&&$room_id!=''&&$reservation_time!=''&&$duration!='')
    //     {
    //            $selectedTime             = $reservation_time;
    //           $start_time_range         = date('H:i:s',strtotime($selectedTime));
    //           $end_time_range           = date('H:i:s',strtotime("+".$duration." hours", strtotime($selectedTime)));
    //           $availability_status        = $this->mapi->is_available($reservation_date,$room_id,$start_time_range,$end_time_range);
    //     }
    //     return $availability_status;
    //   }

    //Updated is_available from API
    public function is_available($reservation_date, $room_id, $reservation_time, $duration)
    {
        $availability_status = 0;
        if ($reservation_date != '' && $room_id != '' && $reservation_time != '' && $duration != '') {
            $selectedTime = $reservation_time;
            $start_time_range = date('H:i:s', strtotime($selectedTime));
            $end_time_range = date('H:i:s', strtotime("+" . $duration . " hours", strtotime($selectedTime)));
            $availability_status = $this->mapi->is_available($reservation_date, $room_id, $start_time_range, $end_time_range);
        }
        return $availability_status;
    }

    ////////add reservation /////////////////////////////////////////////////
    public function add_content()
    {
        // echo "<pre>";// print_r($this->input->post());
        //reservation_no creation 
        $counter_details  = $this->mcommon->getRow("reservation", array('cafe_id'=>$this->input->post('cafe_id')), 'reservation_id desc');
        $cafe_place       = $this->mcommon->getRow("master_cafe", array('cafe_id'=>$this->input->post('cafe_id')))['cafe_place'];
        $final_cafe_place = substr($cafe_place, 0, 5);
        
        if($counter_details['cafe_id_serial_no']==''){
        //if(empty($counter_details['cafe_id_serial_no'])){
            $counter = 1;
        }else{
            $counter = $counter_details['cafe_id_serial_no'] + 1;            
        }
        $final_counter = str_pad($counter, 4, '0', STR_PAD_LEFT);        
        $reservation_no = $final_cafe_place.'/'.date('m').'/'.date('Y').'/'.$final_counter;
        //echo $reservation_no;exit;
        
        $this->form_validation->set_rules('mobile', 'mobile', 'required');
        $this->form_validation->set_rules('no_of_guests', 'no of guests', 'trim|required');
        $this->form_validation->set_rules('reservation_date', 'reservation date', 'trim|required');
        //$this->form_validation->set_rules('reservation_time','reservation time','required');
        $this->form_validation->set_rules('duration', 'duration', 'trim|required');
        $this->form_validation->set_rules('cafe_id', 'Cafe', 'trim|required');
        $this->form_validation->set_rules('room_id', 'Room', 'trim|required');
        $this->form_validation->set_rules('reservation_type', 'Type', 'trim|required');
        $this->form_validation->set_rules('media_type', 'Media Type', 'trim|required');
        $this->form_validation->set_rules('reservation_for', 'Reservation For', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error_message', 'Validation error');
            $this->add();
        } else {
            $reservation_date = $this->input->post('reservation_date');
            $room_id = $this->input->post('room_id');
            $duration = $this->input->post('duration');
            $reservation_time = date('H:i', strtotime($this->input->post('reservation_time')));
            $end_time_range = date('H:i', strtotime("+" . $duration . " hours", strtotime($reservation_time)));
            $availability_status = $this->is_available($reservation_date, $room_id, $reservation_time, $duration);
            /* commented due to off time in frontend -- */

            //  if($availability_status!=0){
            //      $this->session->set_flashdata('error_message','This time this room is not available');
            //     $this->add();
            //  }
            //  else
            //  {
            if ($this->input->post('user_id') > 0) {
                $user_id = $this->input->post('user_id');
            } else {
                $user_id = 0;
            }

            ////////user details:
            $name = "";
            $email = "";
            $mobile = "";
            $message = "";
            if ($this->input->post('name') != "") {
                $name = $this->input->post('name');
            }
            if ($this->input->post('email') != "") {
                $email = $this->input->post('email');
            }
            if ($this->input->post('mobile') != "") {
                $mobile = $this->input->post('mobile');
            }

            if ($this->input->post('message') != "") {
                $message = $this->input->post('message');
            }

            $condition_default_price['id'] = 1;
            $defult_price_row = $this->mcommon->getRow("price_settings", $condition_default_price);
            $defult_price = $defult_price_row['cafe_price'];

            //$total_price=$defult_price*$duration;
            $discount_amount = "0.00";
            $payable_amount = $this->input->post('reservation_charge');
            $coupon_code = "";
            if (!empty($this->input->post('discount_amount'))) {
                $payable_amount = $payable_amount - $this->input->post('discount_amount');
            }
            if (!empty($this->input->post('membership_discount_amount'))) {
                $payable_amount = $payable_amount - $this->input->post('membership_discount_amount');
            }
            //////////////////////////
            $admin = $this->session->userdata('admin');
            $insrtarry = array('reservation_date' => date('Y-m-d', strtotime(str_replace("/", "-", $this->input->post('reservation_date')))),
                'reservation_time' => $reservation_time,
                'reservation_end_time' => $end_time_range,
                //'duration' => $this->input->post('duration') ?? 1,
                'duration' => $this->input->post('duration'),
                'cafe_id' => $this->input->post('cafe_id'),
                'no_of_guests' => $this->input->post('no_of_guests'),
                'total_price' => $this->input->post('reservation_charge'),
                'room_id' => $this->input->post('room_id'),
                'user_id' => $user_id,
                'name' => $name,
                'email' => $email,
                'country_code' => "91",
                'mobile' => $mobile,
                'cafe_price' => $this->input->post('reservation_charge'),
                // 'movie_id'     =>$movie_id,
                'coupon_code' => $this->input->post('coupon'),
                'discount_amount' => $this->input->post('discount_amount'),
                'membership_discount_amount' => $this->input->post('membership_discount_amount'),
                'membership_discount_percent' => $this->input->post('membership_discount_percent'),
                'payable_amount' => $payable_amount,
                'payment_mode' => $this->input->post('reservation_type'), //added after discussion
                                          
                'cafe_id_serial_no' => $final_counter,
                'reservation_no' => $reservation_no,

                'add_from' => 'admin',
                'message' => $message,
                'media_type' => $this->input->post('media_type'),
                'status' => '1',
                'reservation_type' => $this->input->post('reservation_type'),
                'created_by' => $admin['user_id'],
                'created_on' => date('Y-m-d'),
            );

            //print_r($insrtarry);
            $reservation_id = $this->mapi->insert('reservation', $insrtarry);
			//echo $this->db->last_query();
            /** added by ishani on 18.09.2020 */
            //fn defined in common helper
            $user_data['name'] = $name;
            $user_data['email'] = $email;
            $user_data['mobile'] = $mobile;
            insert_all_user($user_data);

            /*****************/
            /********************************** Send reservation details in sms *************************************************/
            $condition_cafe['cafe_id'] = $this->input->post('cafe_id');
            $cafe_row = $this->mapi->getRow("master_cafe", $condition_cafe);
            $reservation_date = $this->input->post('reservation_date');
            
            //$message = "Thank you for confirming your Reservation at " . ORGANIZATION_NAME . ". Your reservation details are: \n";
            //$message .= "Cafe: " . $cafe_row['cafe_name'] . "-" . $cafe_row['cafe_place'] . "\n Date: " . $reservation_date . "\n Time: " . $reservation_time . "\n No. of Guests: " . $this->input->post('no_of_guests');
            //$message .= " \nWe would be holding your reservation for 15 minutes from the time of reservation and it will be released without any prior information.";
            //smsSend($mobile, $message);
            
            $template_id = '1207163653375517655';
            $message = "Dear ".$name."\n";
            $message .= "Thank you for confirming your Reservation at Cinecafes.\n";
            $message .= "Your reservation details are:\n";
            $message .= "Cafe: ".$cafe_row['cafe_name']."-".$cafe_row['cafe_place']."\n";
            $message .= "Date: ".$reservation_date."\n";
            $message .= "Time: ".$reservation_time."\n";
            $message .= "No. of Guests: ".$this->input->post('no_of_guests')."\n";
            $message .= "CINE CAFES";
            
            smsSend($mobile, $message, $template_id);
            
            if(ENVIRONMENT=='production')
            {
                smsSend(NANDINIMOBILE, $message, $template_id);
                smsSend(SUMNANMOBILE, $message, $template_id);
            }
            
            /*********Mail fn ...************************************************/
            $mail['name']       = $name;
            $mail['to']         = $email;
            
            $mail['subject']    = ORGANIZATION_NAME.' - Reservation request received';                             
            $mail_temp          = file_get_contents('./global/mail/reservation_template.html');
            $mail_temp          = str_replace("{web_url}", base_url(), $mail_temp);
            $mail_temp          = str_replace("{logo}", LOGOURL, $mail_temp);
            $mail_temp          = str_replace("{shop_name}", ORGANIZATION_NAME, $mail_temp);  
            $mail_temp          = str_replace("{name}", $mail['name'], $mail_temp);
                    
            $mail_temp          = str_replace("{current_year}", date('Y'), $mail_temp); 

            
            $mail_temp                = str_replace("{cafe_name}", $cafe_row['cafe_name']."-".$cafe_row['cafe_place'], $mail_temp);
            $mail_temp                = str_replace("{reservation_date}", $reservation_date, $mail_temp);
            $mail_temp                = str_replace("{reservation_time}", $reservation_time, $mail_temp);
            $mail_temp                = str_replace("{no_of_guests}", $this->input->post('no_of_guests'), $mail_temp);
            $mail_temp                = str_replace("{reservation_status}", "Confirmed", $mail_temp);
            //echo $mail_temp; die;
            $mail['message']            = $mail_temp;
            $mail['from_email']         = FROM_EMAIL;
            $mail['from_name']          = ORGANIZATION_NAME;
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
                if($this->input->post('cafe_id')==57)
                {
                  $mail['name']            = 'Manager Sec5';
                  $mail['to']              = 'sec5@cinecafes.com';   
                }
                   
                $mail_temp                = str_replace("{name}", $mail['name'], $mail_temp);
                sendmail($mail);
            }
            /*************** mail ends*******************************************/ 
            
            /******************************************************************/
            $this->session->set_flashdata('success_message', 'Booking confirmed.');
            //}
            redirect('admin/reservation');
        }
    }
}

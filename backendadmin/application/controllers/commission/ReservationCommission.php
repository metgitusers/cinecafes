<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ReservationCommission extends MY_Controller {

	public function __construct() {
		parent::__construct();
		
		/*$this->load->library('PushNotification');
		$this->load->model('admin/mreservation');*/
		$this->load->model('admin/mzone');	
		$this->load->model('commission/Mreservationcomission');
		if($this->session->userdata('user_data') == '')
		{
			redirect('commission/Login');
			die();
		}	
	}		
	
	public function index(){
		//echo $this->session->userdata('role_id');exit;
		 $first_day_this_month = date('01/m/Y'); // hard-coded '01' for first day
         $last_day_this_month  = date('t/m/Y');
        $this->session->set_userdata('from_dt', $first_day_this_month);
        $this->session->set_userdata('to_dt', $last_day_this_month); 
		$result 		= array();
		$result['content'] 				= 'admin/reservation/list';
		$result['cafe_list'] 			= $this->mcommon->select('master_cafe', ['status'=> 1, 'is_delete'=> 0]);
		$this->load->view('commission/layouts/reservation_commission_header');			
		$this->load->view('commission/reservation_commission/reservation_commission_list',$result);
		$this->load->view('commission/layouts/footer');
	}

	public function filterSearchReservationCommission()
	{
		$data   			= array();
		$responce_arr       = array();
		$final_resv_commission_list   = array();		
        $cond   			= '1';
        $commission_charge 	= 100;
        $total_commission	= 0;   
        $total_reservation	= 0; 
        $from_dt      = $this->input->post("from_date");
        $to_dt        = $this->input->post("to_date");
        $cafe_id      = $this->input->post("cafe_id");
        if($from_dt !='' && $to_dt !=''){
          $this->session->set_userdata('from_dt', $from_dt);
          $this->session->set_userdata('to_dt', $to_dt);  
          $from_date  = date('Y-m-d',strtotime(str_replace('/','-',$from_dt)));
          $to_date    = date('Y-m-d',strtotime(str_replace('/','-',$to_dt)));
          $cond .=  " and rev.reservation_date between '".$from_date."' and '".$to_date."'";      
        }
        else
        {
            $this->session->set_userdata('from_dt', "");
            $this->session->set_userdata('to_dt', ""); 
        }
        if($cafe_id !=''){
      		$cond .= " and rev.cafe_id ='".$cafe_id."'";
    	}
        $resv_commission_list    = $this->Mreservationcomission->reservationCommissionFilterSearch($cond, $cafe_id);
        //pr($resv_commission_list);
        if(!empty($resv_commission_list)){
        	foreach($resv_commission_list as $val){
    			$resv_commisn_list['no_of_reservation'] = $val['no_of_reservation'];
    			$resv_commisn_list['cafe_id'] 			= $val['cafe_id'];
    			$resv_commisn_list['cafe_name'] 		= $val['cafe_name'];
    			$resv_commisn_list['cafe_place'] 		= $val['cafe_place'];

    			$final_resv_commission_list[] = $resv_commisn_list;
        	}
        	$data['reservation_commission_list']  = $final_resv_commission_list;
        }
        //pr($data['reservation_commission_list']);
        if(!empty($data['reservation_commission_list'])){
        	foreach($data['reservation_commission_list'] as $list){
        		$total_reservation	= $total_reservation + $list['no_of_reservation'];
        		$total_commission	= $total_commission + ($list['no_of_reservation']*$commission_charge);
        	}
        } 
        $data['total_reservation_commission']    =  $total_commission;
        $data['total_reservation_cnt']    		 =  $total_reservation;
		// echo '<pre>';
		// print_r($data); die;
        $responce_arr['html'] = $this->load->view('commission/reservation_commission/ajax_reservation_commission_list',$data,true);
        echo json_encode($responce_arr);exit;
	}

	public function viewReservationDetails($cafe_id = null)
	{
		$data   	= array();		
        $cond   	= '1';
		if(!empty($cafe_id)){
			
			$data['cafe_id'] = $cafe_id;
			$join[] = ['table' => 'room_type rt', 'on' => 'rt.room_type_id = room.room_type_id', 'type' => 'left'];
			$data['room_list'] = $this->mcommon->select('room', ['room.status'=> 1, 'room.is_delete'=> 0, 'room.cafe_id'=> $cafe_id], 'room.*, rt.room_type_name', 'room.room_id', 'DESC', $join);
			$this->load->view('commission/layouts/reservation_commission_header');			
			$this->load->view('commission/reservation_commission/reservation_details_list',$data);
			$this->load->view('commission/layouts/footer');
		}
		else{
			redirect('commission/ReservationCommission');
		}
	}

	public function filterSearchResvDetails()
	{
		$data   			= array();
		$responce_arr       = array();				
        $cond   			= '1';        
        $from_dt      		= $this->input->post("from_date");
        $to_dt        		= $this->input->post("to_date");
        $status_id     		= $this->input->post("status_id");
        $cafe_id     		= $this->input->post("cafe_id");
        $room_id     		= $this->input->post("room_id");
        //$reservation_date   = $this->input->post("reservation_date");
        $cond .=  " and reservation.cafe_id = '".$cafe_id."'";
        if($from_dt !='' && $to_dt !=''){
          $from_date  = date('Y-m-d',strtotime(str_replace('/','-',$from_dt)));
          $to_date    = date('Y-m-d',strtotime(str_replace('/','-',$to_dt)));
          $cond .=  " and reservation.reservation_date between '".$from_date."' and '".$to_date."'";      
        }
        else{
        	$cond .=  " and reservation.reservation_date = '".date('Y-m-01')."' AND '".date('Y-m-d')."'";
        }
        if($status_id !=''){
      		$cond .= " and reservation.status ='".$status_id."'";
    	}
        if($room_id !=''){
      		$cond .= " and reservation.room_id ='".$room_id."'";
    	}
    	$reservation_details		= $this->Mreservationcomission->get_reservation_list($cond);			
		$data['reservation_data']	= $reservation_details;
		// echo '<pre>';
		// print_r($data['reservation_data']); die;
		$responce_arr['html'] = $this->load->view('commission/reservation_commission/ajax_reservation_details_list',$data,true);
        echo json_encode($responce_arr);exit;
	}
}
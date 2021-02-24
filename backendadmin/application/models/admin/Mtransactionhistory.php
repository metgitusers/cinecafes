<?php
class Mtransactionhistory extends CI_Model{
/*
    AUTHOR NAME: Soma Nandi Dutta
    DATE: 20/8/20
    PURPOSE: Transactionhistory listing
*/

    function __construct(){
        parent::__construct();
    }
    public function getTransactionhistoryList($start_date=null,$end_date=null,$user_id=null){
 
        /*if(!empty($start_date)){
            if($start_date != '')
            {
                 $start_dt=date('Y-m-d',strtotime($start_date));
                 echo $start_dt;die;
            }
        }
        if(!empty($end_date)){
            if($end_date != '')
            {
                 //$end_dt=date('Y-m-d',strtotime($end_date));
                $end_dt=date('Y-m-d',strtotime($end_date));
                  echo $end_dt;die;
            }
        }*/

        $this->db->select('transaction_history.*,user.name,user.email,user.mobile,reservation.reservation_date,reservation.reservation_time,master_cafe.cafe_name,master_package.package_name');
        $this->db->from('transaction_history');
        //$this->db->join('master_package', 'master_package.package_id = transaction_history.package_id');
        $this->db->join('user', 'user.user_id = transaction_history.user_id', 'inner');
       
        $this->db->join('reservation', 'reservation.reservation_id = transaction_history.reservation_id', 'left');
        $this->db->join('master_cafe', 'master_cafe.cafe_id = reservation.cafe_id', 'left');

        $this->db->join('master_package', 'master_package.package_id = transaction_history.package_id', 'left');
       
        if(!empty($start_date) && !empty($end_date) ){
           //$this->db->where('reservation_date between "'.$start_dt.'" and "'.$end_dt.'"');
           $this->db->where('transaction_date between "'.date('Y-m-d 00:00:01', strtotime($start_date)).'" and "'.date('Y-m-d 23:59:00', strtotime($end_date)).'"');
        }
        if($user_id > 0){
           //$this->db->where('reservation_date between "'.$start_dt.'" and "'.$end_dt.'"');
           $this->db->where('transaction_history.user_id',$user_id);
        }

        
        $this->db->order_by("transaction_history.transaction_history_id", "desc");
        $query=$this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }
    public function getpackage($package_id){
      //echo $package_id;die;
      if($package_id!=0){
        $sql = "select package_name from master_package where master_package.package_id='".$package_id."'";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        //echo $this->db->last_query();
        return $result; 
      }
    } 
    public function getDetails($table,$condition){
        $this->db->where($condition);
        $query=$this->db->get($table);
        //echo $this->db->last_query();
        return $query->result_array(); 
    }

    //get transacted users
    public function getDistinctUser()
    {
         $sql = "select distinct transaction_history.user_id,user.name from transaction_history left join user on user.user_id=transaction_history.user_id";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        //echo $this->db->last_query();
        return $result; 
    }
    
}
<?php
class Mwallet extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    public function getWalletList()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user.is_delete',0);
        $this->db->where('user.role_id!=',1);
       // $this->db->order_by('user.user_id','desc');
        $this->db->order_by('user.wallet','desc');
        $query=$this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }
   
    public function getWalletTransactionhistoryList($user_id=null){
 
       
        $this->db->select('transaction_history.*,user.name,user.email,user.mobile,reservation.reservation_date,reservation.reservation_time,master_cafe.cafe_name,master_package.package_name');
        $this->db->from('transaction_history');
        //$this->db->join('master_package', 'master_package.package_id = transaction_history.package_id');
        $this->db->join('user', 'user.user_id = transaction_history.user_id', 'inner');
       
        $this->db->join('reservation', 'reservation.reservation_id = transaction_history.reservation_id', 'left');
        $this->db->join('master_cafe', 'master_cafe.cafe_id = reservation.cafe_id', 'left');

        $this->db->join('master_package', 'master_package.package_id = transaction_history.package_id', 'left');
       
        $this->db->where('transaction_history.user_id='.$user_id.' and ( transaction_history.payment_mode="wallet" or transaction_history.add_wallet=1)');
       
        $this->db->order_by("transaction_history.transaction_history_id", "desc");
        $query=$this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }


}
<?php
class Msubadmin extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    public function getsubadminList()
    {
        $this->db->select('user.*,master_role.role_id,master_cafe.cafe_name,master_cafe.cafe_place');
        $this->db->from('user');
        $this->db->join('master_role', 'master_role.role_id = user.role_id');
        $this->db->join('master_cafe', 'master_cafe.cafe_id = user.cafe_id');
        $this->db->where('user.role_id!=',0);
        $this->db->where('user.role_id!=',1);
        $this->db->where('user.is_delete',0);
        $this->db->order_by('user.user_id','desc');
        $query=$this->db->get();
       // echo $this->db->last_query();die;
        return $query->result_array();
    }
    public function get_details($table,$condition){
        $this->db->where($condition);
        $query=$this->db->get($table);
        //echo $this->db->last_query();die;
        return $query->row_array();
    } 
    

}
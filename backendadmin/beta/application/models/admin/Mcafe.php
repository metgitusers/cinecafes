<?php
class Mcafe extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    public function getCafeList()
    {
       // $supplier=$this->session->userdata('supplier'); 
        $this->db->select('master_cafe.*,CONCAT(cafe_name, "-",cafe_place) AS cafe_name');
        $this->db->from('master_cafe');
        //$this->db->where('product_master.status',1);
        //$this->db->where('product_master.supplier_id',$supplier['user_id']);
        $this->db->where('master_cafe.is_delete',0);
        $this->db->order_by('master_cafe.cafe_id','desc');
        $query=$this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }
    public function get_details($table,$condition){
        $this->db->where($condition);
        $query=$this->db->get($table);
        //echo $this->db->last_query();die;
        return $query->row_array();
    } 
    public function getImages($cafe_id){
        $sql = "select image from cafe_images where cafe_images.cafe_id='".$cafe_id."' limit 1";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result; 
    } 
    public function getallImages($cafe_id){
        $sql = "select * from cafe_images where cafe_id='".$cafe_id."'";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        //echo $this->db->last_query();die;
        return $result; 
    } 


}
<?php
class Mreview extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    public function getReviewList()
    {
        $this->db->select('rating_review.*,CONCAT(master_cafe.cafe_name, "-",master_cafe.cafe_place) AS cafe_name,user.name,user.email');
        $this->db->from('rating_review');
        $this->db->join('master_cafe', 'master_cafe.cafe_id = rating_review.cafe_id');
        $this->db->join('user', 'user.user_id = rating_review.user_id');
        //$this->db->where('user.is_delete',0);
        //$this->db->where('rating_review.status',1);
        $this->db->order_by('rating_review.rating_id','desc');
        $query=$this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }
   
   


}
<?php
class Mmovie extends CI_Model{
/*
        AUTHOR NAME: Soma Nandi Dutta
        DATE: 29/7/20
        PURPOSE: movie listing
*/
    function __construct(){
        parent::__construct();
    }

    public function getmovieList(){

        $this->db->select('movie.*,movie_category.category_name');
        $this->db->from('movie');
        $this->db->join('movie_category', 'movie_category.category_id = movie.category_id');
        $this->db->where("movie.is_delete", "0");
        $this->db->order_by("movie.movie_id", "desc");
        $query=$this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }
    public function getDetails($table,$condition){
        $this->db->where($condition);
        $query=$this->db->get($table);
        //echo $this->db->last_query();
        return $query->result_array(); 
    }
    
   

}
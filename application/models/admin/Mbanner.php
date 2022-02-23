<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mbanner extends CI_Model {
	var $table = 'banner';	
    var $column_order = array('banner.id','banner.banner_image'); //set column field database for datatable orderable
    var $column_search = array('banner.id','banner.banner_image'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('id' => 'desc'); // default order 
	public function __construct() {
        parent::__construct();
    }
	
	private function _get_datatables_query(){
		$this->db->select('*');
        $this->db->from($this->table);		
        $i = 0;
        foreach ($this->column_search as $item){ // loop column			
            if($_POST['search']['value']){ // if datatable send POST for search                 
                if($i===0){ // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else{
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i) //last loop
                $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])){ // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
	
	public function get_datatables(){   
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
	
	public function count_filtered(){
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
	
	public function count_all(){
        $this->db->from($this->table); 		
        return $this->db->count_all_results();
    }
	
	public function get_details($id){
        $this->db->from($this->table);        
        $this->db->where('id',$id);
        $query=$this->db->get();
        return $query->row_array();
    }
	
	public function add($data){
        $this->db->insert($this->table,$data);
        return $this->db->insert_id();
    }
	
	public function update($condition,$data){
		$this->db->where($condition);
		$this->db->update($this->table,$data);
		return 1;
	}
	
	public function delete($condition){
        $this->db->delete($this->table,$condition);
        return 1;
    }
	
	public function active($condition,$data){
        $this->db->where($condition);
        $this->db->update($this->table,$data);
        return 1;
    }
	
	public function check_banner_exsits($cms_id){
		$this->db->select('*');
        $this->db->from($this->table);		
		 $this->db->where('cms_id',$cms_id);	
        $query=$this->db->get();
		if($query->result())
		{
			return 1;
		}else{
			return 0;
		}
	}
	
	public function getRows($table,$condition){
        $this->db->where($condition);
		
		if(isset($limit)){
          $this->db->limit($limit);      
        }
        $query=$this->db->get($table);		
        return $query->result_array();
    }
	
	public function get_row($table,$condition){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($condition);
        $query=$this->db->get();
        return $query->row_array();
    }
}
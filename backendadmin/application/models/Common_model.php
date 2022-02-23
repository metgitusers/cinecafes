<?php
class Common_model extends CI_Model {
 
	/**
	* Responsable for auto load the database
	* @return void
	*/
	
	function add($table,$data){
		  $this->db->insert($table, $data);
		  return $this->db->insert_id();
	}
	function update($table,$data,$condition=null){
		if(isset($condition)){
				foreach($condition as $key => $value){
					  $this->db->where($key,$value);
				}
		}
		$this->db->update($table, $data);
		return true;
  
	}
	public function get($table,$what=null,$condition=null,$limit_start=null, $limit_end=null,$group=null,$condition1=null,$order_in=null,$order_by='DESC',$join=null,$join_type=null)
	{
		if(isset($what)){
				foreach ($what as $key => $value){
					$this->db->select($value);
				}
		}else{
				$this->db->select('*');
		}
		
		$this->db->from($table);
		if(isset($condition)){
				foreach ($condition as $key => $value){
					$this->db->where($key,$value);
				}
		}
		if(isset($condition1)){
				$this->db->where($condition1);
		}
		if(isset($join)){
			 foreach ($join as $key => $value){
					$this->db->join($key,$value,$join_type[$key]);
			 }
		}
		if($limit_start != null){
					$this->db->limit($limit_start, $limit_end);    
		}
		if($group != null){
					$this->db->group_by($group);
		}
		
		if($order_in != null ){
			$this->db->order_by($order_in,$order_by);
		}
		$query = $this->db->get();
		return $query->result_array();
	}
	function count($table,$condition=null,$limit_start=null, $limit_end=null)
	{
		$this->db->select('*');
		$this->db->from($table);
		if(isset($condition)){
				foreach ($condition as $key => $value){
					 $this->db->where($key,$value);
				}
		}
		if($limit_start != null){
					$this->db->limit($limit_start, $limit_end);    
		}
		$query = $this->db->get();
		return $query->num_rows();        
	}
	function delete($table,$condition=null){
		if(isset($condition)){
				foreach ($condition as $key => $value){
						$this->db->where($key,$value);
			  }
		}
		$this->db->delete($table);
		return true;
	}
	function get_time_diff( $start,$end)
	{
		$uts['start'] = strtotime( $start );
		$uts['end'] = strtotime( $end );

		if( $uts['start']!==-1 && $uts['end']!==-1 ){
					if($uts['end'] >= $uts['start'] ){
					
						$diff = $uts['end'] - $uts['start'];
						if( $year=intval((floor($diff/(365*86400)))) )
							 $diff = $diff % (365*86400);
						if( $months=intval((floor($diff/(30*86400)))) )
							 $diff = $diff % (30*86400);
						if( $days=intval((floor($diff/86400))) )
							 $diff = $diff % 86400;
						if( $hours=intval((floor($diff/3600))) )
							 $diff = $diff % 3600;
						if( $minutes=intval((floor($diff/60))) )
							 $diff = $diff % 60;
	
						$diff = intval( $diff );
						$start= array('years'=>$year,'months'=>$months,'days'=>$days, 'hours'=>$hours, 'minutes'=>$minutes, 'seconds'=>$diff) ;
						if($start['years']>0)
							 {return( $start['years']);}
						elseif($start['months']>0)
							 {return( '');}
						else
							 {return( '');}
					}else{
						return '';
					}
		}else{
				return '';
		}
		return( false );
	}
}
?>
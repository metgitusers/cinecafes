<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Madd extends CI_Model {

	public function add_user($data)
    {
        $num = '';
        $query = '';

        $query = "insert into master_cafe (cafe_name, cafe_description, cafe_location, avg_rating, review_count, price, status, is_delete, created_by, updated_by) values ('$data[name]', '$data[desp]', '$data[address]', 0.0, 0.0, 0, 1, 0, 1, 1)";
        $this->db->query($query);
        $num = $this->db->affected_rows();


        //return $result;

        if($num == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
	public function add_user_image($img)
    {
        $num = '';
        $query = '';
		$id = $this->db->insert_id();
        $query = "insert into cafe_images (cafe_id, cafe_image) values ($id, '$img')";
        $this->db->query($query);
        $num = $this->db->affected_rows();



        //return $result;

        /*if($num == 1)
        {
            return true;
        }
        else
        {
            return false;
        }*/
            
    }

}
?>
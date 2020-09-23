<?php
 class Mapi extends CI_Model {
    function __construct(){
        parent::__construct(); 
    }

    ///////////////////added for member details//////////////////////////////
    public function getMemberDetailsRow($condition){
        $this->db->select("user.*,(IF(user_profile.profile_img !='',CONCAT('".base_url()."public/upload_images/profile_photo/',user_profile.profile_img),'".base_url()."public/upload_images/No_Image_Available.jpg')) as profile_image,user_profile.address,user_profile.lat,user_profile.lng,DATE_FORMAT(user_profile.dob, '%d/%m/%Y') as dob,user_profile.gender as gender");
        $this->db->join('user_profile', 'user_profile.user_id = user.user_id', 'inner'); 
        //$this->db->join('api_token', 'api_token.user_id = user.user_id', 'inner');
       // $this->db->join('package_membership_mapping', 'package_membership_mapping.member_id = mm.member_id', 'left');
       
        $this->db->where($condition);
        //$this->db->where('package_membership_mapping.status','1');
        $query=$this->db->get('user');
        //echo $this->db->last_query(); die();
        return $query->result_array(); 
    }

    ///////////////////added for movie list//////////////////////////////
    public function getMovieList($table,$condition,$order_col=null,$order_type=null,$start=null,$length=null,$user_id=null,$cafe_id=null){
        $this->db->select("movie.*,(IF(movie.image !='',CONCAT('".base_url()."public/upload_images/movie_images/',movie.image),'".base_url()."public/upload_images/No_Image_Available.jpg')) as image,movie_category.category_name");
        $this->db->join('movie_category', 'movie_category.category_id = movie.category_id', 'inner'); 
        
       
        
        if($cafe_id>0)
        {
            $this->db->join('movie_cafe_mapping', 'movie_cafe_mapping.movie_id = movie.movie_id', 'left'); 
           $this->db->where('movie_cafe_mapping.cafe_id',$cafe_id); 
        }
        $this->db->where($condition);
        if(!empty($order_col) && !empty($order_type)){
        $this->db->order_by($order_col,$order_type);
        }
        if($length>0){
        $this->db->limit($length,$start);
        }
        $query=$this->db->get($table);
        //echo $this->db->last_query(); die();
        
        ////for multiple images
        $List=$query->result_array();
        for($i=0;$i<count($List);$i++)
        {
         
          ////////////////////////get images.............................
            $images_arr=array();
            $mapped_id=$List[$i]['movie_id'];
            $mapped_column_name="movie_id";
            $table_img="movie_images";
            $images_arr =$this->getOtherData($table_img,$mapped_column_name,$mapped_id);
            $List[$i]['images'] =$images_arr;          
        }
        return $List;
    }

    ///////////////////added for food list//////////////////////////////
    public function getFoodList($table,$condition,$order_col=null,$order_type=null,$start=null,$length=null,$user_id=null){
        $this->db->select("food.*,(IF(food.image !='',CONCAT('".base_url()."public/upload_images/food_images/',food.image),'".base_url()."public/upload_images/No_Image_Available.jpg')) as image,food_category.category_name");
        $this->db->join('food_category', 'food_category.category_id = food.category_id', 'inner'); 
       
        $this->db->where($condition);
        if(!empty($order_col) && !empty($order_type)){
        $this->db->order_by($order_col,$order_type);
        }
        if($length>0){
        $this->db->limit($length,$start);
        }
        $query=$this->db->get($table);
        $List=$query->result_array();
        for($i=0;$i<count($List);$i++)
        {
            ////////////////////////get variant.............................
            $variant_arr=array();
            $mapped_id=$List[$i]['food_id'];
            $mapped_column_name="food_id";
            $table_variant="food_variant";
            $variant_arr =$this->getOtherData($table_variant,$mapped_column_name,$mapped_id);
            $List[$i]['variant_data'] =$variant_arr;  
         
          ////////////////////////get add on.............................
            $addon_arr=array();
            $mapped_id=$List[$i]['food_id'];
            $mapped_column_name="food_id";
            $table_addon="food_addon";
            $addon_arr =$this->getOtherData($table_addon,$mapped_column_name,$mapped_id);
            $List[$i]['add_on_data'] =$addon_arr;          
        }
        return $List;
    }

    ///////////////////added for room list by availability//////////////////////////////
    public function getAvailableRoomList($table,$condition,$order_col=null,$order_type=null,$start=null,$length=null,$user_id=null){
        $this->db->select("room.*,(IF(room.image !='',CONCAT('".base_url()."public/upload_images/room_images/',room.image),'".base_url()."public/upload_images/No_Image_Available.jpg')) as image,room_type.room_type_name,room.no_of_people as capacity");
        $this->db->join('room_type', 'room_type.room_type_id = room.room_type_id', 'inner'); 
       
        $this->db->where($condition);
        if(!empty($order_col) && !empty($order_type)){
        $this->db->order_by($order_col,$order_type);
        }
        if($length>0){
        $this->db->limit($length,$start);
        }
        $query=$this->db->get($table);
        //echo $this->db->last_query(); die();
        return $query->result_array(); 
    }
    /////////////////////////////////////////////////////////////////////////
     public function getReservationList($table,$condition,$order_col=null,$order_type=null,$start=null,$length=null,$status=null){
       // SELECT * FROM `reservation` WHERE unix_timestamp(concat(reservation_datetime," ",reservation_time)) < unix_timestamp(now())
       //  $query = "select reservation.*,room.room_no,movie.name from reservation left join room on reservation.room_id = room.room_id left join movie on reservation.movie_id = movie.movie_id where unix_timestamp(concat(`reservation_date`,' ',`reservation_time`)) < unix_timestamp(now()) order by reservation.reservation_id desc";     
       // //echo $query;exit;
       //  $query1 = $this->db->query($query);
        $this->db->select("reservation.*,room.room_no,movie.name,master_cafe.cafe_name,master_cafe.cafe_place,master_cafe.cafe_location,(IF(cafe_images.image !='',CONCAT('".base_url()."public/upload_images/cafe_images/',cafe_images.image),'".base_url()."public/upload_images/No_Image_Available.jpg')) as cafe_image");
        $this->db->join('room', 'room.room_id = reservation.room_id', 'left');
        $this->db->join('movie', 'movie.movie_id = reservation.movie_id', 'left'); 
        $this->db->join('master_cafe', 'master_cafe.cafe_id = reservation.cafe_id', 'left');
        $this->db->join('cafe_images', 'cafe_images.cafe_id = reservation.cafe_id', 'left');
        $this->db->where($condition);
        if($status=="past")
        {
          $this->db->where("unix_timestamp(concat(`reservation_date`,' ',`reservation_time`)) < unix_timestamp(now())");  
        }
        if($status=="upcoming")
        {
          $this->db->where("unix_timestamp(concat(`reservation_date`,' ',`reservation_time`)) >= unix_timestamp(now())");  
        }
        $status_reservation=1;
        if($status=="cancelled")
        {
           $status_reservation=2;
        }
        $this->db->where("reservation.status",$status_reservation); 
        if(!empty($order_col) && !empty($order_type)){
        $this->db->order_by($order_col,$order_type);
        }
        if($length>0){
        $this->db->limit($length,$start);
        }
        $query=$this->db->get($table);
        //echo $this->db->last_query(); die();
        $List=$query->result_array();
        for($i=0;$i<count($List);$i++)
        {
         
          ////////////////////////get food.............................
            $food_arr=array();
            
            $reservation_id=$List[$i]['reservation_id'];

            //food list
            $this->db->select("reservation_food_mapping.*,food.name,food.veg_nonveg,(IF(food.image !='',CONCAT('".base_url()."public/upload_images/food_images/',food.image),'".base_url()."public/upload_images/No_Image_Available.jpg')) as image,food_category.category_name,food_variant.food_variant_name");
            $this->db->join('food', 'food.food_id = reservation_food_mapping.food_id', 'left');
            $this->db->join('food_category', 'food_category.category_id = food.category_id', 'left'); 
            $this->db->join('food_variant', 'food_variant.food_variant_id = reservation_food_mapping.food_variant_id', 'left'); 
       
            $this->db->where("reservation_food_mapping.reservation_id",$reservation_id);
            $query_food=$this->db->get("reservation_food_mapping");
            $food_arr=array();
            $food_data=$query_food->result_array();
            $food_arr=$food_data;
            //echo $this->db->last_query(); die;

            //addon list
            for($k=0;$k<count($food_arr);$k++)
            {
               $food_id=$food_arr[$k]['food_id'];

               $addon_arr=array();
               if($food_id>0)
               {
               $this->db->select("reservation_addon_mapping.*,food_addon.addon_text as addon");
               $this->db->join('food_addon', 'food_addon.addon_id = reservation_addon_mapping.addon_id', 'left');
               $this->db->where("reservation_addon_mapping.reservation_id",$reservation_id);
               $this->db->where("reservation_addon_mapping.food_id",$food_id);
                $query_addon=$this->db->get("reservation_addon_mapping");
                $addon_arr=$query_addon->result_array();
                }
              $food_arr[$k]['addon_list']=$addon_arr;
                
            }
            
            $List[$i]['food_list'] =$food_arr;          
        }
        // echo '<pre>';
        // print_r($List);
        // echo '</pre>';
        // die;
        return $List;
    }

    ///////////////////added for review list//////////////////////////////
    public function geReviewList($table,$condition,$order_col=null,$order_type=null,$start=null,$length=null,$user_id=null){
        $this->db->select("rating_review.*,(IF(user_profile.profile_img !='',CONCAT('".base_url()."public/upload_images/profile_photo/',user_profile.profile_img),'".base_url()."public/upload_images/No_Image_Available.jpg')) as profile_image,user.name");
        $this->db->join('user', 'rating_review.user_id = user.user_id', 'inner'); 
       $this->db->join('user_profile', 'rating_review.user_id = user_profile.user_id', 'left'); 
        $this->db->where($condition);
        if(!empty($order_col) && !empty($order_type)){
        $this->db->order_by($order_col,$order_type);
        }
        if($length>0){
        $this->db->limit($length,$start);
        }
        $query=$this->db->get($table);
        //echo $this->db->last_query(); die();
        return $query->result_array(); 
    }

    public function insert($table,$data){
        $this->db->insert($table,$data);
        //echo $this->db->last_query(); die();
        return $this->db->insert_id();
    }
	public function batch_insert($table,$data){
        $this->db->insert_batch($table,$data);
        return 1;
    } 
    public function getDashboardDetails($condition){
        $this->db->select("*,(IF(dashboard_images !='',CONCAT('".base_url()."public/upload_images/dashboard_images/',dashboard_images),'".base_url()."public/upload_images/No_Image_Available.jpg')) as dashboard_images");
        $this->db->where($condition);
        $query=$this->db->get('front_dashboard_images');
        return $query->result_array(); 
    }
    public function getDetails($table,$condition = null){
        if(!empty($condition)){
            $this->db->where($condition);
        }        
        $query=$this->db->get($table);
        return $query->result_array(); 
    }
    public function getRow($table,$condition = null){
         if(!empty($condition)){
            $this->db->where($condition);
        }    
        //$this->db->where($condition);
        $query=$this->db->get($table);
        //echo $this->db->last_query(); die();
        return $query->row_array();
    }
    public function getRow3($table,$condition){
        $this->db->where($condition);
        $query=$this->db->get($table);
        echo $this->db->last_query(); die();
        return $query->row_array();
    }
    public function getRowObject($table,$condition){
        $this->db->where($condition);
        $query=$this->db->get($table);
        return $query->row();
    }


    public function getRowsLike($table,$searchText,$searchCol,$condition=array(),$order_col=null,$order_type=null){
       $this->db->like($searchCol, $searchText);
       $this->db->where($condition);
        if(!empty($order_col) && !empty($order_type)){
            $this->db->order_by($order_col,$order_type);
        }
        $query=$this->db->get($table);      
        return $query->result_array();
    } 

    public function getRowsIn($table,$categories,$inCol,$condition=array(),$order_col=null,$order_type=null){
       $this->db->select('*');
        $this->db->from($table);
        $this->db->where_in($inCol, $categories);
        $this->db->where($condition);
        if(!empty($order_col) && !empty($order_type)){
            $this->db->order_by($order_col,$order_type);
        }
        $query = $this->db->get();    
        return $query->result_array();
    } 

    public function getRowsInLike($table,$categories,$inCol,$searchText,$searchCol,$condition=array(),$order_col=null,$order_type=null){
       $this->db->select('*');
        $this->db->from($table);
        $this->db->where_in($inCol, $categories);
        $this->db->like($searchCol, $searchText);
        $this->db->where($condition);
        if(!empty($order_col) && !empty($order_type)){
            $this->db->order_by($order_col,$order_type);
        }
        $query = $this->db->get();    
        return $query->result_array();
    } 
    // public function getMemberDetailsRow($condition){
    //     $this->db->select("mm.*,package_membership_mapping.membership_id,DATE_FORMAT(mm.dob, '%d/%m/%Y') as dob,DATE_FORMAT(mm.doa, '%d/%m/%Y') as doa,(IF(mm.profile_img !='',CONCAT('".base_url()."public/upload_images/profile_photo/',mm.profile_img),'".base_url()."public/upload_images/No_Image_Available.jpg')) as profile_image,api_token.access_token as access_token"); 
    //     $this->db->join('api_token', 'api_token.member_id = mm.member_id', 'inner');
    //     $this->db->join('package_membership_mapping', 'package_membership_mapping.member_id = mm.member_id', 'left');
       
    //     $this->db->where($condition);
    //     //$this->db->where('package_membership_mapping.status','1');
    //     $query=$this->db->get('master_member mm');
    //     //echo $this->db->last_query(); die();
    //     return $query->result_array(); 
    // }
    
    public function getNotificationList($notif_cond){
        //pr($notif_cond);
        $this->db->select("notification.*"); 
        //$this->db->join('notification', 'notification.user_id = user.user_id', 'left');
        $this->db->where($notif_cond);
        $this->db->order_by('notification_id','desc');
        $query=$this->db->get('notification');
        //echo $this->db->last_query(); die();
        return $query->result_array(); 
    }
   
    public function getCount($table,$condition){
        $this->db->where($condition);
        $query=$this->db->get($table);
        return $query->num_rows();
    } 
    
	public function delete($table,$condition){
        $this->db->where($condition);  
        $this->db->delete($table); 
        return true;
    }
    public function joinQuery($data,$condition = null,$return_type,$order_by= null,$order_type = 'ASC'){
        //pr($data,0);
        if(array_key_exists('select',$data) && $data['select'] != ""){
            $this->db->select($data['select']);
        }else{
            $this->db->select('*');
        }
        $this->db->from($data['first_table']);

        if(array_key_exists('second_table',$data) && array_key_exists('dependency1',$data) && array_key_exists('join_type1',$data)){
            if($data['second_table'] != "" && $data['dependency1'] != "" && $data['join_type1'] != ""){
                $this->db->join($data['second_table'],$data['dependency1'],$data['join_type1']);
            }
        }
        if(array_key_exists('third_table',$data) && array_key_exists('dependency2',$data) && array_key_exists('join_type2',$data)){
            if($data['third_table'] != "" && $data['dependency2'] != "" && $data['join_type2'] != ""){
                $this->db->join($data['third_table'],$data['dependency2'],$data['join_type2']);
            }
        }
        if(array_key_exists('forth_table',$data) && array_key_exists('dependency3',$data) && array_key_exists('join_type3',$data)){
            if($data['forth_table'] != "" && $data['dependency3'] != "" && $data['join_type3'] != ""){
                $this->db->join($data['forth_table'],$data['dependency3'],$data['join_type3']);
            }
        }
        if(array_key_exists('fifth_table',$data) && array_key_exists('dependency4',$data) && array_key_exists('join_type4',$data)){
            if($data['fifth_table'] != "" && $data['dependency4'] != "" && $data['join_type4'] != ""){
                $this->db->join($data['fifth_table'],$data['dependency4'],$data['join_type4']);
            }
        }
        if(array_key_exists('sixth_table',$data) && array_key_exists('dependency5',$data) && array_key_exists('join_type5',$data)){
            if($data['sixth_table'] != "" && $data['dependency5'] != "" && $data['join_type5'] != ""){
                $this->db->join($data['sixth_table'],$data['dependency5'],$data['join_type5']);
            }
        }
        if(array_key_exists('seventh_table',$data) && array_key_exists('dependency6',$data) && array_key_exists('join_type6',$data)){
            if($data['seventh_table'] != "" && $data['dependency6'] != "" && $data['join_type6'] != ""){
                $this->db->join($data['seventh_table'],$data['dependency6'],$data['join_type6']);
            }
        }
        if(array_key_exists('eighth_table',$data) && array_key_exists('dependency7',$data) && array_key_exists('join_type7',$data)){
            if($data['eighth_table'] != "" && $data['dependency7'] != "" && $data['join_type7'] != ""){
                $this->db->join($data['eighth_table'],$data['dependency7'],$data['join_type7']);
            }
        }
        if(array_key_exists('ninth_table',$data) && array_key_exists('dependency8',$data) && array_key_exists('join_type8',$data)){
            if($data['ninth_table'] != "" && $data['dependency8'] != "" && $data['join_type8'] != ""){
                $this->db->join($data['ninth_table'],$data['dependency8'],$data['join_type8']);
            }
        }
        $this->db->where($condition);
        $this->db->order_by($order_by, $order_type);
        //ORDER BY `menu_rank` ASC
        $query = $this->db->get();
//echo $this->db->last_query();
        if($query->num_rows() > 0){
            if($return_type == 'result'){
                return $query->result_array();
            }elseif($return_type == 'row'){
                return $query->row_array();
            }
        }else{
            return false;
        }
    }
    
    public function update($table,$condition,$data){
        $this->db->where($condition);
        $this->db->update($table,$data);
     //echo $this->db->last_query();exit;
        return 1;
    }
    public function getMembershipData($package_id=NULL){
        $result=array();
        $where="";
        if($package_id>0)
        {
            $where .= " and mp.package_id=".$package_id;
        } 
        $query = "select mp.*,pt.package_type_name from master_package mp left join package_type as pt on pt.package_type_id = mp.package_type_id where mp.status = '1' and mp.is_delete = '0' ".$where." order by mp.package_id desc"; 

       //echo $query;exit;
        $query1 = $this->db->query($query);
        $result=$query1->result_array();
        return $result;
    }
    /*public function getMembershipData($status =null,$condition){
        $result=array();
        if($status != null){
           $query = "select mp.*,pmm.renewal_date,pmm.package_id,pmm.added_from,pmm.buy_on,pt.package_type_name,package_price_mapping.price,pmm.status as package_mapping_status from master_member mu left join package_membership_mapping pmm on pmm.member_id = mu.member_id left join master_package mp on mp.package_id = pmm.package_id left join package_price_mapping on pmm.package_price_id = package_price_mapping.package_price_mapping_id left join package_type as pt on pt.package_type_id = package_price_mapping.package_type_id where pmm.status = '".$status."' and mu.status ='1' ".$condition." order by mu.member_id desc";     
        }
        else{
           $query = "select mp.*,pmm.renewal_date,pmm.package_id,pmm.added_from,pmm.buy_on,pt.package_type_name,package_price_mapping.price,pmm.status as package_mapping_status from master_member mu left join package_membership_mapping pmm on pmm.member_id = mu.member_id left join master_package mp on mp.package_id = pmm.package_id left join package_price_mapping on pmm.package_price_id = package_price_mapping.package_price_mapping_id left join package_type as pt on pt.package_type_id = package_price_mapping.package_type_id where mu.status ='1' ".$condition." order by mu.member_id desc"; 
        }
        //echo $query;exit;
        $query1 = $this->db->query($query);
        $result=$query1->result_array();
        return $result;
    }*/
    public function get_package_benefit_list($pkg_id){
        $result=array();
        $query = "select pb.* from package_benefits_mapping pbm left join package_benefits pb on pbm.package_benefit_id = pb.package_benefit_id where pbm.package_id = '".$pkg_id."' and pb.package_benefit_id !='18' order by pb.benefit_name ASC" ;
       //echo $query;exit;
        $query1 = $this->db->query($query);
        $result=$query1->result_array();
        return $result;
    }
   
    public function get_package_image_list($pkg_id){
        $result=array();
        $query = "select package_images.*,(IF(images !='',CONCAT('".base_url()."public/upload_images/package_image/',images),'".base_url()."public/upload_images/No_Image_Available.jpg')) as package_images from package_images where package_images.package_id = '".$pkg_id."'" ;
        //echo $query;exit;
        $query1 = $this->db->query($query);
        $result = $query1->result_array();
        return $result;
    }

    /*public function getEventList($event_flag = NULL,$condition = NULL){
        $result=array();
        if($event_flag !=""){
            $query = "select me.* from master_event me where me.event_flag ='".$event_flag."' and me.status = '1' and me.is_delete = '0' order by me.event_order ASC";
        }
        else{
            if($condition !=""){
                $query = "select me.* from master_event me where me.status = '1' and ".$condition."  and me.is_delete = '0' order by me.event_order ASC";
            }
            else{
                $query = "select me.* from master_event me where me.status = '1' and me.is_delete = '0' order by me.event_order ASC";
            }            
        }
        //echo $query;exit;
        $query  =   $this->db->query($query);
        $result =   $query->result_array();
        return $result;
    }*/
   
    public function getMembershipDetails($member_id){
        $result=array();
        $query = "select pmm.membership_no,pmm.expiry_date,pmm.package_id,pmm.added_from,pmm.buy_on,pt.package_type_name,pmm.status as package_mapping_status,mp.* from package_membership_mapping pmm left join master_package mp on mp.package_id = pmm.package_id left join package_type as pt on pt.package_type_id = pmm.package_type_id where pmm.user_id ='".$member_id."' and pmm.status ='1' order by pmm.package_membership_mapping_id DESC limit 0,1"; 
        
        //echo $query;exit;
        $query1 = $this->db->query($query);
        $result=$query1->row_array();
        return $result;
    }
    public function getMembershipPaymentCheck($member_id){
        $result=array();
        $query = "select pmm.* from package_membership_mapping pmm left join transaction_history pmt on pmm.member_id = pmt.member_id where pmm.member_id ='".$member_id."' and pmm.status ='1' and pmt.payment_status ='1'"; 
        //echo $query;exit;
        $query1 = $this->db->query($query);
        $result=$query1->row_array();
        return $result;
    }

/* cafe ..................................*/

    ////////////////////////count cafe list///////////////////////////////////////

     public function get_data_total_count($table,$condition,$user_id=null){
        //$this->db->select('master_cafe.*');
        $this->db->from($table);
       // $this->db->join('users u', 'video.seller_id = u.user_id', 'left');
        $this->db->where($condition);

        //////////////////////////////check by user id////////////////////////////////
        // if($user_id>0)
        // {
        //    $this->db->where("video.seller_id!=",$user_id);
        //    ///////////////////chk purchased///////////////////////////////
        //    $this->db->where("video.video_id NOT IN (SELECT video_id FROM purchase_history where buyer_id=$user_id)", NULL, FALSE);
        // }
        //////////////////////////////////////////////////////////////////////////////
        $query = $this->db->get();  
        //echo $this->db->last_query(); die;  
        return $query->num_rows();
    }


    ////////////////////////////////cafe list wd limit //////////////////////////////////////
    public function get_data_limit($table,$condition,$order_col=null,$order_type=null,$start=null,$length=null,$user_id=null,$searchText=null,$searchCol=null){
        $this->db->select('master_cafe.*,CONCAT(cafe_name, "-",cafe_place) AS cafe_name');
        $this->db->from($table);
        //$searchText="flur";
        //$searchCol="cafe_name";
        if($searchText!=""||$searchText!=null)
        {
            $this->db->like($searchCol, $searchText);
            //$this->db->or_like(array('cafe_name' => $searchText, 'cafe_place' => $searchText,CONCAT(cafe_name, "-",cafe_place)=> $searchText));
        }
        
        $this->db->where($condition);

        //////////////////////////////check by user id////////////////////////////////
        // if($user_id>0)
        // {
        //    $this->db->where("video.seller_id!=",$user_id);
        //    ///////////////////chk purchased///////////////////////////////
        //    $this->db->where("video.video_id NOT IN (SELECT video_id FROM purchase_history where buyer_id=$user_id)", NULL, FALSE);
        // }
        //////////////////////////////////////////////////////////////////////////////

        if(!empty($order_col) && !empty($order_type)){
        $this->db->order_by($order_col,$order_type);
        }
        if($length>0){
        $this->db->limit($length,$start);
        }
        $query=$this->db->get();
        //echo $this->db->last_query();
        //return $query->result_array();

        $List=$query->result_array();
        for($i=0;$i<count($List);$i++)
        {
         
          ////////////////////////get images.............................
            $images_arr=array();
            $mapped_id=$List[$i]['cafe_id'];
            $mapped_column_name="cafe_id";
            $table_img="cafe_images";
            $images_arr =$this->getOtherData($table_img,$mapped_column_name,$mapped_id);
            $List[$i]['images'] =$images_arr;          
        }
        return $List;
    }

    ///////////////single cafe row////////////////////////////////
    public function get_data_row($table,$condition,$user_id=null){
        //$this->db->select('master_cafe.*');
        $this->db->from($table);
        $this->db->where($condition);

        //////////////////////////////check by user id////////////////////////////////
        // if($user_id>0)
        // {
        //    $this->db->where("video.seller_id!=",$user_id);
        //    ///////////////////chk purchased///////////////////////////////
        //    $this->db->where("video.video_id NOT IN (SELECT video_id FROM purchase_history where buyer_id=$user_id)", NULL, FALSE);
        // }
        //////////////////////////////////////////////////////////////////////////////

        $query=$this->db->get();
        //echo $this->db->last_query();
        //return $query->result_array();

        $List=$query->row_array();
        for($i=0;$i<count($List);$i++)
        {
         
          ////////////////////////get images.............................
            $images_arr=array();
            $mapped_id=$List['cafe_id'];
            $mapped_column_name="cafe_id";
            $table_img="cafe_images";
            $images_arr =$this->getOtherData($table_img,$mapped_column_name,$mapped_id);
            $List['images'] =$images_arr;          
        }
        return $List;
    }
    /////////////////////////////get images///////////////////
    public function getOtherData($table=NULL,$mapped_column_name=NULL,$mapped_id=NULL)
    {
        //$this->db->select('AVG(star) as avg_rating, count(review_id) as review_count');
        $this->db->from($table);
        if ($mapped_id!='' && $mapped_column_name!='') {
          $this->db->where($mapped_column_name, $mapped_id);
      }
        $query=$this->db->get();
        return $query->result_array();
    }

    ////////////////////////////////cafe list by distance //////////////////////////////////////
    public function get_data_limit_by_distance($table,$condition,$order_col=null,$order_type=null,$start=null,$length=null,$user_id=null,$fromlat,$fromlng){
        $this->db->select($table.'.*,( 3959 * acos( cos( radians('.$fromlat.') ) * cos( radians( cafe_lat ) ) 
    * cos( radians( cafe_lng ) - radians('.$fromlng.') ) + sin( radians('.$fromlat.') ) * sin(radians(cafe_lat)) ) ) AS distance');
        $this->db->from($table);
        $this->db->where($condition);

        //////////////////////////////check by user id////////////////////////////////
        // if($user_id>0)
        // {
        //    $this->db->where("video.seller_id!=",$user_id);
        //    ///////////////////chk purchased///////////////////////////////
        //    $this->db->where("video.video_id NOT IN (SELECT video_id FROM purchase_history where buyer_id=$user_id)", NULL, FALSE);
        // }
        //////////////////////////////////////////////////////////////////////////////

        if(!empty($order_col) && !empty($order_type)){
        $this->db->order_by($order_col,$order_type);
        }
        if($length>0){
        $this->db->limit($length,$start);
        }
        $query=$this->db->get();
        //echo $this->db->last_query();die;
        //return $query->result_array();

        $List=$query->result_array();
        for($i=0;$i<count($List);$i++)
        {
         
          ////////////////////////get images.............................
            $images_arr=array();
            $mapped_id=$List[$i]['cafe_id'];
            $mapped_column_name="cafe_id";
            $table_img="cafe_images";
            $images_arr =$this->getOtherData($table_img,$mapped_column_name,$mapped_id);
            $List[$i]['images'] =$images_arr;          
        }
        return $List;
    }


    ////////////////////////get row count////////////////////////////////
    public function getRowCount($table,$condition){
        $this->db->where($condition);
        $query=$this->db->get($table);
        return $query->num_rows(); 
    }

    ///get rows
    public function getRows($table,$condition,$order_col=null,$order_type=null,$start=null,$length=null){
        $this->db->where($condition);
        if(!empty($order_col) && !empty($order_type)){
            $this->db->order_by($order_col,$order_type);
        }

        if($length>0){
            if($start==null||$start=="")
            {
              $start=0;  
            }
           $this->db->limit($length, $start);
        }
        $query=$this->db->get($table);      
        return $query->result_array();
    }

    //////////////////////////check if wishlisted////////////////////////////////////

    public function is_wishlisted($item_id="",$user_id=""){
    $table="wishlist";
    $response_no=0; //default variable count value
     if ($item_id!=''&&$user_id!="") {
       $this->db->from($table);
       $this->db->where('cafe_id', $item_id);
       $this->db->where('user_id', $user_id);
       $query=$this->db->get();      
       $response_no=$query->num_rows();
     }
        return $response_no;
    }

    //chk availability of reservation room
    public function is_available($reservation_date,$room_id,$start_time_range,$end_time_range){
  
    $table="reservation";
    $response_no=0; //default variable count value
     if($reservation_date!=''&&$room_id!=""&&$start_time_range!=""&&$end_time_range!="") {
       $reservation_condition    = "reservation_date= '".$reservation_date."' and room_id = '".$room_id."' and ((reservation_time between '".$start_time_range."' and '".$end_time_range."') or (reservation_end_time between '".$start_time_range."' and '".$end_time_range."')) and status!=2";
       $this->db->where($reservation_condition);    
        $query=$this->db->get($table);
        //echo $this->db->last_query(); die();
        $response_no=$query->num_rows();
     }
        return $response_no;
    }

    ///** calculate avg rating with quality and service together ***////
    public function calculate_rating($cafe_id)
    {
        $avg=0;
        $sql="select SUM(service_rating) as service_rating_total,SUM(quality_rating) as quality_rating_total,count(rating_id) as rating_count from rating_review where cafe_id=".$cafe_id;
        $query=$this->db->query($sql);
        $rating_arr=$query->row_array();
        $sum=$rating_arr['service_rating_total']+$rating_arr['quality_rating_total'];
        $row_count=$rating_arr['rating_count'];
        $avg=($sum/$row_count)/2 ;
        return round($avg,1);

    }


}
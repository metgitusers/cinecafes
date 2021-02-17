<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH.'third_party/dompdf/dompdf/autoload.inc.php';
// Reference the Dompdf namespace 
use Dompdf\Dompdf;
class Api extends MY_Controller
{
  var $arr;
  var $obj;
  var $request_day;
  var $request_time;
  function __construct()
  {
    parent::__construct();
    $this->load->library('PushNotification');
    $this->load->library('imageupload');
    $this->load->model('mapi');
    $this->arr = array();
    $this->obj = new stdClass();
    $this->http_methods = array('POST', 'GET', 'PUT', 'DELETE');
    $this->logo = base_url() . 'public/images/logo_new.jpg';
    $this->request_day = strtolower(date("l"));
    $this->request_time = date("h:i A");
    //$this->load->library('notification');
  }

  private function displayOutput($response)
  {
    header('Content-Type: application/json');
    echo json_encode($response);
    exit(0);
  }
  private function checkHttpMethods($http_method_type)
  {
    if ($_SERVER['REQUEST_METHOD'] == $http_method_type) {
      return 1;
    }
  }
  private function check_access_token($device_type,$user_id)
  {
    $condition_token = array('device_type' => $device_type,'user_id'=>$user_id);
    //pr($condition_token);
    $access_token_result = $this->mapi->getRow('api_token', $condition_token);

    return true;
    // if(empty($access_token_result)){
    //   $response['status']['error_code'] = 1;
    //   $response['status']['message']    = 'Unauthorize Token';        
    //   $this->displayOutput($response);
    // }
  }
  public function getCategories()
  {
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {        
          $where = array();
          if(isset($ap['source']) && $ap['source'] == 'WEB'){
            $where['fc.status !='] = 3;
          }else{
            $where['fc.status'] = 1;
            $where['fc.parent_category'] = null;
          }
          if(isset($ap['parent_category'])){
            $where['fc.parent_category'] = $ap['parent_category'];
          }
          //$categories = $this->mcommon->getDetails('food_categories', $where);
          $join[] = ['table' => 'food_categories fc2', 'on' => 'fc2.food_category_id = fc.parent_category', 'type' => 'left'];
          $categories = $this->mcommon->select('food_categories fc', $where, 'fc.*, fc2.category_name parent_category_name', 'fc.category_name', 'ASC', $join);

          if(isset($ap['source']) && $ap['source'] == 'WEB'){
            $this->data['categories'] = (object)$categories;
            $html = $this->load->view('admin/food/ajax-view', $this->data, true);
            $response['status']['error_code'] = 0;
            $response['status']['message']    = "Success html";
            $response['response']['data']      = $html;
          }else{
            $response['status']['error_code'] = 0;
            $response['status']['message']    = "Success";
            $response['response']['data']      = $categories;
          }
      }
      else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Please fill up all required fields';        
      }
    }
    else{
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Wrong http method type.';        
    }
    $this->displayOutput($response);
  }
  public function items()
  {
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {        
          $where = array();
          if(isset($ap['source']) && $ap['source'] == 'WEB'){
            $where['fi.status !='] = 3;
          }else{
            $where['fi.status'] = 1;
          }
          //$categories = $this->mcommon->getDetails('food_categories', $where);
          $join[] = ['table' => 'food_categories fc', 'on' => 'fc.food_category_id = fi.category_id', 'type' => 'left'];
          $items = $this->mcommon->select('food_items fi', $where, 'fi.*, fc.category_name', 'fi.item_name', 'ASC', $join);

          if(isset($ap['source']) && $ap['source'] == 'WEB'){
            $this->data['items'] = (object)$items;
            $html = $this->load->view('admin/food/ajax-view', $this->data, true);
            $response['status']['error_code'] = 0;
            $response['status']['message']    = "Success html";
            $response['response']['data']      = $html;
          }else{
            $response['status']['error_code'] = 0;
            $response['status']['message']    = "Success";
            $response['response']['data']      = $items;
          }
      }
      else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Please fill up all required fields';        
      }
    }
    else{
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Wrong http method type.';        
    }
    $this->displayOutput($response);
  }
  public function getCategorieItems()
  {
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
          //check access token for user 
          //Items are available to all users
          // if(isset($ap['member_id']) && !empty($ap['member_id'])){
          //   $member_id            = $ap['member_id'];
          //   $access_token         = $ap['access_token'];
          //   $device_type          = $ap['device_type'];
          //   $this->check_access_token($access_token, $device_type,$member_id);
          // }
        
          $where = array();
          
          //check is request for search or not
          if(!isset($ap['search_key']) && empty($ap['search_key'])){
            //check category_id
            if(empty($ap['category_id'])){
              $response['status']['error_code'] = 1;
              $response['status']['message']    = "Incomplete request";
              $this->displayOutput($response);
            }
            $where['fc.parent_category'] = $ap['category_id'];
            $where['fc.status'] = 1;
            $where['fc2.status'] = 1; //fc2 indicate subcategory
            $join[] = ['table' => 'food_categories fc2', 'on' => 'fc2.food_category_id = fc.parent_category', 'type' => 'left'];
            $sub_categories = $this->mcommon->select('food_categories fc', $where, 'fc.*, fc2.category_name parent_category_name', 'fc.category_name', 'ASC', $join);
          }else{
            $this->db->select('fc.*, fc2.category_name parent_category_name, fi.item_name, fi.price, fi.description');
            $this->db->from('food_categories fc');
            $this->db->join('food_categories fc2', 'fc2.food_category_id = fc.parent_category', 'left');
            $this->db->join('food_items fi', 'fi.category_id = fc2.food_category_id', 'left');
            // food item price 
            $this->db->join('food_item_available_days fiad', 'fiad.food_item_id = fi.food_item_id', 'left');

            $this->db->where('fc.status', 1);
            $this->db->where('fi.status', 1);
            $this->db->where('fc2.status', 1);  //fc2 indicate subcategory
            //day related condition
            $this->db->where(['fiad.day'=> $this->request_day, 'fiad.is_seen'=> 1]);
            //like 
            $this->db->like('fi.item_name', $ap['search_key']);
            $this->db->group_by('fc.parent_category');
            $sub_categories = $this->db->get()->result();
          }
          // echo '<pre>';
          // echo $this->db->last_query(); die;
          // print_r($sub_categories);

          /**
           * get cart availibility for items
          */
          $this->db->where('status', 1);
          $is_cart_disabled = $this->db->get('food_cart_option')->row();
          $item_array = array();
          if($sub_categories){
            foreach($sub_categories as $key=> $val){
              $sort_column = 'fi.item_name';
              $sort_order= 'ASC';
              if(isset($ap['filterBy']) && $ap['filterBy'] != "popular"){
                //filter value
                //$sort_column = 'fi.price';
                $sort_column = 'fiad.price';
                $sort_order= $ap['filterBy'] =="lowToHigh"?'ASC':'DESC';
              }
              //Add where to get day price
              $where_array= array(
                                  'fi.sub_category_id'=> $val->food_category_id,
                                  'fi.status'=> 1,
                                  'fiad.day'=> $this->request_day,
                                  //'fiad.is_seen'=> 1 // required if blocked item not send in list
                                );
              $join = [];
              $join[] = ['table' => 'food_categories fc', 'on' => 'fc.food_category_id = fi.category_id', 'type' => 'left'];
              $join[] = ['table' => 'food_item_available_days fiad', 'on' => 'fiad.food_item_id = fi.food_item_id', 'type' => 'left'];
              $val->items = $this->mcommon->select('food_items fi', $where_array, 'fi.*, fc.food_category_id, fc.slug',$sort_column , $sort_order, $join);
              // insert cart items only for members
              //if(isset($ap['member_id']) && !empty($ap['member_id']))
              if(!empty($val->items)){
                foreach ($val->items as $k => $v) {
                  /*
                  get item availabilities details based on day & time
                  @response[]; ['price', 'availablity']
                  */
                  $availability = $this->getItemAvailabilityDetails($this->request_day, $this->request_time, $v->food_item_id);
                  $v->price = $availability->price;
                  $v->is_seen = $availability->is_seen;
                  $v->is_disabled = !empty($is_cart_disabled)?$is_cart_disabled->is_disabled:1;
                  // echo $this->db->last_query();
                  // print_r($availability); die;
                  /******************************************************* */
                  $v->quantity = 0;
                  $w = array('item_id'=> $v->food_item_id, 'item_addon_id'=> null);
                  if(isset( $ap['user_id']) && !empty( $ap['user_id'])){
                    $w['user_id']= $ap['user_id'];
                    $this->db->select('SUM(quantity) quantity');
                    $this->db->where($w);
                    $this->db->group_by('item_id');
                    $q = $this->db->get('food_cart_items')->row_array();
                    if($q){
                      $v->quantity = $q['quantity'];
                    }
                    // else{
                    //   $v->quantity = 0;
                    // }
                  }
                  //get item addons
                  $v->addons = $this->mcommon->select('food_item_addons',['item_id'=> $v->food_item_id, 'status'=> 1], '*', 'addon_name', 'ASC');
                  //print_r($v->addons);
                  if(!empty($v->addons)){
                    foreach ($v->addons as $k => $addon) {
                      $addon->quantity = 0;
                      $w = array('item_id'=> $v->food_item_id, 'item_addon_id'=> $addon->food_item_addon_id);
                      if(isset( $ap['member_id']) && !empty( $ap['member_id'])){
                        $w['member_id']= $ap['member_id'];
                        $this->db->select('*');
                        $this->db->where($w);
                        //$this->db->group_by('item_addon_id');
                        $qaddon = $this->db->get('food_cart_items')->row_array();
                        //echo $this->db->last_query();
                        if($qaddon){
                          $addon->quantity = 1;
                        }
                        // else{
                        //   $addon->quantity = 0;
                        // }
                      }
                      
                    }
                  } //end cart addon checking
                }
                //If category have items then only listed 
                $item_array[] = $val;
              } //end cart item checking
              //$item_array[] = $val;
            }
          }
          $response['status']['error_code'] = 0;
          $response['status']['message']    = "Success";
          $response['response']['data']     = $item_array;
      }
      else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Please fill up all required fields';
      }
    }
    else{
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Wrong http method type.';        
    }
    $this->displayOutput($response);
  }

  /**
     * Search items
  */
  public function getSearchItems()
  {
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {        
          $where = array();
          
          $this->db->select('fc.*, fi.*');
          $this->db->from('food_items fi');
          $this->db->join('food_categories fc', 'fi.category_id = fc.food_category_id', 'left');
          // food item price 
          $this->db->join('food_item_available_days fiad', 'fiad.food_item_id = fi.food_item_id', 'left');

          $this->db->where('fc.status', 1);
          $this->db->where('fi.status', 1);
          //$this->db->where('fc.parent_category', null);

          //day related condition
          $this->db->where(['fiad.day'=> $this->request_day, 'fiad.is_seen'=> 1]);
          //like 
          $this->db->like('fi.item_name', $ap['search_key']);
          //$this->db->or_like('fiad.price', $ap['search_key']);      //request day price
          $this->db->or_like('fi.description', $ap['search_key']);
          //$this->db->or_like('fc.category_name', $ap['search_key']);

          //$this->db->group_by('fiad.food_item_id');
          $this->db->group_by('fi.food_item_id');
          $items = $this->db->get()->result();
          
          // echo '<pre>';
          // echo $this->db->last_query();
          // print_r($items); die;
          /**
           * get cart availibility for items
          */
          $this->db->where('status', 1);
          $is_cart_disabled = $this->db->get('food_cart_option')->row();
          $item_array = array();
          if(!empty($items)){
            foreach ($items as $k => $value) {
              /*
              get item availabilities details based on day & time
              */
              $availability = $this->getItemAvailabilityDetails($this->request_day, $this->request_time, $value->food_item_id);
              $value->price = $availability->price;
              $value->is_seen = $availability->is_seen;
              $value->is_disabled = !empty($is_cart_disabled)?$is_cart_disabled->is_disabled:1;
              // echo $this->db->last_query();
              // print_r($availability); die;
              /******************************************************* */
              $value->quantity = 0;
              $w = array('item_id'=> $value->food_item_id, 'item_addon_id'=> null);
              if(isset( $ap['user_id']) && !empty( $ap['user_id'])){
                $w['user_id']= $ap['user_id'];
                $this->db->select('SUM(quantity) quantity');
                $this->db->where($w);
                $this->db->group_by('item_id');
                $q = $this->db->get('food_cart_items')->row_array();
                if($q){
                  $value->quantity = $q['quantity'];
                }
              }
              //get item addons
              $value->addons = $this->mcommon->select('food_item_addons',['item_id'=> $value->food_item_id, 'status'=> 1], '*', 'addon_name', 'ASC');
              //print_r($v->addons);
              if(!empty($value->addons)){
                foreach ($value->addons as $k => $addon) {
                  $addon->quantity = 0;
                  $w = array('item_id'=> $value->food_item_id, 'item_addon_id'=> $addon->food_item_addon_id);
                  if(isset( $ap['user_id']) && !empty( $ap['user_id'])){
                    $w['user_id']= $ap['user_id'];
                    $this->db->select('*');
                    $this->db->where($w);
                    //$this->db->group_by('item_addon_id');
                    $qaddon = $this->db->get('food_cart_items')->row_array();
                    //echo $this->db->last_query();
                    if($qaddon){
                      $addon->quantity = 1;
                    }
                    // else{
                    //   $addon->quantity = 0;
                    // }
                  }
                  
                }
              } //end cart addon checking
            //If category have items then only listed 
            $item_array[] = $value;
            }
          } //end cart item checking
          //$item_array[] = $val;
          $response['status']['error_code'] = 0;
          $response['status']['message']    = "Success";
          $response['response']['data']     = $item_array;
      }
      else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Please fill up all required fields';
      }
    }
    else{
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Wrong http method type.';        
    }
    $this->displayOutput($response);
  }
  //get addons
  /** admin listing purpose
   * @request member_id
   */
  public function getAddons()
  {
    ini_set('display_errors', 1);
    $this->isJSON(file_get_contents('php://input'));
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
          //check access token for user
          // $member_id            = $ap['user_id']; 
          // $device_type          = $ap['device_type'];
          // $this->check_access_token($device_type,$member_id);
          $this->arr = array('addon.status !='=> 3);
          // $this->arr = array(
          //   'user_id'=> $ap['user_id']
          // );
          //$join[] = ['table' => 'food_categories fc', 'on' => 'fc.food_category_id = fi.category_id', 'type' => 'left'];
          $join[] = ['table' => 'food_items fi', 'on' => 'fi.food_item_id = addon.item_id', 'type' => 'left'];
            //echo 'test'; die;
          $this->arr = $this->mcommon->select('food_item_addons addon', $this->arr, 'addon.*, addon.status addon_status, fi.*', 'addon.addon_name', 'ASC', $join);
          //echo $this->db->last_query();
          if(isset($ap['source']) && $ap['source'] == 'WEB'){
            $this->data['addons'] = $this->arr;
            $html = $this->load->view('admin/food/ajax-view', $this->data, true);
            $response['status']['error_code'] = 0;
            $response['status']['message']    = "Success html";
            $response['response']['data']      = $html;
          }else{
            $response['status']['error_code'] = 0;
            $response['status']['message']    = "Success";
            $response['response']['data']      = $this->arr;
          }
      }
      else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Please fill up all required fields';        
      }
    }
    else{
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Wrong http method type.';        
    }
    $this->displayOutput($response);
  }

  //add to cart
  /**
   * @request user_id, product_id, quantity
   * @request food_item_addon_id for addon add
   */
  public function addItemToCart()
  {
    //ini_set('display_errors', 1);
    $this->isJSON(file_get_contents('php://input'));
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
          //check access token for user
          $member_id            = $ap['user_id'];
          //$device_type          = $ap['device_type'];
          //$this->check_access_token($device_type,$member_id);

          //validate request input 
          if(empty($ap['item_id'])){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Item is required";
            $response['response']['data']      = $this->obj;
          }
          if(empty($ap['quantity'])){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Product quantity is required";
            $response['response']['data']      = $this->obj;
          }

          $this->arr = array(
            'user_id'=> $ap['user_id'],
            'item_id'=> $ap['item_id'],
            //'quantity'=>$ap['quantity']
          );
          /*------------------------add item oaddon---------------------------*/
          $this->arr['item_addon_id']= null;
          if(isset($ap['food_item_addon_id']) && !empty($ap['food_item_addon_id'])){
            $this->arr['item_addon_id'] = $ap['food_item_addon_id'];
          }
          /*---------------------------end----------------------------------*/
          //$isSuccess = $this->mcommon->insert('food_cart_items', $this->arr);
          if(!empty($data = $this->mcommon->getRow('food_cart_items', $this->arr)) && empty($ap['food_item_addon_id'])){
            
            $isSuccess = $this->mcommon->update('food_cart_items', $this->arr, ['quantity'=> $data['quantity']+$ap['quantity']]);
          }else{
            //check is request add on exists in cart
            if(!empty($addon_data = $this->mcommon->getrow('food_cart_items', $this->arr)) && !empty($ap['food_item_addon_id'])){
              $isSuccess = $this->mcommon->update('food_cart_items', $this->arr, ['quantity'=> $addon_data['quantity']+$ap['quantity']]);
            }else{
              $this->arr['quantity'] = $ap['quantity'];
              $isSuccess = $this->mcommon->insert('food_cart_items', $this->arr);
            }
          }
          //echo $this->db->last_query();
          if($isSuccess){
            //get cart details for a item
            $cart_item_details = $this->cartItemDetails($ap['item_id']);
            $response['status']['error_code'] = 0;
            $response['status']['message']    = "Item added successfully";
            $response['response']['data']      = $cart_item_details;
          }else{
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Unable to saved item to cart";
            $response['response']['data']      = $this->obj;
          }
      }
      else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Please fill up all required fields';        
      }
    }
    else{
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Wrong http method type.';        
    }
    $this->displayOutput($response);
  }

  //remove cart item
  /**
   * @request member_id
   */
  public function removeItemFromCart()
  {
    //ini_set('display_errors', 1);
    $this->isJSON(file_get_contents('php://input'));
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
          //check access token for user
          $member_id            = $ap['user_id']; 
          $device_type          = $ap['device_type'];
          //$this->check_access_token($device_type,$member_id);

          //validate request input 
          if(empty($ap['item_id'])){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Item is required";
            $response['response']['data']      = $this->obj;
          }

          $this->arr = array(
            'user_id'=> $ap['user_id'],
            'item_id'=> $ap['item_id']
          );
          if(!empty($data = $this->mcommon->getRow('food_cart_items',  $this->arr)) && empty($ap['food_item_addon_id'])){
            //id data quantity is 1 then remove addon 
            if($data['quantity'] == 1 ){
              $this->db->where( $this->arr);
              $this->db->delete('food_cart_items');
            }else{
              $this->arr['item_addon_id']= null;
              $this->mcommon->update('food_cart_items', $this->arr, ['quantity'=> $data['quantity']-$ap['quantity']]);
            }
            $isSuccess = true;
          }else{
            //remove if request for addon items
            $isSuccess = false;
            if(!empty($ap['food_item_addon_id'])){
              $this->arr = array(
                'item_addon_id'=> $ap['food_item_addon_id']
              );
              if(!empty($addon_data = $this->mcommon->getRow('food_cart_items',  $this->arr))){
                //id data quantity is 1 then remove addon 
                if($addon_data['quantity'] == 1 ){
                  $this->db->where($this->arr);
                  $this->db->delete('food_cart_items');
                }else{
                  $this->mcommon->update('food_cart_items', $this->arr, ['quantity'=> $addon_data['quantity']-$ap['quantity']]);
                }
                $isSuccess = true;
              }
            }
          }
          /*------------------------add item oaddon---------------------------*/
          // if(isset($ap['food_item_addon_id']) && !empty($ap['food_item_addon_id'])){
          //   $this->db->where($this->arr);
          //   $this->db->where('item_addon_id', $ap['food_item_addon_id']);
          //   $this->db->delete('food_cart_items');
          //   //echo $this->db->last_query();
          //   $isSuccess = true;
          // }
          /*---------------------------end----------------------------------*/
          
          if($isSuccess){
            $cart_item_details = $this->cartItemDetails($ap['item_id']);
            $response['status']['error_code'] = 0;
            $response['status']['message']    = "Removed successfully";
            $response['response']['data']      = $cart_item_details;
          }else{
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Unable to delete item to cart";
            $response['response']['data']      = $this->obj;
          }
      }
      else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Please fill up all required fields';        
      }
    }
    else{
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Wrong http method type.';        
    }
    $this->displayOutput($response);
  }
  //add to cart
  /**
   * @request member_id
   */
  public function getCartItems()
  {
    //ini_set('display_errors', 1);
    $this->isJSON(file_get_contents('php://input'));
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
          //check access token for user
          $member_id            = $ap['user_id'];  
          //$device_type          = $ap['device_type'];
          //$this->check_access_token($device_type,$member_id);

          $this->arr = array(
            'user_id'=> $ap['user_id'],
            'item_addon_id'=> null,
            'fi.status'=> 1
          );
          //$join[] = ['table' => 'food_categories fc', 'on' => 'fc.food_category_id = fi.category_id', 'type' => 'left'];
          $join[] = ['table' => 'food_items fi', 'on' => 'fi.food_item_id = fci.item_id', 'type' => 'left'];
          $this->arr = $this->mcommon->select('food_cart_items fci', $this->arr, 'fci.*, fi.*', 'fci.food_cart_item_id', 'DESC', $join);
          //echo $this->db->last_query();
          if(!empty($this->arr)){
            $total_amount = 0;
            $total_item_count = 0;
            $total_addon = 0;
            $item_list = array();
            $addon_list = array();
            foreach ($this->arr as $key => $value) {
              //print_r($value);
              if($value->quantity != 0){
                //get item availability based on day & time
                $availability = $this->getItemAvailabilityDetails($this->request_day, $this->request_time, $value->item_id);
                //update price
                if($availability){
                  $value->price = $availability->price;
                  $value->is_seen = $availability->is_seen; // is this item visible to add or proceed
                  //print_r($value);
                  if($value->is_seen == 1){
                    $total_amount = $total_amount+($value->quantity*$value->price);
                    $total_item_count = $total_item_count+$value->quantity;

                    $join = [];
                    $join[] = ['table' => 'food_item_addons fi', 'on' => 'fi.food_item_addon_id = fci.item_addon_id', 'type' => 'left'];
                    $cartItemAddons = $this->mcommon->select('food_cart_items fci', ['user_id'=> $ap['user_id'], 'fci.item_id'=> $value->item_id, 'fci.item_addon_id !='=> null, 'fi.status'=> 1], 'fci.*, fi.*', '', '', $join);
                    //echo $this->db->last_query();
                    if(!empty($cartItemAddons)){
                      foreach ($cartItemAddons as $key => $val) {
                        $total_addon++;
                        $total_item_count = $total_item_count+$val->quantity;
                        $total_amount = $total_amount+($val->quantity*$val->addon_price);
                        $val->quantity = $val->quantity;

                        $addon_list[] = $val;
                      }
                    $value->addons = $cartItemAddons;
                    }
                  }
                }
                
                $item_list[] = $value;
              }              
            }
            $response['status']['error_code'] = 0;
            $response['status']['message']    = "success";
            $response['response']['data']      = array(
                                                      'total_amount'=> $total_amount,
                                                      'total_addon'=> $total_addon,
                                                      'total_count'=> count($this->arr),
                                                      'total_item_count'=> $total_item_count,
                                                      'list'=> $item_list,
                                                      'addons'=>$addon_list
                                                    );
          }else{
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Sorry!! Item not found";
            $response['response']['data']      = $this->obj;
          }
      }
      else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Please fill up all required fields';        
      }
    }
    else{
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Wrong http method type.';        
    }
    $this->displayOutput($response);
  }
  /*
    ** Apply coupon
  */
  public function applyCoupon()
  {
    $this->isJSON(file_get_contents('php://input'));
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
          //check access token for user
          $user_id            = $ap['user_id'];
          // $access_token         = $ap['access_token'];  
          // $device_type          = $ap['device_type'];
          // $this->check_access_token($access_token, $device_type,$member_id);

          //validate request input
          if(empty($ap['cupon_code'])){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Coupon Code is required";
            $response['response']['data']      = $this->obj;
            $this->displayOutput($response);
          }
          if(empty($ap['order_id'])){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Order No is required to apply coupon";
            $response['response']['data']      = $this->obj;
            $this->displayOutput($response);
          }

          //check is coupon valid
          $this->db->where(['coupon_code'=> trim($ap['cupon_code']), 'status'=> 1]);
          if(!$coupon_data = $this->db->get('food_coupons')->row()){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Coupon Code is invalid";
            $response['response']['data']      = $this->obj;
            $this->displayOutput($response);
          }
          //get applied coupon count
          $this->db->where(['coupon_code'=> trim($ap['cupon_code']), 'applied_status'=> 1]);
          $total_apply = $this->db->get('food_apply_coupon')->num_rows();
          if($total_apply >= $coupon_data->max_uses){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Sorry!! Coupon Code access limit completed";
            $response['response']['data']      = $this->obj;
            $this->displayOutput($response);
          }
          // get all cart items total amount
          $totalCartPrice = $this->getCartPrice($ap['user_id']);
          /********************************************************** */
          //echo $total_amount;
          $where = array(
                          'coupon_code'=> trim($ap['cupon_code']),
                          'start_date <='=> date('Y-m-d'),
                          'end_date >='=> date('Y-m-d'),
                          'min_purchase_amount <'=> $totalCartPrice,
                          'status'=> 1,
                          );
          $this->arr = $this->mcommon->select('food_coupons', $where, '*');
          //echo $this->db->last_query();
          if(!empty($this->arr)){
            //print_r($this->arr);
            $discount_amount = $this->arr[0]->discount_amount;
            if($this->arr[0]->coupon_type == 2){
              $discount_amount = ($totalCartPrice*$this->arr[0]->discount_amount)/100;
            }
            $response['status']['error_code'] = 0;
            $response['status']['message']    = "Coupon applied successfully";
            $response['response']['data']      = $insert_array = array(
                                                        'discount_amount'=> (string)round($discount_amount, 0),
                                                        'cart_amount'=> (int)round($totalCartPrice, 0),
                                                        'payable_amount'=> (int)round($totalCartPrice - $discount_amount, 0),
                                                      );
            // insert into temp_coupon table
            $insert_array['user_id']= $ap['user_id'];
            $insert_array['coupon_code']= trim($ap['cupon_code']);
            $insert_array['food_order_id']= $ap['order_id'];
            $this->mcommon->insert('food_apply_coupon', $insert_array);
            //echo $this->db->last_query();
          }else{
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Sorry!! coupon is not applicable";
            $response['response']['data']      = $this->obj;
          }
      }
      else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Please fill up all required fields';        
      }
    }
    else{
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Wrong http method type.';        
    }
    $this->displayOutput($response);
  }

  /*
    ** Remove coupon
  */
  public function removeCoupon()
  {
    ini_set('display_errors', 1);
    $this->isJSON(file_get_contents('php://input'));
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
          //check access token for user
          $member_id            = $ap['user_id']; 
          $device_type          = $ap['device_type'];
          //$this->check_access_token($device_type,$member_id);

          // //validate request input
          // if(empty($ap['cupon_code'])){
          //   $response['status']['error_code'] = 1;
          //   $response['status']['message']    = "Coupon Code is required";
          //   $response['response']['data']      = $this->obj;
          //   $this->displayOutput($response);
          // }

          //check is coupon valid
          // $this->db->where(['coupon_code'=> trim($ap['cupon_code']), 'status'=> 1]);
          // if(!$coupon_data = $this->db->get('food_coupons')->row_array()){
          //   $response['status']['error_code'] = 1;
          //   $response['status']['message']    = "Coupon Code is invalid";
          //   $response['response']['data']      = $this->obj;
          //   $this->displayOutput($response);
          // }
          // get all cart items total amount
          $totalCartPrice = $this->getCartPrice($ap['user_id']);
          /********************************************************** */
          //echo $this->db->last_query();
          if(!empty($this->arr)){
            //print_r($this->arr);
            $response['status']['error_code'] = 0;
            $response['status']['message']    = "Success";
            $response['response']['data']      = array(
                                                        'discount_amount'=> 0,
                                                        'cart_amount'=> $totalCartPrice,
                                                        'payable_amount'=> $totalCartPrice,
                                                      );
            // remove unsaved temp_coupon 
            $this->db->where(['user_id'=> $ap['user_id'], 'applied_status'=>0]);
            $this->db->delete('food_apply_coupon');
          }else{
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Sorry!! coupon is not applicable";
            $response['response']['data']      = $this->obj;
          }
      }
      else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Please fill up all required fields';        
      }
    }
    else{
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Wrong http method type.';        
    }
    $this->displayOutput($response);
  }
  
  /*
    ** Checkout User
  */
  public function userCheckout()
  {
    $this->isJSON(file_get_contents('php://input'));
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
          //check access token for user
          $member_id            = $ap['user_id'];  
          $device_type          = $ap['device_type'];
          //$this->check_access_token($access_token, $device_type,$member_id);

          // get all cart items total amount
          $totalCartPrice = $this->getCartPrice($ap['user_id']);

          // if(empty($ap['food_member_address_id'])){
          //   $response['status']['error_code'] = 1;
          //   $response['status']['message']    = "Address is required to complete checkout";
          //   $response['response']['data']      = $this->obj;
          // }
          if($totalCartPrice <=0){
              $response['status']['error_code'] = 1;
              $response['status']['message']    = "Cart is empty";
              $response['response']['data']      = $this->obj;
              $this->displayOutput($response);
          }
          /********************************************************** */
          
          $checkout_array = array(
                                  'discount_amount'=> "0",
                                  'cart_amount'=> $totalCartPrice,
                                  'payable_amount'=> $totalCartPrice,
                                  'coupon_code'=> ""
                                );
          //check is coupon applied
          $this->arr = $this->mcommon->select('food_apply_coupon', ['user_id'=> $ap['user_id'], 'applied_status'=> 0], '*');
          
          if(!empty($this->arr)){
            $data = $this->arr[0];
            //check coupon is valid or expired 
            $where_coupon = array(
                                'coupon_code'=> trim($data->coupon_code),
                                'start_date <='=> date('Y-m-d'),
                                'end_date >='=> date('Y-m-d'),
                                'min_purchase_amount <'=> $totalCartPrice,
                                'status'=> 1,
                                );
              $is_coupon_active = $this->mcommon->select('food_coupons', $where_coupon, '*');
              //echo $this->db->last_query();
              if(!empty($is_coupon_active)){
                //check whether coupon used limit
                //get applied coupon count
                $this->db->where(['coupon_code'=> trim($data->coupon_code), 'applied_status'=> 1]);
                $total_apply = $this->db->get('food_apply_coupon')->num_rows();
                // echo $total_apply;
                //print_r($is_coupon_active);
                if($total_apply >= $is_coupon_active[0]->max_uses){
                  // remove unsaved temp_coupon 
                $this->db->where(['user_id'=> $ap['user_id'], 'applied_status'=>0]);
                $this->db->delete('food_apply_coupon');

                $checkout_array = array(
                                        'discount_amount'=> "0",
                                        'cart_amount'=> $totalCartPrice,
                                        'payable_amount'=> $totalCartPrice,
                                        'coupon_code'=> ""
                                      );
                }else{
                  $discount_amount = round($data->discount_amount, 0);
                  $checkout_array = array(
                                    'discount_amount'=> (string)$discount_amount,
                                    'cart_amount'=> $totalCartPrice,
                                    'payable_amount'=> ($totalCartPrice - $discount_amount),
                                    'coupon_code'=> $data->coupon_code
                                  );
                }
                
              }else{
                // remove unsaved temp_coupon 
                $this->db->where(['user_id'=> $ap['user_id'], 'applied_status'=>0]);
                $this->db->delete('food_apply_coupon');

                $checkout_array = array(
                                        'discount_amount'=> 0,
                                        'cart_amount'=> $totalCartPrice,
                                        'payable_amount'=> $totalCartPrice,
                                        'coupon_code'=> ""
                                      );
              }
          }

          //insert into order as pending
          $order_array = $checkout_array;
          unset($order_array['cart_amount']); //Remove unwanted column
          $order_array['user_id']= $ap['user_id'];
          $order_array['total_amount']= $totalCartPrice;
          $order_array['order_status']= 0;   // Pending

          //check is member has any 
          $this->db->where(['user_id'=>$ap['user_id'], 'order_status'=> 0]);
          $this->db->order_by('food_order_id', 'DESC');
          $isOrdered = $this->db->get('food_orders')->row_array();
          if(!empty($isOrdered)){
            $order_id = $isOrdered['food_order_id'];
            $this->mcommon->update('food_orders', ['food_order_id'=> $order_id],  $order_array);
          }else{
            $order_id = $this->mcommon->insert('food_orders', $order_array);
          }
          //echo $this->db->last_query();
          if($order_id){
            $checkout_array['order_id'] = (string)$order_id;
            //insert order_details
              //get cart items
            $join_1 = [];
            $join_1[] = ['table' => 'food_items fi', 'on' => 'fi.food_item_id = fci.item_id', 'type' => 'left'];
            $tcart_items = $this->mcommon->select('food_cart_items fci', ['fi.status'=> 1, 'fci.user_id'=> $ap['user_id'], 'fci.item_id !='=> 0], 'fci.user_id, fci.item_id, fci.item_addon_id, fci.quantity', '', '', $join_1);
            $items_array = [];
            $total_item_count = 0;
            foreach ($tcart_items as $key => $value) {
              if(!empty($value->item_addon_id)){
                $this->db->where('food_item_addon_id', $value->item_addon_id);
                $rr = $this->db->get('food_item_addons')->row();
                if(!empty($rr)){
                  $value->price= $rr->addon_price;
                }
              }else{
                $availability = $this->getItemAvailabilityDetails($this->request_day, $this->request_time, $value->item_id);
                // $availability->price;
                // $availability->is_seen;
                if(!empty($availability)){
                  $value->price= $availability->price;
                }else{
                  $value->price= 0;
                }
              }
              $value->food_order_id= $order_id;

              $total_item_count += $value->quantity;
              $items_array[] = $value;
            }
            
            //delete if exists
            //clear cart after check functionality
            $this->db->where(['food_order_id'=> $order_id]);
            $this->db->delete('food_order_items');
            // echo '<pre>';
            // print_r($items_array);
            $this->mcommon->batch_insert('food_order_items', $items_array);
            //echo $this->db->last_query();
            $checkout_array['total_item_count'] =$total_item_count;
            //print_r($checkout_array); die;
            if(isset($ap['food_member_address_id'])){
              //insert ordered address
              $this->db->where('food_member_address_id', $ap['food_member_address_id']);
              $default_address = $this->db->get('food_member_address')->row_array();
              unset($default_address['food_member_address_id']);
              unset($default_address['user_id']);
              $default_address['order_id'] = $order_id;

              //clear cart after check functionality
              $this->db->where(['order_id'=> $order_id]);
              $this->db->delete('food_ordered_address');
              $this->mcommon->insert('food_ordered_address', $default_address);
            }

            $response['status']['error_code'] = 0;
            $response['status']['message']    = "Success";
            $response['response']['data']      = $checkout_array;
          }else{
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Sorry!! unable to proceed";
            $response['response']['data']      = $this->obj;
          }
      }
      else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Please fill up all required fields';        
      }
    }
    else{
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Wrong http method type.';        
    }
    $this->displayOutput($response);
  }

  /*
    ** Order confirm after payment
  */
  public function order()
  {
    $this->isJSON(file_get_contents('php://input'));
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
          //check access token for user
          $member_id            = $ap['user_id']; 
          //$device_type          = $ap['device_type'];
          //$this->check_access_token($device_type,$member_id);

          // get all cart items total amount
          if(empty($ap['order_id'])){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Request is not complete";
            $response['response']['data']      = $this->obj;
          }
          if(empty($ap['transaction_id'])){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Transaction ID is required";
            $response['response']['data']      = $this->obj;
          }
          if(empty($ap['source'])){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Transaction ource is required";
            $response['response']['data']      = $this->obj;
          }
          /********************************************************** */
          /*
            ** deduct wallet ammount if order request from wallet
          */
          if(isset($ap['payment_mode']) && $ap['payment_mode']=="wallet")
          {
            $wallet_response_status=$this->deductWalllet($ap['user_id'], $ap['payable_amount']);
          }
          /**
           * do the needfull after complete order
          */
          //$returnInvoice = $this->doAfterOrderOperations($ap['order_id'], $ap['transaction_id']);
          //insert into order as pending
          $invoice = '';
          $invoice = $this->generateOrderInvoice($ap['order_id']);
          $order_array = [];
          $order_array['food_order_status_id']= 1;   // Paid
          $order_array['order_status']= 1;   // Paid
          $order_array['status']= 1;   // Paid
          $order_array['invoice_url']= $invoice!=""?$invoice:null;   // Paid
          $order_array['payment_mode']= isset($ap['payment_mode'])?$ap['payment_mode']:'';   // Paid

          // $order_array['order_date']= date('Y-m-d h:i a');
          // $order_array['created_at']= date('Y-m-d h:i a');

          $this->mcommon->update('food_orders', ['food_order_id'=> $ap['order_id']],  $order_array);
          //remove hide items from list
          $order_items = $this->mcommon->select('food_order_items', ['food_order_id'=> $ap['order_id']], '*');
          foreach($order_items as $item){
            $availability = $this->getItemAvailabilityDetails($this->request_day, $this->request_time, $item->item_id);
            // $availability->price;
            // $availability->is_seen;
            if(!empty(!$availability)){
              if($availability->is_seen == 0){
                $this->db->where('food_order_item_id', $item->food_order_item_id);
                $this->db->delete('food_order_items');
              }
            }
          }
          
          //update coupon
          $this->mcommon->update('food_apply_coupon', ['user_id'=> $ap['user_id'], 'applied_status'=> 0], ['applied_status'=> 1, 'food_order_id'=> $ap['order_id']]);

          $trans_array = array(
            'food_order_id'=> $ap['order_id'],
            'transaction_id'=> $ap['transaction_id'],
            'source'=> $ap['source'],
          );

          $this->mcommon->insert('food_order_transactions', $trans_array);

          /**
           * Insert into common transaction
          */
            $food_trans_array_data   = array('transaction_id'    => $ap['transaction_id'],
                                            'food_order_id'  => $ap['order_id'],
                                            'user_id'         => $ap['user_id'],
                                            'added_form'        => 'front',
                                            'amount'            => $ap['payable_amount'],                  
                                            'payment_mode'      => $ap['payment_mode'],
                                            'payment_status'    => '1',
                                            'transaction_type'  =>'Food Reservation'
                                            );
            $this->mcommon->insert('transaction_history',$food_trans_array_data);

          //clear cart after check functionality
          $this->db->where(['user_id'=> $ap['user_id']]);
          $this->db->delete('food_cart_items');


          /*------------------------------Notification section-----------------*/ 
        $message_data         = array('title' => 'Buy Food','message' => 'Your order received. Thank you for ordering with us.');
        $user_fcm_token_data  = $this->mcommon->getRow('device_token',array('user_id' => $ap['user_id']));
        //pr($user_fcm_token_data);
        if(!empty($user_fcm_token_data)){
          $member_datas   = $this->mcommon->getRow('master_member',array('member_id' => $ap['user_id']));

          $user_name      = $member_datas['first_name'];
          $user_email     = $member_datas['email'];
          $user_mobile    = $member_datas['mobile'];

          if($member_datas['notification_allow_type'] == '1'){
            if($ap['device_type'] == 1){
              $push_array = array("to" => 
														//"d_C0y2ibSU9GsMxMH3nhCj:APA91bGdwAjyMIFPZCtiWrO4UZ7OGlBsYIPjyrJaD_K1aytOKxAJGReiUdJOg8Cr5_Z3SvNi2UkDBMa_NumyGR70hFZvr2cUOcVjFcZHYOSWX2qDzwIbnbi2kCttaiVBvd0ssjA4jidt",
														$user_fcm_token_data['fcm_token'],
														"mutable_content"=>true,
														"notification" => array(
															"body" => 'Your order received. Thank you for ordering with us.',
															"title"=> 'Buy Food'															
														)
													);
										
              $this->pushnotification->send_ios_notification($push_array);          
            }
            else{
              $push_array = array("to" => 
														//"dZNaReIIohg:APA91bGNi9LMa92icmS2950VT5IS7MRS4SFRtDlz9Yp8e5HxvOUL3qTG1RKEiJQI9hRbKyx077r0nhOqjcpeq7tPaRrgCPZUs2bQmZOUxwZYqPZiCFbD6QXPaiyJdglOS5ciYQmPM4tF",
														$user_fcm_token_data['fcm_token'],
														"collapse_key"=> "type_a",
														"notification" => array(
															"body" => 'Your order received. Thank you for ordering with us.',
															"title"=> 'Buy Food'															
														)
                          );
              $this->pushnotification->send_android_notification($push_array);
            }
          }          
          $notification_arr = array('user_id'                 => $member_id,
                                    'notification_title'        => 'Buy Food',
                                    'notification_description'  => 'Your order received. Thank you for ordering with us.',
                                    'status'                    => '1',
                                    'created_on'                => date('Y-m-d H:i:s')
                                    );
          $insert_data      = $this->mcommon->insert('notification', $notification_arr);

          /****************** Send password to the member ****************************/

          $logo               =   base_url('public/images/logo.png');
          $params['name']     =   $user_name;
          $params['to']       =   $user_email; 
          $details            =   "Food ordered on: ".date('d-M-Y, h:i a')."<br>"." has successfully received with ordered no-: ".$ap['order_id'];
          $params['subject']  =   'Cinecafe - Food ordered successfully done';                             
          $mail_temp          =   file_get_contents('./global/mail/food_ordered.html');
          $mail_temp          =   str_replace("{web_url}", base_url(), $mail_temp);
          $mail_temp          =   str_replace("{logo}", $logo, $mail_temp);
          $mail_temp          =   str_replace("{shop_name}", 'Cinecafe', $mail_temp);  
          $mail_temp          =   str_replace("{name}", $user_name, $mail_temp);
          $mail_temp          =   str_replace("{details}", $details, $mail_temp);
          $mail_temp          =   str_replace("{current_year}", date('Y'), $mail_temp);           
          $params['message']  =   $mail_temp;
          if($invoice){
            $params['attach']  =   $invoice;
          }
          $msg                =   registration_mail($params);
        }

              $message  = "Your order received. Thank you for ordering with us.";
              //$message  .=   "Membership name: ".$package_name.", Membership type: ".$package_type_name.", Membership Price: ".$package_price."Membership Status: Under process";
              
              $this->smsSend($user_mobile,$message);
              $where['food_order_id'] = $ap['order_id'];
          $where = array(
            'food_order_id' => $ap['order_id']
          );
          $orderedList = $this->mcommon->getOrderedHistory($where);
          $response['status']['error_code'] = 0;
          $response['status']['message']    = "Order placed successfully";
          $response['response']['data']      = array('order_id'=> $ap['order_id'], 'order_details'=> (object)$orderedList[0], 'invoice_url'=> $invoice);          
      }
      else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Please fill up all required fields';        
      }
    }
    else{
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Wrong http method type.';        
    }
    $this->displayOutput($response);
  }

  /*
    ** Member order history
  */
  public function getOrderedHistory()
  {
    ini_set('display_errors', 1);
    $this->isJSON(file_get_contents('php://input'));
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
          //check access token for user
          $member_id            = $ap['user_id']; 
          //$device_type          = $ap['device_type'];
          //$this->check_access_token($device_type,$member_id);

          /*
            get ordered history
          */
          
          $where = array('user_id'=>$ap['user_id'], 'order_status'=> 1);
          if(isset($ap['order_id'])){
            $where['food_order_id'] = $ap['order_id'];
          }
          $orderedList = $this->mcommon->getOrderedHistory($where);
          $response['status']['error_code'] = 0;
          $response['status']['message']    = "Success";
          $response['response']['data']      = $orderedList;          
      }
      else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Please fill up all required fields';        
      }
    }
    else{
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Wrong http method type.';        
    }
    $this->displayOutput($response);
  }
  //function to caculate cart price
  private function getCartPrice($member_id = null)
  {
    $join[] = ['table' => 'food_items fi', 'on' => 'fi.food_item_id = fci.item_id', 'type' => 'left'];
          $this->arr = $this->mcommon->select('food_cart_items fci', ['fi.status'=> 1, 'user_id'=> $member_id, 'item_addon_id'=> null], 'fci.*, fi.*', 'fci.food_cart_item_id', 'DESC', $join);
        //  echo $this->db->last_query();
        //   print_r( $this->arr); die;
          if(!empty($this->arr)){ 
           $total_amount = 0;          
            foreach ($this->arr as $key => $value) {
              if($value->quantity != 0){
                $availability = $this->getItemAvailabilityDetails($this->request_day, $this->request_time, $value->item_id);
               // $availability->price;
                // $availability->is_seen;
                // if item is available based on day & time then only calculate
                if($availability->is_seen == 1){
                  $total_amount = $total_amount+($value->quantity*$availability->price);
                  $join = [];
                  $join[] = ['table' => 'food_item_addons fi', 'on' => 'fi.food_item_addon_id = fci.item_addon_id', 'type' => 'left'];
                  $cartItemAddons = $this->mcommon->select('food_cart_items fci', ['fi.status'=> 1,'user_id'=> $member_id,'fci.item_id'=> $value->item_id, 'fci.item_addon_id !='=> null], 'fci.*, fi.*', '', '', $join);
                 if(!empty($cartItemAddons)){
                    foreach ($cartItemAddons as $key => $val) {
                      $total_amount =$total_amount+($val->quantity*$val->addon_price);
                    }
                  }
                }
              }              
            }
            return $total_amount;
          }else{
            return 0;
          }
  }
  /*-----------------------------------------------** Address Management **---------------------------------------------*/ 
  //add & edit to address
  /**
   * @request member_id, `name`, `country_code`, `phone`, `pincode`, `state`, `address`, `locality`, `district`, `is_default`, `status`,
   * to update must have food_member_address_id
   */
  public function addAddress()
  {
    //ini_set('display_errors', 1);
    $this->isJSON(file_get_contents('php://input'));
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
          //check access token for user
          $member_id            = $ap['user_id'];
          $device_type          = $ap['device_type'];
          //$this->check_access_token($device_type,$member_id);

          //validate request input 
          if(empty($ap['name'])){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Name is required";
            $response['response']['data']      = $this->obj;
          }
          if(empty($ap['country_code'])){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Country Code is required";
            $response['response']['data']      = $this->obj;
          }
          if(empty($ap['phone'])){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Phone is required";
            $response['response']['data']      = $this->obj;
          }
          if(empty($ap['pincode'])){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Pin Code is required";
            $response['response']['data']      = $this->obj;
          }
          if(empty($ap['state'])){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "State is required";
            $response['response']['data']      = $this->obj;
          }
          if(empty($ap['address'])){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Address is required";
            $response['response']['data']      = $this->obj;
          }
          if(empty($ap['locality'])){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Locality is required";
            $response['response']['data']      = $this->obj;
          }
          if(empty($ap['district'])){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "District is required";
            $response['response']['data']      = $this->obj;
          }

          $this->arr = array(
            'user_id'=> $ap['user_id'],
            'name'=> $ap['name'],
            'country_code'=>$ap['country_code'],
            'phone'=>$ap['phone'],
            'pincode'=>$ap['pincode'],
            'state'=>$ap['state'],
            'address'=>$ap['address'],
            'locality'=>$ap['locality'],
            'district'=>$ap['district'],
            'is_default'=>$ap['is_default'],
            'status'=> 1,
          );
          //remove default address if have
          if($ap['is_default'] == 1){
            $isSuccess = $this->mcommon->update('food_member_address', ['user_id'=> $ap['user_id']], ['is_default'=> 0]);
          }
          //$isSuccess = $this->mcommon->insert('food_cart_items', $this->arr);
          if( isset($ap['food_member_address_id']) && !empty($ap['food_member_address_id']) ){
            $this->arr['updated_at'] = date('Y-m-d H:i:s');
            $isSuccess = $this->mcommon->update('food_member_address', ['food_member_address_id'=> $ap['food_member_address_id']], $this->arr);
            $msg = "Address updated successfully";
          }else{
            $isSuccess = $this->mcommon->insert('food_member_address', $this->arr);
            $msg = "Address saved successfully";
          }          
     
          if($isSuccess){
            $response['status']['error_code'] = 0;
            $response['status']['message']    = $msg;
            $response['response']['data']      = (object) $this->arr;
          }else{
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Unable to complete action";
            $response['response']['data']      = $this->obj;
          }
      }
      else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Please fill up all required fields';        
      }
    }
    else{
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Wrong http method type.';        
    }
    $this->displayOutput($response);
  }

  //add & edit to address
  /**
   * @request member_id,food_member_address_id
   */
  public function removeAddress()
  {
    //ini_set('display_errors', 1);
    $this->isJSON(file_get_contents('php://input'));
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
          //check access token for user
          $member_id            = $ap['user_id']; 
          $device_type          = $ap['device_type'];
          //$this->check_access_token($device_type,$member_id);

          //validate request input 
          if(empty($ap['food_member_address_id'])){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Incomplete request";
            $response['response']['data']      = $this->obj;
          }

          if($this->mcommon->update('food_member_address', ['food_member_address_id'=> $ap['food_member_address_id']], ['status'=> 3])){
            $response['status']['error_code'] = 0;
            $response['status']['message']    = "Address deleted successfully";
            $response['response']['data']      = $this->obj;
          }else{
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Unable to delete address";
            $response['response']['data']      = $this->obj;
          }
      }
      else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Please fill up all required fields';        
      }
    }
    else{
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Wrong http method type.';        
    }
    $this->displayOutput($response);
  }
  //Address listing
  /**
   * @request member_id,
   */
  public function getAddress()
  {
    ini_set('display_errors', 1);
    $this->isJSON(file_get_contents('php://input'));
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
          //check access token for user
          $member_id            = $ap['user_id'];
          $device_type          = $ap['device_type'];
          //$this->check_access_token($device_type,$member_id);

          //validate request input 
          $where = array('user_id'=> $ap['user_id'], 'status'=> 1);
          if(isset($ap['is_default']) && $ap['is_default'] == '1'){
            $where['is_default'] = 1;
          }
          if($this->arr = $this->mcommon->select('food_member_address', $where, '*', 'is_default', 'DESC')){
            $response['status']['error_code'] = 0;
            $response['status']['message']    = "Success";
            $response['response']['data']      = $this->arr;
          }else{
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Sorry!! no address added yet";
            $response['response']['data']      = $this->obj;
          }
      }
      else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Please fill up all required fields';        
      }
    }
    else{
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Wrong http method type.';        
    }
    $this->displayOutput($response);
  }
  public function makeDefaultAddress()
  {
    ini_set('display_errors', 1);
    
    $this->isJSON(file_get_contents('php://input'));
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
          //check access token for user
          $member_id            = $ap['user_id']; 
          $device_type          = $ap['device_type'];
          //$this->check_access_token($device_type,$member_id);

            //validate request input 
            if(empty($ap['food_member_address_id'])){
              $response['status']['error_code'] = 1;
              $response['status']['message']    = "Incomplete request";
              $response['response']['data']      = $this->obj;
            }
            
            // set all is_default = 0
            $this->mcommon->update('food_member_address', ['user_id'=> $ap['user_id']], ['is_default'=> 0, 'updated_at' => date('Y-m-d H:i:s')]);
  
            $isSuccess = $this->mcommon->update('food_member_address', ['food_member_address_id'=> $ap['food_member_address_id']], ['is_default'=> 1]);

          if($isSuccess){
            $response['status']['error_code'] = 0;
            $response['status']['message']    = "Successfully set default address";
            $response['response']['data']      = (object)$this->arr;
          }else{
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Sorry!! unable to make default address";
            $response['response']['data']      = $this->obj;
          }
      }
      else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Please fill up all required fields';        
      }
    }
    else{
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Wrong http method type.';        
    }
    $this->displayOutput($response);
  }

  /***************** Common methods********************* */
  /**
   * @item_id int
   * $response details[]
   */
  protected function cartItemDetails($item_id){
    // get item detsila from cart
    $join[] = ['table' => 'food_items fi', 'on' => 'fi.food_item_id = fci.item_id', 'type' => 'left'];
    $cartItem = $this->mcommon->select('food_cart_items fci', ['fci.item_id'=> $item_id], 'fci.*, fi.*', '', '', $join);
    $total_qty = 0;
    $total_addon = 0;
    $total_amount = 0;
    if(!empty($cartItem)){
      $availability = $this->getItemAvailabilityDetails($this->request_day, $this->request_time, $item_id);
      // $availability->price;
      // $availability->is_seen;
      // if item is available based on day & time then only calculate
      if(!empty($availability)){
        if($availability->is_seen == 1){
          $item = $cartItem[0];
          $total_qty = $item->quantity;
          $total_amount = $item->quantity*$availability->price;
          //get cart item addonlist
          $join = [];
          $join[] = ['table' => 'food_item_addons fi', 'on' => 'fi.food_item_addon_id = fci.item_addon_id', 'type' => 'left'];
          $cartItemAddons = $this->mcommon->select('food_cart_items fci', ['fci.item_id'=> $item_id, 'fci.item_addon_id !='=> null], 'fci.*, fi.*', '', '', $join);
          if(!empty($cartItemAddons)){
            foreach ($cartItemAddons as $key => $value) {
              $total_addon++;
              $total_qty++;
              $total_amount +=$value->quantity*$value->addon_price;
            }
          }
        }
      }
    }
    return $return = array(
        'total_addon'=> $total_addon,
        'total_qty'=> $total_qty,
        'total_amount'=> $total_amount
    );
  }

  /*
    ** get coupon list
  */
  public function getCoupons()
  {
    ini_set('display_errors', 1);
    $this->isJSON(file_get_contents('php://input'));
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
          //check access token for user
          $this->arr = $this->mcommon->select('food_coupons', ['status !='=> 3], '*', 'food_coupon_id', 'DESC');
  
          if(isset($ap['source']) && $ap['source'] == 'WEB'){
            $this->data['coupons'] = $this->arr;
            $html = $this->load->view('admin/food/ajax-view', $this->data, true);
            $response['status']['error_code'] = 0;
            $response['status']['message']    = "Success html";
            $response['response']['data']      = $html;
          }else{
            $response['status']['error_code'] = 0;
            $response['status']['message']    = "Success";
            $response['response']['data']      = $this->arr;
          }
      }
      else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Please fill up all required fields';        
      }
    }
    else{
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Wrong http method type.';        
    }
    $this->displayOutput($response);
  }

  //function to send sms
  public function smsSend($mobile,$message){
    //echo $mobile."<br>".$message;die;
    $api_key = '45DB969F6550A9';
    //$api_key = '45DA414F762394'; //19-11
    //$contacts = '97656XXXXX,97612XXXXX,76012XXXXX,80012XXXXX,89456XXXXX,88010XXXXX,98442XXXXX';
    $contacts= $mobile;
    $from = 'CINCAF';
    //$from = 'TXTSMS';
    $sms_text = urlencode($message);
    //Submit to server
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, "https://sms.hitechsms.com/app/smsapi/index.php");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".$api_key."&campaign=0&routeid=13&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text);
    $response = curl_exec($ch);
    curl_close($ch);
    //echo $response;exit;
    if(mb_substr($response, 0, 3)=='ERR'){
        return false;
    }else{

      /***************insert into sms log table ****************************/
        $sms_arr=array();
        $sms_log_data = array('sms_txt'   => $message,
                'sms_urlencode'   => $sms_text,
                'source_page'     => "API"
                
              );
        $this->mcommon->insert('sms_log',$sms_log_data);

        /*******************************************************************/
        return $response;
    }
    //print_r($response);

  }

  /**
	 * Common function to manage status
	 * */
	public function changeStatus(){
		$this->isJSON(file_get_contents('php://input'));
		$postData = $this->extract_json(file_get_contents('php://input'));
		if (!empty($postData)) {
				$isUpdate = $this->mcommon->update($postData['table'], [$postData['indexKey'] => $postData['id']], ['status' => $postData['status']]);
				//echo $this->db->last_query();
				if($isUpdate){
					$response = array('status' => array('error_code' => 0, 'message' => 'Request successfully done'), 'result' => array('data' => $this->obj));
				}else{
					$response = array('status' => array('error_code' => 1, 'message' => 'Unable to perform request'), 'result' => array('data' => $this->obj));
				}
		}  else {
			$response = array('status' => array('error_code' => 1, 'message' => 'BAD REQUEST'), 'result' => array('data' => $this->obj));
		}

		$this->outputJson($response);
  }
  /**
	 * Function to manage food app access
	 * */
	public function updateFoodAccess(){
		$this->isJSON(file_get_contents('php://input'));
		$postData = $this->extract_json(file_get_contents('php://input'));
		if (!empty($postData)) {
				$isUpdate = $this->mcommon->update('food_access', ['id' => 1], ['is_active' => $postData['status']]);
				//echo $this->db->last_query();
				if($isUpdate){
					$response = array('status' => array('error_code' => 0, 'message' => 'Access Request saved successfully'), 'result' => array('data' => $this->obj));
				}else{
					$response = array('status' => array('error_code' => 1, 'message' => 'Unable to perform request'), 'result' => array('data' => $this->obj));
				}
		}  else {
			$response = array('status' => array('error_code' => 1, 'message' => 'BAD REQUEST'), 'result' => array('data' => $this->obj));
		}

		$this->outputJson($response);
  }
  
  /**
   * Deduct wallet copy from Controller/API 
   */
  public function deductFromWalllet($user_id, $amount)
  {
    $condition  = array('user_id'=>$user_id);
    $user_row   = $this->mcommon->getRow('user',$condition);

    $notification_title="Point deducted from wallet";
    $notification_des= $amount." point deducted from your wallet";
    $this->add_notification($user_id,$notification_title,$notification_des);
    //update to wallet user table//////////////////////////
    $present_amount=$user_row['wallet'];
    $updated_amount=$present_amount-$amount;
    $user_data=array();
    $user_data['wallet']=$updated_amount;
    $this->mcommon->update('user',$condition,$user_data);

          ///////////////////////////////////////////////////////////////
    ////Notification////////////////////////////////////////////
    //get user info
    // $condition_user['user_id']=$user_id;
    // $user_row=$this->mapi->getRow("user",$condition_user); 
    
    //   $notification_title="Point deducted from wallet";
    //   $notification_des= $amount." point deducted from your wallet";
    //   $this->add_notification($user_id,$notification_title,$notification_des);
    /** Notification ends here.............................**/

    /********************************** Send reservation details in sms *************************************************/

        $message  = $notification_des." at ".ORGANIZATION_NAME.". \n";
        $message .= "Present wallet balance is : ".$updated_amount;
        
        smsSend($user_row['mobile'],$message);

        /********push notification fr membership ************************/
        $title=$notification_title;
        //$message   = $notification_des;
        $message_data = array('title' => $title,'message' => $notification_des);
        $user_fcm_token_data  = $this->mcommon->getRow('device_token',array('user_id' => $user_id));
        //pr($user_fcm_token_data);
        if(!empty($user_fcm_token_data)){
          $member_datas  = $this->mcommon->getRow('user',array('user_id' => $user_id));
            if($member_datas['notification_allow_type'] == '1'){
                if($user_fcm_token_data['device_type'] == 1){
                  $this->pushnotification->send_ios_notification($user_fcm_token_data['fcm_token'], $message_data);
                }
                else{
                  $this->pushnotification->send_android_notification($user_fcm_token_data['fcm_token'], $message_data);
                }
            }
          }

          /*********Mail fn ...************************************************/
          $details            =  $message;  
          $name=$user_row['name'];
          $email=$user_row['email'];
          $mail['name']       = $name;
          $mail['to']         = $email;    
          //$params['to']     = 'sreelabiswas.kundu@met-technologies.com';
          
          $mail['subject']    = ORGANIZATION_NAME." wallet point deducted";                             
          $mail_temp          = file_get_contents('./global/mail/wallet_template.html');
          $mail_temp          = str_replace("{web_url}", base_url(), $mail_temp);
          $mail_temp          = str_replace("{logo}", LOGOURL, $mail_temp);
          $mail_temp          = str_replace("{shop_name}", ORGANIZATION_NAME, $mail_temp);  
          $mail_temp          = str_replace("{name}", $mail['name'], $mail_temp);
                  
          $mail_temp          = str_replace("{current_year}", date('Y'), $mail_temp);                         
          $mail_temp                 =   str_replace("{details}", $details, $mail_temp);
          
          

          $mail['message']    = $mail_temp;
          $mail['from_email']    = FROM_EMAIL;
          $mail['from_name']    = ORGANIZATION_NAME;
          sendmail($mail); 

                         
                          
            /****************mail ends*******************************************/ 
          /////////////////////////////////////////////////////////////////////////////
          return 1;
  }

  /**
   * Food Application is vissible in App
  */
  public function getFoodApplicationStatus()
  {
    $status = $this->mcommon->select('food_access', array(), '*');
    if($status){
      $response = array('status' => array('error_code' => 0, 'message' => 'Access status'), 'result' => array('data' => array('is_active'=> (int)$status[0]->is_active)));
    }else{
      $response = array('status' => array('error_code' => 0, 'message' => 'Access status'), 'result' => array('data' => array('is_active'=> 0)));
    }

    $this->outputJson($response);
  }

  /**----------------------------Admin APIs support----------------------------- */
  public function getFrontendOrders()
  {
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {        
          $where = array('fo.status'=> 1, 'order_status'=> 1);
          if(!empty($ap['start_date']) && !empty($ap['end_date'])){
            $where['order_date >='] = date('Y-m-d 00:00:01', strtotime($ap['start_date']));
            $where['order_date <='] = date('Y-m-d 23:59:59', strtotime($ap['end_date']));
          }
          
          //$categories = $this->mcommon->getDetails('food_categories', $where);
          $join[] = ['table' => 'user u', 'on' => 'u.user_id = fo.user_id', 'type' => 'left'];
          $items = $this->mcommon->select('food_orders fo', $where, 'fo.*, u.name first_name, u.last_name', 'fo.food_order_id', 'DESC', $join);
          //echo $this->db->last_query(); 
          if(isset($ap['source']) && $ap['source'] == 'WEB'){
            $this->data['orders'] = (object)$items;
            $this->data['order_status'] = $this->mcommon->select('food_order_status', ['status'=> 1], '*', 'order', 'ASC');
            $html = $this->load->view('admin/food/ajax-view', $this->data, true);
            $response['status']['error_code'] = 0;
            $response['status']['message']    = "Success html";
            $response['response']['data']      = $html;
          }else{
            $response['status']['error_code'] = 0;
            $response['status']['message']    = "Success";
            $response['response']['data']      = $items;
          }
      }
      else {
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Please fill up all required fields';        
      }
    }
    else{
        $response['status']['error_code'] = 1;
        $response['status']['message']    = 'Wrong http method type.';        
    }
    $this->displayOutput($response);
  }

  public function generateOrderInvoice($food_order_id)
  {
    $dompdf = new Dompdf();
    $result = $this->getOrderDetails($food_order_id);
    $result['logo'] = getcwd().'/public/images/logo.png';
    $html = $this->load->view('admin/food/orders/invoice', $result, true);
    //echo $html; die;
    $dompdf->load_html($html);
		$customPaper =  array(0,0,840.00,1200.89);
		$dompdf->set_paper('A4', 'portrait');
		
    $dompdf->render();
		$file = "FEN000".$food_order_id.".pdf";
		$file_to_save = FCPATH.'uploads/invoices/'.$file;
    //$dompdf->stream($file);
    if(file_put_contents($file_to_save, $dompdf->output())){
      return base_url('uploads/invoices/'.$file);
    }else{
      return false;
    }
  }
}
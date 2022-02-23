<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Api extends MY_Controller
{
  var $arr;
  var $obj;
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
  private function check_access_token($access_token, $device_type,$member_id)
  {
    $condition_token = array('access_token' => $access_token, 'device_type' => $device_type,'member_id'=>$member_id);
    //pr($condition_token);
    $access_token_result = $this->mapi->getRow('api_token', $condition_token);
    if(empty($access_token_result)){
      $response['status']['error_code'] = 1;
      $response['status']['message']    = 'Unauthorize Token';        
      $this->displayOutput($response);
    }
  }
  public function getCategories()
  {
    ini_set('display_errors', 1);
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
    ini_set('display_errors', 1);
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
    //ini_set('display_errors', 1);
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
          //check access token for user
          if(isset($ap['member_id']) && !empty($ap['member_id'])){
            $member_id            = $ap['member_id'];
            $access_token         = $ap['access_token'];
            $device_type          = $ap['device_type'];
            $this->check_access_token($access_token, $device_type,$member_id);
          }
          
          if(empty($ap['category_id'])){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Incomplete request";
            $this->displayOutput($response);
          }
          $where = array();
          $where['fc.parent_category'] = $ap['category_id'];
          //$categories = $this->mcommon->getDetails('food_categories', $where);
          $join[] = ['table' => 'food_categories fc2', 'on' => 'fc2.food_category_id = fc.parent_category', 'type' => 'left'];
          $sub_categories = $this->mcommon->select('food_categories fc', $where, 'fc.*, fc2.category_name parent_category_name', 'fc.category_name', 'ASC', $join);
          // echo $this->db->last_query();
          // print_r($sub_categories);
          $item_array = array();
          if($sub_categories){
            foreach($sub_categories as $key=> $val){
              $join = [];
              $join[] = ['table' => 'food_categories fc', 'on' => 'fc.food_category_id = fi.category_id', 'type' => 'left'];
              $val->items = $this->mcommon->select('food_items fi', ['fi.sub_category_id'=> $val->food_category_id, 'fi.status'=> 1], 'fi.*, fc.food_category_id, fc.slug', 'fi.item_name', 'ASC', $join);
              // insert cart items only for members
              if(isset($ap['member_id']) && !empty($ap['member_id']))
              if(!empty($val->items)){
                foreach ($val->items as $k => $v) {
                  $w = array('member_id'=> $ap['member_id'], 'item_id'=> $v->food_item_id, 'item_addon_id'=> null);
                  $this->db->select('SUM(quantity) quantity');
                  $this->db->where($w);
                  $this->db->group_by('item_id');
                  $q = $this->db->get('food_cart_items')->row_array();
                  if($q){
                    $v->quantity = $q['quantity'];
                  }else{
                    $v->quantity = 0;
                  }
                  //get item addons
                  $v->addons = $this->mcommon->select('food_item_addons',['item_id'=> $v->food_item_id], '*', 'addon_name', 'ASC');
                  //print_r($v->addons);
                  if(!empty($v->addons)){
                    foreach ($v->addons as $k => $addon) {
                      $w = array('member_id'=> $ap['member_id'], 'item_id'=> $v->food_item_id, 'item_addon_id'=> $addon->food_item_addon_id);
                      $this->db->select('*');
                      $this->db->where($w);
                      //$this->db->group_by('item_addon_id');
                      $qaddon = $this->db->get('food_cart_items')->row_array();
                      //echo $this->db->last_query();
                      if($qaddon){
                        $addon->quantity = 1;
                      }else{
                        $addon->quantity = 0;
                      }
                    }
                  } //end cart addon checking
                }
              } //end cart item checking
              $item_array[] = $val;
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

  //get addons
  /**
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
          // $member_id            = $ap['member_id'];
          // $access_token         = $ap['access_token'];  
          // $device_type          = $ap['device_type'];
          // $this->check_access_token($access_token, $device_type,$member_id);
          $this->arr = array();
          // $this->arr = array(
          //   'member_id'=> $ap['member_id']
          // );
          //$join[] = ['table' => 'food_categories fc', 'on' => 'fc.food_category_id = fi.category_id', 'type' => 'left'];
          $join[] = ['table' => 'food_items fi', 'on' => 'fi.food_item_id = addon.item_id', 'type' => 'left'];
            //echo 'test'; die;
          $this->arr = $this->mcommon->select('food_item_addons addon', $this->arr, 'addon.*, fi.*', 'addon.addon_name', 'ASC', $join);
  
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
          $member_id            = $ap['member_id'];
          $access_token         = $ap['access_token'];  
          $device_type          = $ap['device_type'];
          $this->check_access_token($access_token, $device_type,$member_id);

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
            'member_id'=> $ap['member_id'],
            'item_id'=> $ap['item_id'],
            //'quantity'=>$ap['quantity']
          );
          /*------------------------add item oaddon---------------------------*/
          if(isset($ap['food_item_addon_id']) && !empty($ap['food_item_addon_id'])){
            $this->arr['item_addon_id'] = $ap['food_item_addon_id'];
          }
          /*---------------------------end----------------------------------*/
          //$isSuccess = $this->mcommon->insert('food_cart_items', $this->arr);
          if(!empty($data = $this->mcommon->getRow('food_cart_items',  $this->arr)) && empty($ap['food_item_addon_id'])){
            $this->arr['item_addon_id']= null;
            $isSuccess = $this->mcommon->update('food_cart_items', $this->arr, ['quantity'=> $data['quantity']+$ap['quantity']]);
          }else{
            $this->arr['quantity'] = $ap['quantity'];
            $isSuccess = $this->mcommon->insert('food_cart_items', $this->arr);
          }          
          
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
          $member_id            = $ap['member_id'];
          $access_token         = $ap['access_token'];  
          $device_type          = $ap['device_type'];
          $this->check_access_token($access_token, $device_type,$member_id);

          //validate request input 
          if(empty($ap['item_id'])){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Item is required";
            $response['response']['data']      = $this->obj;
          }

          $this->arr = array(
            'member_id'=> $ap['member_id'],
            'item_id'=> $ap['item_id']
          );
          if(!empty($data = $this->mcommon->getRow('food_cart_items',  $this->arr)) && empty($ap['food_item_addon_id'])){
            $this->arr['item_addon_id']= null;
            $isSuccess = $this->mcommon->update('food_cart_items', $this->arr, ['quantity'=> $data['quantity']-$ap['quantity']]);
            //id data quantity is 1 then remove addon 
            if($data['quantity'] == 1 ){
              $this->db->where(array(
                              'member_id'=> $ap['member_id'],
                              'item_id'=> $ap['item_id']
                            ));
              $this->db->delete('food_cart_items');
            }
          }else{
            $isSuccess = false;
          }
          /*------------------------add item oaddon---------------------------*/
          if(isset($ap['food_item_addon_id']) && !empty($ap['food_item_addon_id'])){
            $this->db->where($this->arr);
            $this->db->where('item_addon_id', $ap['food_item_addon_id']);
            $this->db->delete('food_cart_items');
            //echo $this->db->last_query();
            $isSuccess = true;
          }
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
          $member_id            = $ap['member_id'];
          $access_token         = $ap['access_token'];  
          $device_type          = $ap['device_type'];
          $this->check_access_token($access_token, $device_type,$member_id);

          $this->arr = array(
            'member_id'=> $ap['member_id'],
            'item_addon_id'=> null,
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
              if($value->quantity != 0){
                $total_amount += $value->quantity*$value->price;
                $total_item_count += $value->quantity;
                $join = [];
                $join[] = ['table' => 'food_item_addons fi', 'on' => 'fi.food_item_addon_id = fci.item_addon_id', 'type' => 'left'];
                $cartItemAddons = $this->mcommon->select('food_cart_items fci', ['member_id'=> $ap['member_id'], 'fci.item_id'=> $value->item_id, 'fci.item_addon_id !='=> null], 'fci.*, fi.*', '', '', $join);
                //echo $this->db->last_query();
                if(!empty($cartItemAddons)){
                  foreach ($cartItemAddons as $key => $val) {
                    $total_addon++;
                    $total_item_count += $val->quantity;
                    $total_amount +=$val->quantity*$val->addon_price;
                    $val->quantity = 1;

                    $addon_list[] = $val;
                  }
                }
                $value->addons = $cartItemAddons;
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
    ini_set('display_errors', 1);
    $this->isJSON(file_get_contents('php://input'));
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
          //check access token for user
          $member_id            = $ap['member_id'];
          $access_token         = $ap['access_token'];  
          $device_type          = $ap['device_type'];
          $this->check_access_token($access_token, $device_type,$member_id);

          //validate request input
          if(empty($ap['cupon_code'])){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Coupon Code is required";
            $response['response']['data']      = $this->obj;
            $this->displayOutput($response);
          }

          //check is coupon valid
          $this->db->where(['coupon_code'=> trim($ap['cupon_code']), 'status'=> 1]);
          if(!$coupon_data = $this->db->get('food_coupons')->row_array()){
            $response['status']['error_code'] = 1;
            $response['status']['message']    = "Coupon Code is invalid";
            $response['response']['data']      = $this->obj;
            $this->displayOutput($response);
          }
          // get all cart items total amount
          $totalCartPrice = $this->getCartPrice($ap['member_id']);
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
            $response['status']['error_code'] = 0;
            $response['status']['message']    = "Success";
            $response['response']['data']      = $insert_array = array(
                                                        'discount_amount'=> (int)$this->arr[0]->discount_amount,
                                                        'cart_amount'=> $totalCartPrice,
                                                        'payable_amount'=> ($totalCartPrice - $this->arr[0]->discount_amount),
                                                      );
            // insert into temp_coupon table
            $insert_array['member_id']= $ap['member_id'];
            $insert_array['coupon_code']= trim($ap['cupon_code']);
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
          $member_id            = $ap['member_id'];
          $access_token         = $ap['access_token'];  
          $device_type          = $ap['device_type'];
          $this->check_access_token($access_token, $device_type,$member_id);

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
          $totalCartPrice = $this->getCartPrice($ap['member_id']);
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
            $this->db->where(['member_id'=> $ap['member_id'], 'applied_status'=>0]);
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
    ini_set('display_errors', 1);
    $this->isJSON(file_get_contents('php://input'));
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
          //check access token for user
          $member_id            = $ap['member_id'];
          $access_token         = $ap['access_token'];  
          $device_type          = $ap['device_type'];
          $this->check_access_token($access_token, $device_type,$member_id);

          // get all cart items total amount
          $totalCartPrice = $this->getCartPrice($ap['member_id']);
          if($totalCartPrice <=0){
              $response['status']['error_code'] = 1;
              $response['status']['message']    = "Cart is empty";
              $response['response']['data']      = $this->obj;
              $this->displayOutput($response);
          }
          /********************************************************** */
          
          $checkout_array = array(
                                  'discount_amount'=> 0,
                                  'cart_amount'=> $totalCartPrice,
                                  'payable_amount'=> $totalCartPrice,
                                  'coupon_code'=> ""
                                );
          //check is coupon applied
          $this->arr = $this->mcommon->select('food_apply_coupon', ['member_id'=> $ap['member_id'], 'applied_status'=> 0], '*');
          if(!empty($this->arr)){
            $data = $this->arr[0];
            $checkout_array = array(
                                    'discount_amount'=> $data->discount_amount,
                                    'cart_amount'=> $totalCartPrice,
                                    'payable_amount'=> ($totalCartPrice - $data->discount_amount),
                                    'coupon_code'=> $data->coupon_code
                                  );
          }

          //insert into order as pending
          $order_array = $checkout_array;
          unset($order_array['cart_amount']); //Remove unwanted column
          $order_array['member_id']= $ap['member_id'];
          $order_array['total_amount']= $totalCartPrice;
          $order_array['order_status']= 0;   // Pending

          $order_id = $this->mcommon->insert('food_orders', $order_array);
          //echo $this->db->last_query();
          if($order_id){
            $checkout_array['order_id'] = $order_id;
            //insert order_details
            //get cart items
            $tcart_items = $this->mcommon->select('food_cart_items', ['member_id'=> $ap['member_id']], 'member_id, item_id, item_addon_id, quantity');
            $items_array = [];
            $total_item_count = 0;
            foreach ($tcart_items as $key => $value) {
              $value->foor_order_id= $order_id;              
              $total_item_count += $value->quantity;
              $items_array[] = $value;
            }
            $this->mcommon->batch_insert('food_order_items', $items_array);

            
            $checkout_array['total_item_count'] =$total_item_count;

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
    ini_set('display_errors', 1);
    $this->isJSON(file_get_contents('php://input'));
    $ap = json_decode(file_get_contents('php://input'), true);
    if ($this->checkHttpMethods($this->http_methods[0])) {
      if (sizeof($ap)) {
          //check access token for user
          $member_id            = $ap['member_id'];
          $access_token         = $ap['access_token'];  
          $device_type          = $ap['device_type'];
          $this->check_access_token($access_token, $device_type,$member_id);

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
          

          //insert into order as pending
          $order_array = [];
          $order_array['order_status']= 1;   // Paid

          $this->mcommon->update('food_orders', ['food_order_id'=> $ap['order_id']],  $order_array);

          $trans_array = array(
            'food_order_id'=> $ap['order_id'],
            'transaction_id'=> $ap['transaction_id'],
            'source'=> $ap['source'],
          );

          $this->mcommon->insert('food_order_transactions', $trans_array);

          //clear cart after check functionality
          // $this->db->where(['member_id'=> $ap['member_id']]);
          // $this->db->delete('food_cart_items');
          /*------------------------------Notification section-----------------*/ 
        $message_data         = array('title' => 'Buy Food','message' => 'Your food ordered received. Thank you for ordering with us.');
        $user_fcm_token_data  = $this->mcommon->getRow('device_token',array('member_id' => $ap['member_id']));
        //pr($user_fcm_token_data);
        if(!empty($user_fcm_token_data)){
          $member_datas   = $this->mcommon->getRow('master_member',array('member_id' => $ap['member_id']));

          $user_name      = $member_datas['first_name'];
          $user_email     = $member_datas['email'];
          $user_mobile    = '8927279789';//$member_datas['mobile'];

          if($member_datas['notification_allow_type'] == '1'){
            if($ap['device_type'] == 1){
              $push_array = array("to" => 
														//"d_C0y2ibSU9GsMxMH3nhCj:APA91bGdwAjyMIFPZCtiWrO4UZ7OGlBsYIPjyrJaD_K1aytOKxAJGReiUdJOg8Cr5_Z3SvNi2UkDBMa_NumyGR70hFZvr2cUOcVjFcZHYOSWX2qDzwIbnbi2kCttaiVBvd0ssjA4jidt",
														$user_fcm_token_data['fcm_token'],
														"mutable_content"=>true,
														"notification" => array(
															"body" => 'Your food ordered received. Thank you for ordering with us.',
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
															"body" => 'Your food ordered received. Thank you for ordering with us.',
															"title"=> 'Buy Food'															
														)
                          );
              $this->pushnotification->send_android_notification($push_array);
            }
          }          
          $notification_arr = array('member_id'                 => $member_id,
                                    'notification_title'        => 'Buy Food',
                                    'notification_description'  => 'Your food ordered received. Thank you for ordering with us.',
                                    'status'                    => '1',
                                    'created_on'                => date('Y-m-d H:i:s')
                                    );
          $insert_data      = $this->mcommon->insert('notification', $notification_arr);
        }
        /****************** Send password to the member ****************************/
             
              // $logo               =   base_url('public/images/logo.png');
              // $params['name']     =   $user_name;
              // $params['to']       =   $user_email; 
              // //$params['to']     =   'sreelabiswas.kundu@met-technologies.com';
              // $details            =   "Membership name: ".$package_name."<br>"."Membership type: ".$package_type_name."<br>"."Membership Price:(₹) ".$package_price."<br>"."Membership Status: Your Club Membership is under process";                     
              // $params['subject']  =   'Club Fenicia - Membership subscription Mail';                             
              // $mail_temp          =   file_get_contents('./global/mail/membership_subscription.html');
              // $mail_temp          =   str_replace("{web_url}", base_url(), $mail_temp);
              // $mail_temp          =   str_replace("{logo}", $logo, $mail_temp);
              // $mail_temp          =   str_replace("{shop_name}", 'Club Fenicia', $mail_temp);  
              // $mail_temp          =   str_replace("{name}", $params['name'], $mail_temp);
              // $mail_temp          =   str_replace("{membership_name}", $package_name, $mail_temp);
              // $mail_temp          =   str_replace("{details}", $details, $mail_temp);
              // $mail_temp          =   str_replace("{current_year}", date('Y'), $mail_temp);           
              // $params['message']  =   $mail_temp;
              // $msg                =   registration_mail($params);


              $message  = "Food order received. Your food ordered received. Thank you for ordering with us.";
              //$message  .=   "Membership name: ".$package_name.", Membership type: ".$package_type_name.", Membership Price: ".$package_price."Membership Status: Under process";
              
              //$this->smsSend($user_mobile,$message);

          $response['status']['error_code'] = 0;
          $response['status']['message']    = "Order placed successfully";
          $response['response']['data']      = array('order_id'=> $ap['order_id']);          
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
          $this->arr = $this->mcommon->select('food_cart_items fci', ['member_id'=> $member_id, 'item_addon_id'=> null], 'fci.*, fi.*', 'fci.food_cart_item_id', 'DESC', $join);
         if(!empty($this->arr)){ 
           $total_amount = 0;          
            foreach ($this->arr as $key => $value) {
              if($value->quantity != 0){
                $total_amount += $value->quantity*$value->price;
                $join = [];
                $join[] = ['table' => 'food_item_addons fi', 'on' => 'fi.food_item_addon_id = fci.item_addon_id', 'type' => 'left'];
                $cartItemAddons = $this->mcommon->select('food_cart_items fci', ['fci.item_id'=> $value->item_id, 'fci.item_addon_id !='=> null], 'fci.*, fi.*', '', '', $join);
                //echo $this->db->last_query();
                //print_r($cartItemAddons);
                if(!empty($cartItemAddons)){
                  foreach ($cartItemAddons as $key => $val) {
                    $total_amount +=$val->quantity*$val->addon_price;
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
          $member_id            = $ap['member_id'];
          $access_token         = $ap['access_token'];  
          $device_type          = $ap['device_type'];
          $this->check_access_token($access_token, $device_type,$member_id);

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
            'member_id'=> $ap['member_id'],
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
            $isSuccess = $this->mcommon->update('food_member_address', ['member_id'=> $ap['member_id']], ['is_default'=> 0]);
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
          $member_id            = $ap['member_id'];
          $access_token         = $ap['access_token'];  
          $device_type          = $ap['device_type'];
          $this->check_access_token($access_token, $device_type,$member_id);

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
          $member_id            = $ap['member_id'];
          $access_token         = $ap['access_token'];  
          $device_type          = $ap['device_type'];
          $this->check_access_token($access_token, $device_type,$member_id);

          //validate request input 
          $where = array('member_id'=> $ap['member_id'], 'status'=> 1);
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
          $member_id            = $ap['member_id'];
          $access_token         = $ap['access_token'];  
          $device_type          = $ap['device_type'];
          $this->check_access_token($access_token, $device_type,$member_id);

            //validate request input 
            if(empty($ap['food_member_address_id'])){
              $response['status']['error_code'] = 1;
              $response['status']['message']    = "Incomplete request";
              $response['response']['data']      = $this->obj;
            }
            
            // set all is_default = 0
            $this->mcommon->update('food_member_address', ['member_id'=> $ap['member_id']], ['is_default'=> 0, 'updated_at' => date('Y-m-d H:i:s')]);
  
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
      $item = $cartItem[0];
      $total_qty = $item->quantity;
      $total_amount = $item->quantity*$item->price;
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
    $from = 'FENCIA';
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
}
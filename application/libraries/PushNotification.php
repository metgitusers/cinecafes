<?php
 class PushNotification { 
  private $CI;
  function __construct() {
        $this->CI =& get_instance();
     }
  //public function send_android_notification($fcmtoken, $data) {
  public function send_android_notification($arrayToSend) {
    //pr($data);
    $url = "https://fcm.googleapis.com/fcm/send";
            //$token = $fcmtoken; 
             
            $serverKey = 'AAAA15rbgcY:APA91bHG9YdDsYS3UPXL5H-uV4dxGBVTXPbdXNnU3_Og052IIPgzHw5d7RQrjrPi2CC1JjfnNIxQVudCa580beTxY2BHI4zgDBauQsw9p9b6e9NKu7e-4mBHWZCzQHuvXPRrXhXwmKig';
            // $title = $data['title'];
            // $body = $data['message'];
            // $notification = array('title' =>$title , 'text' => $body, 'sound' => 'default', 'badge' => '1','data'=>array());
            // $arrayToSend = array('to' => $token, 'notification' => $notification, 'priority'=>'high');
            
            $json = json_encode($arrayToSend);
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Authorization: key='. $serverKey;
            $ch = curl_init();
            
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
   
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   // Disabling SSL Certificate support temporarly
   curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
   
            //Send the request
            $response = curl_exec($ch);
            //Close request
            if ($response === FALSE) {
                die('FCM Send Error: ' . curl_error($ch));
            }
            curl_close($ch);
  }
  //public function send_ios_notification($fcmtoken,$data){ 
  public function send_ios_notification($arrayToSend){ 
                  
            $url = "https://fcm.googleapis.com/fcm/send";
           // $token = $fcmtoken; 
            //$serverKey = 'AAAAov-bqrI:APA91bF8rMdYalxEskc5qVxslBRfI9BAqok5__G-Bpwqi7piURwR3pp6iepH2edBdgdxGA_v_HK_UuTZF3PDjL6y5b6MyUa6n12_k6bEcvH6iSYd1ZhlroFITcG_YUg_q-xYDR_gsdSm';
            $serverKey = 'AAAA15rbgcY:APA91bHG9YdDsYS3UPXL5H-uV4dxGBVTXPbdXNnU3_Og052IIPgzHw5d7RQrjrPi2CC1JjfnNIxQVudCa580beTxY2BHI4zgDBauQsw9p9b6e9NKu7e-4mBHWZCzQHuvXPRrXhXwmKig';
            
            // $title = $data['title'];
            // $body = $data['message'];
            // $notification = array('title' =>$title , 'text' => $body, 'sound' => 'default', 'badge' => '1','data'=>array());
            // $arrayToSend = array('to' => $token, 'notification' => $notification, 'priority'=>'high');
            $json = json_encode($arrayToSend);
            //print_r($json);
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Authorization: key='. $serverKey;
            $ch = curl_init();
            
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
   
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           // Disabling SSL Certificate support temporarly
           curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
   
            //Send the request
            $response = curl_exec($ch);
            //Close request
            if ($response === FALSE) {
                die('FCM Send Error: ' . curl_error($ch));
            }
            curl_close($ch);
            
        }
  public function getAllDeviceList(){
   $query=$this->CI->db->get('devices');
   return $query->result_array();   
  } 
 }
?>
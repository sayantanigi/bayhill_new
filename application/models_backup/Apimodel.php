<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Apimodel extends MY_Model
{
  function __construct() 
  {
    parent::__construct();
  }   

  
  public function add_details($tbl,$data)
  {  
    $this->db->insert($tbl,$data);
    $lastid= $this->db->insert_id();
    return $lastid;
  }

  public function insert_bulk($tbl, $data = array())
  { 
        $insert = $this->db->insert_batch($tbl, $data); 
        return $insert?true:false; 
    } 

  public function get_cond($tablename,$cond)
  {
    $this->db->select('*');
    $this->db->from($tablename);
    $this->db->where($cond); 
    $query = $this->db->get();
    $res = $query->row();
    return $res; 
  }

  public function get_cond_all($tablename, $cond) 
  {
    $this->db->select('*');
    $this->db->from($tablename);
    $this->db->where($cond); 
    $query = $this->db->get();
    $res = $query->result();
    return $res ; 
  }

  public function update_cond($tablename,$cond,$value) 
  {
    $this->db->where($cond); 
    $this->db->update($tablename, $value);
    return true;
  }

  public function fetch_all_join($query)
  {
    $query = $this->db->query($query);
    return $query->result();        
  }

  public function fetch_single_join($query)
  {
    $query = $this->db->query($query);
    return $query->row();        
  }

  public function delete_single_con($tbl,$where)
  {
    $this->db->where($where);
    $delete = $this->db->delete($tbl); 
    return $delete;

  }

  public function count($table, $where = NULL)
  {
    if ($where != NULL) 
    {
      $this->db->where($where);

    }
    $this->db->from($table);
    return $this->db->count_all_results();
  }

  public function randString($length, $charset='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789')
  {
    $str = '';
    $count = strlen($charset);
    while ($length--) {
      $str .= $charset[mt_rand(0, $count-1)];
    }

    return $str;
  }

   /*public function sendPushMessage($data)
  {
    $content = array(
      "en" => $data['msg']
    );

    $fields = array(
      'app_id' => "5a7b3457-edf6-4111-8566-396c20f73adf",
      //'included_segments' => array('All'),
      'include_player_ids' => [$data['playerId']],
      'data' => array("status" => "1", "type"=>$data['type'], "name"=>$data['name']),
      'large_icon' =>"https://utaliiworld.com/uploads/logos/favicon.png",
      'contents' => $content
    );


    $fields = json_encode($fields);       

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
      'Authorization: Basic YTFjYjUxMmUtYmFhZi00MmVlLWEyYTQtY2M4NGY3ZWRkYzQw'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
  }*/
  
  /**
   * Sending Push Notification Through Firebase
  */
  public function sendFirebaseNotification($paramArr) {

      $apiUrl = 'https://fcm.googleapis.com/fcm/send';

      $fcmToken = $paramArr['fcmToken'];
      $notification = $paramArr['notification'];
      $device_type = $paramArr['device_type'];
            
      if ($device_type == "Android") {
          $fields = array(
              'to' => $fcmToken,
              'data' => $notification,
              'priority' => 'high'
          );
      }else {
          $fields = array(
              'to' => $fcmToken,
              'notification' => $notification,
              'priority' => 'high'
          );
      }

      //echo FIREBASE_SERVER_KEY;exit;
    
      // Firebase API Key
      $headers = array(
        'Authorization: key=' . FIREBASE_SERVER_KEY,
        'Content-Type: application/json',
      );
      
      // Open connection
      $ch = curl_init();

      // Set the url, number of POST vars, POST data
      curl_setopt($ch, CURLOPT_URL, $apiUrl);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // Disabling SSL Certificate support temporarly
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
      $result = curl_exec($ch);

      if ($result === FALSE) {
          //die('Curl failed: '.curl_error($ch));
          $response = array('success'=>false,'message'=>curl_error($ch));
      }else{
        $result = (array)json_decode($result);

        if($result['success'] == true){
           $response = array("success"=>true,"message"=>"Push notification is successfully delivered!");
        }else{
           $response = array("success"=>false,"message"=>$result['results'][0]->error);
        }
      }

      curl_close($ch);

      return $response;
  }
	public function getSettings()
	{
		return $this->get('settings', true, 'settingId', '1');
	}
	
	function send_mail($to_email = '', $from_email = '', $msg = '', $subject = '', $mail_username = '', $mail_password = ''){
		require_once APPPATH.'third_party/email/vendor/autoload.php';
		$mail = new PHPMailer();
		$mail->SMTPDebug = 0; //Enable verbose debug output
		$mail->Host = 'smtp.office365.com'; // Specify main and backup SMTP servers
		$mail->IsSMTP();
		$mail->SMTPAuth = true; // Enable SMTP authentication
		$mail->Username = $mail_username;                
		$mail->Password = $mail_password;
		$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587; // TCP port to connect to
		//$mail->setFrom($from_email);
		$mail->From = ''.$from_email.'';
		$mail->addAddress($to_email);
		$mail->isHTML(true); // Set email format to HTML
		$mail->Subject = $subject;
		$mail->Body    = $msg;
		return $mail->send();
		
		//email
		/*$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		// More headers
		$headers .= 'From: <'.@$from_email.'>' . "\r\n";
		$subject = @$subject;	
		$to = 	@$to_email;	
		$message = @$msg;
		return mail($to, $subject, $message, $headers);*/
	}
	function add_multiple_listing_gallery($data = '', $table = '', $id = ''){
		//print_r($data);die;
		$count = 0;
		foreach ($data as $image) {
						
			$galleryData = array(
				'image' => $image['image'],
				'event_id' => $id,
				'user_id' => $image['userId'],
				'created_at' =>date('Y-m-d H:i:s')
			);
			
			$this->db->insert($table, $galleryData);
			$result[] =  $this->db->insert_id();
		}
		return $result;
	}
	function add_multiple_listing_gallery_update($data = '', $table = '', $id = ''){
		//print_r($data);die;
		$count = 0;
		foreach ($data as $image) {
						
			$galleryData = array(
				'image' => $image['image'],
				'event_id' => $id,
				'created_at' =>date('Y-m-d H:i:s')
			);
			
			$this->db->insert($table, $galleryData);
			$result[] =  $this->db->insert_id();
		}
		return $result;
	}
	
	function countMyeventList($table = '', $where = ''){
		$sql = "SELECT * FROM ".$table." WHERE ".@$where."  ORDER BY event_id DESC";
	    $query = $this->db->query($sql);
		$result = ($query->num_rows() > 0)	? $query->num_rows() : false;
		return $result;
	}
	
	function getAllMyeventList($start = '', $limit = '', $where = '', $table = ''){
		if($start == 0){
		  $start = '';
		}else{
		  $start = ''.$start.',';
		}
		
		$sql = "SELECT * FROM ".$table." WHERE ".@$where." ORDER BY event_id DESC Limit ".$start." ".$limit."";
	    $query = $this->db->query($sql);
		$result = ($query->num_rows() > 0)	? $query->result() : false;
		return $result;
	}
	
	function countAlleventList($userId = '', $email = ''){
		$query = $this->db->query("select * from event where status = '1' and (user_id = ".@$userId." OR event_id IN(select event_id from event_invited_people where email = '".@$email."')) ORDER BY event_id DESC");
		$result = ($query->num_rows() > 0) ? $query->num_rows() : FALSE;
		return $result;
	}
	function getAlleventList($start = '', $limit = '', $userId = '', $email = ''){
		if(@$start == 0){
		  @$start = '';
		}else{
		  @$start = ''.$start.',';
		}
		$query = $this->db->query("select * from event where status = '1' and (user_id = ".@$userId." OR event_id IN(select event_id from event_invited_people where email = '".@$email."')) ORDER BY event_id DESC Limit ".$start." ".$limit."");
		$result = ($query->num_rows() > 0) ? $query->result() : FALSE;
		return $result;
	}
	
	public function update_data($table = '', $colum = '', $where = '', $data = ''){
        if(!empty($data)){
            $this->db->select($colum);
            $this->db->from($table);
            $this->db->where($where);
            $prevQuery = $this->db->get();
            $prevCheck = $prevQuery->num_rows();
            
            if($prevCheck > 0){
                $prevResult = $prevQuery->row_array();
                $data['updated_at'] = date("Y-m-d H:i:s");
                $update = $this->db->update($table, $data, $where);
                $userID = $prevResult['id'];
            }else{
                $data['created_at']  = date("Y-m-d H:i:s");
				$insert = $this->db->insert($table, $data);
                $userID = $this->db->insert_id();
            }
        }
        //return user ID
        return $userID?$userID:FALSE;
    }
	
	public function sendPushMessage($pushData){
        $content = array(
            "en" => $pushData['msg']
        );
       
        $fields = array(
            'app_id' => "361882f3-ac2c-40fe-aaa9-65192c0e8267",
            'include_player_ids' => [$pushData['playerId']],
            'data' => array("name"=>"MadeToSplit Team"),
            'large_icon' =>"https://madetosplit.com/uploads/logos/logo.png",
            'contents' => $content
        );        

        $fields = json_encode($fields); 

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
         'Authorization: Basic YWVhODE4MWUtODQ2OS00ZmJiLThjNmItN2JiYTI3MjE1YmQ4'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
  }
  
    public function Google_Login($userData = array()){ 
        if(!empty($userData)){
            //check whether user data already exists in database with same oauth info
            $this->db->select('id');
            $this->db->from('users');
            $this->db->where(array('oauth_provider'=>$userData['oauth_provider'], 'oauth_uid'=>$userData['oauth_uid']));
            $prevQuery = $this->db->get();
            $prevCheck = $prevQuery->num_rows();
            if($prevCheck > 0){
                $prevResult = $prevQuery->row_array();
                $userData['updated_at'] = date("Y-m-d H:i:s");
                $update = $this->db->update('users', $userData, array('id' => $prevResult['id']));
                $userID = $prevResult['id'];
            }else{
                $userData['created_at']  = date("Y-m-d H:i:s");
                $insert = $this->db->insert('users', $userData);
                $userID = $this->db->insert_id();
            }
        }
        return $userID?$userID:FALSE;
    }
	
	public function Facebook_Login($userData = array()){ 
        if(!empty($userData)){
            //check whether user data already exists in database with same oauth info
            $this->db->select('id');
            $this->db->from('users');
            $this->db->where(array('oauth_provider'=>$userData['oauth_provider'], 'oauth_uid'=>$userData['oauth_uid']));
            $prevQuery = $this->db->get();
            $prevCheck = $prevQuery->num_rows();
            if($prevCheck > 0){
                $prevResult = $prevQuery->row_array();
                $userData['updated_at'] = date("Y-m-d H:i:s");
                $update = $this->db->update('users', $userData, array('id' => $prevResult['id']));
                $userID = $prevResult['id'];
            }else{
                $userData['created_at']  = date("Y-m-d H:i:s");
                $insert = $this->db->insert('users', $userData);
                $userID = $this->db->insert_id();
            }
        }
        return $userID?$userID:FALSE;
    }
	
}

?>
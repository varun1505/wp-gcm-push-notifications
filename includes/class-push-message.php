<?php
class PushMessage {
	/**
	 * @var String
	 * The message to be send to the devices.
	 */
	private $message;
	
	/**
	 * @var Array
	 * Array of all the device GCM ID's
	 */
	private $deviceIds; 
	
	/**
	 * @var String
	 * The Google URL to send the notifications. 
	 * This will not change and is initialized in the __construct() mehtod.
	 */
	private $url;
	
	/**
	 * @var String
	 * The API key for GCM.
	 */
	private $apiKey;
	
	function __construct(){
		$this->url = "https://android.googleapis.com/gcm/send";
		$this->apiKey = $this->get_api_key();
		$this->deviceIds = $this->get_device_ids();
		$this->message = array('message' => 'Activity on Website');
	}
	
	public function getMessage(){
		return $this->message;
	}
	
	public function setMessage($msg){
		$this->message = $msg;
		return $this;
	}
	
	private function get_device_ids(){
		global $wpdb;
		$response = array();
		
		$devices = $wpdb->get_results(
				" SELECT * FROM ".$wpdb->prefix."gcm_push"
		);
		
		foreach ( $devices as $device )
		{
			$response[] =  $device->gcm_id;
		}
		return $response;
	}
	
	private function get_api_key(){
		return get_option('gcm_apikey','');
	}
	
	public function send(){
		$fields = array(
				'registration_ids'  => $this->deviceIds,
				'data'              => $this->message
		);
		
		$headers = array(
				'Authorization: key=' . $this->apiKey,
				'Content-Type: application/json'
		);
		
		$ch = curl_init();
		
		curl_setopt( $ch, CURLOPT_URL, $this->url );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
		
		$result = curl_exec($ch);
	}
	
}
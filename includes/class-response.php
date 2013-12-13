<?php
/**
 * WP GCM
*
* @package   WP_GCM
* @author    Varun Srinivas <me@varun1505.com>
* @license   GPL-2.0+
* @link      http://varun1505.com
* @copyright 2013 SudoSaints
*/

class Response {
	private $success;
	private $error;
	private $data;
	
	function __construct(){
		$this->success = false;
		$this->error = array();
		$this->data = array();
	}
	
	function getSuccess(){
		return $this->success;
	}
	
	function setSuccess($success) {
		$this->success = $success;
		return $this;
	}
	
	function getError(){
		return $this->error;
	}
	
	function setError($error){
		$this->error = $error;
		return $this;
	}
	
	function getData(){
		return $this->data;
	}
	
	function setData($data) {
		$this->data = $data;
		return $this;
	}
	
	function respond(){
		$resp = array();
		$resp['success'] = $this->success;
		$resp['error'] = $this->error;
		$resp['data'] = $this->data;
		header("Content-Type: application/json");
		echo json_encode($resp);
	}
	
}

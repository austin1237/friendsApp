<?php 
class Logout extends CI_Controller {
	function index() {

	$fb_config = array(
	            'appId'  => '140692572794210',
	            'secret' => '9dbcfc38fd50701693dd8603e7bd558c',
	            'cookie' => false
	        );

	$this->load->library('facebook', $fb_config);
	//$facebook = $this->facebook;
	//var_dump($facebook);
	$this->facebook->destroySession();
	header('Location: http://localhost/AustinTest/index.php');
	}
}
?>
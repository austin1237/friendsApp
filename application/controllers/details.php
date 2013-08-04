<?php
class Details extends CI_Controller { 
	//var $facebook;
	public function index()
	{
		session_start();
		$first_name = $_GET['firstName'];
        $last_name = $_GET['lastName'];
        $img_source = urldecode($_GET['imageSource']);
        $uid = $_GET['uid'];



        //echo $first_name + $last_name;
        echo $first_name . $last_name . $img_source . ' ' . $uid;
        $this->setUpModel();
        $status = $this->Details_model->getStatus($uid);
        echo $status;

	}

	function initalize($fb){
    	$this->facebook = $fb;

    }

    function setUpModel(){
    	$fb_config = array(
            'appId'  => '140692572794210',
            'secret' => '9dbcfc38fd50701693dd8603e7bd558c'
        );

        $this->load->library('facebook', $fb_config);

        $this->load->model('Details_model');
        $this->Details_model->initalize($this->facebook);
        
    }
}
?>
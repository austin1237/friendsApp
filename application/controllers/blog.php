<?php
class Blog extends CI_Controller {

	public function index()
	{
		$fb_config = array(
            'appId'  => '140692572794210',
            'secret' => '9dbcfc38fd50701693dd8603e7bd558c'
        );

        $this->load->library('facebook', $fb_config);

        $this->load->model('Facebook_model');
        $this->Facebook_model->initalize($this->facebook);
        $user = $this->Facebook_model->getUser();
        $data['friends'] = $this->Facebook_model->getFriends(); 
        if ($user) {
            try {
                $data['user_profile'] = $this->facebook->api('/me');
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }

        if ($user) {

            $data['logout_url'] = $this->facebook->getLogoutUrl();
            $this->load->view('friendsview',$data);
        } else {
	    	$params = array( 'next' => 'http://localhost/AustinTest/index.php/blog/ajax' );
	        $data['login_url'] = $this->facebook->getLoginUrl($params);
	        $this->load->view('facebookview',$data);
    }
	}

	public function comments()
	{
		echo 'Look at this!';
	}

	public function ajax()
	{
		$this->load->model("Test_model");
		$this->Test_model->ajax();
	}

    public function getBio(){
        session_start();
        $first_name = $_GET['first_name'];
        $last_name = $_GET['last_name'];
        $fb_config = array(
            'appId'  => '140692572794210',
            'secret' => '9dbcfc38fd50701693dd8603e7bd558c'
        );

        $this->load->library('facebook', $fb_config);

        $this->load->model('Facebook_model');
        $this->Facebook_model->initalize($this->facebook);
        $this->Facebook_model->getBio($first_name, $last_name);
    }

}
?>

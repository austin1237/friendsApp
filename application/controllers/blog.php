<?php
class Blog extends CI_Controller {
//been lazy to change this name at some point this needs to happen
	public function index()
	{
		$fb_config = array(
            'appId'  => '140692572794210',
            'secret' => '9dbcfc38fd50701693dd8603e7bd558c', 
            'cookie' =>  false
        );

        $this->load->library('facebook', $fb_config);

        $this->load->model('Facebook_model');
        $this->Facebook_model->initalize($this->facebook);
        $user = $this->Facebook_model->getUser();
        

        if ($user) { //if user exists
            try {
                $data['user_profile'] = $this->facebook->api('/me');
            } catch (FacebookApiException $e) {
                $user = null; //makes user null if no one has loged in yet
            }
        }

        //shows either friends or the login screen depending on whether a user has logged in yet.
        if ($user) {

            $data['logout_url'] = $this->facebook->getLogoutUrl(array('next'=>'http://localhost/AustinTest/index.php/logout'));
            $data['friends'] = $this->Facebook_model->getFriends(); 
            $this->load->view('friendsview',$data);
        } else {
            //$permissions = array('scope' => 'read_stream', 'friends_videos', 'user_likes', 'friend_likes');// gets the right permissions from the user
	        $data['login_url'] = $this->facebook->getLoginUrl(array('scope' => 'read_stream, user_likes, friends_likes'));
	        $this->load->view('loginview',$data);
    }
	}


    public function getBio(){
        session_start();
        $first_name = $_GET['firstName'];
        $last_name = $_GET['lastName'];
        $fb_config = array(
            'appId'  => '140692572794210',
            'secret' => '9dbcfc38fd50701693dd8603e7bd558c'
        );

        $this->load->library('facebook', $fb_config);

        $this->load->model('Facebook_model');
        $this->Facebook_model->initalize($this->facebook);
        $this->Facebook_model->getBio($first_name, $last_name);
    }

    public function getPosts(){
        session_start();
        $first_name = $_GET['firstName'];
        $last_name = $_GET['lastName'];
        $button_type = $_GET['buttonType'];
        $fb_config = array(
            'appId'  => '140692572794210',
            'secret' => '9dbcfc38fd50701693dd8603e7bd558c'
        );

        $this->load->library('facebook', $fb_config);

        $this->load->model('Facebook_model');
        $this->Facebook_model->initalize($this->facebook);
        $this->Facebook_model->getPosts($first_name, $last_name, $button_type);
    }

}
?>


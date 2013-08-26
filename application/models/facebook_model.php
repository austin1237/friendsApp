<?php
class Facebook_model extends CI_Model {
var $facebook;//Facebooks sdk
var $fql_start = 'https://graph.facebook.com/fql?q=';
public $fql_end='&access_token=';

    function __construct()
    {
        parent::__construct();
    }

    //This method is needed because codignitor for some reason
    //dosen't allow varaible to be set in construct method 
    function initalize($fb){
    	$this->facebook = $fb;
    }

    function getUser(){
    	return $this->facebook->getuser();
    }

    /*Gets all of the users friends from facebook
    returns an array of there first/last name and UID */
    function getFriends(){
      $fql_query =  'SELECT first_name, last_name, uid, about_me FROM user WHERE uid in (select uid2 from friend where uid1 = me())';
      $fql_query = urlencode($fql_query);
      $friends = file_get_contents($this->fql_start.$fql_query.$this->fql_end . $this->facebook->getAccessToken());
      $friends = json_decode($friends, true);
      $friends = $friends['data'];
      return $friends;
    }

    //Gets a specfics friends about me text
    function getBio($first_name, $last_name){
          $fql_query =  'SELECT about_me FROM user WHERE first_name = "'. $first_name . '" and last_name="'. $last_name . '" and uid in (select uid2 from friend where uid1 = me())';
          $fql_query = urlencode($fql_query);
          $fql = file_get_contents($this->fql_start.$fql_query.$this->fql_end . $this->facebook->getAccessToken());
          $fql = json_decode($fql, true); 
          $about_me = $fql['data'][0]['about_me'];
          echo $about_me;   
    }

    /*Gets a friends UID which is important
    since UID is normally a friends Key on facebooks tables*/
    function getUID($first_name, $last_name){
      $fql_query=  'SELECT uid FROM user WHERE first_name = "'. $first_name . '" and last_name="'. $last_name . '" and uid in (select uid2 from friend where uid1 = me())';
      $fql_query = urlencode($fql_query);
      $fql = file_get_contents($this->fql_start.$fql_query.$this->fql_end . $this->facebook->getAccessToken());
      $fql = json_decode($fql, true); 
      $uid= $fql['data'][0]['uid'];
      return $uid;
    } 

    //Gets the number of posts from the user from a certain amount of time
    function getPosts($first_name, $last_name, $button_type){
      switch ($button_type){
        case "Daily":
        $time = strtotime("-1 day");
        break;

        case "Weekly":
        $time = strtotime("-1 week");
        break;

        case "Monthly":
        $time = strtotime("-4 week");
        break;
      }
    $fql_query =  'SELECT post_id FROM stream WHERE source_id = ' . $this->getUID($first_name, $last_name) . ' AND created_time > ' .$time;
    $fql_query = urlencode($fql_query);
    $fql = file_get_contents($this->fql_start.$fql_query.$this->fql_end . $this->facebook->getAccessToken());
    $fql = json_decode($fql, true); 
    $posts = $fql['data'];
    echo count($posts);   

      
  }

//Gets a users current status update.
  function getStatus($uid){
      $fql_query =  'SELECT message FROM status WHERE source_id = $uid';
      $fql_query = urlencode($fql_query);
      $fql = file_get_contents($this->fql_start.$fql_query.$this->fql_end . $this->facebook->getAccessToken());
      $fql = json_decode($fql, true); 
      $status = $fql['data'][0]['message'];
      echo $status;   
    }
}
?>
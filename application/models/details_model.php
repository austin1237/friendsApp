<?php
include('facebook_model.php');
class Details_model extends Facebook_model {

    function getStatus($uid){
      $fql_query =  'SELECT message FROM status WHERE uid = ' . $uid;
      $fql_query = urlencode($fql_query);
      $fql = file_get_contents($this->fql_start.$fql_query.$this->fql_end . $this->facebook->getAccessToken());
      $fql = json_decode($fql, true); 
      $status = $fql['data'][0]['message'];
      echo $status;   
    }

}//end of the class
?>
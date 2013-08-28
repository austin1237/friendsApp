<?php
include('facebook_model.php');
class Details_model extends Facebook_model {

    function getStatus($uid){
      $fql_query =  'SELECT message, time FROM status WHERE uid = ' . $uid . ' AND time > 1373227627';
      $fql_query = urlencode($fql_query);
      $fql = file_get_contents($this->fql_start.$fql_query.$this->fql_end . $this->facebook->getAccessToken());
      $status = json_decode($fql, true); 
      $latest = $status['data'][0]['message'];
      return $latest;
    }

      function getLink($uid){
        $fql_query =  'SELECT url FROM url_like WHERE user_id = '. $uid;
        $fql_query = urlencode($fql_query);
        $fql = file_get_contents($this->fql_start.$fql_query.$this->fql_end . $this->facebook->getAccessToken());
        $fql = json_decode($fql, true); 
        $url = $fql['data'][0]['url'];
        return $url;  
      }

    function getOwnersLink($uid){
      $fql_query =  'SELECT  owner_comment, url  FROM link WHERE owner = '. $uid;
      $fql_query = urlencode($fql_query);
      $fql = file_get_contents($this->fql_start.$fql_query.$this->fql_end . $this->facebook->getAccessToken());
      $fql = json_decode($fql, true); 
      $comment = $fql['data'][0]['owner_comment'];
      $url = $fql['data'][0]['url'];
      return array("comment" => $comment, "url" => $url);  
    }



    //Below is a sample pull from the stream table you need to mess
    // with either the time_created as well as the limit option
    //SELECT post_id, created_time FROM stream WHERE source_id = 1687190204 AND created_time < 1372378628 limit 100
    //Still can't get any results from trying to get videos off of the video table.

    //gets the last thing the user liked
    //SELECT like_info, created_time FROM stream WHERE source_id = 100002261440732 AND like_info.user_likes = 'true'

    //returns all of the likes with a specific limit
    //SELECT post_id, like_info.user_likes, created_time FROM stream WHERE source_id = 100002261440732 AND like_info.user_likes = 'true' limit 100 


    //stats on dj
    // 1 week 51

}//end of the class
?>
<?php
class Test_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function ajax(){
    	echo 'ajax successful';
    }

?>
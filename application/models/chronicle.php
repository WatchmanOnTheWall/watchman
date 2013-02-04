<?php

class Chronicle extends CI_Model {

    function __construct()
    {
	parent::__construct();

	$this->load->database();
	$this->table_name = 'chronicle';
    }
    
    function get( $where = null ) {

	$query	= "SELECT * FROM ".$this->table_name."";
    
	$data	= $this->db->query( $query );

	return $data;
    }
}

?>
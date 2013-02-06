<?php

class Chronicle extends CI_Model {

    function __construct()
    {
	parent::__construct();

	$this->load->database();
	$this->table_name = 'chronicle';
    }

    function count_items() {
	$query			= "select count(*) as count_item from ". $this->table_name;

	$sql			= $this->db->query($query);

	$result			= $sql->result();

	return $result[0]->count_item;
    }    
    function get( $num, $offset ) {
	$this->db->select();
	$query			= $this->db->get( $this->table_name, $num, $offset );
	return $query;
    }
}

?>
<?php

class Chronicle extends CI_Model {

    function __construct()
    {
	// Call the Model constructor
	parent::__construct();
    }
    
    function chronicle() {
	$query = $this->db->get('entries');
	
    }
}

?>
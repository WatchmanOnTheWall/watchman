<?php

class Chronicle extends CI_Controller {

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
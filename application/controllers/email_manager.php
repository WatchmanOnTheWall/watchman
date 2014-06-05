<?php

class Email_manager extends CI_Controller {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();

	$this->load->helper('url');
	$this->load->database();
    }
    
    function unsubscribe()
    {
	$this->load->view( 'unsubscribe' );
    }
    
}
?>
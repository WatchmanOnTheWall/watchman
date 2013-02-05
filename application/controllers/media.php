<?php

class Media extends CI_Controller {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();

	$this->load->helper('url');
	$this->load->database();
	$this->table_name = 'chronicle';
    }
    
    function index() {
	$this->load->view( 'media/index' );
    }
    
    function chronicle() {
	$this->db->select();

	$item_query			= $this->db->get( $this->table_name );

	$data['item']			= $item_query->result_array();
	$this->load->view( 'media/chronicle', $data );

	$this->load->library( 'pagination' );
	$config['base_url']		= base_url().'index.php/media/chronicle';
	$config['total_rows']		= 200;
	$config['per_page']		= 5; 

	$this->pagination->initialize($config); 

	if ( count( $data['item'] == !null)) {
		log_message( 'error', 'No items were gotten');
	    }
	else {
	    echo log_message( 'info', 'There were '.count( $data['item'] ).' items grabbed');
	}
    }
    function reader() {
	$this->db->select();
	$id = $_GET['id'];
	$query		= $this->db->get_where( $this->table_name, array('id' => $id ));
	$data['item']	= $query->row();

	$this->load->view( 'media/reader', $data);
	
	if ( count( $data == !null))
	    {
		log_message( 'error', 'No items were gotten');
	    }
	else {
	    log_message( 'info', 'There were '.count( $data ).' items grabbed');
	}

    }
}
?>
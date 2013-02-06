<?php

class Media extends CI_Controller {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();

	$this->load->helper('url');
	$this->load->database();
	$this->load->library( 'pagination' );
    }
    
    function index() {
	$this->load->view( 'media/index' );
    }
    
    function chronicle() {
	$this->table_name = 'chronicle';

	$this->load->model( 'chronicle');

	$data['count_item']		= $this->chronicle->count_items();

	$config['base_url']		= base_url().'index.php/media/chronicle';
	$config['per_page']		= 10;
	$config['total_rows']		= $data['count_item'];

	$this->pagination->initialize($config);

	$query				= $this->chronicle->get( $config['per_page'], $this->uri->segment( 3 ));
	$data['item']			= $query->result_array();
	$data['page_links']		= $this->pagination->create_links();
	print $config['total_rows'];
	$this->load->view( 'media/chronicle', $data );

	if ( count( $data['item'] == !null)) {
		log_message( 'error', 'No items were gotten');
	    }
	else {
	    echo log_message( 'info', 'There were '.count( $data['item'] ).' items grabbed');
	}
    }
    function reader() {
	$this->table_name = 'chronicle';

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
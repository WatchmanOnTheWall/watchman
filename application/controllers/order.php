<?php
class Order extends CI_Controller {

    function __construct()
    {
	// Call the Model constructor
	parent::__construct();
	$this->load->model( '_order', 'Order' );
	include( FCPATH.'stripe-php-1.7.15/lib/Stripe.php'  );
    }
    
    function index() {
	
	$data['token']		= isset( $_POST['stripeToken'] )
	    ? $_POST['stripeToken']
	    : null;
	      
	$data['amount']			='';
	$data['title']			= 'Order the stuff!';
	    $this->load->view( 'order', $data );
    }
    function charge() {
	$api_key		= "2KBHK7QsyCry40kURtkWDODDfdro4oBb";

	if( ! isset( $_POST['stripeToken'] ) ){
	    redirect('/order/index');
	}
	$data['title']			= 'You ordered the stuff!';
	$this->Order->charge( $api_key );
	$this->load->view( 'order');
    }
}

?>

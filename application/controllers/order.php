<?php
class Order extends CI_Controller {

    function __construct()
    {
	// Call the Model constructor
	parent::__construct();
	$this->load->model( '_order', 'Order', true );
	$this->load->library( 'session' );
	include( FCPATH.'stripe-php-1.7.15/lib/Stripe.php'  );
	
    }
    
    function index()
    {
	$data['query']		= $this->Order->get_inventory();
	$data['title']			= 'Online Store';
	$data['audio']		= false;
	$data['video']		= false;
	$data['book']		= false;
	
	foreach( $data['query'] as $q ){
	    if ( $q->medium == 'audio' ) {
		$data['audio']	= true;
	    }
	    elseif ( $q->medium == 'video' ) {
		$data['video']	= true;
	    }
	    elseif ( $q->medium == 'book' ) {
		$data['book']	= true;
	    }
	}
	
	$this->load->view( 'order/index', $data );
	unset( $stripetoken );
    }
    function item( $id ) {
	if ( $id == null ){
	    redirect( base_url().'order' );
	}
	$data = $this->Order->get_item( $id )[0];

	
	$this->load->view( 'order/item', $data );
    }
    function complete() {
	if( ! isset( $_POST[ 'stripetoken' ] ) ){
	    $data[ 'query' ]		= $this->Order->get_inventory();
	    
	    $api_key		= "2KBHK7QsyCry40kURtkWDODDfdro4oBb";

	    // Live Key:
	    // $api_key		= "msVXO9a8a2BLUQIbRiRFnrNbTijcQXeH";

	    // Set your secret key: remember to change this to your live secret key
	    // in production
	    // See your keys here https://manage.stripe.com/account
	    Stripe::setApiKey( $api_key);
	
	    $price			= 0;
	    $data['price']		= 0;
	    $data['titles']		= [];
	    $data['bought']		= [];

	    foreach( $data['query'] as $q ) {
		if ( in_array( $q->id, $_POST, true ) ){
		    $price	+= $q->price;
		    array_push( $data['bought'], $q );
		}
	    }
	    if( $price != $_POST['amount'] ) {
		$data['title']			= 'Something went wrong';
		$data['error']			= '<b>There was an error with the payment process. Your card was not charged.</b>';
		$this->load->view( 'order/landing', $data);
		return false;
	    }
	
	    $amount		= $price.'00';
	    // Create the charge on Stripe's servers - this will charge the user's
	    // card
	    $data['title']			= 'Order Complete!';
	    $data['price']			= $price;
	    $this->load->view( 'order/landing', $data);
	    $this->Order->charge( $api_key, $amount );

	    return true;
	}
    }

    function charge()
    {
	$api_key		= "2KBHK7QsyCry40kURtkWDODDfdro4oBb";

	// Set your secret key: remember to change this to your live secret key
	// in production
	// See your keys here https://manage.stripe.com/account
	Stripe::setApiKey( $api_key);
	
	$query		= $this->Order->get_inventory();
	$price		= 0;

	foreach( $query as $q ) {
	    if ( in_array( $q->id, $_POST, true ) ){
		$price	+= $q->price;
		echo $q->price."<br />";
	    }
	}
	if( $price != $_POST['amount'] ) {
	    return false;
	}
	
	$amount		= $price.'00';
	
	// Create the charge on Stripe's servers - this will charge the user's
	// card
	$this->Order->charge( $api_key, $amount );
	$data['title']			= 'You ordered the stuff!';
	$this->load->view( 'order', $data);

	$_POST['stripeToken']	= null;
	return true;

    }
    
    function fix(){
	$this->Order->mysql_image_fix();
    }

    function live(  $test = null )
    {
	if ( $test != true )
	    {
		return false;
	    }
	
	$data['query']		= $this->Order->get_inventory();
	$data['title']			= 'Online Store';
	$this->load->view( 'order/index', $data );
	unset( $stripetoken );
    }
    function live_complete() {
	if( ! isset( $_POST[ 'stripetoken' ] ) ){
	    $data[ 'query' ]		= $this->Order->get_inventory();
	    
	    $api_key		= "msVXO9a8a2BLUQIbRiRFnrNbTijcQXeH";

	    // Set your secret key: remember to change this to your live secret key
	    // in production
	    // See your keys here https://manage.stripe.com/account
	    Stripe::setApiKey( $api_key);
	
	    /* foreach( $data['query'] as $q ) { */
	    /* 	if ( in_array( $q->id, $_POST, true ) ){ */
	    /* 	    $price	+= $q->price; */
	    /* 	    array_push( $data['bought'], $q ); */
	    /* 	} */
	    /* } */
	    
	    
	    $price			= '1';

	    $data['price']		= 0;
	    $data['titles']		= [];
	    $data['bought']		= [];
	    $amount			= $price.'00';
	    if( $amount != '100' ) {
		$data['title']			= 'Something went wrong';
		$data['error']			= '<b>There was an error with the payment process. Your card was not charged.</b>';
		$this->load->view( 'order/landing', $data);
		return false;
	    }
	
	    // Create the charge on Stripe's servers - this will charge the user's
	    // card
	    $data['title']			= 'Order Complete!';
	    $data['price']			= $price;
	    $this->load->view( 'order/landing', $data);
	    $this->Order->live_charge( $api_key, $amount );

	    return true;
	}
    }

}

?>

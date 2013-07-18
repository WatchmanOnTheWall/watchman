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
	$data['country']	= $this->Order->get_countries();
	
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
	    Stripe::setApiKey( $api_key );
	
	    $price			= 0;
	    $data[ 'price' ]		= 0;
	    $data[ 'titles' ]		= [];
	    $data[ 'bought' ]		= [];

	    foreach( $data[ 'query' ] as $key => $val ) {
		foreach( $_POST as $Pk => $Pv ){
		    if ( $Pk == 'id_'.$val->id ) {
			$price	+= $val->price;
			array_push( $data[ 'bought' ], $val );
		    }
		}
	    }
	    echo $price.'<br />';
	    if( $price != $_POST[ 'amount' ] ) {
		$data[ 'title' ]			= 'An error has occured';
		$data[ 'error' ]			= '<b>There was an error with the payment process. Your card was not charged.</b>';
		$this->load->view( 'order/landing', $data);
		return false;
	    }
	
	    $amount				= $price.'00';
	    $data[ 'title' ]			= 'Order Complete!';
	    $data[ 'price' ]			= $price;
	      
	    $this->load->view( 'order/landing', $data);

	    // Create the charge on Stripe's servers - this will charge the user's
	    // card
	    $this->Order->charge( $api_key, $amount );

	    // Send Email
	    $data[ 'name' ]		= sprintf( "%s %s", $_POST[ 'first_name' ], $_POST[ 'last_name' ] );
	    $data[ 'country' ]		= $_POST[ 'country' ];
	    $data[ 'region' ]		= $_POST[ 'region' ];
	    $data[ 'city' ]		= $_POST[ 'city' ];
	    $data[ 'street' ]		= $_POST[ 'street' ];
	    $data[ 'code' ]		= $_POST[ 'code' ];
	    $data[ 'email' ]		= $_POST[ 'email' ];

	    $data[ 'title' ]			= 'Order';
	    $message			= $this->load->view( 'order/email', $data, true );
	    $email			= "travis@webheroes.ca";
	    $this->load->library( 'email' );
	    $config[ 'mailtype' ] = 'html';

	    $this->email->initialize($config);
	    $this->email->from('contact@webheroes.ca', 'Watchman');
	    $this->email->to( $email );
	    $this->email->subject('Watchman Order');
	    $this->email->message( $message );
	    $this->email->send();

	    return true;
	}
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

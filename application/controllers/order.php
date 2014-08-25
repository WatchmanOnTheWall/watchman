<?php
class Order extends CI_Controller {

    function __construct()
    {
	// Call the Model constructor
	parent::__construct();
	$this->load->model( '_order', 'Order', true );
	$this->load->library( 'session' );
	include( FCPATH.'stripe-php-1.7.15/lib/Stripe.php'  );
	$this->sale_on			= $this->Order->sale_on();
    }
    
    function index()
    {
	$query				= $this->Order->get_inventory();
	$data[ 'error' ]		= $this->input->get('error');
	$data[ 'title' ]		= 'Online Store';
	$data[ 'audio' ]		= false;
	$data[ 'video' ]		= false;
	$data[ 'book' ]			= false;
	$data[ 'country' ]		= $this->Order->get_countries();
	$data[ 'sale_on' ]		= $this->sale_on;
	$data[ 'query' ]		= $query;

	foreach( $data[ 'query' ] as $q ){

	    $q->image = ( file_exists( FCPATH.'images/covers/' . $q->image ) )
		? $q->image
		: 'no-image.jpg';

	    if ( $q->medium == 'audio' ) {
		$data[ 'audio' ]	= true;
	    }
	    
	    elseif ( $q->medium == 'video' ) {
		$data[ 'video' ]	= true;
	    }
	    
	    elseif ( $q->medium == 'book' ) {
		$data[ 'book' ]	= true;
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
	
	$data->image = ( file_exists( FCPATH.'images/covers/' . $data->image ) )
	    ? $data->image
	    : 'no-image.jpg';

	$this->load->view( 'order/item', $data );
    }
    
    function cont( ) {
	if( ! isset( $_POST[ 'stripetoken' ] ) ){
	    $data[ 'query' ]		= $this->Order->get_inventory();
	    
	    //Dev Key:
	    	   $api_key		= "sk_test_S95Wl40z76CwrkDXFPgSE23v";

	    //Live Key:
	    //    $api_key		= "sk_live_72IHAofr91oYTybfcIb3SUfo";

	    // Set your secret key: remember to change this to your live secret key
	    // in production
	    // See your keys here https://manage.stripe.com/account
	    Stripe::setApiKey( $api_key );
	
	    $price			= 0;
	    $data[ 'price' ]		= 0;
	    $data[ 'titles' ]		= [];
	    $data[ 'bought' ]		= [];
	    $data[ 'sale_on' ]		= $this->sale_on;

	    foreach( $data[ 'query' ] as $key => $val ) {
	    	foreach( $_POST as $Pk => $Pv ){
	    	    if ( $Pk == 'id_'.$val->id ) {
			$to_add		= ( $this->sale_on
					    && isset( $val->sale_price )
					    && $val->sale_price !== '' )
			    ? $val->sale_price
			    : $val->price;
	    		$price	+= $to_add;
	    		array_push( $data[ 'bought' ], $val );
	    	    }
	    	}
	    }

	    // Figure out shipping cost
	    if ( $price <= 15 ) {
	    	$shipping		= 5;
	    }
	    elseif ( $price > 15 && $price <= 35 ) {
	    	$shipping		= 9;
	    }
	    elseif ( $price > 35 && $price <= 80 ){
	    	$shipping		= 15;
	    }
	    elseif ( $price > 80 ) {
	    	$shipping		= 0;
	    }

	    $price			= $price + $shipping;
	    
	    if( $price != $_POST[ 'amount' ] ) {
	    	$data[ 'title' ]			= 'An error has occured';
	    	$data[ 'error' ]			= '<b>There was an error with the payment process. Your card was not charged.</b>';
	    	$this->load->view( 'order/landing', $data);
	    	return false;
	    }
	
	    $email				= $_POST[ 'email' ];
	    $amount				= $price.'00';
	    $data[ 'shipping' ]			= $shipping;
	    $data[ 'price' ]			= $price;

	    $data[ 'name' ]			= sprintf( "%s %s", $_POST[ 'first_name' ], $_POST[ 'last_name' ] );
	    $data[ 'country' ]			= $_POST[ 'country' ];
	    $data[ 'region' ]			= $_POST[ 'region' ];
	    $data[ 'city' ]			= $_POST[ 'city' ];
	    $data[ 'street' ]			= $_POST[ 'street' ];
	    $data[ 'code' ]			= $_POST[ 'code' ];
	    $data[ 'email' ]			= $email;

	      
	    // Create the charge on Stripe's servers - this will charge the user's
	    // card
	    $charge = $this->Order->charge( $api_key, $amount, $email );
	    log_message('info', $charge);
	    if( $charge !== true ) {
	        redirect( base_url().'order?error='.$charge );
	    }

	    // Send Email
	    $admin_email			= "admin@watchman.ca";
				
	    $message				= $this->load->view( 'order/email', $data, true );
	    $this->load->view( 'order/email', $data );
	    $this->load->library( 'email' );
	    // $config[ 'protocol' ] = 'sendmail';
	    $config[ 'mailtype' ] = 'html';
				
	    $this->email->initialize($config);
	    $this->email->from('info@watchman.ca', 'Watchman');
	    $this->email->bcc( $admin_email );
	    $this->email->to( $email );
	    $this->email->subject('Watchman Order');
	    $this->email->message( $message );
	    $this->email->send();

	    redirect( base_url().'order/complete/'.urlencode( $email ) );
	    return true;
	}
    }
    function complete( $email = null ){
	if ( empty( $email ) ) {
	    redirect( base_url().'order' );
	}
	$data['email']			= urldecode( $email );
	$data['active']			= 'order';
	$data[ 'title' ]		= 'Order Complete!';
	$this->load->view( 'order/landing', $data);
    }
    function fix(){
	$this->Order->mysql_image_fix();
    }

    /* function live(  $test = null ) */
    /* { */
    /* 	if ( $test != true ) */
    /* 	    { */
    /* 		return false; */
    /* 	    } */
	
    /* 	$data['query']		= $this->Order->get_inventory(); */
    /* 	$data['title']			= 'Online Store'; */
    /* 	$this->load->view( 'order/index', $data ); */
    /* 	unset( $stripetoken ); */
    /* } */
    /* function live_complete() { */
    /* 	if( ! isset( $_POST[ 'stripetoken' ] ) ){ */
    /* 	    $data[ 'query' ]		= $this->Order->get_inventory(); */
	    
    /* 	    $api_key		= "msVXO9a8a2BLUQIbRiRFnrNbTijcQXeH"; */

    /* 	    // Set your secret key: remember to change this to your live secret key */
    /* 	    // in production */
    /* 	    // See your keys here https://manage.stripe.com/account */
    /* 	    Stripe::setApiKey( $api_key); */
	
    /* 	    /\* foreach( $data['query'] as $q ) { *\/ */
    /* 	    /\* 	if ( in_array( $q->id, $_POST, true ) ){ *\/ */
    /* 	    /\* 	    $price	+= $q->price; *\/ */
    /* 	    /\* 	    array_push( $data['bought'], $q ); *\/ */
    /* 	    /\* 	} *\/ */
    /* 	    /\* } *\/ */
	    
	    
    /* 	    $price			= '1'; */

    /* 	    $data['price']		= 0; */
    /* 	    $data['titles']		= []; */
    /* 	    $data['bought']		= []; */
    /* 	    $amount			= $price.'00'; */
    /* 	    if( $amount != '100' ) { */
    /* 		$data['title']			= 'Something went wrong'; */
    /* 		$data['error']			= '<b>There was an error with the payment process. Your card was not charged.</b>'; */
    /* 		$this->load->view( 'order/landing', $data); */
    /* 		return false; */
    /* 	    } */
	
    /* 	    // Create the charge on Stripe's servers - this will charge the user's */
    /* 	    // card */
    /* 	    $data['title']			= 'Order Complete!'; */
    /* 	    $data['price']			= $price; */
    /* 	    $this->load->view( 'order/landing', $data); */
    /* 	    $this->Order->live_charge( $api_key, $amount ); */

    /* 	    return true; */
    /* 	} */
    /* } */

}

?>

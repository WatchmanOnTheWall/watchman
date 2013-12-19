<?php
class Partners extends CI_Controller {

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
	$data[ 'title' ]		= 'Partners';
	$data[ 'audio' ]		= false;
	$data[ 'video' ]		= false;
	$data[ 'book' ]			= false;
	$data[ 'country' ]		= $this->Order->get_countries();
	$data[ 'sale_on' ]		= $this->sale_on;
	$data[ 'query' ]		= $query;

	foreach( $data[ 'query' ] as $q ){

	    $q->image = ( file_exists( FCPATH.'static/resources/images/covers/' . $q->image ) )
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
	
	$this->load->view( 'partners', $data );
	unset( $stripetoken );
    }
        
    function cont( )
    {
	if( ! isset( $_POST[ 'stripetoken' ] ) ) {
	    //Dev Key:
	    	   $api_key		= "sk_test_S95Wl40z76CwrkDXFPgSE23v";

	    //Live Key:
	       /* $api_key		= "sk_live_72IHAofr91oYTybfcIb3SUfo"; */

	    // Set your secret key: remember to change this to your live secret key
	    // in production
	    // See your keys here https://manage.stripe.com/account
	    Stripe::setApiKey( $api_key );
	
	    $email				= $_POST[ 'email' ];
	    $initial_amount			= $_POST[ 'amount' ];
	    $name				= $_POST[ 'name' ];
	    
	    if( ! ctype_digit( $initial_amount ) ) {
		$error				= 'Incorrect money value given: '. $initial_amount;
		redirect( base_url().'partners?error='.$error );
	    }

	    $amount				= $initial_amount * 100;

	    $data[ 'email' ]			= $email;
	    $data[ 'amount' ]			= $amount;
	    $data[ 'name' ]			= $name;
	      
	    // Create the charge on Stripe's servers - this will charge the user's
	    // card
	    $charge = $this->Order->charge( $api_key, $amount, $email );
	    log_message('info', $charge);

	    if( $charge !== true ) {
	        redirect( base_url().'partners?error='.$charge );
	    }

	    // Send Email
	    $admin_email			= "admin@watchman.ca";

	    $message				= $this->load->view( 'donation_thankyou_email', $data, true );

	    $this->load->library( 'email' );
	    $config[ 'protocol' ] = 'sendmail';
	    $config[ 'mailtype' ] = 'html';
				
	    $this->email->initialize($config);
	    $this->email->from('info@watchman.ca', 'Watchman');
	    $this->email->bcc( $admin_email );
	    $this->email->to( $email );
	    $this->email->subject('Watchman Order');
	    $this->email->message( $message );
	    $this->email->send();
	    $redirect				= sprintf( '%s/partners/donation_thankyou/?name=%s&email=%s&amount=%s',
							   base_url(), urlencode( $name ), urlencode( $email ), urlencode( $initial_amount ) );
	    redirect( $redirect );
	    return true;
	}
    }

    function donation_thankyou()
    {
	
	$data[ 'error' ]		= $this->input->get('error');

	$name				= urldecode( $this->input->get( 'name' ) );

	$data['title']			= 'Thankyou ' . $name;
	$data['email']			= urldecode( $this->input->get( 'email' ) );
	$data['amount']			= urldecode( $this->input->get( 'amount' ) );
	
	$this->load->view( 'donation_thankyou', $data );
    }
    
}
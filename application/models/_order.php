<?php
class _order extends CI_Model {

    function __construct()
    {
	// Call the Model constructor
	parent::__construct();
	
    }

    function get_inventory( $medium = null ) {
	if ( $medium == null ){
	    $query		= $this->db->get_where( 'inventory', array( 'for_sale' => '1' ) );
	    $result		= $query->result();
	    return $result;
	}
	$query = $this->db->get_where('inventory', array( 'medium' => $medium ));

	return $query->result();
    }

    function get_item( $id = null ) {
	$query = $this->db->get_where('inventory', array( 'id' => $id ));

	return $query->result();
    }

    function get_countries( $id = null ) {
	$query = $this->db->get( 'country' );
	return $query->result();
    }

    function charge( $api_key, $amount ) {

	// Set your secret key: remember to change this to your live secret key
	// in production
	// See your keys here https://manage.stripe.com/account
	Stripe::setApiKey( $api_key);
	
	// Get the credit card details submitted by the form
	$token = $_POST['stripeToken'];

	// Create the charge on Stripe's servers - this will charge the user's
	// card
	try {
	    $charge = Stripe_Charge::create( array(
						   "amount" => $amount,
						   "currency" => "cad",
						   "card" => $token,
						   "description" => "payinguser@example.com")
					    );
	    return true;
	} catch(Stripe_CardError $e) {
	    // The card has been declined
	    return $e->getMessage();
	}
    }
    //
    // Changes image tags to just get the
    function mysql_image_fix( $var = null ) {
	if ( $var == 'true' ) {
	    $query = $this->db->get('inventory');

	    $result = $query->result();


	    foreach($result as $row){
		$id				= $row->id;
		$image				= $row->image;
		$splice				= explode( 'images/resources/', $image );
		//print_r( $splice[1]);
		$splice2			= explode( '"', $splice[1] );
		$final				= $splice2[0];

		$object = array(
				'image' => $final
				);

		$this->db->where('id', $id);
		$this->db->update('inventory', $object);
	    }
	}
    }

    function save() {
    	// Set your secret key: remember to change this to your live secret key in
    	// production
    	// See your keys here https://manage.stripe.com/account
	Stripe::setApiKey("2KBHK7QsyCry40kURtkWDODDfdro4oBb");
	// Live Key:
	// Stripe::setApiKey("msVXO9a8a2BLUQIbRiRFnrNbTijcQXeH");

    	// Get the credit card details submitted by the form
    	$token = $_POST['stripeToken'];

    	// Create a Customer
    	$customer = Stripe_Customer::create(array(
    						  "card" => $token,
    						  "description" => "payinguser@example.com")
					    );
	
    	// Charge the Customer instead of the card
	Stripe_Charge::create(array(
				    "amount" => 1000, # amount in cents, again
				    "currency" => "cad",
				    "customer" => $customer->id)
    			      );

    	// Save the customer ID in your database so you can use it later
    	saveStripeCustomerId($user, $customer->id);

    	// Later...
    	$customerId = getStripeCustomerId($user);

	Stripe_Charge::create(array(
				    "amount"   => 1500, # $15.00 this time
    				    "currency" => "cad",
    				    "customer" => $customerId)
			      );
    }

    function sale_on()
    {
	$query = $this->db->get('sale');
	$result = $query->result();
	$result = $result[0]->sale_on;

	if ( $result ) {
	    return true;
	}
	return false;
    }
    
}

?>
<?php
class _Order extends CI_Model {

    function __construct()
    {
	// Call the Model constructor
	parent::__construct();
    }
    function charge( $api_key ) {
	// Set your secret key: remember to change this to your live secret key
	// in production
	// See your keys here https://manage.stripe.com/account
	Stripe::setApiKey( $api_key);
	
	// Get the credit card details submitted by the form
	$token = $_POST['stripeToken'];

	// Create the charge on Stripe's servers - this will charge the user's
	// card
	try {
	    $charge = Stripe_Charge::create(array(
						  "amount" => $_POST['amount'], // amount in
								    // cents,
						  // again
						  "currency" => "cad",
						  "card" => $token,
						  "description" => "payinguser@example.com")
					    );
	} catch(Stripe_CardError $e) {
	    // The card has been declined
	}
    }
    function save() {
    	// Set your secret key: remember to change this to your live secret key in
    	// production
    	// See your keys here https://manage.stripe.com/account
	Stripe::setApiKey("2KBHK7QsyCry40kURtkWDODDfdro4oBb");

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
}

?>
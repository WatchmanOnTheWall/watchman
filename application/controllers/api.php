<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class api extends CI_Controller {

    function __construct()
    {
	parent::__construct();

	$this->load->model('_echronicle',	'echronicle');
	$this->load->model('_api',		'api');
    }

    function _remap( $method, $params = [] )
    {
	if( method_exists( $this, $method ) ) {
	    return call_user_func_array( [ $this, $method ], $params );
	}
	
	$this->api->not_found( $method );
    }

    function chronicle( $type = null, $action = null )
    {
	// API key is required to access most chronicle data.
	if( !( $type == 'email' and $action == 'add' ) ) {
	    
	    if( $this->input->get('api_key') !== 'C318636F1C4891783ACF37E5EE3B2' ) {
		$this->api->error('Invalid API key');
		return;
	    }
	}

	if( $type == 'email' ) {
	    switch( $action ) {
	    case 'list':
		$emails		= $this->echronicle->email_list();
		$this->api->dump( $emails );
		return;
	    case 'add':
		$first_name	= $this->input->get('first_name');
		$last_name	= $this->input->get('last_name');
		$email		= $this->input->get('email');

		$status		= $this->echronicle->add_email( $email, $first_name, $last_name );

		$this->api->return_status( $status === true,
					   "Success fully added 1 email to the chronicle subscribers list.",
					   $status );
		
		return;
	    }
	}
	
	$data	= (object) [
			    'targets'	=> [
					    'email/list'	=> "List all the emails of all the chronicle subscribers"
					    ]
			    ];
	$this->api->dump( $data );
    }

}


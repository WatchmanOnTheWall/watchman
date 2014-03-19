<?php

class _api extends CI_Model {

    function __construct()
    {
	parent::__construct();
    }

    function dump( $data )
    {
	echo json_encode( $data );
    }

    function return_status( $bool, $success, $failure )
    {
	$data	= (object) [
			    'status'	=> $bool
			    ];
	$mkey		= $bool === true ? 'message' : 'error';
	$data->$mkey	= $bool === true ? $success : $failure;
					
	$this->dump( $data );
    }

    function error( $error )
    {
	$data	= (object) [
			    'error'	=> 'API error',
			    'message'	=> $error
			    ];
	$this->dump( $data );
    }

    function not_found( $method )
    {
	$data	= (object) [
			    'error'	=> 'API target 404',
			    'message'	=> sprintf( 'The API target `%s` does not exist.', $method )
			    ];
	$this->dump( $data );
    }

}

?>
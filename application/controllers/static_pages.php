<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Static_pages extends CI_Controller {

    function _remap( $method, $segments = [] )
    {
	// If the path to the static file contains forward slashes the method
	// will be the first dir in the path and the rest (including the file)
	// will be in the {segments} array.
	// 
	// Add {method} to the beginning of the segments array and glue the
	// array together with forward slashes to get the full path to the
	// static file.
	
	array_unshift( $segments, $method );
	require_once FCPATH . 'static/' . implode('/', $segments) . '.php';
    }

}


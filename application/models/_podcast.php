<?php

class _Podcast extends CI_Model {

    function __construct()
    {
	parent::__construct();
    }
    
    function read( $url = null )
    {
	if( is_null( $url ) ) {
	    return false;
	}

	$content	= file_get_contents($url);
	$x		= new SimpleXmlElement($content);
	
	return $x;
    }
}
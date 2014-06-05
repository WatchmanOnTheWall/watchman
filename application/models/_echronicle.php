<?php

class _echronicle extends CI_Model {

    function __construct()
    {
	parent::__construct();
	
	$this->db	= $this->load->database('echronicle', true);

	$this->load->helper('array');
	$this->load->helper('email');
    }

    function email_list( $filter = false )
    {
        $select		= "SELECT email FROM email_list ";
	if( $filter )
	    $select    .= "WHERE lists LIKE '%". $filter ."%' ";

	$query		= $this->db->query( $select );

	$result		= $query->result_array();
	$data		= array_column( $result, 'email' );
	return $data;
    }

    function add_email( $email, $first_name, $last_name,
			$age		= null,
			$city		= null,
			$province	= null,
			$country	= null,
			$phone		= null )
    {
	if( ! valid_email($email) ) {
	    return "Invalid email address: ". $email;
	}
	
	$required = [
		     'first_name'	=> $first_name,
		     'last_name'	=> $last_name
		     ];
	foreach( $required as $key => $val ) {
	    if( empty($val) ) {
		return "Missing required information: ". $key;
	    }
	}
	
	$insert = "
  INSERT INTO email_list (email, first_name, last_name, age, city, prov, country, phone)
  VALUES (?,?,?,?,?,?,?,?)
";
	
	$query		= $this->db->query( $insert, [$email, $first_name, $last_name, $age, $city, $province, $country, $phone] );

	if( $query === false ) {
	    return $this->sql_error();
	}

	return $query;
    }

    function sql_error()
    {
	return mysql_errno() .': '. mysql_error();
    }

    function unsubscribe( $email )
    {
	$update	= " UPDATE email_list SET unsubscribed=1 WHERE email LIKE '%". $email ."%' ";
	return $this->db->query( $update );
    }
}

?>

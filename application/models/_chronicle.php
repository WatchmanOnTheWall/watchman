<?php

class _Chronicle extends CI_Model {

    function __construct()
    {
	parent::__construct();

	$this->load->database();
	$this->table_name = 'chronicles';
    }
    
    function get( $limit = null, $start = null )
    {
	$this->db->limit( $limit, $start );
	
	$this->db->order_by( 'created', 'desc' );
	$this->db->order_by( 'id' );
	$query			= $this->db->get( $this->table_name );
	
	$data			= $query->result();

	return $data;
    }

    function get_one( $id )
    {
	$query			= $this->db->get_where( $this->table_name, array( "id"=>$id ) );
	
	$data			= $query->row();

	return $data;
    }

    function count( $limit = null, $start = null )
    {
	$this->db->limit( $limit, $start );
	
	$data			= $this->db->count_all( $this->table_name );

	return $data;
    }

    function cut( $paper = null, $amount = 100 )
    {
	$query			= sprintf( 'SELECT LEFT( "%s", %s );', $paper, $amount );
	
	$data			= $this->db->query( $query );

	return $data->result();
    }

    function prep_content() {
	$query			= sprintf( 'update %s set %s = replace( content, \'\'\', \'\"\');', $this->table_name, 'content' );
	//$query = sprintf(             "select replace( content, '\"', '\'') from chronicles" );
	
	$data			= $this->db->query( $query )->result();
	
	return $data;
    }
    
}

?>
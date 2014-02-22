<?php

class Media extends CI_Controller {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();

	$this->load->helper('url');
	$this->load->model('_chronicle', 'Chronicle');
	$this->load->database();
    }
    
    function index()
    {
	$this->load->view( 'media/index' );
    }
    
    function chronicle()
    {

	$limit				= 5;
	$start				= ( $this->uri->segment( 3 ) )
	    ? $this->uri->segment( 3 )
	    : 0;
	$count 				= $this->Chronicle->count();
	
	$this->load->library( 'pagination' );

	$config['base_url']		= base_url().'media/chronicle';
	$config['total_rows']		= $count;
	$config['per_page']		= $limit;
	$choice = $count / $limit;
	$config["num_links"] = round($choice);
	
	$this->pagination->initialize($config);

	$links				= $this->pagination->create_links();

	$article 			= $this->Chronicle->get( $limit, $start );

	foreach( $article as $a ) {
	    $a->sample			= $this->Chronicle->cut( $a->content, 500 );
	    foreach( $a->sample as $key => $val ){
		foreach( $val as $k => $v ) {
		    $a->sample		= $v."...";
		    if ( substr_count( $v, '<p' ) > 1 ) {
			$v			= '<p' . explode( '<p', $v )[1] . '' ;
			$a->sample		= $v;
		    }
		}
	    }
	}
	    
	/* $title				= sprintf( 'Chronicles (%s - %s)', $start + 1, $start + $limit );  */
	$title				= 'Chronicles';
	
	$data[ 'article' ]		= $article;
	$data[ 'links' ]		= $links;
	$data[ 'title' ]		= $title;
	
	$this->load->view( 'media/chronicle', $data );
	
	if ( count( $data[ 'article' ] == !null)) {
		log_message( 'error', 'No items were gotten');
	    }
	else {
	    log_message( 'info', 'There were '.count( $data['item'] ).' items grabbed');
	}
    }
    function reader()
    {
	$id			= $this->uri->segment( 3 );
	$query			= $this->Chronicle->get_one( $id );
	$data['article']	= $query;

	$this->load->view( 'media/reader', $data);
	
	if ( count( $data == !null))
	    {
		log_message( 'error', 'No items were gotten');
	    }
	else {
	    log_message( 'info', 'There were '.count( $data ).' items grabbed');
	}

    }

    function podcasts()
    {
	$this->load->model( '_podcast', 'Podcast' );
	$feed			= 'http://watchmanministries.libsyn.com/rss';
	
	$rss			= $this->Podcast->read( $feed );
	$data['podcasts']	= $rss->channel;
	$this->load->view( 'media/podcasts', $data);
    }
}
?>
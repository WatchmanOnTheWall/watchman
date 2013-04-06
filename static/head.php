<?php
    function base_url()
    {
	return 'http://dev.watchman.ca/';
    }

    if( ! defined('BASEPATH') ) {
	define( 'BASEPATH', '/server/watchman.ca/' );
    }
?>


<link href="<?php echo base_url() ?>css/reset.css"
      rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>css/template.css"
      rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>css/style.css"
      rel="stylesheet" type="text/css" />

<!--[IF IE]>
    <link href="<?php echo base_url() ?>css/ie.css" rel="stylesheet" type="text/css" />
    <![ENDIF]-->
<!--[IF IE 7]>
    <link href="<?php echo base_url() ?>css/ie7.css" rel="stylesheet" type="text/css" />
    <![ENDIF]-->
<!--[IF IE 8]>
    <link href="<?php echo base_url() ?>css/ie8.css" rel="stylesheet" type="text/css" />
    <![ENDIF]-->

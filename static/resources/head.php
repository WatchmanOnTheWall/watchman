    <?php
         
    if( ! function_exists( "base_url" ) ) {
	function base_url()
	{
	    return 'http://'. $_SERVER[ "HTTP_HOST" ] .'/';
	}
    }

    if( ! defined('BASEPATH') ) {
	define( 'BASEPATH', $_SERVER[ "DOCUMENT_ROOT" ] );
    }

    if( ! function_exists( "_show" ) ) {
	function _show( $show ) {
	    echo '<pre>';
	    print_r( $show );
	    echo '</pre>';
	}
    }
?>
<link rel="icon" href="<?php echo base_url()?>images/favicon.ico" type="text/css" media="screen" />
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
<script type="text/javascript">
    var base_url		= "<?php echo base_url() ?>"
</script>

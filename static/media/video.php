<?php $active = 'media'; ?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        
        <!-- Global Head -->
        <?php
     	    include FCPATH.'static/resources/head.php';
	?>

    </head>
    <body>
        <div class="body">
            <div id="container">
                
                <!-- Start Container Top -->
                <div class="container_top">
                    <?php
     			include FCPATH.'static/resources/header.php';
		    ?>
                </div>
                <!-- Stop Container Top -->

                <!-- Start Container Middle -->
                <div class="container_middle">
                    <div class="padding">
                        
                        <!-- Main Content -->
                        <div class="content" style="width: 955px; height: auto;">
                            <div class="padding">
                                <h1>Videos</h1>
                                <div class="videos">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Bottom Content -->
	                <div id="content_bottom">
                            <?php
     				include FCPATH.'static/resources/copyright.php';
			    ?>
	                </div>
                        <div style="clear: both; margin: -7px 0;"></div>
                    </div>
                    
                </div>
                <!-- Stop Container Middle -->
                
                <!-- Start Container Bottom -->
                <div class="container_bottom">

                </div>
                <!-- Stop Container Bottom -->
                
            </div>
        </div>

        <?php
     	    include FCPATH.'static/resources/scripts.php' ;
	?>
        <script type="text/javascript" src="<?php echo base_url() ?>js/youtube.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/youtube-popup.js"></script>
    </body>
</html>

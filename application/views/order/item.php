<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        
        <!-- Global Head -->
        <?php
     	    include( 'static/resources/head.php' );
	?>
        
    </head>
    <body>
        <div class="body">
            <div id="container">
                
                <!-- Start Container Top -->
                <div class="container_top">
                    <?php
     			include( 'static/resources/header.php' );
		    ?>
                </div>
                <!-- Stop Container Top -->
                
                <!-- Start Container Middle -->
                <div class="container_middle">
                    <div class="padding">
                        
                        <!-- Main Content -->
                        <div class="content full" >
                            <div class="padding">
                                <h1><?php echo $title ?></h1>
                                <div class="padding product">
                                    <div id="content-box">
                                        <div class="left column">
                                            <img src="<?php echo base_url().'resources/images/covers/'.$image ?>"
                                                 class="cover" alt="" />
                                            <h5 class="padding ">
                                                Price: $<?php echo $price ?>.00
                                            </h5>
                                        </div>
                                        <div class="right column">
                                            <div class="info" >
                                                <?php echo $text ?>
                                            </div>
                                        </div>
                                    </div>
                                <a href="<?php echo base_url() ?>order"
                                   class="button" >Back to store</a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Bottom Content -->
                        <div id="content_bottom">
                            <div class="copyright">
                                <div class="seperator-2"></div>
                                <div class="padding">
                                    <p>Copyright © Watchman on the Wall
                                        Ministries</p>
                                </div>
                            </div>
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
    </body>
</html>

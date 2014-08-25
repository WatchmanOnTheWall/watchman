<?php $active = 'travel-schedule'; ?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        
        <!-- Global Head -->
        <?php
     	    include 'resources/head.php';
	?>

    </head>
    <body>
        <div class="body">
            <div id="container">
                
                <!-- Start Container Top -->
                <div class="container_top">
                    <?php
     			include 'resources/header.php';
		    ?>
                </div>
                <!-- Stop Container Top -->

                <!-- Start Container Middle -->
                <div class="container_middle">
                    <div class="padding">
                        
                        <!-- Main Content -->
                        <div class="content">
                            <div class="padding">
                                <h1>Travel Schedule</h1>
                                <div class="editable">
                                    <div class="indent">
                                        <h2>September 2014</h2>
                                        
                                        <h3>September 3 - 11</h3>
                                        <p>
                                            <b>Ireland</b>
                                        </p>

                                        <h3>September 25 - 28</h3>
                                        <p>
                                            <b>Spruce Grove "Glory of the Father's House Conference"</b>
                                        </p>
                                        
                                        <h2>October 2014</h2>
                                        
                                        <h3>October 29 - November 14</h3>
                                        <p>
                                            <b>Italy/Israel</b>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Side Content -->
                        <div class="content right">
                            <div class="padding">
                                <?php
				    include 'resources/book-slideshow.php';
				?>
                            </div>
                        </div>
                        <!-- Bottom Content -->
	                <div id="content_bottom">
                            <?php
				  include 'resources/copyright.php';
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
     	    include 'resources/scripts.php' ;
	?>
    </body>
</html>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

    <!-- Head Tag -->
    <?php include 'resources/head.php' ; ?>
    
    <body>
        <div class="body">
            <div id="container">
                
                <!-- Start Container Top -->
                <div class="container_top">
                    <?php include 'resources/header.php' ; ?>
                </div>
                <!-- Stop Container Top -->

                <!-- Start Container Middle -->
                <div class="container_middle">
                    <div class="padding">
                        
                        <!-- Main Content -->
                        <div class="content" style="width: 630px; height: auto;">
                            <div class="padding">
                                <h1>Welcome to Watchman on the Wall Ministries</h1>

                                <!-- Welcome Video -->
                                <iframe height="360" class="welcome-video"
                                        src="http://www.youtube.com/embed/CEVUf_RM6uI?feature=player_embedded"
                                        frameborder="0"
                                        allowfullscreen></iframe>
                                <img src="<?php echo base_url() ?>resources/images/5-smooth-stones-banner.jpg"
                                     class="banner" alt="5 Smooth Stones" />
                            </div>
                        </div>
                        
                        <!-- Side Content -->
                        <div class="content right" style="width: 310px; height: auto;">
                            <div class="padding">
                                <div class="moduletable">
                                    <h3>Watchman Chronicle Sign up</h3>
                                    <form name="add_to_email_list" id="" action="">
                                        <label for="first_name">First Name:</label>
                                        <input type="text" id="first_name" value="" />

                                        <label for="last_name">Last Name:</label>
                                        <input type="text" id="last_name" value="" />
                                        
                                        <label for="email">Email:</label>
                                        <input type="text" id="email" value="" />
                                    </form>
                                </div>

                                <div class="moduletable">
                                    <?php
     					include 'resources/book-slideshow.php' ;
				    ?>
                                </div>
                                
                                <div class="moduletable">
                                    <div style="text-align: center;">
                                        <a href="">
                                            <img class="podcast-symbol" src="<?php echo base_url() ?>/resources/images/podcasting_symbol.png" class="" alt="Podcasts" />
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="moduletable">
                                    <div style="text-align: center;">
                                        <a href="">
                                            <img class="banner"
                                                 src="<?php echo base_url() ?>/resources/images/off-the-wall-tv.jpg"
                                                 class="" alt="Off The Wall" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Bottom Content -->
	                <div id="content_bottom">
                            <?php include 'resources/copyright.php' ; ?>
	                </div>
                        <div style="clear: both; margin: -7px 0;"></div>
                    </div>
                    
                </div>

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

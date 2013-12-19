<?php
    $active	= 'partners';
?>
<!DOCTYPE html>
<html>
    
    <!-- Head Tag -->
    
    <?php include FCPATH.'static/resources/head.php' ?>
    <body>
        <div class="body">
            <div id="container">
                
                <!-- Start Container Top -->
                <div class="container_top">
                    <?php include FCPATH.'static/resources/header.php' ?>
                </div>
                <!-- Stop Container Top -->
                
                <!-- Start Container Middle -->
                <div class="container_middle">
                    <div class="padding">
                        
                        <!-- Main Content -->
                        <div class="content full">
                            <div class="padding">
                                <h1><?php echo $title ?></h1>
                                <div class="payment-info">
                                    <?php if ( $error ) :
     					echo $error;
 					else:
				          ?>
                                    <?php endif; ?>
                                    <p style="font-size: 16px">Thankyou for your donation of
                                        $<?php echo $amount ?>.00 CAD to
                                        Wathcman on the Wall Ministries. <br />
                                        An email was sent out to <?php echo $email ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Bottom Content -->
	                <div id="content_bottom">
                            <?php include FCPATH.'static/resources/copyright.php' ?>
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
        <script type="text/javascript" src="<?php include FCPATH.'js/jquery.min.js'?>"></script>
        <script src="https://js.stripe.com/v1/"></script>
    </body>
</html>

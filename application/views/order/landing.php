<?php $active = 'order' ?>
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
                                    <?php if (isset( $error )) :
     					echo $error;
 					else:
				          ?>
                                    <p>Thankyou for your order, an email has
                                        been sent to <b><?php echo $email ?></b>.</p>
                                    If you have any questions, please feel free email us at contact@watchman.ca.
                                    </p>
                                    <?php endif; ?>
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

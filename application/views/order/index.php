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
                                <h1><?php echo $title
				?></h1>
                                <form action="<?php echo base_url() ?>index.php/order/live_complete" method="POST">
                                    <div class="padding">
                                        <?php if ( $book ): ?>
                                        <div id="books">
                                            <div class="inv span12 separate">
                                                <h2 class="push-right">Books</h2>
                                            </div>
                                        </div>
                                        <?php endif ?>
                                        <?php if ( $video ): ?>
                                        <div id="video">
                                            <div class="inv span12 separate">
                                                <h2 class="push-right">Video</h2>
                                            </div>
                                        </div>
                                        <?php endif ?>
                                        <?php if ( $audio ): ?>
                                        <div id="audio">
                                            <div class="inv span12 separate">
                                                <h2 class="push-right">Audio</h2>
                                            </div>
                                        </div>
                                        <?php endif ?>
                                        <input type="hidden" name="amount"
                                               class="amount" />
                                        <input type="button" id="checkout-button"
                                               value="Checkout" style="margin: 10px 0 17px;"/>
                                    </div>
                                </form>
                                
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
        <?php
     	    include FCPATH.'static/resources/scripts.php'
	?>
        <script src="https://js.stripe.com/v1/"></script>
        <script src="https://checkout.stripe.com/v2/checkout.js"></script>
        <script type="text/javascript">
            var inventory			= <?php echo json_encode( $query ) ?>;
        </script>
        <script src="/resources/js/order.js"></script>

    </body>
</html>

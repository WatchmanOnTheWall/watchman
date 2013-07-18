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
                                <form action="/order/complete" method="POST">
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
                                        <div class="order text-right">
                                            <h2>Shipping Address</h2>
                                            <div>
                                                <label>Country: </label>
                                                <select name="country">
                                                    <option disabled="disabled" selected="selected">
                                                        Select a country
                                                    </option>
                                                    <option disabled="disabled" >
                                                        ---
                                                    </option>
                                                    <option value="United States">
                                                        United States
                                                    </option>
                                                    <option value="Canada">
                                                        Canada
                                                    </option>
                                                    <option disabled="disabled" >
                                                        ---
                                                    </option>
                                                    <?php foreach( $country as $c ): ?>
                                                    <option value="<?php echo $c->nicename ?>">
                                                        <?php echo $c->nicename ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div> 
                                            <div> 
                                                <label>Province / State: </label>
                                                <input type="text" name="region" />
                                            </div> 
                                            <div> 
                                                <label>City: </label>
                                                <input type="text" name="city" />
                                            </div> 
                                            <div> 
                                                <label>Street: </label>
                                                <input type="text" name="street" />
                                            </div> 
                                            <div> 
                                                <label>Postal Code: </label>
                                                <input type="text" name="code" />
                                            </div>
                                            <br />
                                            <h2>Contact</h2>
                                            <div>
                                                <label>First Name: </label>
                                                <input type="text" name="first_name" />
                                            </div> 
                                            <div>
                                                <label>Last Name: </label>
                                                <input type="text" name="last_name" />
                                            </div> 
                                            <div>
                                                <label>Email Address: </label>
                                                <input type="text" name="email" />
                                            </div> 
                                            <div class="validate-alert"></div>
                                        </div>
                                        <input type="hidden" name="amount"
                                               class="amount" />
                                        <input type="button" id="checkout-button"
                                               value="Purchase" style="margin: 10px 0 17px;"/>
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

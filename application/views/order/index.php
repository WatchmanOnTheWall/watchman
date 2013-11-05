<?php $active = 'order'; ?>
<!DOCTYPE html>
<html>
    <!-- Head Tag -->
    <?php
	include FCPATH.'static/resources/head.php';
	?>
    
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
                        <div class="content full">
                            <div class="padding">
                                <h1><?php echo $title
				?></h1>
                                <form action="/order/cont" method="POST">
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
                                        <hr class="break" />
                                        <div class="order pull-left">
                                            <h2>Contact</h2>
                                            <div>
                                                <span>First Name: </span>
                                                <input type="text" name="first_name" />
                                            </div> 
                                            <div>
                                                <span>Last Name: </span>
                                                <input type="text" name="last_name" />
                                            </div> 
                                            <div>
                                                <span>Email Address: </span>
                                                <input type="text" name="email" />
                                            </div>
                                            <br />
                                            <h2>Shipping Address</h2>
                                            <div>
                                                <span>Country: </span>
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
                                                <span>Province / State: </span>
                                                <input type="text" name="region" />
                                            </div> 
                                            <div> 
                                                <span>City: </span>
                                                <input type="text" name="city" />
                                            </div> 
                                            <div> 
                                                <span>Street: </span>
                                                <input type="text" name="street" />
                                            </div> 
                                            <div> 
                                                <span>Postal Code: </span>
                                                <input type="text" name="code" />
                                            </div>
                                            <br />
                                            <div class="validate-alert"></div>
                                            <input type="button" id="checkout-button"
                                                   value="Purchase" style="margin: 10px 0 17px;"/>
                                        </div>
                                            <input type="hidden" name="amount"
                                                   class="amount" />
                                        <div class="shipping pull-left">
                                            <h2>Shipping Costs</h2>
                                            <table class="shipping-table" border="1">
                                                <tr>
                                                    <th><b>Order Amount</b></th>
                                                    <th><b>Shipping Price</b></th>
                                                </tr>
                                                <tr>
                                                    <td>0 - $15.00</td>
                                                    <td>$5</td>
                                                </tr>
                                                <tr>
                                                    <td>$15.01 - $35.00</td>
                                                    <td>$9</td>
                                                </tr>
                                                <tr>
                                                    <td>$35.01 - $80.00</td>
                                                    <td>$15</td>
                                                </tr>
                                                <tr>
                                                    <td> $80.01 and over </td>
                                                    <td> free </td>
                                                </tr>
                                            </table>
                                            
                                        </div>
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
            var sale				= null;
            if ( "<?php echo $sale_on ?>" === "1" ) {
                var sale			= 1;
            }
        </script>
        <script src="/resources/js/order.js"></script>

    </body>
</html>

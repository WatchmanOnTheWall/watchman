<!DOCTYPE html>
<html>
    
    <!-- Head Tag -->
    
    <?php include FCPATH.'static/head.php' ?>
    
    <body>
        <div class="body">
            <div id="container">
                
                <!-- Start Container Top -->
                <div class="container_top">
                    <?php include FCPATH.'static/header.php' ?>
                </div>
                <!-- Stop Container Top -->
                
                <!-- Start Container Middle -->
                <div class="container_middle">
                    <div class="padding">
                        
                        <!-- Main Content -->
                        <div class="content" style="height: auto;">
                            <div class="padding">
                                <h1><?php echo $title
				?></h1>
                                <form action="<?php echo base_url()
				              ?>index.php/order/charge" method="POST">
                                    <table>
                                        <?php foreach( $query as $row ): ?>
                                        <tr>
                                            <td><?php echo $row['image']?></td>
                                            <td><?php echo $row['image']?></td>
                                            <td><?php echo $row['image']?></td>
                                            <td><?php echo $row['image']?></td>
                                            
                                        </tr>
                                        <?php endforeach; ?>
                                    </table>
				    <script
                                         src="https://checkout.stripe.com/v2/checkout.js"
                                         class="stripe-button"
                                         data-key="pk_yLFjPSiZOODGvjlBquqqNpcfqo2Fa"
                                         data-amount= <?php echo $amount ?>
                                         data-name="Buy products"
                                         data-description=""
                                         data-image="/128x128.png">
                                    </script>
                                </form>
                                
                            </div>
                        </div>
                        
                        <!-- Bottom Content -->
	                <div id="content_bottom">
                            <?php include FCPATH.'static/copyright.php' ?>
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
        <script type="text/javascript">
            // This identifies your website in the createToken call below
            Stripe.setPublishableKey('pk_yLFjPSiZOODGvjlBquqqNpcfqo2Fa');
            // ...
            function fill( ) {
                $('#paymentNumber').val('4242424242424242')
                $('#paymentExpiry').val('')
            }
        </script>
        
    </body>
</html>

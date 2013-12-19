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
                        <div class="content" style="width: 630px; height: auto;">
                            <div class="padding">
                                <h1>Partners</h1>
                                <div class="editable">
                                    <p>Partners make the reality of the
                                        Supernatural Life of God available to all as
                                        Watchman on the Wall Ministries &amp; Marc
                                        Brisebois reach the World through travel
                                        assignments &amp; Television Ministry.
                                    </p>
                                    <p>
                                        The gifts of our Partners enable us to
                                        do both domestic &amp; international
                                        outreaches-touching people with the
                                        life-changing message of the Word of
                                        God.
                                    </p>
                                    <p>
                                        As a Partner you become an integral
                                        member of a dynamic, relationship-based
                                        spiritual family.
                                    </p>
                                    <p>
                                        Partnership involves in prayer, we
                                        gratefully seek your intercession on behalf
                                        of this ministry and what the Lord has
                                        called Watchman On The Wall Ministries to do
                                        in these days for the Kingdom.
                                    </p>
                                    <p>
                                        Your gifts help advance the Kingdom of
                                        God &amp; you will share in Kingdom
                                        rewards.  (1 Samuel 30:24; Matthew
                                        10:41-42).
                                    </p>
                                    <p>
                                        Join Us as we reach the world with the
                                        message of God's Word &amp; His Power to
                                        transform lives.
                                    </p>                                          
                                </div>
                            </div>
                        </div>

                        <div class="content right">
			    <?php
				if($error) {
				echo '<div class="alert alert-error"><b>Transaction failed:</b> '.$error.' </div>';
				}
			    ?>
                            <div class="padding">
                                <div class="moduletable">
                                    <h3>Make a Donation:</h3>
                                    <form action="<?php echo base_url()?>/partners/cont"
                                          method="POST" id="donation-form">
                                        <div>
                                            <div class="input-group">
                                                <span class="label">
                                                    <b>Name:</b>
                                                </span>
                                                <input type="text" name="name"
                                                       class="form-control"
                                                       style="width: 125px"/>
                                            </div>
                                            <div class="input-group">
                                                <span class="label">
                                                <b>Email:</b>
                                                </span>
                                                <input type="text" name="email"
                                                       class="form-control"
                                                       style="width: 125px"/>
                                            </div>

                                            <span class="label pull-left">Amount:</span>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    $
                                                </span>
                                                <input type="text" name="amount"
                                                       class="form-control text-right"
                                                       style="width: 45px"/>
                                                <span class="input-group-addon">.00</span>
                                            </div>
                                            <input type="submit" name="checkout"
                                                   id="donate-button" value="Donate"
                                                   class="btn pull-right"
                                                   style="margin: 8px"/>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Bottom Content -->
	                    <div id="content_bottom">
                                <?php
				    include FCPATH . 'static/resources/copyright.php';
				?>
	                    </div>
                            <div style="clear: both; margin: -7px 0;"></div>
                        </div>
                        
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
        <script src="https://js.stripe.com/v1/"></script>
        <script src="https://checkout.stripe.com/v2/checkout.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>/resources/js/donate.js"></script>
    </body>
</html>

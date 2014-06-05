<?php $active = 'media'; ?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

    <!-- Global Head -->
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
                                <h1>Unsubscribe</h1>

				<form id="form-unsubscribe">
				    <input type="text" name="email" placeholder="Email" />
				    <input type="submit" value="Unsubscribe" />
				    <div class="response"></div>
				</form>
                            </div>
                        </div>
                        
                        <!-- Bottom Content -->
	                <div id="content_bottom">
                            <?php
     				include FCPATH.'static/resources/copyright.php';
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
	<script type="text/javascript" src="<?php echo base_url() ?>js/jquery-2.0.2.min.js"></script>
	<script type="text/javascript">
	    var $form		= $('#form-unsubscribe');
	    $form.submit(function(e) {
	        e.preventDefault();
	        var data	= $(this).serialize();
		$.ajax({
		    url: location.origin + "/api/unsubscribe",
		    data: data,
		    dataType: 'json',
		    success: function(d) {
		        if( d.status )
			    $('.response').text(d.message).css('color', 'green');
		        else
			    $('.response').text(d.error).css('color', 'red');
		    }
		});
	    });
	</script>
    </body>
</html>

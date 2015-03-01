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
                                <h1><?php echo $title
				?></h1>
                                <div class="item-container blog">
                                    <div class="pagination">
                                        <?php echo $links ?>
                                    </div>
                                     <?php foreach ( $article as $a ): ?>
                                    <div class="item chronicle">
                                        <a title="print"></a>
                                        <h2 class="title">
                                            <a href="<?php echo base_url()
						. 'media/reader/'
						. $a->id ?>" >
                                                <?php echo $a->title; ?>
                                            </a>
                                        </h2>
                                        <div class="sample">
                                            <p><?php print_r( $a->sample ); ?></p>
                                        </div>
                                        <a href="<?php echo base_url()
					    . 'media/reader/'
					    . $a->id ?>"
                                           class="button">Read
                                            more...</a>
                                        <div class="article_separator">&nbsp</div>
                                    </div>
                                    <?php endforeach; ?>
                                    <div class="pagination">
                                        <?php echo $links ?>
                                    </div>
                                </div>
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
    </body>
</html>

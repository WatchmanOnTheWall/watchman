<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    
    <!-- Head Tag -->
    <?php $this->load->view('head-tag') ?>

    <body>
        <div class="body">
            <div id="container">
                
                <!-- Start Container Top -->
                <div class="container_top">
                    <?php $this->load->view( 'header' ); ?>
                </div>
                <!-- Stop Container Top -->
                <div class="container_middle">
                    <div class="padding">

                        <!-- Main Content -->
                        <div class="content">
                            <div class="padding">
                                <ul>
                                    <?php
     					print $article['full_text'];
					?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

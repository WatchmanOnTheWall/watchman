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
                                    <?php foreach ($item as $article) { ?>
                                    <li><a href="<?php echo base_url() ?>index.php/media/reader?id=<?php echo $article['id'] ?>">
                                        <?php echo $article['title']; ?>
                                    </a></li>
                                    <?php }; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

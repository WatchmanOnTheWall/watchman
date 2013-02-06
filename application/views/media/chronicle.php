<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    
    <!-- Head Tag -->
    <?php $this->load->view( 'head-tag' ) ?>
    
    <body>
        <div class="body">
            <div id="container">
                
                <!-- Start Container Top -->
                <div class="container_top">
                    <?php $this->load->view( 'header' ) ?>
                </div>
                <!-- Stop Container Top -->
                
                <!-- Start Container Middle -->
                <div class="container_middle">
                    <div class="padding">
                        <!-- Main Content -->
                        <div class="content" style="width: 958px; height: auto;">
                            <div class="padding">
                                <div class="item-container blog">
                                    <?php foreach ($item as $article) { ?>
                                    <div class="item chronicle">
                                        <a title="print"></a>
                                        <h2 class="title">
                                            <a href="<?php echo base_url() ?>index.php/media/reader?id=<?php echo $article['id'] ?>">
                                                <?php echo $article['title']; ?>
                                            </a>
                                        </h2>
					<?php echo $article['intro_text'] ?>
                                        <a href="<?php echo base_url() ?>index.php/media/reader?id=<?php echo $article['id'] ?>"
                                           class="readon" >
                                            Read more...
                                        </a>
                                        <div class="article_separator">&nbsp</div>
                                    </div>
                                    <?php }; ?>
                                    <div class="paginate-links">
                                        <?php echo $page_links; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Bottom Content -->
	                <div id="content_bottom">
                            <?php $this->load->view( 'copyright' ) ?>
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

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        
        <!-- Global Head -->
        <?php
     	    include $_SERVER['DOCUMENT_ROOT']. 'static/head.php';
	?>

    </head>
    <body>
        <div class="body">
            <div id="container">
                
                <!-- Start Container Top -->
                <div class="container_top">
                    <?php
     			include $_SERVER['DOCUMENT_ROOT']. 'static/header.php';
		    ?>
                </div>
                <!-- Stop Container Top -->

                <!-- Start Container Middle -->
                <div class="container_middle">
                    <div class="padding">
                        
                        <!-- Main Content -->
                        <div class="content" style="width: 955px; height: auto;">
                            <div class="padding">
                                <h1>Videos</h1>
                                <div class="videos"></div>
                            </div>
                        </div>
                        
                        <!-- Bottom Content -->
	                <div id="content_bottom">
                            <?php
     				//$this->load->view( 'copyright' );
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

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/youtube.js"></script>
        <script type="text/javascript">
            (function( $ ) {
                if( $('.over-shadow').length == 0 ) {
                    $( '.body' ).prepend(
                        $( '<div />' )
                            .addClass( 'over-shadow' )
                    )
                };
                if( $('.popup').length == 0 ) {
                    $( '.body' ).prepend(
                        $( '<div />' )
                            .addClass( 'popup' )
                    )
                };
                var popup			= $('.over-shadow, .popup');
                
                
                (function( window ) {
                    
                    // https://developers.google.com/youtube/2.0/developers_guide_protocol_api_query_parameters
                    // &orderby=published
                    // &start-index=11
                    // &max-results=10
                    tube	= youtube( 'Watchmanminstries' );
                    
                    var video_box			= function() {
                        return $( '<span />' )
                            .addClass( 'video thumbnail' )
                    },
                    img					= function() {
                        return $( '<img />' )
                    }
                    play				= function() {
                        return $( '<div />' )
                            .addClass( 'play' )
                    }
                    
                    
                    tube.fetch( function(data) {
                        
                        this.each( function( i, video ) {
                            $('.videos')
                                .append(
                                    video_box()
                                        .attr({
                                            dataid: this.data.items[i].id
                                        })
                                        .append(
                                            img().attr( 'src', video.thumbnail.sqDefault )
                                        )
                                        .append(
                                            play()
                                        )
                                )
                        });
                    },function(event){
                        $('.video.thumbnail').on( 'click', function( event ){
                            pop()
                            var dataid			= $(this).attr('dataid')
                            var close			= $('<div />').attr('name', 'close' ).html( 'close' )
                            console.log(["Video ID" ,$('span.thumbnail').attr('dataid') ])
                            $('.popup').html( tube.embed( dataid ) )
                                .append( close )
                            var hhalf			= $('.popup iframe').width()/2
                            var vhalf			= $('.popup iframe').height()/2;
                            $( close )
                                .css({
                                    right: hhalf,
                                    top: -vhalf
                                })
                            $( '.popup iframe' )
                                .css({
                                    right: hhalf,
                                    top: -vhalf
                                })
                            
                        })
                    });
                    //
                    // Closing the popup
                    //
                    $('.popup div[name="close"]').on( 'click',
                        pop('drop')
                    )
                    //
                    // If the first parameter is "drop"
                    // then the popup will be hidden.
                    //
                    function pop( r )
                    {
                        if( r == "drop" ){
                            $('.popup').hide()
                            popup.hide()
                                .html(""),
                            console.log( 'Popup dropped.' )
                            return true
                        }
                        else(
                            popup.show(),
                            console.log( 'Popup popped.' )
                        )
                            }
                    $( document ).keydown(function(e) {
                        // ESCAPE key pressed
                        if (e.keyCode == 27) {
                            pop('drop');
                        }
                    });
                    
                })(window);
                
            })(jQuery);
        </script>
    </body>
</html>

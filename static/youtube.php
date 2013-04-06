<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        
    </head>
    <body>
        <pre>
            
        </pre>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript">
            (function( $ ) {
            })(jQuery);
                

            (function( window ) {

                // https://developers.google.com/youtube/2.0/developers_guide_protocol_api_query_parameters
                // &orderby=published
                // &start-index=11
                // &max-results=10
                
                tube	= youtube( 'Watchmanminstries' );

                tube.fetch(function(data) {

                    this.each(function( i, video ) {
                        if( i == 0 ) {
                            $('body')
                                .prepend( video.embed() );
                        }
                        else {
                            $('pre')
                                .before( '<img src="'+ video.thumbnail.sqDefault +'" />' );
                        }
                    });

                    $('pre')
                        .text( JSON.stringify(data, null, 4) );
                });

            })(window);

        </script>
    </body>
</html>


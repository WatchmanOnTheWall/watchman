//
// This file depends on youtube.js
//
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
    
    // https://developers.google.com/youtube/2.0/developers_guide_protocol_api_query_parameters
    // &orderby=published
    // &start-index=11
    // &max-results=10
    tube	= youtube( 'Watchmanminstries' );
    
    var img				= function() {
        return $( '<img />' )
    }
    ,thumbnail				= function() {
        return $( '<span />' )
            .addClass( 'thumbnail video' )
    }
    ,play				= function() {
        return $( '<div />' )
            .addClass( 'play' )
    }
    , youtitle				= function() {
        return $( '<div />' )
            .addClass( 'youtitle' )
    }
    ,video_box				= function() {
        return $( '<span />' )
            .addClass( 'thumbnail video' )
    }
    ,close				= function() {
        var item = $('<a />')
            .attr('name', 'close')
            .html( 'Close' )
        $( item ).on( 'click',  function() {
            pop( 'drop' )
            console.log('CLOSE ON CLICK;' )
        })
        return item
    }
    ,popup			= $('.over-shadow, .popup');

    //
    // If the first parameter is "drop"
    // then the popup will be hidden.
    //
    function pop( r )
    {
        if( r == "drop" ){
            $('.popup').hide();
            popup.hide().html("");
            console.log( 'Popup dropped.' );
            return true;
        }
        else {
            popup.show();
            console.log( 'Popup popped.' );
        }
    }

    
    tube.fetch( function(data) {
        
        this.each( function( i, video ) {
            var months = [ 'Jan', 'Feb', 'Mar', 'Apr',
                           'May', 'Jun', 'Jul', 'Aug',
                           'Sep', 'Oct', 'Nov', 'Dec' ];
            var d = new Date(video.uploaded)
            , date = months[d.getMonth()]+' '+d.getDay()+', '+d.getFullYear();
            $('.videos')
                .append(
                    video_box()
                        .append(
                            img().attr( 'src', video.thumbnail.hqDefault ),
                            youtitle().html( video.title + '<span class="date"> - uploaded '+date+'</span>' ),
                            play()
                                .attr({
                                    dataid: video.id
                                })
                        )
                )
            console.log(this.data.items[i].title);
        });
    },function(event){
        $('.thumbnail .play').on( 'click', function( event ){
            pop()
            var dataid			= $(this).attr('dataid')
            console.log(["Video ID" ,$('span.thumbnail').attr('dataid') ])
            $('.popup').html( tube.embed( dataid ) )
                .append( close() )
            var hhalf			= $('.popup iframe').width()/2
            var vhalf			= $('.popup iframe').height()/2;
            $( '[name="close"]' )
                .css({
                    left: hhalf,
                    bottom: vhalf - 28
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
    $( document ).keydown(function(e) {
        // ESCAPE key pressed
        if (e.keyCode == 27) {
            pop('drop');
        }
    });
    
})(jQuery);

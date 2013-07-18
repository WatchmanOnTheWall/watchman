(function( $ ) {

    function youtube( user ) {
        if( ! ( this instanceof youtube ) ) {
            return new youtube( user );
        }

        this.dataUrl		= 'http://gdata.youtube.com/feeds/api/users/'+user+'/uploads?v=2&alt=jsonc';

        return this;
    }
    youtube.prototype = {
        fetch: function( callback, success ) {
            var $this		= this;

            $.ajax({
                url: this.dataUrl,
                dataType: 'jsonp',
                error: function() {
                    console.log( 'And not a single data was found that day....' )
                },
                success: function( data ) {
                    $this.data	= data.data;

                    if( callback )
                        callback.call( $this, $this.data );
                    if ( success ) {
                        success();
                    }
                }
            });
        },
        embed: function( id, width, height, params ) {
            var width		= width
                ? width : 560;
            var height		= height
                ? height : 315;

            // iframe
            //     .width( width ? width : 560 )
            //     .height( height )

            // if( params.frameborder ) {
            //     iframe
            //         .attr( 'framebof' )
            // }
            
            return '<iframe width="'+ width +'" height="'+ height +'" src="http://www.youtube.com/embed/'+ id +'" frameborder="0" allowfullscreen></iframe>'
        },
        each: function( callback ) {
            if( ! this.data ) {
                return "No data. Use .fetch( callback ) before .each()";
            }
            var $this			= this;

            $.each( this.data.items, function( i, video ) {
                console.log([ i, video, $this ]);

                video.embed = function( id, w, h, p ) {
                    var id			= id ? id : video.id;

                    return $this.embed( id, w, h, p );
                }
                
                if( callback )
                    callback.call( $this, i, video );
            });
        }
    }

    window.youtube			= youtube;

})(jQuery);

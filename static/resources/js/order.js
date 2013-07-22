
var nocontent			= $('<div />')
    .html( '<h1>Not Currently Available</h1>' )

for( var i=0; i<inventory.length; i++ ) {
    var data = inventory[i];

    //                console.log([ "Building row for data:", data
    //                ]);

    function under_construction( name, data )
    {
        if( data.medium == name ){
            $('#'+name+' .inv').append(
                build_row( data )
            )
            return true;
        }
        $( '#'+name+' .inv' ).html(
            '<h2>Under Construction</h2>'
        )
        return false;
    }

    // under_construction( 'audio', data )
    
    if( data.medium == 'audio' ){
        $('#audio .inv').append(
            build_row( data )
        );
    }
    
    if( data.medium == 'book' ){
        $('#books .inv').append(
            build_row( data )
        );
    }

    if( data.medium == 'video' ){
        $('#video .inv').append(
            build_row( data )
        );
    }
}

function build_header( header )
{
    var h1 = $( header.toLowerCase().replace(/\b[a-z]/g, function(letter) {
        return letter.toUpperCase();
    }));

    return $('.'+header).append( h1 )
}

function build_row( data )
{
    
    var item		= $( '<div />' )
        .addClass( 'row' )
        .attr( 'id', data.id )
    
    , id			= $( '<div />' )
        .html( data.id )
        .addClass('hidden')
    , image			= $( '<span />' )
        .addClass('cover')
    , img_link		= $( '<a />' )
        .addClass( 'no-padding, span12' )
        .attr({
            'href': '/resources/images/covers/'+data.image
        })
        .css( 'background', ' url( "/resources/images/covers/'+data.image+ '") no-repeat')
    
    , info			= $( '<span />' )
        .addClass('info')
    , title			= $( '<h2 />' )
        .addClass('contentheading, title')
        .html( data.title )
    , link			= $( '<a />' )
        .attr({
            'href': '/order/item/'+data.id
        })
    , price			= $( '<span />' )
        .html( "$"+data.price )
        .addClass( 'hidden' )
    , buy_info		= $( '<p />' )
        .html( data.info )
    , checkbox		= $( '<input />' )
        .attr({
            'type': 'checkbox',
            'name': 'id_' + data.id,
            'row-data': JSON.stringify( data )
        })
        .addClass( 'wanted' )
        .val( data.id )
    , want_box		= $( '<span />' )
        .addClass('want-box')
    
    item.append(
        id,
        want_box.append(
            checkbox
        ),
        image.append(
            img_link
        ),
        info.append(
            link.append(
                title
            ),
            buy_info
            // text
        ),
        price
    )
    return item
}

num_selected	= function(){
    return $('.wanted:checked').length
}
var checked			= [];
var total			= 0;

$("input.wanted").click(
    function() {
        var value		= $( this ).val()
        , price		= $.parseJSON( $(this).attr('row-data') ).price
        if ( $(this).is( ":checked" ) ) {
            checked.push( value )
            total += parseInt( price, 10);
            
            $( '.amount' ).val( total );

            console.log( "checked", checked );
            console.log([ "Total: ", total ]);

            return;
        }
        
        checked		= $.grep( checked, function( a ){
            return a != value;
        });

        total -= price;
        
        $( '.amount' ).val( total )
        
        console.log( "checked", checked );
        console.log([ "Total: ", total ]);
    }
);

console.log([ "Checked: ", checked ])

$('#checkout-button').click(function(){
    console.log([ "Checked: ", checked ])

    var token = function(res){
        var input	= $('<input type=hidden name=stripeToken />').val( res.id )
        $('form')
            .append( input )
            .submit();
    };

    StripeCheckout.open({
        key:         'pk_yLFjPSiZOODGvjlBquqqNpcfqo2Fa',

        //Live Key:
        //key:         'pk_UyniFUBW5FwmyFDfbiNxWdVEOSuTP',
        address:     true,
        amount:      total + '00',
        name:        'Checkout',
        description: function() {
            return num_selected() + ' items (' + total + ')';
        },
        panelLabel:  'Checkout',
        token:       token
    })
});

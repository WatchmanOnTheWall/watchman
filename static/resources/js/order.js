
var nocontent			= $('<div />')
    .html( '<h1>Not Currently Available</h1>' )

for( var i=0; i<inventory.length; i++ ) {
    var data = inventory[i];

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
            'href': '/resources/images/covers/' + data.image
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
    , sale_price			= $( '<span />' )
        .addClass( 'sale' )
        .html( 'On Sale! $' + data.sale_price + '.00 + Shipping and Handling' )
    , price			= $( '<div />' )
        .html( ( data.sale_price !== null
                 && sale === 1 )
               ? sale_price
               : '$' + data.price+'.00 + Shipping and Handling'
             )
    , buy_info		= $( '<div />' )
        .html( ( data.info !== null )
    	       ? data.info
               : ''
             )
    , checkbox = $( '<input />' )
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
            link.append (
                title
            ),
            buy_info,
            price
        )
    )
    return item
}

function validate()
{
    $('.validate-alert').html( '' );
    var inputs		= $( '.order input, .order select' )
    , i			= 0;
    inputs.each( function( ) {
        if( $.trim( $( this ).val() ) == ''
            || $( this ).val() === null ) {
            i++;
            $( this ).css( 'outline', '#F00 thin solid' )
        }
    });
    if( $( '.wanted:checked' ).length < 1 ) {
        $('.validate-alert').html( 'There are no items selected' );
        i++;
    }
    if( i > 0 ) {
        console.log( 'Form not validated.' );
        return false;
    }
    return true;
}

num_selected	= function(){
    return $('.wanted:checked').length
}
var checked			= [];

$("input.wanted").click(
    function() {
        var value		= $( this ).val()
        if ( $(this).is( ":checked" ) ) {
            checked.push( value )

            console.log( "checked", checked );

            $( this ).closest( '.row' ).addClass( 'active' );

            return;
        }

        $( this ).closest( '.row' ).removeClass( 'active' );
        
        checked		= $.grep( checked, function( a ){
            return a != value;
        });
        
        console.log( "checked", checked );
    }
);

console.log([ "Checked: ", checked ])

$('#checkout-button').click(function(){
    if( ! validate() ){
        return false;
    };

    var total			= 0;
    
    $( '.wanted:checked' ).each( function() {
        var row_data		= $.parseJSON( $( this ).attr('row-data') )
        var price		= ( row_data.sale_price !== null && sale === 1 )
            ? row_data.sale_price
            : row_data.price;
        var price		= parseInt( price, 10 );
        total += price;
    });

    // Figure out shipping cost
    if ( total <= 15 ) {
	var shipping		= 5;
    }
    else if ( total > 15 && total <= 35 ) {
	var shipping		= 9;
    }
    else if ( total > 35 && total <= 80 ){
	var shipping		= 15;
    }
    else if ( total > 80 ) {
	var shipping		= 0;
    }

    total			= total + shipping;
    
    $( '.amount' ).val( total );
    
    console.log([ "Total: ", total ]);
    console.log([ "Checked: ", checked ])

    var token = function(res){
        var input	= $('<input type=hidden name=stripeToken />').val( res.id )
        $('form')
            .append( input )
            .submit();
    };

    StripeCheckout.open({
        //Dev Key:
        // key:		'pk_yLFjPSiZOODGvjlBquqqNpcfqo2Fa',
        //Live Key:
        key:		'pk_UyniFUBW5FwmyFDfbiNxWdVEOSuTP',
        amount:		total + '00',
        name:		'Checkout',
        description:	function() {
            return num_selected() + ' items (' + total + ')';
        },
        panelLabel:  'Checkout',
        token:       token
    })
});

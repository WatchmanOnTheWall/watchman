function validate( form_id )
{
    $('.validate-alert').html( '' );
    var inputs		= $( '#' + form_id + ' input, #' + form_id + ' select' )
    , i			= 0;
    console.log( inputs );
    
    inputs.each( function( ) {
        if( $.trim( $( this ).val() ) == ''
            || $( this ).val() === null ) {
            i++;
            $( this ).css( 'outline', '#F00 thin solid' )
        }
    });
    if( i > 0 ) {
        console.log( 'Form not validated.' );
        return false;
    }
    return true;
}

$('form#donation-form #donate-button').click( function(e){
    if( ! validate( 'donation-form' ) ){
        return false;
    };
    var amount			= $( 'input[name="amount"]' ).val();
    var email			= $( 'input[name="email"]' ).val();
    
    console.log([ "amount: ", amount ]);

    var token = function(res){
        var input	= $('<input type=hidden name=stripeToken />').val( res.id )
        $('form#donation-form')
            .append( input )
            .submit();
    };
    console.log( token );
    StripeCheckout.open({
        //Dev Key:
        // key:		'pk_test_rmo8R31SMUZkbyv2TTU7osQz',
        //Live Key:
        key:		'pk_live_MVBbOnmTzVS8jQrYQ8Xjl3oN',
        amount:		amount + '00',
        name:		'Donate',
        description:	function() {
            return amount;
        },
        panelLabel:  'Donate',
        token:       token
    })
    return false;
});

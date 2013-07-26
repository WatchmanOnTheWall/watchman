<!-- Main Content -->
<div class="content" style="height: auto;">
    <div class="padding">
        <h1>Watchman on the Wall Order</h1>
        <p class="payment-info">
        <p>
            <b>Customer Name:</b>
            <?php printf( "%s", $name) ?>
        </p>
        <p>
            <b>Customer Email:</b>
            <?php printf( "%s", $email ) ?>
        </p>
        <p>
            <b>Address:</b>
            <?php printf( "%s, %s, %s, %s", $street, $city,
			  $region ,$country ) ?>
        </p>
        <p>
            <b>Postal Code:</b>
            <?php printf( "%s", $code ) ?>
        </p>
        <p>
            <b>Items Purchased:</b>
        <table class="definition" cellpadding="10px">
            <?php foreach( $bought as $b ):
     		if ( $sale_on
		     && isset( $b->sale_price )
		     && $b->sale_price != '') {
		    $p		= $b->sale_price;
		}
		else{
		    $p		= $b->price;
		}
	    ?>		
            <tr>
                <td>
                    <?php echo $b->title ?>
                </td>
                <td>
                    <?php echo $b->medium ?>
                </td>
                <td>
                    $<?php echo $p ?>.00
                </td>
            </tr>
            <?php
 		endforeach;
	    ?>
        </table>
        </p>
        <p>
            <b>Shipping Cost:</b>
            <?php printf( "$%s.00", $shipping ) ?>
        </p>
        <p>
            <b>Amount Payed:</b>
            <span><?php echo
     		'$'. $price.'.00' ?></span>
        </p>
        </div>
    </div>
</div>

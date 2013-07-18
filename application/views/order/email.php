<!-- Main Content -->
<div class="content" style="height: auto;">
    <div class="padding">
        <h1><?php $title ?></h1>
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
                <?php printf( "%s, %s, %s, %s", $street, $city, $region ,$country ) ?>
            </p> 
            <p>
                <b>Postal Code:</b>
                <?php printf( "%s", $code ) ?>
            </p> 
            <dl class="definition">
                <dt>Items Purchased:</dt>
                <?php foreach( $bought as $b ){
     		    printf( '<dd> %s ( $%s.00 ) </dd>', $b->title, $b->price );
		    }
		?>
                <dt> Amount Payed: <span><?php echo '$'. $price.'.00' ?></span></dt>
            </dl>
        </div>
    </div>
</div>

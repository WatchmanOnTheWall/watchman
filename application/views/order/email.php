<!-- Main Content -->
<div class="content" style="height: auto;">
    <div class="padding">
        <h1><?php echo $title ?></h1>
        <div class="payment-info">
            <?php if (isset( $error )) :
     		echo $error;
 		else:
	    ?>
            <dl class="definition">
                <dt>Items Purchased:</dt>
                <?php foreach( $bought as $b ){
			printf( '<dd> %s ( $%s.00 ) </dd>', $b->title, $b->price );
		    }
		?>
                <dt> Amount Payed: <span><?php echo '$'. $price.'.00' ?></span></dt>
            </dl>
            <?php endif; ?>
        </div>
    </div>
</div>

<ul class="rslides">
    <?php
     foreach( scandir( BASEPATH."resources/images/covers/" ) as $cover ){
     if ( substr( $cover , -4 ) == ".jpg"
	  && $cover !== "no-image.jpg" ) {
	 $covers[]		= $cover;
     }
    }
     shuffle( $covers);
    foreach( $covers as $c ):
    ?>
    <li class="slide">
        <img src="resources/images/covers/<?php echo $c ?>"  alt="<?php echo $c ?>">
        <div href="/order" class="holder">
            <a href="/order">
                Click here to be directed to our Store.
            </a>
        </div>
    </li>
    <?php
	endforeach;
    ?>
</ul>

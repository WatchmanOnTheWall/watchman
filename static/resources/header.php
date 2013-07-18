<?php
    if( ! isset( $active ) ) {
	//	$active		= null;
    }

    function active( $tab ) {
	global $active;
	if ( $active == $tab ) {
	    echo 'class="active"';
	}
    }
?>
<div class="header">
    <div class="tabs">
        <div class="tab facebook">
            <a href="https://www.facebook.com/watchmanonthewallministries" target="_blank"></a>
        </div>
        <div class="tab twitter">
            <a href="http://twitter.com/watchonthewall" target="_blank"></a>
        </div>
        <div class="tab vimeo">
            <a href="http://vimeo.com/watchman" target="_blank"></a>
        </div>
    </div>
</div>
<div class="top_menu">
    <ul class="menu">
        <li <?php active( 'home' ) ?> > 
            <a href="/index.php">
                <span>Home
                </span>
            </a>
        </li>
        <li <?php active( 'about' )  ?> > 
            <a href="/about.php">
                <span>About</span>
            </a>
        </li>
	<li <?php active( 'travel-schedule' )  ?> > 
            <a href="/travel-schedule.php">
                <span>Travel Schedule</span>
            </a>
        </li>
	<li <?php active( 'media' )  ?> > 
            <a href="#">
                <span>Media</span>
            </a>
            <ul class="sub_menu">
                <li>
                    <a href="/media/chronicle">
                        <span>Chronicle</span>
                    </a>
                </li>
                <li>
                    <a href="/media/video.php">
                        <span>Video</span>
                    </a>
                </li>
                <!-- <li> -->
                <!--     <a href="#"> -->
                <!--         <span>Podcasts</span> -->
                <!--     </a> -->
                <!-- </li> -->
            </ul>
        </li>
	<li <?php active( 'order' )  ?> > 
            <a href="/order/">
                <span>Online Store</span>
            </a>
        </li>
	<li <?php active( 'links' )  ?> > 
            <a href="/links.php">
                <span>Links</span>
            </a>
        </li>
	<li <?php active( 'partners' )  ?> > 
            <a href="/partners.php">
                <span>Partners</span>
            </a>
        </li>
	<li <?php active( 'contact' )  ?> > 
            <a href="/contact.php">
                <span>Contact</span>
            </a>
            </ul>
        </li>
    </ul>
</div>

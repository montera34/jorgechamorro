<?php get_header(); ?>

<div class="container">
	<div class="row">

<?php
		include "margen.php";

// archive.php loop for posts
// output: all posts with pagination
// The Query
if ( have_posts() ) {

	// The Loop
	while ( have_posts() ) : the_post();
		include "loop.php";
	endwhile;

	/* Restore original Post Data 
	 * NB: Because we are using new WP_Query we aren't stomping on the 
	 * original $wp_query and it does not need to be reset.
	*/
	wp_reset_postdata();

} else {
// if no posts in this loop
	$loop_out[] = "
		<div class='span6 offset1'>
			<p>Aún no hay proyectos en este mosaico. ¡Añádelos!</p>
		</div>
	";
} ?>
		<div class='span6 offset1 box-padding box-margin'>
			<?php
			$count = 0;
			foreach ( $loop_out as $loop ) {
				$count++;
				if ( $count == 1 ) { echo "<div class='row'>"; }
				echo $loop;
				if ( $count == 6 ) { echo "</div>"; $count = 0; }
			}
			if ( $count != 0 ) { echo "</div>"; } ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>

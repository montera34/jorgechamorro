<?php get_header(); ?>

<div class="container">
	<div class="row">

<?php
// single.php loop
// output: this proyecto | this post
// The Query
if ( have_posts() ) {

	// The Loop
	while ( have_posts() ) : the_post();
		include "margen.php"; ?>
				<div class="span6 box-padding box-margin">
					<div class="row">
						<?php include "loop.php"; echo $loop_out; ?>
					</div>
				</div>
	<?php endwhile;

	/* Restore original Post Data 
	 * NB: Because we are using new WP_Query we aren't stomping on the 
	 * original $wp_query and it does not need to be reset.
	*/
	wp_reset_postdata();

} else {
// if no posts in this loop

} ?>

	</div>
</div>

<?php get_footer(); ?>

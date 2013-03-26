<?php /* Template Name: Noticias */
get_header(); ?>

<?php
// page.news.php loop for posts
// output: all posts with pagination
$page_id = get_the_ID();
$args = array(
	'post_type' => 'post',
);
// The Query
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {

	// The Loop
	while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<div class="container box-borderb">
			<div class="row">
				<?php include "margen.php"; ?>
				<div class="span6 box-padding box-margin">
					<div class="row">
						<?php include "loop.php"; echo $loop_out; ?>
					</div>
				</div>
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

<?php get_footer(); ?>

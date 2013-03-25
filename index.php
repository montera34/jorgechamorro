<?php get_header(); ?>

<div class="container">
	<div class="row">

<?php
// random loop of proyectos custom post type
// output: 1 proyecto
// The Query
$args = array(
	'post_type' => 'proyecto',
	'posts_per_page' => '1',
	'orderby' => 'rand'
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {

	// The Loop
	while ( $the_query->have_posts() ) : $the_query->the_post();
		include "margen.php";
		include "loop.random.php";
	endwhile;

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

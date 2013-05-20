<?php get_header(); ?>

<div class="content container">
	<div class="row">

<?php
		include "margen.php";

// check if there is sticky content
$args = array(
	'post_type' => 'jorgech_fimg',
	'posts_per_page' => '1',
//	'orderby' => 'rand',
	'meta_query' => array(
		array(
			'key' => '_jch_home_sticky',
			'compare' => '=',
			'value' => 'on'
		),
	),
);
$the_query = new WP_Query( $args );
if ( $the_query->found_posts != '' ) {
// if there is any sticky post, do nothing

} else {
// build the random content query

	// random loop of proyectos custom post type
	// output: 1 proyecto
	// The Query
	$args = array(
		'post_type' => 'jorgech_fimg',
		'posts_per_page' => '1',
		'orderby' => 'rand',
	);
	$the_query = new WP_Query( $args );
}

if ( $the_query->have_posts() ) {

	// The Loop
	while ( $the_query->have_posts() ) : $the_query->the_post();
		include "loop.php";
	endwhile;
	/* Restore original Post Data 
	 * NB: Because we are using new WP_Query we aren't stomping on the 
	 * original $wp_query and it does not need to be reset.
	*/
	wp_reset_postdata();

} else {
// if no posts in this loop
	$loop_out = "
		<div class='span6'>
			<p>La portada está programada para que aparezca una imagen de un proyecto, elegido aleatoriamente de entre los proyectos que hayan sido seleccionados para aparecer en la portada. Aún no hay ningún proyecto que haya sido seleccionado para aparecer en portada.</p>
			<p>Para hacer aparecer un proyecto en portada basta ir a la página del proyecto en el administrador de WordPress y añadir una imagen destacada mediante la caja Featured Image.</p>
		</div>
	";
} ?>
		<div class="span6 offset1 box-padding box-margin">
		<div class="row">
			<?php echo $loop_out; ?>
		</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>

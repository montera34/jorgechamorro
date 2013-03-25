<?php
if ( is_home() ) {
// if is home page
	// random image

	$loop_out = "
		<div class='span6'>
		<p>Una imagen aleatoria de entre los proyectos. Cual de todas las de un proyecto?</p>
		</div>
	";
} // end if is home page

elseif ( is_single() && get_post_type( $post->ID ) == 'proyecto' ) {
// if single of proyecto custom post type
	$loop_out = "
		<div class='span6'>
		<p>Todas las imagenes de este proyecto. Vars: image with, image cols, image pos.</p>
		</div>	
	";
} // end if single of proyecto custom post type

elseif ( is_archive() && get_post_type( $post->ID ) == 'post' ) {
// if posts archive
	$desc_es = get_the_content();
	$desc_en = get_post_meta( $post->ID, '_jch_pr_desc', true );
	$loop_out = "
		<div class='span2'>
		<p>Here the featured image of this new.</p>
		</div>
		<div class='span2'>
		 " .$desc_es. "
		</div>
		<div class='span2 muted'>
		 " .$desc_en. "
		</div>
	";
} // end if posts archive

?>
		<div class="span6 box-padding box-margin">
		<div class="row">
			<?php echo $loop_out; ?>
		</div>
		</div>


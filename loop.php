<?php
if ( is_home() ) {
// if is home page
	// random proyecto: outputting featured image
	if ( has_post_thumbnail() ) {
		$featured_img = get_the_post_thumbnail($post->ID,'full');
		$loop_out = "
		<div class='span6'>
			".$featured_img."
		</div>
		";
	} else {
		$loop_out = "
		<div class='span6'>
		<p>La portada está programada para que aparezca una imagen de un proyecto, elegido aleatoriamente de entre los proyectos que hayan sido seleccionados para aparecer en la portada. Aún no hay ningún proyecto que haya sido seleccionado para aparecer en portada.</p>
		<p>Para hacer aparecer un proyecto en portada basta ir a la página del proyecto en el administrador de WordPress y añadir una imagen destacada mediante la caja Featured Image.</p>
		</div>
		";
	}
} // end if is home page

//elseif ( is_post_type_archive('proyecto') ) {
elseif ( is_tax('tipo') ) {
// if any proyecto archive
	$mosac_img = get_post_meta( $post->ID, '_jch_pr_mosac', true );
	$mosac_tit = get_the_title();
	$mosac_tit_en = get_post_meta( $post->ID, '_jch_pr_tit', true );
	$mosac_link = get_permalink();
	$loop_out[] = "	
		<div class='span1'><img src='" .$mosac_img. "' alt='" .$mosac_tit. "' /><a href='" .$mosac_link. "' title='" .$mosac_tit. "'>" .$mosac_tit. "<br />" .$mosac_tit_en. "</a></div>
	";
} // end if any proyecto archive

elseif ( is_single() && get_post_type( $post->ID ) == 'proyecto' ) {
// if single of proyecto custom post type
	$rows = 17;
	$count_rows = 0;
	$loop_out = "";
	$img_class = "gallery-item";
	$prefix = "pr";
	include "loop.gallery.php";
} // end if single of proyecto custom post type

//elseif ( !is_single() && get_post_type( $post->ID ) == 'post' ) {
elseif ( get_post_type( $post->ID ) == 'post' ) {
// if posts archive

	$desc_es = get_the_content();
	$desc_es = apply_filters( 'the_content', $desc_es );
	$desc_en = get_post_meta( $post->ID, '_jch_pr_desc', true );
	$desc_en = apply_filters( 'the_content', $desc_en );
	if ( has_post_thumbnail() ) {
		$featured_img = get_the_post_thumbnail($post->ID,'mini');
		$loop_out = "
			<div class='span2'>
			" .$featured_img. "
			</div>
			<div class='span2'>
			 " .$desc_es. "
			</div>
			<div class='span2 muted'>
			 " .$desc_en. "
			</div>
		";
	} else {
		$loop_out = "
			<div class='span3'>
			 " .$desc_es. "
			</div>
			<div class='span3 muted'>
			 " .$desc_en. "
			</div>
		";
	}
} // end if posts archive

elseif ( is_page() ) {
// if page
	$desc_es = get_the_content();
	$desc_es = apply_filters( 'the_content', $desc_es );
	$desc_en = get_post_meta( $post->ID, '_jch_pr_desc', true );
	$desc_en = apply_filters( 'the_content', $desc_en );
	$cols = get_post_meta( $post->ID, '_jch_cols', true );
	// check if this page has images
	$rows = 1;
	$count_rows = 0;
	$loop_out = "";
	$img_class = "gallery-item";
	$prefix = "pag";
	include "loop.gallery.php";
	if ( $cols == '2' ) {
	// if 2 columns template
		$loop_out .= "
			<div class='span3'>
			 " .$desc_es. "
			</div>
			<div class='span3 muted'>
			 " .$desc_en. "
			</div>
		";
	} else {
		$loop_out .= "
			<div class='span6'>
			 " .$desc_es. "
			</div>
		";
	}
} // end if page
?>

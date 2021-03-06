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
		<div class='span6 textes'>
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
	$mosac_tit_short = get_post_meta( $post->ID, '_jch_pr_tit_short', true );
	$mosac_tit_short_en = get_post_meta( $post->ID, '_jch_pr_tit_short_en', true );
	if ( $mosac_tit_short != '' ) { $mosac_tit = $mosac_tit_short; }
	if ( $mosac_tit_short_en != '' ) { $mosac_tit_en = $mosac_tit_short_en; }
	if ( $mosac_tit_en != '' ) { $mosac_tit_en = "<br /><span class='muted'>" .$mosac_tit_en. "</span>"; }
	$mosac_link = get_permalink();
	$loop_out[] = "	
		<div class='span1 mosac-item'><a href='" .$mosac_link. "' title='" .$mosac_tit. "'><img src='" .$mosac_img. "' alt='" .$mosac_tit. "' /><div clas='mosac-tit'>" .$mosac_tit . $mosac_tit_en. "</div></a></div>
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
			<div class='span2 newimg'>
			" .$featured_img. "
			</div>
			<div class='span2 textes newtext'>
			 " .$desc_es. "
			</div>
			<div class='span2 muted newtext'>
			 " .$desc_en. "
			</div>
		";
	} else {
		$loop_out = "
			<div class='span3 textes'>
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
	if ( $loop_out != '' && $desc_es != '' || $loop_out != '' && $desc_en != '' ) { $loop_out .= "</div><div class='row'>"; }
	if ( $desc_es != '' || $desc_en != '' ) { // if any description exists
		if ( $cols == '2' ) {
		// if 2 columns template
			$loop_out .= "
			<div class='span3 boxtext textes'>
			 " .$desc_es. "
			</div>
			<div class='span3 boxtext muted'>
			 " .$desc_en. "
			</div>
			";
		} else {
			$loop_out .= "
			<div class='span6 boxtext textes'>
			 " .$desc_es. "
			</div>
			";
		} // end if 1 or 2 cols
	} // end any if description exists
} // end if page
?>

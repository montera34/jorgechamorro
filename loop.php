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
	$rows = 17;
	$count_rows = 0;
	$loop_out = "";
	while ( $rows > $count_rows ) {
		$count_rows++;
		$row_cols = get_post_meta( $post->ID, '_jch_pr_row'.$count_rows.'_cols', true );
		if ( $row_cols == 1 ) {
			$row_img1 =  get_post_meta( $post->ID, '_jch_pr_row'.$count_rows.'_img1', true );
			$loop_out .= "
				<div class='span6'>
				<p>".$row_img1."</p>
				</div>
			";
		} elseif ( $row_cols == 2 ) {
			$row_img1 =  get_post_meta( $post->ID, '_jch_pr_row'.$count_rows.'_img1', true );
			$row_img2 =  get_post_meta( $post->ID, '_jch_pr_row'.$count_rows.'_img2', true );
			$loop_out .= "
				<div class='span3'>
				<p>".$row_img1."</p>
				</div>
				<div class='span3'>
				<p>".$row_img2."</p>
				</div>
			";
		} elseif ( $row_cols == 3 ) {
			$row_img1 =  get_post_meta( $post->ID, '_jch_pr_row'.$count_rows.'_img1', true );
			$row_img2 =  get_post_meta( $post->ID, '_jch_pr_row'.$count_rows.'_img2', true );
			$row_img3 =  get_post_meta( $post->ID, '_jch_pr_row'.$count_rows.'_img3', true );
			$loop_out .= "
				<div class='span2'>
				<p>".$row_img1."</p>
				</div>
				<div class='span2'>
				<p>".$row_img2."</p>
				</div>
				<div class='span2'>
				<p>".$row_img3."</p>
				</div>
			";
		} else {
			// do nothing
		}
	} // end while rows
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

elseif ( is_page() ) {
// if page
	$desc_es = get_the_content();
	$desc_en = get_post_meta( $post->ID, '_jch_pr_desc', true );
	$cols = get_post_meta( $post->ID, '_jch_cols', true );
	if ( $cols == '2' ) {
	// if 2 columns template
		$loop_out = "
			<div class='span3'>
			 " .$desc_es. "
			</div>
			<div class='span3 muted'>
			 " .$desc_en. "
			</div>
		";
	} else {
		$loop_out = "
			<div class='span6'>
			 " .$desc_es. " / <span class='muted'>" .$desc_en. "</span>
			</div>
		";
	}
} // end if page

?>
		<div class="span6 box-padding box-margin">
		<div class="row">
			<?php echo $loop_out; ?>
		</div>
		</div>


<?php
	while ( $rows > $count_rows ) {
		$count_rows++;
		$row_cols = get_post_meta( $post->ID, '_jch_'.$prefix.'_row'.$count_rows.'_cols', true );
		if ( $row_cols == 1 ) {
			$row_img1 =  get_post_meta( $post->ID, '_jch_'.$prefix.'_row'.$count_rows.'_img1', true );
			$loop_out .= "
				<div class='span6'>
				<img class='".$img_class."' src='".$row_img1."' alt='".$tit_es."' />
				</div>
			";
		} elseif ( $row_cols == 2 ) {
			$row_img1 =  get_post_meta( $post->ID, '_jch_'.$prefix.'_row'.$count_rows.'_img1', true );
			$row_img2 =  get_post_meta( $post->ID, '_jch_'.$prefix.'_row'.$count_rows.'_img2', true );
			$loop_out .= "
				<div class='span3'>
				<img class='".$img_class."' src='".$row_img1."' alt='".$tit_es."' />
				</div>
				<div class='span3'>
				<img class='".$img_class."' src='".$row_img2."' alt='".$tit_es."' />
				</div>
			";
		} elseif ( $row_cols == 3 ) {
			$row_img1 =  get_post_meta( $post->ID, '_jch_'.$prefix.'_row'.$count_rows.'_img1', true );
			$row_img2 =  get_post_meta( $post->ID, '_jch_'.$prefix.'_row'.$count_rows.'_img2', true );
			$row_img3 =  get_post_meta( $post->ID, '_jch_'.$prefix.'_row'.$count_rows.'_img3', true );
			$loop_out .= "
				<div class='span2'>
				<img class='".$img_class."' src='".$row_img1."' alt='".$tit_es."' />
				</div>
				<div class='span2'>
				<img class='".$img_class."' src='".$row_img2."' alt='".$tit_es."' />
				</div>
				<div class='span2'>
				<img class='".$img_class."' src='".$row_img3."' alt='".$tit_es."' />
				</div>
			";
		} else {
			// do nothing
		}
	} // end while rows

?>

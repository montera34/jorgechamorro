<?php
if ( is_home() ) {
// if is home page
	$desc_es = $genvars['blogdesc'];
	$desc_en = $genvars['blogdesc'];
	$user_mail = $genvars['user_mail'];
	$user_data = get_user_by('email', $user_mail);
	//$user_phone = $user_data->phone;
	$user_phone = "+34 91 521 75 26";

	$margen_out = "
		<h2>" .$desc_es. "<br />
			<span class='muted'>" .$desc_en. "</span>
		</h2>
		<div>
			<div>" .$user_mail. "</div>
			<div>" .$user_phone. "</div>
		</div>
	";
} // end if is home page

elseif ( is_single() && get_post_type( $post->ID ) == 'proyecto' ) {
// if single of proyecto custom post type
	$tipos = get_the_terms( $post->ID, "tipo" );
	$tipo_es = "";
	$tipo_en = "";
	$tit_es = get_the_title();
	$tit_en = get_post_meta( $post->ID, '_jch_pr_tit', true );
	$desc_es = get_the_content();
	$desc_en = get_post_meta( $post->ID, '_jch_pr_desc', true );
	$date = get_post_meta( $post->ID, '_jch_pr_date', true );

	$margen_out = "
		<p>" .$tipo_es. "<br /><span class='muted'>" .$tipo_en. "</span></p>
		<h2>" .$tit_es. "<br />
			<span class='muted'>" .$tit_en. "</span>
		</h2>
		<p>
			" .$desc_es. "<br />
			<span class='muted'>" .$desc_en. "</span>
		</p>
		<p>
			" .$date. "
		</p>
	";
} // end if single of proyecto custom post type

//elseif ( is_post_type_archive() ) {
elseif ( is_archive() && get_post_type( $post->ID ) == 'post' ) {
// if posts archive
	$tit_es = get_the_title();
	$tit_en = get_post_meta( $post->ID, '_jch_pr_tit', true );
	$desc_es = get_the_content();
	$desc_en = get_post_meta( $post->ID, '_jch_pr_desc', true );
	$date = get_the_date('j\.m\.y');

	$margen_out = "
		<h2>" .$tit_es. "<br />
			<span class='muted'>" .$tit_en. "</span>
		</h2>
		<p>
			" .$date. "
		</p>
	";
} // end if single of proyecto custom post type

elseif ( is_page() ) {
// if page
	$tit_es = get_the_title();
	$tit_en = get_post_meta( $post->ID, '_jch_pr_tit', true );

	$margen_out = "
		<h2>" .$tit_es. "<br />
			<span class='muted'>" .$tit_en. "</span>
		</h2>
	";
} // end if single of proyecto custom post type

?>

	<div class="span1 box-margin">
		<?php echo $margen_out; ?>
	</div>



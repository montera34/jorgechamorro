<?php
if ( is_home() ) {
// if is home page
	$desc_es = $genvars['blogdesc'];
	$desc_en = $genvars['blogdesc_en'];
	$user_mail = $genvars['user_mail'];
	$user_data = get_user_by('email', $user_mail);
	$user_phone = $user_data->phone;

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

//elseif ( get_query_var('tipo') != '' && !is_single() ) {
elseif ( is_tax('tipo') ) {
// if disegno archivo
	$margen_out = "";
	$current_term = get_query_var('tipo');
	$current_term_data = get_term_by( 'slug', $current_term, 'tipo' );
	$current_term_id = $current_term_data->term_id;
	$current_term_children = get_terms( "tipo",array('parent'=>$current_term_id,'hide_empty'=>0) );
	
	if ( count($current_term_children) == 0 ) { // if current term has no children
//		$tipo_es = $current_term_data->name;
//		$tipo_en = $current_term_data->description;
//		$margen_out .= "
//			<h2>" .$tipo_es. "<br />
//				<span class='muted'>" .$tipo_en. "</span>
//			</h2>
//		";
	} else { // if current term has children
		foreach ( $current_term_children as $child ) {
			$tipo_es = $child->name;
			$tipo_en = $child->description;
			$term_link = get_term_link( $tipo_es, 'tipo' );
			$margen_out .= "
				<h2><a href='" .$term_link. "'>" .$tipo_es. "<br />
					<span class='muted'>" .$tipo_en. "</span></a>
				</h2>
			";
		}
	} // end if current term has children
} // end if disegno archive

elseif ( is_single() && get_post_type( $post->ID ) == 'proyecto' ) {
// if single of proyecto custom post type
	$tipos = get_the_terms( $post->ID, "tipo" );
	foreach ( $tipos as $tipo ) {
		if ( $tipo->parent == 0 ) {
			$tipo_es = $tipo->name;
			$tipo_en = $tipo->description;
		}
	}
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

//elseif ( is_page_template('page.news.php') ) {
elseif ( get_post_type( $post->ID ) == 'post' ) {
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

	if ( $post->post_parent == '0' ) { }
	else {
		$margen_out = "
			<h2>" .$tit_es. "<br />
				<span class='muted'>" .$tit_en. "</span>
			</h2>
		";
	}
} // end if single of proyecto custom post type
?>

<?php if ( is_front_page() || is_tax('tipo') || is_single() ) { ?>
	<div id= "margen" class="span1 box-margin box-padding affix">
<?php } else { ?>
	<div id= "margen" class="span1 box-margin box-padding">
<?php } ?>
		<?php echo $margen_out; ?>
	</div>



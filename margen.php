<?php
if ( is_home() ) {
// if is home page
	$desc_es = $genvars['blogdesc'];
	$desc_en = $genvars['blogdesc_en'];
//	$user_mail = $genvars['user_mail'];
	$user_data = get_user_by('email', $user_mail);
	$user_phone = $user_data->phone;

	$margen_out = "
		<h2>" .$desc_es. "<br />
			<span class='muted'>" .$desc_en. "</span>
		</h2>
		<div id='credits'>
			Desarrollo web<br />
			<span class='muted'>Web development</span><br />
			<a href='http://montera34.com'>montera34</a>
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

//print_r($wp_query->query_vars);
//echo $current_term_data->parent; 
	if ( $current_term_data->parent == '0' && count($current_term_children) != 0 ) {
	// if current term is TOP TERM and HAS CHILDREN
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

	} elseif ( $current_term_data->parent == '0' && count($current_term_children) != 0 ) {
	// if current term is TOP TERM and has NO CHILDREN

	} elseif ( $current_term_data->parent != '0' ) {
		$parent_term_id = $current_term_data->parent;
		$current_term_brothers = get_terms( "tipo",array('parent'=>$parent_term_id,'hide_empty'=>0) );
		foreach ( $current_term_brothers as $child ) {
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
	$post_terms = get_the_terms( $post->ID, "tipo" );
	if ( has_term('arte','tipo') ) { $parent_term = "arte"; }
	elseif ( has_term('diseno-grafico','tipo') ) { $parent_term = "diseno-grafico"; }
	$parent_term_data = get_term_by( 'slug', $parent_term, 'tipo' );
	$terms =  get_terms( "tipo",array('parent'=>$parent_term_data->term_id,'hide_empty'=>0) );

	$margen_out = "";
	foreach ( $terms as $tipo ) {
		$tipo_es = $tipo->name;
		$tipo_en = $tipo->description;
		$term_link = get_term_link( $tipo_es, 'tipo' );
		if ( has_term($tipo->slug,'tipo') ) {
			$margen_out .= "<p class='current-tipo'><a href='" .$term_link. "'>" .$tipo_es. "<br /><span class='muted'>" .$tipo_en. "</span></a></p>";
		}
		else {
			$margen_out .= "<p><a href='" .$term_link. "'>" .$tipo_es. "<br /><span class='muted'>" .$tipo_en. "</span></a></p>";
		}
	}
	$tit_es = get_the_title();
	$tit_en = get_post_meta( $post->ID, '_jch_pr_tit', true );
	$desc_es = get_the_content();
	$desc_en = get_post_meta( $post->ID, '_jch_pr_desc', true );
	$date = get_post_meta( $post->ID, '_jch_pr_date', true );
	//$previous_post = get_previous_posts_link('Anterior proyecto<br /><span class="muted">Previous project</span>');
	$previous_post_perma = get_permalink(get_adjacent_post(false,'',false));
	$next_post_perma = get_permalink(get_adjacent_post(false,'',true));
	if ( has_term('diseno-grafico','tipo') ) { $tit_class = " class='box-bordert'"; $adjacent_class = $tit_class; } else { $tit_class = ""; $adjacent_class = " class='box-bordert'"; }	
	$margen_out .= "
		<h2" .$tit_class. ">" .$tit_es. "<br />
			<span class='muted'>" .$tit_en. "</span>
		</h2>
		<p>
			<div class='proy-desc'>" .$desc_es. "</div>
			<span class='muted'>" .$desc_en. "</span>
		</p>
		<p" .$adjacent_class. "><a href='" .$next_post_perma. "'>Siguiente projecto<br /><span class='muted'>Next project</span></a></p>
		<p><a href='" .$previous_post_perma. "'>Anterior projecto<br /><span class='muted'>Previous project</span></a></p>
	";
	if ( $date != '' ) { $margen_out .= "<p>" .$date. "</p>"; }
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



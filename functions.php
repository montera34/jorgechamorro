<?php
// Custom post types
add_action( 'init', 'create_post_type', 0 );

function create_post_type() {
	// Proyectos custom post type
	register_post_type( 'proyecto', array(
		'labels' => array(
			'name' => __( 'Proyectos' ),
			'singular_name' => __( 'Proyecto' ),
			'add_new_item' => __( 'Añadir un proyecto' ),
			'edit' => __( 'Editar' ),
			'edit_item' => __( 'Editar este proyecto' ),
			'new_item' => __( 'Nuevo proyecto' ),
			'view' => __( 'Ver proyecto' ),
			'view_item' => __( 'Ver este proyecto' ),
			'search_items' => __( 'Buscar proyectos' ),
			'not_found' => __( 'No se ha encontrado ningún proyecto' ),
			'not_found_in_trash' => __( 'Ningún proyecto en la papelera' ),
			'parent' => __( 'Parent' )
		),
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'menu_position' => 5,
		//'menu_icon' => get_template_directory_uri() . '/images/icon-post.type-integrantes.png',
		'hierarchical' => false, // if true this post type will be as pages
		'query_var' => true,
		'supports' => array('title', 'editor','author','trackbacks','comments','thumbnail' ),
		'rewrite' => array('slug'=>'proyecto','with_front'=>false),
		'can_export' => true,
		'_builtin' => false,
		'_edit_link' => 'post.php?post=%d',
	));
	// Features images in home page
	register_post_type( 'jorgech_fimg', array(
		'labels' => array(
			'name' => __( 'Imágenes de portada' ),
			'singular_name' => __( 'Imagen de portada' ),
			'add_new_item' => __( 'Añadir una imagen' ),
			'edit' => __( 'Editar' ),
			'edit_item' => __( 'Editar esta imagen' ),
			'new_item' => __( 'Nueva imagen' ),
			'view' => __( 'Ver imagen' ),
			'view_item' => __( 'Ver esta imagen' ),
			'search_items' => __( 'Buscar imagenes' ),
			'not_found' => __( 'No se ha encontrado ninguna imagen' ),
			'not_found_in_trash' => __( 'Ninguna imagen en la papelera' ),
			'parent' => __( 'Parent' )
		),
		'has_archive' => false,
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => true,
		'menu_position' => 5,
		//'menu_icon' => get_template_directory_uri() . '/images/icon-post.type-integrantes.png',
		'hierarchical' => false, // if true this post type will be as pages
		'query_var' => true,
		'supports' => array('thumbnail'),
		//'rewrite' => array('slug'=>'proyecto','with_front'=>false),
		'can_export' => true,
		'_builtin' => false,
		'_edit_link' => 'post.php?post=%d',
	));

}

// Custom Taxonomies
add_action( 'init', 'build_taxonomies', 0 );

function build_taxonomies() {
register_taxonomy( 'tipo', 'proyecto', array( // Tipo taxonomy
	'hierarchical' => true,
	'label' => 'Tipos',
	'name' => 'Tipos',
	'query_var' => true,
	'rewrite' => array( 'slug' => 'tipo', 'with_front' => false ),) );
//register_taxonomy( 'fecha', 'proyecto', array( // Fecha taxonomy
//	'hierarchical' => true,
//	'label' => 'Fecha',
//	'name' => 'Fecha',
//	'query_var' => true,
//	'rewrite' => array( 'slug' => 'fecha', 'with_front' => false ),) );
}

//Add metaboxes to Case Study Custom post type
function be_sample_metaboxes( $meta_boxes ) {//metaboxes common variables to all scales
	$prefix = '_jch_'; // Prefix for all fields
	$meta_boxes[] = array(
		'id' => 'english',
		'title' => 'Contenido en inglés y título corto en español',
		'pages' => array('proyecto','page','post'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Title',
				'desc' => '',
				'id' => $prefix . 'pr_tit',
				'type' => 'text'
			),
			array(
				'name' => 'Short Title',
				'desc' => '',
				'id' => $prefix . 'pr_tit_short_en',
				'type' => 'text'
			),
			array(
				'name' => 'Título corto',
				'desc' => '',
				'id' => $prefix . 'pr_tit_short',
				'type' => 'text'
			),
			array(
				'name' => 'Description',
				'desc' => '',
				'id' => $prefix . 'pr_desc',
				'type' => 'wysiwyg',
					'options' => array(
						    'wpautop' => true, // use wpautop?
						    'textarea_rows' => get_option('default_post_edit_rows', 2), // rows="..."
						    'teeny' => false, // output the minimal editor config used in Press This
						    'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
					),
			),
		),
	);
	$meta_boxes[] = array(
		'id' => 'mosac-img',
		'title' => 'Imagen para el mosaico',
		'pages' => array('proyecto'), // post type
		'context' => 'side',
		'priority' => 'high',
		'show_names' => false, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Imagen para el mosaico',
				'desc' => 'Ancho: 150px<br />Alto: 140px',
				'id' => $prefix . 'pr_mosac',
				'type' => 'file',
				'save_id' => false, // save ID using true
				'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
			),
		),
	);
	$meta_boxes[] = array(
		'id' => 'date',
		'title' => 'Año de ejecución del proyecto',
		'pages' => array('proyecto'), // post type
		'context' => 'side',
		'priority' => 'high',
		'show_names' => false, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Año',
				'desc' => '',
				'id' => $prefix . 'pr_date',
				'type' => 'text_small',
			),
		)
	);
	$meta_boxes[] = array(
		'id' => 'cols',
		'title' => 'Número de columnas de esta página',
		'pages' => array('page'), // post type
		'context' => 'side',
		'priority' => 'high',
		'show_names' => false, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Número de columnas',
				'desc' => '',
				'id' => $prefix . 'cols',
				'type' => 'radio_inline',
				'options' => array(
					array('name' => '1', 'value' => '1'),
					array('name' => '2', 'value' => '2'),
				)
			),
		),
	);
	// custom meta boxes for gallery in single proyecto
	$rows = 17; // maximun number of rows
	$count_rows = 0;
	while ( $rows > $count_rows ) {
		$count_rows++;
		$meta_boxes[] = array(
			'id' => 'row_'.$count_rows,
			'title' => 'Galería de imagenes: Fila '.$count_rows,
			'pages' => array('proyecto'), // post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => 'Número de columnas',
					'desc' => '',
					'id' => $prefix . 'pr_row'.$count_rows.'_cols',
					'type' => 'radio_inline',
					'options' => array(
						array('name' => '1', 'value' => '1'),
						array('name' => '2', 'value' => '2'),
						array('name' => '3', 'value' => '3'),
					)
				),
				array(
					'name' => 'Imagen 1',
					'desc' => '',
					'id' => $prefix . 'pr_row'.$count_rows.'_img1',
					'type' => 'file',
					'save_id' => true, // save ID using true
					'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
				),
				array(
					'name' => 'Imagen 2',
					'desc' => '',
					'id' => $prefix . 'pr_row'.$count_rows.'_img2',
					'type' => 'file',
					'save_id' => true, // save ID using true
					'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
				),
				array(
					'name' => 'Imagen 3',
					'desc' => '',
					'id' => $prefix . 'pr_row'.$count_rows.'_img3',
					'type' => 'file',
					'save_id' => true, // save ID using true
					'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
				),
			),
		);	
	} // end while rows
	// custom meta boxes for gallery in pages
	$rows = 1; // maximun number of rows
	$count_rows = 0;
	while ( $rows > $count_rows ) {
		$count_rows++;
		$meta_boxes[] = array(
			'id' => 'pag_row_'.$count_rows,
			'title' => 'Galería de imagenes: Fila '.$count_rows,
			'pages' => array('page'), // post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => 'Número de columnas',
					'desc' => '',
					'id' => $prefix . 'pag_row'.$count_rows.'_cols',
					'type' => 'radio_inline',
					'options' => array(
						array('name' => '1', 'value' => '1'),
						array('name' => '2', 'value' => '2'),
						array('name' => '3', 'value' => '3'),
					)
				),
				array(
					'name' => 'Imagen 1',
					'desc' => '',
					'id' => $prefix . 'pag_row'.$count_rows.'_img1',
					'type' => 'file',
					'save_id' => true, // save ID using true
					'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
				),
				array(
					'name' => 'Imagen 2',
					'desc' => '',
					'id' => $prefix . 'pag_row'.$count_rows.'_img2',
					'type' => 'file',
					'save_id' => true, // save ID using true
					'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
				),
				array(
					'name' => 'Imagen 3',
					'desc' => '',
					'id' => $prefix . 'pag_row'.$count_rows.'_img3',
					'type' => 'file',
					'save_id' => true, // save ID using true
					'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
				),
			),
		);	
	} // end while rows
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'be_sample_metaboxes' );
// Initialize the metabox class
add_action( 'init', 'be_initialize_cmb_meta_boxes', 9999 );
function be_initialize_cmb_meta_boxes() {
	if ( !class_exists( 'cmb_Meta_Box' ) ) {
		require_once( 'lib/metabox/init.php' );
	}
}

// Adding featured image to the custom post types
add_theme_support( 'post-thumbnails', array( 'post','proyecto','jorgech_fimg') );

// extra fields in user profile
add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

	function extra_user_profile_fields( $user ) {
 		$extra_fields = array(
			array(
				'name' => 'Teléfono',
				'label' => 'phone'
			),
		);
?>
		<h3><?php _e("Información adicional", "blank"); ?></h3>
		<table class="form-table">
		<?php foreach ( $extra_fields as $extra_field ) { ?>	
			<tr>
				<th><label for="<?php echo $extra_field['label']; ?>"><?php echo $extra_field['name']; ?></label></th>
				<td>
					<input type="text" name="<?php echo $extra_field['label']; ?>" id="<?php echo $extra_field['label']; ?>" value="<?php echo esc_attr( get_the_author_meta( $extra_field['label'], $user->ID ) ); ?>" class="regular-text" /><br />
				</td>
			</tr>
		<?php } // end loop extra fields ?>
		</table>
<?php } // end extra_user_profile_fields function
 
add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );
 
function save_extra_user_profile_fields( $user_id ) {
 
	if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }
 		$extra_fields = array(
			array(
				'name' => 'Teléfono',
				'label' => 'phone'
			),
		);

	foreach ( $extra_fields as $extra_field ) {	
		update_user_meta( $user_id, $extra_field['label'], $_POST[$extra_field['label']] );
	}

} // end save_extra_user_profile_fields function

// add an extra field to General Settings Page in the admin
$new_general_setting = new new_general_setting();

class new_general_setting {
	function new_general_setting() {
		add_filter( 'admin_init' , array( &$this , 'register_fields' ) );
	}
	function register_fields() {
		register_setting( 'general', 'tagline_en', 'esc_attr' );
		// add_settings_field( $id, $title, $callback, $page, $section, $args );
		add_settings_field('tagl_en', '<label for="tagline_en">'.__('Tagline in english' , 'tagline_en' ).'</label>' , array(&$this, 'fields_html') , 'general' );
	}
	function fields_html() {
		$value = get_option( 'tagline_en', '' );
		echo '<input type="text" id="tagline_en" name="tagline_en" value="' . $value . '" />';
	}
}

// adding necessary terms and pages to the website when the theme is selected
//add_action( 'after_setup_theme', 'add_necessary_terms_and_pages' );
//function add_necessary_terms_and_pages() {
//	// terms
//	$taxo = "tipo";
//	$terms_list = array(
//		array(
//			'name' => 'Arte',
//			'description' => 'Art'
//		),
//		array(
//			'name' => 'Diseño gráfico',
//			'description' => 'Graphic design'
//		)
//	);
//	foreach ( $terms_list as $tipo ) {
//		if ( term_exists($tipo->name,$taxo) == 0 ) { // if term does not exist, create it
//			$args = array(
//				'description' => $tipo->description
//			);
//			wp_insert_term( $tipo->name, $taxo, $args );
//		}
//	} // end loop terms
//
//	// pages
//	$pages_list = array(
//		array(
//			'name' => 'Docencia',
//			'name_en' => 'Teaching',
//			'slug' => 'docencia'
//		),
//		array(
//			'name' => 'Tienda',
//			'name_en' => 'Shop',
//			'slug' => 'tienda'
//		),
//		array(
//			'name' => 'Información',
//			'name_en' => 'About',
//			'slug' => 'informacion'
//		)
//	);
//	foreach ( $pages_list as $ipag ) {
//		if ( get_page_by_title($ipag->name) == NULL ) { // if page already exists, do nothing
//			$ipag_id = wp_insert_post(array(
//				'post_type' => 'page', // "page" para páginas, "libro" para el custom post type libro...
//				'post_status' => 'publish', // "publish" para publicados, "draft" para borrador, "future" para programarlo...
//				'post_author' => '1', // el ID del autor, 1 para admin
//				'post_title' => $ipag->name,
//				'post_name' => $ipag->slug,
//			)); // La funcion insert devuelve la id del post 
//			$post_meta_key = "_jch_pr_tit";
//			$post_meta_value = $ipag->name_en;
//			add_post_meta($ipag_id, $post_meta_key, $post_meta_value, true);
//		}
//	} // end loop pages
//} // end add_necessary_terms_and_pages function

add_filter( 'pre_get_posts', 'jorgech_all_posts_in_tipo_tax_archive' );
function jorgech_all_posts_in_tipo_tax_archive( $query ) {
    if ( is_tax( 'tipo' ) )
        $query->set( 'posts_per_page', -1 );
    return $query;
}
?>

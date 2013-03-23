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
		'supports' => array('title', 'editor','author','trackbacks','comments' ),
		'rewrite' => array('slug'=>'proyecto','with_front'=>false),
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
		'title' => 'Contenido en inglés',
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
add_theme_support( 'post-thumbnails', array( 'post') );

?>

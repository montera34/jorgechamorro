<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 9]>
<html class="ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) | !(IE 9) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<?php
// main page vars
global $genvars;
$genvars = array(
	//'user_mail' => 'jorge@jorgechamorro.es', // main user mail
	'user_mail' => 'info@montera34.com', // main user mail
	'blogname' => get_bloginfo('name'), // title
	'blogdesc' => get_bloginfo( 'description', 'display' ), // description
	'blogdesc_en' => get_option( 'tagline_en' ), // description english
	'blogurl' => get_bloginfo('url'), // home url
	'blogtheme' => get_bloginfo('template_directory'), // theme url
);
?>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>
<?php
	/* From twentyeleven theme
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	//bloginfo( 'name' );
		echo $genvars['blogname'];

		// Add the blog description for the home/front page.
		$site_description = $genvars['blogdesc'];
		if ( $site_description != '' && ( is_home() || is_front_page() ) )
			echo " | $site_description";

		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'jorgech' ), max( $paged, $page ) );
		?>
</title>

<link rel="profile" href="http://gmpg.org/xfn/11" />

<!-- Bootstrap -->
<link href="<?php echo $genvars['blogtheme']; ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<!-- Squirrel Fonts -->
<link href="<?php echo $genvars['blogtheme']; ?>/fonts/stylesheet.css" rel="stylesheet" />
<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" />

<link rel="alternate" type="application/rss+xml" title="<?php echo $genvars['blogname']; ?> RSS Feed suscription" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php echo $genvars['blogname']; ?> Atom Feed suscription" href="<?php bloginfo('atom_url'); ?>" /> 
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php
// if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
wp_head(); ?>
</head>

<body>

<div id="pre" class="navbar navbar-fixed-top">
<div class="navbar-inner">
<div class="container">
	<div class="row">
		<div class="span1">
			<h1><a href="<?php echo $genvars['blogurl']; ?>"><?php echo $genvars['blogname']; ?></a></h1>
		</div>
		<div class="span6 box-borderb">
		<div class="row">
			<?php
			// menu build
			$items = array(
				array('name_es'=>'Diseño gráfico','name_en'=>'Graphic design','class'=>'design','url'=>$genvars['blogurl'].'/tipo/diseno-grafico'),
				array('name_es'=>'Arte','name_en'=>'Art','class'=>'art','url'=>$genvars['blogurl'].'/tipo/arte'),
				array('name_es'=>'Docencia','name_en'=>'Teaching','class'=>'docencia','url'=>$genvars['blogurl'].'/docencia'),
				array('name_es'=>'Noticias','name_en'=>'News','class'=>'news','url'=>$genvars['blogurl'].'/noticias'),
				array('name_es'=>'Tienda','name_en'=>'Shop','class'=>'tienda','url'=>$genvars['blogurl'].'/tienda'),
				array('name_es'=>'Información','name_en'=>'About','class'=>'informacion','url'=>$genvars['blogurl'].'/informacion'),
			);
			if ( get_query_var('tipo') == 'diseno-grafico' || is_single() && has_term("diseno-grafico","tipo") ) { $active = 1; }
			elseif ( get_query_var('tipo') == 'arte' || is_single() && has_term("arte","tipo") ) { $active = 2; }
			elseif ( is_page('docencia') ) { $active = 3; }
			elseif ( is_page_template('page.news.php') || get_post_type( $post->ID ) == 'post' && is_single() ) { $active = 4; }
			elseif ( is_page('tienda') ) { $active = 5; }
			elseif ( is_page('informacion') ) { $active = 6; }
			else { $active = 0; }
			$count = 0;
			foreach ( $items as $item ) {
				$count++;
				if ( $count == $active ) {
					echo "<div class='span1 box-padding current-borderb ".$item['class']."'><a href='".$item['url']."'>".$item['name_es']."<br /><span class='muted'>".$item['name_en']."</span></a></div>";
				} else {
				echo "<div class='span1 box-padding current-borderb-w ".$item['class']."'><a href='".$item['url']."'>".$item['name_es']."<br /><span class='muted'>".$item['name_en']."</span></a></div>";
				}
			} ?>
		</div>
		</div>
	</div>
</div><!-- .container-->
</div><!-- .navbar-inner -->
</div><!-- .navbar -->

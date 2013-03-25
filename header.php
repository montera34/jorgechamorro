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

<div class="container">
	<div class="row">
		<div class="span1">
			<h1><a href="<?php echo $genvars['blogurl']; ?>"><?php echo $genvars['blogname']; ?></a></h1>
		</div>
		<div class="span6 box-borderb box-padding">
		<div class="row">
			<div class="span1"><a href="">Diseño gráfico<br />Graphic Design</a></div>
			<div class="span1"><a href="">Arte<br />Art</a></div>
			<div class="span1"><a href="">Arte<br />Art</a></div>
			<div class="span1"><a href="">Arte<br />Art</a></div>
			<div class="span1"><a href="">Arte<br />Art</a></div>
			<div class="span1"><a href="">Arte<br />Art</a></div>
		</div>
		</div>
	</div>
</div>

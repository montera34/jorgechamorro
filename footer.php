<?php
// main page vars
$genvars = array(
	'blogname' => get_bloginfo('name'), // title
	'blogdesc' => get_bloginfo( 'description', 'display' ), // description
	'blogurl' => get_bloginfo('url'), // home url
	'blogtheme' => get_bloginfo('template_directory'), // theme url
);
?>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="<?php echo $genvars['blogtheme']; ?>/bootstrap/js/bootstrap.min.js"></script>

<?php wp_footer(); ?>
</body>
</html>

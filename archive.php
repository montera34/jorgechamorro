<?php get_header(); ?>


<?php
// archive.php loop for posts
// output: all posts with pagination
// The Query
if ( have_posts() ) {

	// The Loop
	while ( have_posts() ) : the_post(); ?>
<div class="container box-borderb">
	<div class="row">

		<?php include "margen.php";
		include "loop.php"; ?>
	</div>
</div>
	<?php endwhile;

	/* Restore original Post Data 
	 * NB: Because we are using new WP_Query we aren't stomping on the 
	 * original $wp_query and it does not need to be reset.
	*/
	wp_reset_postdata();

} else {
// if no posts in this loop

} ?>

		<div class="span1 box-margin">
			<h2><?php echo "Arte<br />Art"; ?></h2>
		</div>
		<div class="span6 box-padding box-margin">
		<div class="row">
			<div class="span1"><img src="<?php echo $genvars['blogtheme']; ?>/images/m-15m.jpg" />Titulo<br />Title</div>
			<div class="span1"><img src="<?php echo $genvars['blogtheme']; ?>/images/m-alas4.jpg" />Titulo<br />Title</div>
			<div class="span1"><img src="<?php echo $genvars['blogtheme']; ?>/images/m-amaralys.jpg" />Titulo<br />Title</div>
			<div class="span1"><img src="<?php echo $genvars['blogtheme']; ?>/images/m-antropologias.jpg" />Titulo<br />Title</div>
			<div class="span1"><img src="<?php echo $genvars['blogtheme']; ?>/images/m-carnicero.jpg" />Titulo<br />Title</div>
			<div class="span1"><img src="<?php echo $genvars['blogtheme']; ?>/images/m-arteypsicologia.jpg" />Titulo<br />Title</div>
			<div class="span1"><img src="<?php echo $genvars['blogtheme']; ?>/images/m-cartel-trozos.jpg" />Titulo<br />Title</div>
			<div class="span1"><img src="<?php echo $genvars['blogtheme']; ?>/images/m-chelis.jpg" />Titulo<br />Title</div>
		</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>

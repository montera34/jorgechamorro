<?php get_header(); ?>

<?php
// page.php loop for posts
// output: this page and its subpages
// if is a subpage, wp_redirect to parent page
$page_id = get_the_ID();
$pages_in_loop = array();
array_push($pages_in_loop,$page_id);
// getting all the subpages if any
$args = array(
	'post_type' => 'page',
	'child_of' => $page_id
);
$subpages = get_pages($args);
foreach ( $subpages as $subpage ) {
	array_push( $pages_in_loop,$subpage->ID);
}
$args = array(
	'post_type' => 'page',
	'post__in' => $pages_in_loop,
	'order' => 'ASC',
	'orderby' => 'menu_order'
);
// The Query
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
	$query_items = $the_query->found_posts;
	$query_count = 0;
	// The Loop
	while ( $the_query->have_posts() ) : $the_query->the_post();
		$query_count++;
		if ( $query_count == $query_items ) { // if last subpage ?>
		<div class="content container">
		<?php } else { ?>
		<div class="content container box-borderb">
		<?php } ?>
			<div class="row">
				<?php include "margen.php"; ?>
				<div class="span6 box-padding box-margin">
					<div class="row">
						<?php include "loop.php"; echo $loop_out; ?>
					</div>
				</div>
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

<?php get_footer(); ?>

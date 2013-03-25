<?php
// main page vars
$genvars = array(
	'blogname' => get_bloginfo('name'), // title
	'blogdesc' => get_bloginfo( 'description', 'display' ), // description
	'blogurl' => get_bloginfo('url'), // home url
	'blogtheme' => get_bloginfo('template_directory'), // theme url
);
?>

<?php
// share buttons
if ( is_single() ) {
	$tit = urlencode(get_the_title());
	$desc = urlencode(get_the_content());
	$perma = urlencode(get_permalink());
	//$perma = urlencode("http://voragine.net");
	$img = "";
?>
<div class="container">
	<div class="row">
		<div class="span6 offset1">
			<h3>Compartir<br /><span class="muted">Share</span></h3>
			<ul class="inline">
				<li><a href="http://facebook.com/sharer.php?u=<?php echo $perma ?>" target="_blank">Facebook</a></li>
				<li><a href="http://twitter.com/home?status=<?php echo $tit. " " .$perma. " by @lacascaraamarga"; ?>" target="_blank">Twitter</a></li>
				<li><a href="http://www.tumblr.com/share/link?url=<?php echo $perma. "&name=" .$tit. "&description=" .$desc; ?>" target="_blank">Tumblr</a></li>
				<li><a href="http://pinterest.com/pin/create/button/?url=<?php echo $perma. "&media=" .$img. "&description=" .$desc; ?>">Pinterest</a></li>
			</ul>
		</div>
	</div>
</div>

<? } // end share buttons
?>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="<?php echo $genvars['blogtheme']; ?>/bootstrap/js/bootstrap.min.js"></script>

<?php wp_footer(); ?>
</body>
</html>

<?php
if ( is_home() ) {
// if is home page
	$desc_es = $genvars['blogdesc'];
	$desc_en = $genvars['blogdesc'];
	$user_mail = $genvars['user_mail'];
	$user_phone = "+34 91 521 75 26";

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
?>

	<div class="span1 box-margin">
		<?php echo $margen_out; ?>
	</div>



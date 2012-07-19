<?php
/**
 * Template Name: Closeout List
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>

	<section class="grid_12 content">

		<article class="post">

			<img src="/wordpress/wp-content/themes/bikegallery/images/closeouts_short.jpg" height="250" width="960" alt="Specials and Closeouts" />

			<p>
				<em>To make room for all the new and exciting bikes coming our way, we are continuously putting older model road and mountain bikes on sale. Scroll down this page to view all our current close-out deals. For details about a particular model, its features and which Bike Gallery location has it in stock, just <a href="/locations">contact us</a> at any of our six locations.</em>
			</p>

			<p>This list was updated <b><?php echo date("F j, Y"); ?></b>. We don't sell any of the bikes listed on this site directly over the internet.</p>

			<table width="100%" border="0" cellspacing="0" cellpadding="5" style="border: 1px solid silver;">
				<thead>
					<tr>
						<td width="44%" height="30" style="text-align: center; border-right: 1px solid silver; border-bottom: 1px solid silver;"><strong>Description</strong></td>
						<td width="12%" style="text-align: center; border-right: 1px solid silver; border-bottom: 1px solid silver;"><strong>Size</strong></td>
						<td width="20%" style="text-align: center; border-right: 1px solid silver; border-bottom: 1px solid silver;"><strong>Color</strong></td>
						<td width="12%" style="text-align: center; border-right: 1px solid silver; border-bottom: 1px solid silver;"><strong>Sale</strong></td>
						<td width="12%" style="text-align: center; border-bottom: 1px solid silver;"><strong>Reg.</strong></td>

					</tr>
				</thead>

				<tbody>

<?php
$start = time();
$handle = fopen("/home/bikegallery/closeout.csv", "r");
$count = 0;
$line_of_text = fgetcsv($handle, 1024); // Drop column headings

/**************************************************************
This grabs the first line of the closeout file and puts it into
the array. It is roughly reused, so it should be a function.
NOTE: THIS REQUIRES THE FIRST ROW OF THE CLOSEOUT FILE TO HAVE
A HUMAN-READABLE DESCRIPTION! This will be fixed later.
**************************************************************/
$line_of_text = fgetcsv($handle, 1024);
$humanDesc  = $line_of_text[4];
$pieces = explode("@", $humanDesc);
$closeout = array(array('year' => $pieces[0], 'model' => $pieces[1], 'size' => array($pieces[2]), 'color' => array($pieces[3]), 'feat' => $pieces[4], 'sale' => $line_of_text[5], 'reg' => $line_of_text[6]));
if ($closeout[0]['year'] != "") { $closeout[0]['year'] = ('&rsquo;' . $closeout[0]['year']) . ' '; } // Add apostrophe to year
/*************************************************************/

while (!feof($handle) ) { // Continue to read closeout file.
	$line_of_text = fgetcsv($handle, 1024); // Functionize this (see above).
	$humanDesc  = $line_of_text[4];
	$pieces = explode("@", $humanDesc);
	if ($pieces[1] != "") { // If Chris put a description in there.
		$temparray = array('year' => $pieces[0], 'model' => $pieces[1], 'size' => array($pieces[2]), 'color' => array($pieces[3]), 'feat' => $pieces[4], 'sale' => $line_of_text[5], 'reg' => $line_of_text[6]);
		$duplicate = 0;
		if ($temparray['year'] != "") { $temparray['year'] = ('&rsquo;' . $temparray['year']) . ' '; } // Add apostrophe to year
		if ($temparray['sale'] >= $temparray['reg']) { // Check to see that sale price is less than reg price
			// Do nothing
		} else {
			if ($temparray['size'][0] == "m") { // Attach size to bikes in the matrix.
			$temparray['size'][0] = $line_of_text[7];
			}
			foreach ($closeout as $key => $value) { // Do this for every entry in $closeout:
				if (($temparray['model'] == $closeout[$key]['model']) && ($temparray['sale'] == $closeout[$key]['sale']) && ($temparray['price'] == $closeout[$key]['price']) && ($temparray['feat'] == $closeout[$key]['feat'])) { // If the incoming model is in $closeout
					$duplicate = 1;
					if (in_array($temparray['color'][0], $closeout[$key]['color'])) { // If the color is already in $closeout
					} else { // Same model, diff color
						array_push($closeout[$key]['color'], $temparray['color'][0]); // Add color to matrix
					}
					if (in_array($temparray['size'][0], $closeout[$key]['size'])) { // If the size is already in $closeout
					} else { // Same model, diff size
						array_push($closeout[$key]['size'], $temparray['size'][0]); // Add size to matrix
					}
				}
			}
			if ($duplicate == 0) {
				array_push($closeout, $temparray);
			}
		}
	}
}
fclose($handle);

$alternator = 0;
foreach ($closeout as $key => $value) {
	if ($alternator%2 == 0) { // if it's an even row
		echo "<tr bgcolor=\"#e8eff7\">"; // background is shaded
	} else { // if it's an odd row
		echo "<tr>"; // background is not shaded
	}
	$alternator++;
	print('<td style="padding:5px 6px; border-right:1px solid #ddd">' . $closeout[$key]['year'] .  $closeout[$key]['model']);
	if ($closeout[$key]['feat'] != "") {print('<br><em> - ' . $closeout[$key]['feat'] . '</em>');}
	print('</td>');
	print('<td style="padding:5px 6px; border-right:1px solid #ddd; text-align: center;">');
	foreach ($closeout[$key]['size'] as $key2 => $value2) {
		print($closeout[$key]['size'][$key2] . '<br />');
	}
	print('</td>');
	print('<td style="padding:5px 6px; border-right:1px solid #ddd">');
	foreach ($closeout[$key]['color'] as $key2 => $value2) {
		print('<div style="text-indent: -8px; padding:0px 0px 0px 8px; margin:0;">' . $closeout[$key]['color'][$key2] . '</div>');
	}
	print('</td>');
	print('<td style="text-align:center; font-weight:bold; padding:5px 6px; border-right:1px solid #ddd">$' . number_format($closeout[$key]['sale'], 2, '.', ',') . '</td>');
	print('<td style="text-align:center;"><em>$' . number_format($closeout[$key]['reg'], 2, '.', ',') . '</em></td></tr>');
}

//$start = time() - $start;
//echo('<tr colspan="5"><td>' . $start . '</td></tr>');

?>

				</tbody>
			</table>

			<p>This list was updated <b><?php echo date("F j, Y"); ?></b>. We don't sell any of the bikes listed on this site directly over the internet.</p>
		</article><!-- .post -->

	<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>

</section><!-- .grid_12 .content -->

<?php get_footer(); ?>

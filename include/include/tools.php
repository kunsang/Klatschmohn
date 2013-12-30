<?php
// check if color is dark or light
function get_brightness($hex) {
	// returns brightness value from 0 to 255

	// strip off any leading #
	$hex = str_replace('#', '', $hex);

	$c_r = hexdec(substr($hex, 0, 2));
	$c_g = hexdec(substr($hex, 2, 2));
	$c_b = hexdec(substr($hex, 4, 2));

	return (($c_r * 299) + ($c_g * 587) + ($c_b * 114)) / 1000;
}
/*
Usage: 
$color = "#******"; 
if ( get_brightness($color) > 130) // will have to experiment with this number
echo '<font style="color:black;">Black</font>'; 
else 
echo '<font style="color:white;">White</font>'; 
*/




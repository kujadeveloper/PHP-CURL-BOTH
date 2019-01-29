<?php 
	include "init.php";

	$testUrl = 'https:/www.benimislerim.com/';
	$curl = new curl($testUrl);
	$curl->filterlist(array('#'));
	$curl->explode('href="','"');
	utils::print_r($curl->explodeArray);
	utils::print_r($curl->explodeCount);
	
?>
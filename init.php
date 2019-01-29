<?php
	include "class/init.php";
	include "class/utils.php";
	include "class/security.php";
	include "class/curl.php";

	$class_security = new security();
	$posts = $class_security->post($_POST);
	$gets = $class_security->get($_GET); 
?>
<?php 
define("CS4450_PROJECT", "Steam Photo Sharer");
require("settings.php");
require('./includes/auth.php');		

try {
    $openid = new LightOpenID($SITE_HOST);
    $isValid = $openid->validate();
} catch(ErrorException $e) {
    echo $e->getMessage();
}
?>

<html>
<head>
	<title>CS 4550 Final Project</title>
	<meta name="description" content="Here you can see photos that your friends have posted from steam games! This is our final for CS4550">
	<meta name="keywords" content="Steam Photo Share, cs4550, northeastern web dev, brandon lerner, nathan heaps">
	<meta name="author" content="Nathan Heaps and Brandon Lerner">
	<meta charset="UTF-8">

	<script type="text/javascript" src="./scripts/master.js" ></script>
	<?php
	if(file_exists("./scripts/pages/" .  basename ( $_SERVER['PHP_SELF'] ) . ".js")){
		?><script type="text/javascript" src="./scripts/pages/<?php echo basename ( $_SERVER['PHP_SELF'] );?>.js"></script><?php
	}
	?>
	<link rel="stylesheet" type="text/css" href="./css/master.css" />
	<?php
	if(file_exists("./css/pages/" .  basename ( $_SERVER['PHP_SELF'] ) . ".css")){
		?><link rel="stylesheet" type="text/css" href="./css/pages/<?php echo basename ( $_SERVER['PHP_SELF'] );?>.css" /><?php
	}
	?>
</head>
<body>
	<div id="pageWrapper">
		<header>
			
			This is the header
		</header>

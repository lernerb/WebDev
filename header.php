<?php 
define("CS4450_PROJECT", "Steam Photo Sharer");
require_once("./settings.php");
require_once('./includes/auth.php');		
require_once("./includes/steamgames.php");

// try {
//     $openid = new LightOpenID($SITE_HOST);
//     $openid->validate();
// } catch(ErrorException $e) {
//     echo $e->getMessage();
// }


?>

<html>
<head>
	<title><?php echo $SITE_NAME ?></title>
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
		<div id="headerWrapper" class="cf">
			<header>
				<div id="headerLinks" class="cf">
					<?php if ($auth->isLoggedIn()){ ?>
						Hello, <?php echo $auth->getUserData()->steamID ?><br>
						<a class="logoutBtn" href="javascript:void();">Logout</a>

					<?php } else { ?>

						<div id="login">
							<a  class="loginBtn" >
								<img src="/img/sits_small.png" alt="Login"/>
							</a>
						</div>

					<?php } ?>

					<div id="search">
						<form action="/viewPhotos.php" method="get">
							<select id="gamesList" name="gameid">
								<option></option>
								<?php
								foreach ($steamGames as $gameID => $gameName) {

									?><option value="<?php echo $gameID;?>"<?php
										if (isset($_GET["gameid"]) &&
											$_GET["gameid"] !== "" &&
											$gameID == $_GET["gameid"]){
											echo " selected";
										}
									?>><?php echo $gameName?></option><?php
								}
								?>
							</select>

							<input type="submit" value="Go"/>
						</form>
					</div>
					

				</div>

				<a href="/" id="logo">&nbsp;</a>
			</header>
		</div>
		<div id="mainContent">

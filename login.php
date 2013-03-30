<?php
$cs4450_project="Steam Photo Sharer";
require("settings.php");
include("header.php");

?>

<div id="cray">

	<?php
	# Logging in with Steam accounts requires setting special identity, so this example shows how to do it.
	require('./includes/auth.php');
	try {
	    $openid = new LightOpenID($SITE_HOST);

	    if ((!$openid->mode) || (!$openid->validate()) || ($openid->mode == 'cancel')){
    		?>
			<form action="login.php" method="POST">
			    <button>Login with Steam</button>
			</form>
			<?php
	    }
	    if(!$openid->mode) {
	        if(isset($_GET['login'])) {
	            $openid->identity = 'http://steamcommunity.com/openid';
	            header('Location: ' . $openid->authUrl());
	        }

	    } elseif($openid->mode == 'cancel') {
	        echo 'User has canceled authentication!';
	    } else {
	        echo 'User ' . ($openid->validate() ? $openid->identity . ' has ' : 'has not ') . 'logged in.';
	    }
	} catch(ErrorException $e) {
	    echo $e->getMessage();
	}
	?>
</div>



<?php

include("footer.php");

?>
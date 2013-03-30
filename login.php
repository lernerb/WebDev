<?php
define("CS4450_PROJECT", "Steam Photo Sharer");
require("settings.php");
include("header.php");

?>

<div id="datshitcray">

	<?php
	require('./includes/auth.php');
	try {
	    $openid = new LightOpenID($SITE_HOST);
	    $isValid = $openid->validate();

	    if ((!$openid->mode) || 
	    	($isValid == false) || 
	    	($openid->mode == 'cancel')) {
    		?>
			<form action="/login.php?login" method="get">
			    <button>Login with Steam</button>
			    <input type="hidden" name="login" value="yesplease" />
			    <?php
			    if (isset($_GET['back'])){
			    	?><input type="hidden" name="back" value="<?php echo $_GET['back']; ?>" /><?php
			    }
			    ?>
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
	    	if ($isValid){
	    		echo "Logged in..." . $openid->identity;

	    		if (isset($_GET['back'])){
	    			header('Location: ' .  $_GET['back']);
	    		}
	    	} else {
	    		echo "User not logged in.";
	    	}
	        //echo 'User ' . ($openid->validate() ? $openid->identity . ' has ' : 'has not ') . 'logged in.';
	    }
	} catch(ErrorException $e) {
	    echo $e->getMessage();
	}
	?>
</div>



<?php

include("footer.php");

?>
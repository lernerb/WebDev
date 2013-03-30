<?php
include("header.php");
require("./includes/steamgames.php");
?>

INDEX PAGE BITCH.<br><br>


    <select id="gamesList">
		<option></option>
    	<?php
    	foreach ($steamGames as $gameID => $gameName) {

    		?><option value="<?php echo $gameID;?>"><?php echo $gameName?></option><?php
    	}
    	?>
    </select>


<?php


include("footer.php");

?>
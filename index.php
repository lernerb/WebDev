<?php
include("header.php");
?>

GO TO GAME<br><br>

	<form action="/viewPhotos.php" method="get">
		<select id="gamesList" name="gameid">
			<option></option>
			<?php
			foreach ($steamGames as $gameID => $gameName) {

				?><option value="<?php echo $gameID;?>"><?php echo $gameName?></option><?php
			}
			?>
		</select>

		<input type="submit"/>
	</form>


<?php


include("footer.php");

?>
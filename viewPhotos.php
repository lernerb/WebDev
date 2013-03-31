<?php
include("header.php");

do{
if(!isset($_GET['gameid'])){
	echo "You must select a game!";
	break;
}
?>


You selected <?php
echo $steamGames[$_GET['gameid']]; ?>


<br><br>PHOTOS GO HERE!

<?php
}while(false);
include("footer.php");

?>
<?php
include("header.php");

do{
if(!isset($_GET['gameid']) || $_GET['gameid']==""){
	echo "You must select a game!";
	break;
}
?>


You selected <?php
echo $steamGames[$_GET['gameid']]; ?>

<div id="images">



<?php

$files = glob("uploads/*");
for ($i=1; $i < count($files); $i++)
{
	
	$num = $files[$i];
	$str = basename($num);
	
	echo '<a href="/viewPhoto.php?photo_id='.$str.'" title="We should replace this with the vf the image">';
	echo '<img src="'.$num.'" alt="random image" />'."<br /><br />";
}

?>

</a>


<?php
}while(false);
include("footer.php");

?>
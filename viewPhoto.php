<?php
include("header.php");

?>

Page coming soon<br><br>


<?php
echo $_GET['photo_id'];
?>

<div id="image">

<?php

$str = $_GET['photo_id'];
	
echo '<a href="/viewPhoto.php?photo_id='.$str.'" title="We should replace this with the vf the image">';
echo '<img src="/uploads/'.$str.'" alt="random image" />'."<br /><br />";


?>

</a>



<?php

include("footer.php");

?>
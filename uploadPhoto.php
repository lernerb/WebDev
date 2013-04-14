<?php
include("header.php");


if ($auth->isLoggedIn()){

?>

UPLOAD FORM HERE

<?php } else {  ?>


You need to be logged in in order to upload photos!

Please <a class="loginBtn" href="javascript:void()">Login</a>!



<?php
}
include("footer.php");

?>
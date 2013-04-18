<?php
include("header.php");
require_once("./includes/queries.php");

?>


<div id="image">
    
<?php
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWD, $DB_NAME);
/* check connection */
if (mysqli_connect_errno()) {
    die("Connection to database failed:" . mysqli_connect_error());
    exit();
}
if ($stmt = $mysqli->prepare($queryArray['getPhotoByID'])){
	$stmt->bind_param('i', $_GET['photo_id']); 
    $stmt->execute();
    $stmt->bind_result($id, $unique_id, $uploader_id, $game_id, $title, $description, $deleted, $uploaded, $modified);

    while ($stmt->fetch()) {
        ?>
            <a href="/viewPhoto.php?photo_id=<?php echo $id; ?>">
                <img src = "/uploads/<?php echo $unique_id; ?>"/>
            </a>

        <?php
    }

    $stmt->close();

}
$mysqli->close();

?>

</div>



<?php

include("footer.php");

?>
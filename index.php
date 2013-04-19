<?php
include("header.php");
require_once("./includes/queries.php");


?>

<p>
	Welcome to Steam Photo Share. Here you can login with steam and 
	share photos from your favorite moments in-game.
</p>

<p>
	You must sign in with a Steam Community ID to upload, comment and rate photos. 
</p>

<div id="images">
<?php
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWD, $DB_NAME);
/* check connection */
if (mysqli_connect_errno()) {
    die("Connection to database failed:" . mysqli_connect_error());
    exit();
}
if ($stmt = $mysqli->prepare($queryArray['getMostRecentPhotos'])){
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
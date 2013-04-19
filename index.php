<?php
include("header.php");
require_once("./includes/queries.php");


?>

<div class="page_info">
    <div class="title">
        <?php echo "Recent Uploads" ?>
    </div>
</div>

<?php if ($auth->isLoggedIn()){ ?>
<p>
	Welcome to Steam Photo Share. Here you can login with steam and 
	share photos from your favorite moments in-game.
</p>

<p>
	You must sign in with a Steam Community ID to upload, comment and rate photos. 
</p>

<?php } ?>

<div id="images" class="cf">
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
             <a class="image" href="/viewPhoto.php?photo_id=<?php echo $id; ?>">

                <img src = "/uploads/<?php echo $unique_id; ?>"/>
                <div class="info">
                    <div class="title"><?php echo $title; ?></div>
                    <div class="author">By <?php echo $auth->getUserName( $uploader_id ); ?></div>
                </div>
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
<?php
include("header.php");
require_once("./includes/queries.php");

?>



    
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
    //only need 1
    $stmt->fetch()?>
    <div id="image_wrapper" class="cf">
        <?php
            if ($uploader_id == $auth->getUserId()){
                ?>
                    <div class="delete_btn btn red">Delete</div>
                <?php
            }
        ?>
        <div class="title">
            <?php echo $title; ?>
        </div>
        <div class="author">
            By <?php echo $auth->getUserName( $uploader_id ); ?>
        </div>
        <div class="image">
            <a href="/uploads/<?php echo $unique_id; ?>">
                <img src = "/uploads/<?php echo $unique_id; ?>"/>
            </a>
        </div>
        <div class="adtl_info">
            <div class="date">Uploaded <?php echo $uploaded; ?></div>
            <div class="desc"><?php echo str_replace("\n", "<br>", $description); ?></div>
        </div>
    </div>  

    <?php
    $stmt->close();

}
$mysqli->close();

?>





<?php

include("footer.php");

?>
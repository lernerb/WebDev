<?php
include("header.php");
require_once("./includes/queries.php");

do{
if(!isset($_GET['gameid']) || $_GET['gameid']==""){
	echo "You must select a game!";
	break;
}

$page=1;
if (isset($_GET['page']) && !empty($_GET['page']) &&
    is_numeric($_GET['page'])){
    $page = $_GET['page'];
}
$start =($page*$PICS_PER_PAGE)-$PICS_PER_PAGE;
$fin = ($page*$PICS_PER_PAGE);

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWD, $DB_NAME);
/* check connection */
if (mysqli_connect_errno()) {
    die("Connection to database failed:" . mysqli_connect_error());
    exit();
}

$totalPics = 0;
if ($stmt = $mysqli->prepare($queryArray['getTotalNumPhotos'])){
    $stmt->bind_param('i', $_GET['gameid']); 
    $stmt->execute();
    $stmt->bind_result($totalPics);
    $stmt->fetch();
    $stmt->close();

}
$pageCount = ceil($totalPics/$PICS_PER_PAGE);


?>
<div class="page_info">
    <div class="title">
        <?php echo $steamGames[$_GET['gameid']]; ?> images
    </div>
    <div class="page">
        Page <?php echo $page; ?> of <?php echo $pageCount ?>
    </div>
</div>



<div id="images" class="cf">

<?php


if ($stmt = $mysqli->prepare($queryArray['getPhotosByGameID'])){
	$stmt->bind_param('iii', $_GET['gameid'], $start, $fin); 
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

<?php if($pageCount > 1){ ?>
<div class="pagination cf">
    <?php if ($page < $pageCount){ ?>    
    <a href="/viewPhotos.php?gameid=<?php
        echo $_GET['gameid']; ?>&page=<?php echo $page+1;
    ?>" class="btn green next">Next &gt;&gt;</a>
    <?php } 
    if ($page > 1){ ?>
        <a href="/viewPhotos.php?gameid=<?php
            echo $_GET['gameid']; ?>&page=<?php echo $page-1;
        ?>" class="btn green prev">&lt;&lt; Prev</a>
    <?php } ?>
    
</div>


<?php
}
}while(false);
include("footer.php");

?>
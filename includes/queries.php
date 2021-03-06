<?php
###################################
# DB Query List file
###################################
if (!defined("CS4450_PROJECT")){
    die("hacking attempt");
}
require_once("./settings.php");

$queryArray = Array(
    'getPhotoByID' => 'SELECT * FROM photos WHERE id = ? and deleted = "0"',
    'getMostRecentPhotos' => 'SELECT * FROM photos WHERE deleted = "0" ORDER BY id DESC Limit 0, '. $PICS_PER_PAGE,
    'getPhotosByGameID' => 'SELECT * FROM photos WHERE game_id = ? and deleted = "0" ORDER BY id DESC Limit ?, ?',
    'getTotalNumPhotos' => 'SELECT COUNT(*) FROM photos WHERE game_id = ? and deleted = "0"',
    'getLivePhotosByUser' => 'SELECT * FROM photos WHERE uploader_id = ? and deleted = "0"',
    'deletePhotoByID' => 'UPDATE photos SET deleted= "1", modified=NOW() WHERE id = ?',
    'insertPhotoToDB' => 'INSERT INTO photos (unique_id, uploader_id, game_id, title, description, uploaded , modified) VALUES (?,?,?,?,?,NOW(),NOW())'
    );

?>
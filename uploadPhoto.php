<?php
include("header.php");


if ($auth->isLoggedIn()){

    if (isset($_POST) && isset($_POST['photo_unique_id']) && !empty($_POST['photo_unique_id'])){
        require_once ("./includes/validate.class.php");
        require_once ("./includes/queries.php");

        $v = new validate();

        $v->validateStr($_POST['photo_unique_id'],"photo ID", 13, 13);
        $v->validateStr($_POST['photo_uploader_id'], "user ID", 6, 20);
        $v->validateStr($_POST['photo_name'], "photo name", 1, 324);
        $v->validateStr($_POST['photo_desc'], "photo description", 0, 1024);
        $v->validateKeyInArr($_POST['photo_game_id'], "game", $steamGames);

        if ($v->hasErrors()){
            ?>
                <script type="text/javascript">
                var hasErrors=true;
                <?php if (isset($_POST['photo_unique_id']) && !empty($_POST['photo_unique_id'])){ ?>
                var photo_unique_id = "<?php echo $_POST['photo_unique_id']; ?>";
                <?php }  
                if (isset($_POST['photo_game_id']) && !empty($_POST['photo_game_id'])){ ?>
                var photo_game_id = "<?php echo $_POST['photo_game_id']; ?>";
                <?php }  
                if (isset($_POST['photo_name']) && !empty($_POST['photo_name'])){ ?>
                var photo_name = "<?php echo $_POST['photo_name']; ?>";
                <?php }  
                if (isset($_POST['photo_desc']) && !empty($_POST['photo_desc'])){ ?>
                var photo_desc = "<?php echo $_POST['photo_desc']; ?>";
                <?php }  ?>
                var errorListHTML = "<?php echo addslashes($v->displayErrors()); ?>";
                </script>
            <?php
        } else {
            echo '<script type="text/javascript">
                var hasErrors=false;</script>';
            //open up a connection to the DB, save it and redirect to the photo page
            $mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASSWD, $DB_NAME);
            /* check connection */
            if (mysqli_connect_errno()) {
                die("Connection to database failed:" . mysqli_connect_error());
                exit();
            }
            $stmt = $mysqli->prepare($queryArray['insertPhotoToDB']);

            $escapedTitle = htmlspecialchars($_POST['photo_name']);
            $escapedDesc = htmlspecialchars($_POST['photo_desc']);
            $stmt->bind_param('ssiss', 
                              $_POST['photo_unique_id'], 
                              $_POST['photo_uploader_id'], 
                              $_POST['photo_game_id'],
                              $escapedTitle,
                              $escapedDesc);
            $stmt->execute();

            if ( $stmt->affected_rows == 0 ){
                echo "Failed to insert row into database";
            } else {
                //close the connection and navigate to the page!
                $photo_id = $mysqli->insert_id;
                $stmt->close();
                $mysqli->close();

                header('Location: /viewPhoto.php?photo_id=' . $photo_id);
            }

        }



    }
    ?>

    <div id="step1">
        <div id="upload"></div>
    </div>
    <div id="step2" style="display:none;">
        <div id="errors"></div>
        <form action="/uploadPhoto.php" method="POST" id="photo_info">
            <img id="photo_img"/>
            <input type="hidden" name="photo_unique_id" id="photo_unique_id"/> 
            <input type="hidden" name="photo_uploader_id" id="photo_uploader_id" value="<?php echo $auth->getUserId() ?>"/>
            <input type="text" name="photo_name" id="photo_name" class="required" maxlength="324" minlength="1" size="50"/>
            <textarea name="photo_desc" id="photo_desc" class="required" maxlength="1024" minlength="1" cols="80" rows="5"></textarea>

            <select id="photo_game_id" name="photo_game_id" class="required" >
                <option></option>
                <?php
                foreach ($steamGames as $gameID => $gameName) {

                    ?><option value="<?php echo $gameID;?>"<?php
                        if (isset($_GET["gameid"]) &&
                            $_GET["gameid"] !== "" &&
                            $gameID == $_GET["gameid"]){
                            echo " selected";
                        }
                    ?>><?php echo $gameName?></option><?php
                }
                ?>
            </select>
            <input type="submit" />
        </form>
    </div>

    <?php 
} else {  ?>


You need to be logged in in order to upload photos!

Please <a class="loginBtn" href="javascript:void()">Login</a>!



<?php
}
include("footer.php");

?>
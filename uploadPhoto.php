<?php
include("header.php");


if ($auth->isLoggedIn()){

    if (isset($_POST) && isset($_POST['photo_unique_id']) && !empty($_POST['photo_unique_id'])){
        require_once ("./includes/validate.class.php");
        require_once ("./includes/queries.php");

        $v = new validate();

        $v->validateStr($_POST['photo_unique_id'],"photo ID", 11, 11);
        $v->validateStr($_POST['photo_uploader_id'], "user ID", 6, 15);
        $v->validateStr($_POST['photo_name'], "photo name", 1, 324);
        $v->validateStr($_POST['photo_desc'], "photo description", 0, 1024);
        $v->validateInArr($_POST['photo_game_id'], "game", $steamGames);

        if ($v->hasErrors()){
            ?>
                <script type="text/javascript">
                var hasErrors=true;
                <?php if (isset($_POST['photo_unique_id']) && !empty($_POST['photo_unique_id'])){ ?>
                var photo_id = <?php echo $_POST['photo_unique_id']; ?>;
                <?php }  ?>
                </script>
            <?php
        }



    } else {
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

            <select id="photo_game_id" name="photo_game_id">
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

    <?php }
} else {  ?>


You need to be logged in in order to upload photos!

Please <a class="loginBtn" href="javascript:void()">Login</a>!



<?php
}
include("footer.php");

?>
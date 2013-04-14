<?php
require_once("header.php");

?>

<div id="datshitcray">
    <?php 



    if(isset($_GET['login'])) {
        $auth->login();
        //don't do the nav in here since login() needs to do special things first (yay oauth)
    }
    if(isset($_GET['logout'])) {
        $auth->logout();
        if (isset($_GET['back'])){
            header('Location: ' .  $_GET['back']);
        }   
    }

    
    if ($auth->isLoggedIn()){ 

        if (isset($_GET['back'])){
            header('Location: ' .  $_GET['back']);
        }   
        ?>
        <form action="/debug.php" method="get">
            <input type="submit" value="Logout" />
            <input type="hidden" name="logout" value="yesplease" />
            <?php
            if (isset($_GET['back'])){
                ?><input type="hidden" name="back" value="<?php echo $_GET['back']; ?>" /><?php
            }
            ?>
        </form>
    <?php
    } else { 
    ?>
        <form action="/debug.php" method="get">
            <input type="submit" value="Login with steam" />
            <input type="hidden" name="login" value="yesplease" />
            <?php
            if (isset($_GET['back'])){
                ?><input type="hidden" name="back" value="<?php echo $_GET['back']; ?>" /><?php
            }
            ?>
        </form>
    <?php 
    }



    if (isset($_SESSION)){
        var_dump($_SESSION);
    }
    ?>
    <br><hr><br>
    <?php
    if ($auth->isLoggedIn()){
        var_dump ( $auth->getUserData());
    }
    ?>

</div>



<?php

include("footer.php");

?>
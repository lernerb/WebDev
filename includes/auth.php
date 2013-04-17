<?php
require_once("./settings.php");
require_once("./includes/lightopenid/openid.php");
require_once("./includes/SteamAPI/SteamUser.php");

class Auth{

    private $openid,
            $api_key,
            $provider = 'http://steamcommunity.com/openid';
    function __construct($host, $api_key){
        try {
            $this->openid = new LightOpenID($host);
            $this->openid->identity = $this->provider;
            $this->api_key = $api_key;

            session_start();
        } catch(ErrorException $e) {
            echo $e->getMessage();
        }

    }

    /**
     * Starts the login process with the openID provider
     *
     * @param $returnUrl, the url to return to after login, defaults to current page.
     * @return void (does not return, redirects to openID provider)
     */
    function login($returnUrl=""){
        $success = true;
        if ((isset($_SESSION['login_started']) && $_SESSION['login_started'] == true)){
            return $this->finishLogin();
        } elseif ($this->isLoggedIn()){
            return true;
        }
        $_SESSION['login_started']=true;

        if (!empty($returnUrl)){
            $this->openid->returnUrl = $returnUrl;
        }

        header('Location: ' . $this->openid->authUrl());
        //unreachable
        return $success;
    }

    /**
     * Finishes the login after return from openID login page
     *
     * @return true if login was successful
     */
    function finishLogin(){
        //do some cleanup
        unset ($_SESSION['login_started']);

        //check to make sure the login was successful
        if(!$this->openid->mode){
            //not sure how we got here, but they aren't logged in, return false
            return false;
        } elseif ($this->openid->mode == 'cancel'){
            //user canceled, return false
            return false;
        } elseif ($this->openid->validate()) {
            //user attempted to login and the library validated that they are authed
            //set the session data
            $_SESSION['identity']=$this->openid->identity;
            preg_match('/^http:\/\/steamcommunity\.com\/openid\/id\/(?P<id>\d+)$/', 
                       $_SESSION['identity'],
                       $_SESSION['user_id']);
            $_SESSION['user_id']=$_SESSION['user_id']['id'];


            $_SESSION['logged_in']=true;
            return true;
        } else {
            return false;
        }

    }

    /**
     * Logs out
     *
     * @return true if login was successful
     */
    function logout(){
        $success = true;
        unset ($_SESSION['login_started']);
        unset ($_SESSION['logged_in']);
        unset ($_SESSION['identity']);
        unset ($_SESSION['user_id']);

        //restart the session so we can continue to use the $_SESSION variable
        $success &= session_destroy();
        session_start();
        $_SESSION["logged_in"] = false;
        return $success;
    }

    /**
     * Returns if a user is logged in
     *
     * @return true if login was successful
     */
    function isLoggedIn(){

        if (isset($_SESSION['logged_in'])){
            return $_SESSION['logged_in'];
        } else {
            return false;
        }
    }

    /**
     * Gets user data from steam community
     *
     * @return true if login was successful
     */
    function getUserData(){
        if (!($this->isLoggedIn() && isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))){
            throw new Exception("Not actually logged in");
        }

        $user = new SteamUser($_SESSION['user_id'], $this->api_key);
        return $user;
    }

    /**
     * Gets the user ID from the session variable
     *
     * @return int the logged in user's ID
     */
    function getUserId(){
        if ($this->isLoggedIn() && isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
            return $_SESSION['user_id'];
        }
        return "";
        
    }

    /**
     * Translate's a user's ID to a user name
     *
     * @return string the specified user's username
     */
    function getUserName($id){
        $user = new SteamUser($id, $this->api_key);
        return $user->steamID;
        
    }
}




$auth = new Auth($SITE_HOST, $steam['api_key']);
?>
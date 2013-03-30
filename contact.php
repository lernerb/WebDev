<?php
include("header.php");
 
if(isset($_POST['submit'])) {
   
  include('validate.class.php');
   
  //assign post data to variables 
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $message = trim($_POST['message']);


  //start validating our form
  $v = new validate();
  $v->validateStr($name, "name", 3, 75);
  $v->validateEmail($email, "email");
  $v->validateStr($message, "message", 5, 1000);
 
 
  if(!$v->hasErrors()) {
        $header = "From: $email\n" . "Reply-To: $email\n";
        $subject = "LAN Center Reservation Form";
        $email_to = $email;
		
        $emailMessage = "Hello " . $name . ",\n\n"; 

        $url = "http". ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
        header('Location: '.$url."?sent=yes");
        @mail($email_to, $subject ,$emailMessage ,$header );  
		}
    } else {
    //set the number of errors message
    $message_text = $v->errorNumMessage();       
 
    //store the errors list in a variable
    $errors = $v->displayErrors();
     
    //get the individual error messages
    $nameErr = $v->getError("name");
    $emailErr = $v->getError("email");
    $messageErr = $v->getError("message");
  }//end error check
}// end isset



?>

Page coming soon<br><br>

<div id="contactFormWrapper">
    <form id="contactForm" method="post" action="/contact.php">
      <p><label>Name:<br />
      <input type="text" name="name" class="textfield" value="<?php echo htmlentities($name); ?>" />
      </label><br /><span class="errors"><?php echo $nameErr; ?></span></p>
       
      <p><label>Email: <br />
      <input type="text" name="email" class="textfield" value="<?php echo htmlentities($email); ?>" />
      </label><br /><span class="errors"><?php echo $emailErr ?></span></p>          
	
      <p><label>Message: <br />
      <textarea name="message" class="textarea" cols="45" rows="5"><?php echo htmlentities($message); ?></textarea>
      </label><br /><span class="errors"><?php echo $messageErr ?></span></p>
       
      <p><input type="submit" name="submit" class="button" value="Submit" /></p>
    </form>
</div>


<?php

include("footer.php");

?>
<?php
include_once('includes/connection.php');
session_start();
if(!isset($_GET['token'])){
    header('Location:account.php');
}
$password = "";
$confirm_password = "";
$message = "";
$passErr = "";
$token = $_GET['token'];
$email = $_GET['email'];
$subject = "";
$email_message = "";
$from = '';
$to = '';
$sub = '';
$headers = '';
$body = "";
$mail = "";



if(isset($_POST['reset']) && isset($_GET['token'])){
    $password = mysqli_real_escape_string($db, md5($_POST['password']));
    $confirm_password = mysqli_real_escape_string($db, md5($_POST['confirm_password']));
    
    if($password != $confirm_password){
        $passErr = "<div class='error'>Passwords do not match!</span>";
    }
    
    
    $select = mysqli_query($db, "SELECT * FROM guest_table WHERE token = '$token'");
    
    if($select && !$passErr){
    
    /* This sends a notification mail to the client that password has been reset */
    $subject = "Message from Foodies";
    $email_message = "Your password has been successfully changed!";
    $from = 'Foodies Website';
    $sender = "From:phpwebtestmail@gmail.com";
    $to = $email;
    $sub = 'Successful Password Reset';
    $headers = $from . "\r\n";
    $headers .= $to . "\r\n";
    $headers .= $sub . "\r\n";
    $body = "From: $from\nSubject: $subject\nHeading: $sub\nMessage: $email_message";
    $mail = mail($to, $headers, $body, $sender); // sending the email
        
        
        if($mail){
             mysqli_query($db, "UPDATE guest_table SET password='$password', token='' WHERE email = '$email'");
            $message = "<div class='success'>Congratulations, your password has been reset!</div>";
        }else{
            $message = "<div class='error'>Failed!</div>";    
        }
        
    }elseif($select && !$passErr){
        $message = "<div class='error'>Passwords do not match!</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
            <?php include_once('includes/head.php');?>
            <title>Foodie Account</title>
    </head>
    <body>
        
            <!-- This keeps the header menu in the header_menu.php file to avoid repitition of codes -->
            <?php include_once('includes/header_menu.php');?>
            
            
            <div class="feedback-container">
                <div class="feedback-forms-container">
                    <div class="feedback-title">Foodies - Reset Password</div>
                    <?php
                        if(!empty($emailErr)){echo $emailErr; }
                        if(!empty($message)){echo $message; }
                    ?>
                    <div class="feedback-form">
                        <form action="" method="post">
                            <h2>Reset Your Password</h2>
                            <div class="form-group">
                            <input type="password" name="password" placeholder="Enter Password" required>
                            </div>
                            <div class="form-group">
                            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="reset">Submit</button>
                            </div>
                        </form>
                            <div class="forgotten-password"><a href="account.php"> &larr; Back to login</a>
                            </div>
                    </div>
                </div>
            </div>    
            <!-- <div class="see-more">
                <a href="food.php">See More</a>
            </div> -->
            <!-- New Section container -->
                <?php
                    include_once('includes/footer.php');
                ?>
            <!-- New Section container -->
         <script>
    var url = 'https://wati-integration-service.clare.ai/ShopifyWidget/shopifyWidget.js?66316';
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = url;
    var options = {
  "enabled":true,
  "chatButtonSetting":{
      "backgroundColor":"#f4a003",
      "ctaText":"Live Chat",
      "borderRadius":"25",
      "marginLeft":"0",
      "marginBottom":"50",
      "marginRight":"50",
      "position":"right"
  },
  "brandSetting":{
      "brandName":"Foodies",
      "brandSubTitle":"Food away from home",
      "brandImg":"https://danein.com/foodies/assets/css/images/rest.jpg",
      "welcomeText":"Hi there!\nMessage from foodies!",
      "messageText":"Hello, I have a question about your foodies website",
      "backgroundColor":"#f4a003",
      "ctaText":"Start Chat",
      "borderRadius":"25",
      "autoShow":true,
      "phoneNumber":"447443738070"
  }
};
    s.onload = function() {
        CreateWhatsappChatWidget(options);
    };
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);
</script>   
        <script type="text/javascript" src="assets/js/style.js"></script>
    </body>
</html>
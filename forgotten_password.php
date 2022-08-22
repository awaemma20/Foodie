<?php
include_once('includes/connection.php');
session_start();

$email = "";
$emailErr = "";
$token = "";
$mail = "";
$token_shuffle = "";
$headers = '';
$body = "";
$from = '';
$to = '';
$sub = '';
$subject = "";



if(isset($_POST['reset'])){
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $token = "qwertyuiopasdfghjklzxcvbnm1234567890@%&!";
    $token_shuffle = str_shuffle($token);
    
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $emailErr = "<div class='error'>E-mail is invalid</div>";
    }
    
    $select = mysqli_query($db, "SELECT * FROM guest_table WHERE email = '$email'");
    $num = mysqli_num_rows($select);
    
    if($num == 1 && !$emailErr){
    
    /* This is for the guest  email content */
    $subject = "Password Reset Link";
    $email_message = "http://localhost/foodie/password.php?email={$email}&&token={$token_shuffle}";
    $from = 'Foodies Website';
    $sender = "From:phpwebtestmail@gmail.com";
    $to = $email;
    $sub = 'Password Reset Message From Foodies, click the link below to reset your password';
    $headers = $from . "\r\n";
    $headers .= $to . "\r\n";
    $headers .= $sub . "\r\n";
    $body = "From: $from\nSubject: $subject\nHeading: $sub\nMessage: $email_message";
    $mail = mail($to, $headers, $body, $sender); // sending the email        
        
        
        if($mail){
            mysqli_query($db, "UPDATE guest_table SET token = '$token_shuffle' WHERE email = '$email'");
            $message = "<div class='success'>Please visit {$email} to reset password!</div>";
        }else{
            $message = "<div class='error'>Failed!</div>";    
        }
        
    }elseif($num != 1 && !$emailErr){
        $message = "<div class='error'>Please ensure your email exists, thanks!</div>";
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
                    <div class="feedback-title">Foodies - Password Reset</div>
                    <?php
                        if(!empty($emailErr)){echo $emailErr; }
                        if(!empty($message)){echo $message; }
                    ?>
                    <div class="feedback-form">
                        <form action="" method="post">
                            <h2>Reset Your Password</h2>
                            <div class="form-group">
                            <input type="email" name="email" placeholder="Enter Email" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="reset">Reset</button>
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
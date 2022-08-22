<?php
include_once('includes/connection.php');
session_start();
$fulname = "";
$email = "";
$heading = "";
$message_box = "";
$message = "";
$read_status = "";
$emailErr = "";
$subject = "";
$email_message = "";
$from = '';
$to = '';
$sub = '';
$headers = '';
$body = "";
$mail = "";
$owner_email_message = "";
$owner_mail = "";
$owner_subject = "";
$owner_headers = '';
$owner_body = "";
$owner_from = '';
$owner_to = '';
$owner_sub = '';

if(isset($_POST['submit'])){
    $fulname = mysqli_real_escape_string($db, $_POST['fulname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $heading = mysqli_real_escape_string($db, ($_POST['heading']));
    $message_box = mysqli_real_escape_string($db, nl2br($_POST['message_box']));
    $read_status = 0;
    

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $emailErr = "<div class='error'>E-mail is invalid</div>";
    }

    $select = mysqli_query($db, "SELECT * FROM feedback_table WHERE fulname='$fulname' && email = '$email' && heading = '$heading' && message = '$message_box'");
    $num = mysqli_num_rows($select);
    
    if($num != 1 && !$emailErr){
        
    $subject = "Message from Foodies";
    $email_message = "You sent us a feedback message, we are looking into the content of your feedback and will respond!";
    $from = 'Foodies Website';
    $sender = "From:phpwebtestmail@gmail.com";
    $to = $email;
    $sub = 'On ' . $heading;
    $headers = $from . "\r\n";
    $headers .= $to . "\r\n";
    $headers .= $sub . "\r\n";
    $body = "From: $from\nSubject: $subject\nHeading: $sub\nMessage: $email_message";
    $mail = mail($to, $headers, $body, $sender); // sending the email
        
        
    
    /* This is for the guest  email content */
    $owner_subject = "One New Feedback Notification";
    $owner_email_message = "This is just to notify you that {$email}, has just sent you a feedback message, visit your admin dashboard to view message!";
    $owner_from = 'Foodies Website';
    $owner_sender = "From:phpwebtestmail@gmail.com";
    $owner_to = "phpwebtestmail@gmail.com";
    $owner_sub = 'Feedback Notification from ' . $email;
    $owner_headers = $from . "\r\n";
    $owner_headers .= $to . "\r\n";
    $owner_headers .= $sub . "\r\n";
    $owner_body = "From: $owner_from\nSubject: $owner_subject\nHeading: $owner_sub\nMessage: $owner_email_message";
    $owner_mail = mail($owner_to, $owner_headers, $owner_body, $owner_sender); // sending the email
        
        
        
        if($mail && $owner_mail){
            mysqli_query($db, "INSERT INTO feedback_table(fulname, email, heading, message, read_status)VALUES('$fulname', '$email', '$heading', '$message_box', '$read_status')");
            $message = "<div class='success'>Your message has been sent successfully, we will get back to you via your email!</div>";
        }else{
            $message = "<div class='error'>Failed!</div>";
        }
        
    }elseif($num == 1 && !$emailErr){
        $message = "<div class='error'>We've already received your complaint, we are working on your request!</div>";
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
                    <div class="feedback-title">Foodies - Feedback</div>
                    <?php
                        if(!empty($emailErr)){echo $emailErr; }
                        if(!empty($message)){echo $message; }
                    ?>
                        <div class="feedback-form">
                            <form action="" method="post">
                            <h2>Let us get your feedback</h2>
                            <div class="form-group">
                                <input type="text" name="fulname" placeholder="Full Name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="E-mail" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="heading" placeholder="Message Heading">
                            </div>
                            <div class="form-group">
                                <textarea name="message_box" placeholder="Enter Message"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit">Submit</button>
                            </div>
                            </form>
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
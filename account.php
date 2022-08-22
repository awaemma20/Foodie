<?php
include_once('includes/connection.php');
session_start();
$username = "";
$email = "";
$password = "";
$cpassword = "";
$message = "";
$emailErr = "";
$passErr = "";

if(isset($_POST['register'])){
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, md5($_POST['password']));
    $cpassword = mysqli_real_escape_string($db, md5($_POST['cpassword']));

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $emailErr = "<div class='error'>E-mail is invalid</div>";
    }
    if($password != $cpassword){
        $passErr = "<div class='error'>Passwords do not match!</div>";
    }

    $select = mysqli_query($db, "SELECT * FROM guest_table WHERE email = '$email' ||  username = '$username' LIMIT 1");
    $num = mysqli_num_rows($select);

    if($num != 1 && !$emailErr && !$passErr){
        mysqli_query($db, "INSERT INTO guest_table(username, email, password )VALUES('$username', '$email', '$password')");
        $message = "<div class='success'>User Added Successfully!</div>";
        $_SESSION['user'] = $username;
        header('Location:checkout.php');
    }elseif($num == 1 && !$emailErr && !$passErr){
        $message = "<div class='error'>Sorry, this user already exists!</div>";
    }

}




if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, md5($_POST['password']));

    $select = mysqli_query($db, "SELECT * FROM guest_table WHERE username = '$username' && password = '$password' LIMIT 1");
    $num = mysqli_num_rows($select);

    if($num == 1){
        $_SESSION['user'] = $username;
        header('Location:checkout.php');
    }elseif($num != 1){
        $message = "<div class='error'>Sorry, this user does not exist!</div>";
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
            
            
            <div class="account-container">
                <div class="account-forms-container">
                    <div class="account-title">Foodies - Account</div>
                    <?php
                        if(!empty($emailErr)){echo $emailErr; }
                        if(!empty($passErr)){echo $passErr; }
                        if(!empty($message)){echo $message; }
                    
                        if(!empty($_SESSION['acctErr'])){
                            echo $_SESSION['acctErr'];
                            unset($_SESSION['acctErr']);
                        }
                    ?>
                        <div class="account-form">
                            <form action="" method="post">
                            <h2>Register New Account</h2>
                            <div class="form-group">
                                <label>Enter your Username</label>
                                <input type="text" name="username" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <label>Enter Your E-mail Address</label>
                                <input type="email" name="email" placeholder="E-mail" required>
                            </div>
                            <div class="form-group">
                                <label>Enter Your Password</label>
                                <input type="password" name="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label>Confirm Your Password</label>
                                <input type="password" name="cpassword" placeholder="Confirm Password">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="register">Register</button>
                            </div>
                            </form>
                        </div>
                    
                        <div class="account-form">
                            <form action="" method="post">
                            <h2>Returning Customer</h2>
                            <div class="form-group">
                                <label>Enter your Username</label>
                                <input type="text" name="username" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <label>Enter Your Password</label>
                                <input type="password" name="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="login">Login</button>
                            </div>
                            </form>
                            <div class="forgotten-password"><a href="forgotten_password.php">Forgotten Password?</a></div>
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
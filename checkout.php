<?php
include_once('includes/connection.php');
session_start();
    if(empty($_SESSION['cart'])){
        $_SESSION['emptyCartErr'] = '<div class="error">Cart is empty!</div>';
        header('Location:cart.php');
    }
    if(!empty($_SESSION['cart']) && !isset($_SESSION['user'])){
        $_SESSION['acctErr'] = '<div class="error">Please sign in first or sign up as a new user!</div>';
        header('Location:account.php');
    }else{
        if(!empty($_SESSION['cart']) && isset($_SESSION['user'])){
            $_SESSION['acctErr'] = '';
        }
    }


if((isset($_GET['action']) && $_GET['action'] == 'cancel')  && isset($_SESSION['cart'])){
    unset($_SESSION['cart']);
    $_SESSION['quantity'] = 0;
    $total = 0;
    $_SESSION['error'] = '<div class="error">All products have been removed from cart!</div>';
    header('location:cart.php');
}


$order_id = "";
$fname = "";
$lname = "";
$room_number = "";
$email = "";
$phone = "";
$food_id = "";
$username = "";
$food_price = "";
$food_quantity = "";
$rand = "0123456789";
$rand_shuffle = str_shuffle($rand);
$time = 10;
$trend = 0;
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

if(isset($_POST['order'])){
    $fname = mysqli_real_escape_string($db, $_POST['fname']);
    $lname = mysqli_real_escape_string($db, $_POST['lname']);
    $room_number = mysqli_real_escape_string($db, $_POST['room_number']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $status = 0;
    $order_id = substr($rand_shuffle, 0, 6);
    $username = $_SESSION['user'];
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $emailErr = '<div class="error">Please enter a valid mail!</div>';
    }
    
    
    if(!$emailErr){
    mysqli_query($db, "INSERT INTO order_table(order_id, fname, lname, room_number, email, phone, status, username)VALUES('$order_id', '$fname', '$lname', '$room_number', '$email', '$phone', '$status', '$username')");

    $decision = mysqli_query($db, "SELECT * from order_table WHERE status = 0");
    $num = mysqli_num_rows($decision);
    
        
    if(!empty($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $keys => $value){
            $food_id = $value['food_id'];
            $food_price = $value['food_price'];
            $food_quantity = $value['item_quantity'];
    
    $get = mysqli_query($db, "SELECT * FROM trending_table WHERE id = '$food_id'");
    $gotten = mysqli_fetch_array($get);
    
    foreach($get as $gotten){
    $trend = $food_quantity + $gotten['food_trend'];
    }    
    
    $link = "http://localhost/foodie/account.php";
    $subject = "Message from Foodies";
    $email_message = "Your order was successfully placed, we will get back to you shortly, your order id is " . $order_id . ", kinldy visit at " . $link . " your account to view order details & status.";
    $from = 'Foodies Website';
    $sender = "From:phpwebtestmail@gmail.com";
    $to = $email;
    $sub = 'Notification on order placed';
    $headers = $from . "\r\n";
    $headers .= $to . "\r\n";
    $headers .= $sub . "\r\n";
    $body = "From: $from\nSubject: $subject\nHeading: $sub\nMessage: $email_message";
    $mail = mail($to, $headers, $body, $sender); // sending the email        
            
            
    /* This is for the guest  email content */
    $owner_subject = "One New Order Notification";
    $owner_email_message = "This is just to notify you that a new order has been placed, visit your admin dashboard to order details!";
    $owner_from = 'Foodies Website';
    $owner_sender = "From:phpwebtestmail@gmail.com";
    $owner_to = "phpwebtestmail@gmail.com";
    $owner_sub = 'Order Notification from Foodies Website';
    $owner_headers = $from . "\r\n";
    $owner_headers .= $to . "\r\n";
    $owner_headers .= $sub . "\r\n";
    $owner_body = "From: $owner_from\nSubject: $owner_subject\nHeading: $owner_sub\nMessage: $owner_email_message";
    $owner_mail = mail($owner_to, $owner_headers, $owner_body, $owner_sender); // sending the email        
            
            
    mysqli_query($db, "UPDATE trending_table SET food_trend = '$trend' WHERE id = '$food_id'");
    
            
    mysqli_query($db, "INSERT INTO order_list(order_id, food_id, food_price, food_quantity)VALUES('$order_id', '$food_id', '$food_price', '$food_quantity')");
    
    $_SESSION['order_success'] = '<div class="success">Your order has been received, we will get back to you in the next ' . $time * $num . ' mins as we have ' . $num . ' orders in waiting</div>';
    unset($_SESSION['cart']);
    header('location:cart.php');
            }
        }
    }else{
        $message = "";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
            <?php include_once('includes/head.php');?>
            <title>Foodie Checkout</title>
    </head>
    <body>
        
            <!-- This keeps the header menu in the header_menu.php file to avoid repitition of codes -->
            <?php include_once('includes/header_menu.php');?>
        
            <div class="checkout-container">
                <div class="checkout-forms-container">
                    <div class="checkout-title">Foodies - Checkout</div>
                    <?php
                        if(!empty($emailErr)){echo $emailErr; }
                        if(!empty($passErr)){echo $passErr; }
                        if(!empty($message)){echo $message; }
                    ?>
                        <div class="checkout-form">
                            <form action="" method="post">
                            <h2>Guest Details</h2>
                            <?php
                            $user = $_SESSION['user'];
                            $select = mysqli_query($db, "SELECT * FROM order_table WHERE username = '$user'");
                            $selected = mysqli_fetch_array($select);
                            if($selected){
                            ?>
                            <div class="form-group">
                                <label>Enter Your First Name</label>
                                <input type="text" name="fname" value="<?php echo $selected['fname'];?>" required>
                            </div>
                            <div class="form-group">
                                <label>Enter Your Last Name</label>
                                <input type="text" name="lname" value="<?php echo $selected['lname'];?>" required>
                            </div>
                            <div class="form-group">
                                <label>Enter Your Room Number</label>
                                <input type="text" name="room_number" placeholder="Room Number" required>
                            </div>
                            <div class="form-group">
                                <label>Enter Your E-mail Address</label>
                                <input type="email" name="email" value="<?php echo $selected['email'];?>" required>
                            </div>
                            <div class="form-group">
                                <label>Enter Your Phone Number</label>
                                <input type="text" name="phone" value="<?php echo $selected['phone'];?>" required>
                            </div>
                    <?php
                                }else{
                    ?>
                                <div class="form-group">
                                <label>Enter Your First Name</label>
                                <input type="text" name="fname" placeholder="First Name" required>
                            </div>
                            <div class="form-group">
                                <label>Enter Your Last Name</label>
                                <input type="text" name="lname" placeholder="Last Name" required>
                            </div>
                            <div class="form-group">
                                <label>Enter Your Room Number</label>
                                <input type="text" name="room_number" placeholder="Room Number" required>
                            </div>
                            <div class="form-group">
                                <label>Enter Your E-mail Address</label>
                                <input type="email" name="email" placeholder="E - Mail" required>
                            </div>
                            <div class="form-group">
                                <label>Enter Your Phone Number</label>
                                <input type="text" name="phone" placeholder="Phone Number" required>
                            </div>
                    <?php
                            }
                    ?>
                            <div class="form-group">
                                <h2>Your Order Details</h2>
                                <div class="order-container">
                                    <div class="order-table">
                                        <div class='order-title'>Food Name(s)</div>
                                        <div class='order-details'>
                                            <?php
                                            if(!empty($_SESSION['cart'])){
                                                $total = 0;
                                                $total_quantity = 0;
                                                $num = 1;
                                                foreach($_SESSION['cart'] as $keys => $value){
                                                echo "(" . $num++ . ")" . " " . $value['item_name'] . " ";
                                                }
                                            }
                                            ?>  
                                        </div>
                                    </div>
                                    <div class="order-table">
                                        <div class='order-title'>Total Quantity</div>
                                        <div class='order-details'>
                                           <?php
                                            if(!empty($_SESSION['cart'])){
                                                $total = 0;
                                                $total_quantity = 0;
                                                $num = 1;
                                                foreach($_SESSION['cart'] as $keys => $value){
                                                $total_quantity = $total_quantity + ($value['item_quantity']);
                                                }
                                            }
                                                echo $total_quantity;
                                                /*
                                                if(!empty($_SESSION['total_quantity'])){
                                                    echo $_SESSION['total_quantity'];
                                                }
                                                */
                                            ?>
                                        </div>
                                    </div>
                                    <div class="order-table">
                                        <div class='order-title'>Order Total</div>
                                        <div class='order-details'>
                                            <?php
                                                if(!empty($_SESSION['total'])){
                                                    echo "<span class='currency'>N</span> " . number_format($_SESSION['total'], 2);
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="order">Place Order</button>
                                <a href="checkout.php?action=cancel" class="cancel-transaction">Cancel Order</a>
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
<?php
include_once('includes/connection.php');
session_start();

$error = "";
$success = "";

if(isset($_POST['add'])){
    if(isset($_SESSION['cart'])){
        $item_array_id = array_column($_SESSION['cart'], "food_id");
        if(!in_array($_GET['id'], $item_array_id)){
            $count = count($_SESSION['cart']);
            $item_array = array(
                'food_id' => $_GET['id'],
                'item_name' => $_POST['hidden_name'],
                'food_price' => $_POST['hidden_price'],
                'item_quantity' => $_POST['quantity'],
                'item_image' => $_POST['hidden_image'],
            );
            $_SESSION['cart'][$count] = $item_array;
            $success = '<div class="success">Food was successfully added to cart!</div>';
            $_SESSION['success'] = $success;
        }else{
             $error = '<div class="error">Food is already added to cart!</div>';
            $_SESSION['error'] = $error;
        }
    }else{
        $item_array = array(
                'food_id' => $_GET['id'],
                'item_name' => $_POST['hidden_name'],
                'food_price' => $_POST['hidden_price'],
                'item_quantity' => $_POST['quantity'],
                'item_image' => $_POST['hidden_image'],
            );
            $_SESSION['cart'][0] = $item_array;
    }
}


if(isset($_GET['action'])){
    if($_GET['action'] == 'delete'){
    foreach($_SESSION['cart'] as $keys => $value){
        if(isset($_GET['id']) && $value['food_id'] == $_GET['id']){
            unset($_SESSION['cart'][$keys]);
            $error = '<div class="error">Food has been removed from cart!</div>';
            $_SESSION['error'] = $error;
            }
        }
    }
}


if(isset($_POST['cancel']) && isset($_SESSION['cart'])){
    unset($_SESSION['cart']);
    $_SESSION['quantity'] = 0;
    $total = 0;
    $_SESSION['error'] = '<div class="error">All products have been removed from cart!</div>';
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
            <?php include_once('includes/head.php');?>
            <title>Foodie Cart</title>
    </head>
    <body>
        
            <!-- This keeps the header menu in the header_menu.php file to avoid repitition of codes -->
            <?php include_once('includes/header_menu.php');?>
        
            
            <!-- Products container -->
            <div class="food-container">
                <h3>Cart</h3>
                
                <?php
                    if(isset($_SESSION['success'])){
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    }
                    if(isset($_SESSION['error'])){
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                    if(isset($_SESSION['emptyCartErr'])){
                        echo $_SESSION['emptyCartErr'];
                        unset($_SESSION['emptyCartErr']);
                    }
                    if(isset($_SESSION['order_success'])){
                        echo $_SESSION['order_success'];
                        unset($_SESSION['order_success']);
                    }
                ?>
                
                <div class="cart-container">
                    <table>
                        <tr>
                            <th>Food Image</th>
                            <th>Food Name</th>
                            <th>Food Price</th>
                            <th>Food Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                        
                        <?php
                                
                            if(!empty($_SESSION['cart'])){
                                $total = 0;
                                $total_quantity = 0;
                                foreach($_SESSION['cart'] as $keys => $value){
                        ?>
                        
                        <tr>
                            <td class="tab-image"><img src="assets/css/images/<?php echo $value['item_image']; ?>"></td>
                            
                            <td><?php echo $value['item_name']; ?></td>
                                
                            <td><span class="currency">N</span> <?php echo number_format($value['food_price'], 2); ?></td>
                            
                            <td><?php echo $value['item_quantity']; ?></td>
                            
                            <td><span class="currency">N</span> <?php echo number_format($value['item_quantity'] * $value['food_price'], 2); ?></td>
                            
                            <td><a href="cart.php?action=delete&id=<?php echo $value['food_id']; ?>"><i class="fas fa-trash"></i></a></td>    
                        </tr>
                        
                        <?php
                                $total = $total + ($value['item_quantity'] * $value['food_price']);
                                $_SESSION['total'] = $total;
                                
                                $total_quantity = $total_quantity + ($value['item_quantity']);
                                $_SESSION['total_quantity'] = $total_quantity;
                          }     
                            }else{
                             echo  "<tr>
                            <td class='cart-notification' colspan='6' style='text-align: left; padding:30px; font-size:14px; font-family: Montserrat-Regular; color:rgba(0, 0, 0, 0.5);'>Nothing has been entered into cart </td></tr>";   
                            }          
                        ?>
                    </table>
                </div>
                
                <div class="cart-total-table">
                    <div class="cart-total-heading">
                        Cart Total
                    </div>
                    <div class="cart-total-content">
                        Total: &nbsp; <span class="currency">N</span>
                        <?php 
                            if(!empty($total)){echo number_format($total, 2);}else{echo 0;}
                        ?>
                    </div>
                    <div class="cart-total-button">
                        <a href="food.php" class="continue-shopping">CONTINUE SHOPPING</a>
                        <a href="checkout.php" class="checkout-btn">PROCEED TO CHECKOUT</a>
                        <form method="post" action='cart.php'>
                        <button name="cancel" class="cancel-btn" type="submit">EMPTY CART</button>
                        </form>
                    </div>
                </div>
                
            </div>
            <!-- End Products container -->
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
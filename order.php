<?php
include_once('includes/connection.php');
session_start();
if(!isset($_SESSION['user'])){
    header('Location:account.php');
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
            <?php include_once('includes/head.php');?>
            <title>Foodies My Account</title>
    </head>
    <body>
        
            <!-- This keeps the header menu in the header_menu.php file to avoid repitition of codes -->
            <?php include_once('includes/header_menu.php');?>
        
            
            <!-- Products container -->
            <div class="food-container">
                <h3><?php echo $_SESSION['user']; ?> - All Order</h3>
                
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
                            <th># Id</th>
                            <th>Order Id</th>
                            <th>Order Amount</th>
                            <th>Order Quantity</th>
                            <th>Order Date</th>
                            <th>Order Time</th>
                            <th>Order Status</th>
                            <th>Cancel</th>
                        </tr>
                        <?php
                            if(isset($_SESSION['user'])){
                                $user = $_SESSION['user'];
                                $choose = mysqli_query($db, "SELECT * FROM order_table WHERE username = '$user'");
                                $chosen = mysqli_fetch_array($choose);
                                $i = 1;
                                if($chosen){
                                    foreach($choose as $chosen){
                                    $order_id = $chosen['order_id']; 
                        ?>
                        
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo "FD - " . $order_id;?></td>
                                <td>
                                    <?php
                                    $select = mysqli_query($db, "SELECT * FROM order_list WHERE order_id = '$order_id'");
                                    $selected = mysqli_fetch_assoc($select);
                                        if($selected){
                                            $total = 0;
                                            $quantity = 0;
                                            foreach($select as $selected){
                                            $total = $total + ($selected['food_quantity'] * $selected['food_price']);
                                            $quantity = $quantity + $selected['food_quantity'];
                                            }
                                        }
                                    ?>
                                    <?php echo "<span class='currency'>N</span> " . number_format($total, 2) ?>
                                </td>
                                <td><?php echo $quantity ?></td>
                                <td><?php echo date('d-m-Y', strtotime($chosen['time']));?></td>
                                <td><?php echo date('h:i:s a', strtotime($chosen['time']));?></td>
                                <?php
                                  if($chosen['status'] == 0){      
                                ?>
                                <td><a href="reciept.php?order_id=<?php echo $chosen['order_id'];?>" class="pending-status">Pending</a></td>
                                <?php    
                                  }elseif($chosen['status'] == 1){
                                ?>
                                <td><a href="reciept.php?order_id=<?php echo $chosen['order_id'];?>" class="confirmed-status">Confirmed</a></td>
                                <?php
                                  }elseif($chosen['status'] == 2){
                                ?>
                                <td><a href="reciept.php?order_id=<?php echo $chosen['order_id'];?>" class="delivered-status">Delivered</a></td>
                                <?php
                                  }
                                ?>
                                <td>
                                    <?php 
                                      if($chosen['status'] == 2){
                                          echo "Done";
                                    ?>
                                    <?php
                                        }else{
                                    ?>
                                    <a href="delete_order.php?action=delete&order_id=<?php echo $order_id; ?>" onclick="return confirm('Are you sure you want to cancel this order?')"><i class="fas fa-trash"></i></a>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                                    }
                                }else{
                            ?>
                                <tr>
                                    <td colspan="2">You have place no orders!</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                        <?php
                                }
                            }
                        ?>
                    </table>
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
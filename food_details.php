<?php
    include_once('includes/connection.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once('includes/head.php');?>
        <title>Foodie - Food Details</title>
    </head>
    <body>
        
        <!-- This keeps the header menu in the header_menu.php file to avoid repitition of codes -->
            <?php include_once('includes/header_menu.php');?>
        
        <div class="product-details-overlay">
            <div class="product-details-box">
                <div class="image-display">
                    <?php
                        if(isset($_GET['id'])){
                            $food_id = $_GET['id'];

                            $select = mysqli_query($db, "SELECT * FROM food_table WHERE id = '$food_id'");
                            $selected = mysqli_fetch_array($select);
                            if($selected){        
                    ?>
                    <img src="assets/css/images/<?php echo $selected['food_image']; ?>" alt=""/>
                </div>
                
                <div class="details-display">
                    <div class="details-display-header">
                        
                    <a class='back-btn' href="index.php#categories">&larr; Home / <span><?php echo $selected['food_name'] ?></span></a>
                        
                    <h2><?php echo $selected['food_name'] ?></h2>
                        
                    <h3><span class="currency">N</span> <?php echo number_format($selected['food_price'], 2); ?>    
                    </h3>
                        
                    <p><strong>Availability</strong>: <?php echo $selected['status'] ?></p>
                        
                    <p><strong>Category</strong>: <?php echo $selected['food_category'] ?></p>
                        
                        
                    <form method="post" action="cart.php?action=add&id=<?php echo $selected['id']; ?>">
                        
                        <div class="form-group">
                            <input type="number" min="1" max="<?php if(isset($selected['food_quantity'])){ echo $selected['food_quantity']; }?>" value="1" name="quantity">
                            
                            <input type="hidden" value="<?php echo $selected['food_name'] ?>" name="hidden_name">
                            <input type="hidden" value="<?php echo $selected['food_image'] ?>" name="hidden_image">
                            <input type="hidden" value="<?php echo $selected['food_price'] ?>" name="hidden_price">
                            <button type="submit" name="add">ADD TO CART</button>
                        </div>
                        
                    </form>
                        
                        <h2>Description</h2> 
                        <p><?php echo $selected['food_description'];?></p>    
                    </div>
                </div>
                
                <?php
                            }
                        }                
                ?>
                
            </div>
        </div>
        <!-- <a href="#" class="live-chat-btn"><i class="fas fa-comment-dots"></i>&nbsp; Live Chat</a>-->
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
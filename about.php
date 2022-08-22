<?php
include_once('includes/connection.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
            <?php include_once('includes/head.php');?>
            <title>Foodie About</title>
    </head>
    <body>
        
            <!-- This keeps the header menu in the header_menu.php file to avoid repitition of codes -->
            <?php include_once('includes/header_menu.php');?>
            
            
            <div class="about-container">
                <div class="about-title-box">
                    <div class="about-overlay">
                        <h1>FOODIES - ABOUT</h1>
                    </div>
                    <div class="about-content">
                        <?php
                            $select = mysqli_query($db, "SELECT * FROM about_desc_table");
                            $selected = mysqli_fetch_array($select);
                            if($selected){
                        ?>
                        <div class="about-heading"><?php echo $selected['about_heading'];?></div>
                        <div class="about-description"><?php echo $selected['about_description'];?></div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                
                           <!-- <div class="see-more">
                <a href="food.php">See More</a>
            </div> -->
            </div>
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
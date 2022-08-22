<?php
include_once('includes/connection.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            //This keeps all the linked css and javascript in head.php file
            include_once('includes/head.php');
        ?>
        <title>Welcome to Foodie</title>
    </head>
    <body>
        
        <!-- This is the header, it carries the menu and welcome message -->
        <div class="header-container">
            <!-- This keeps the header menu in the header_menu.php file to avoid repitition of codes -->
            <?php include_once('includes/header_menu.php');?>
            <!-- The below container carries the welcome message, title and explore button -->
            <div class="header-message">
                <div class="message-center">
                <h1 class="welcome-message">WELCOME TO FOODIES</h1>
                <p class="title-tag">FOOD AWAY FROM HOME</p>
                <a href="#section-two" class="explore-btn">EXPLORE</a>
                </div>
            </div>
        </div>
        
        <!-- This container displays the different social media platforms-->
        <div class="section-two" id="section-two">
            <a href="#" class="social-links"><i class="fab fa-facebook"></i></a>
            <a href="#" class="social-links"><i class="fab fa-twitter"></i></a>
            <a href="#" class="social-links"><i class="fab fa-whatsapp"></i></a>
            <a href="#" class="social-links"><i class="fab fa-instagram"></i></a>
        </div>
        
        <!-- The section carries all the top/trending food to make users choice faster and easier -->
        <div class="section-three">
        			<h1 class="trending">Top Purchase</h1>
        			<hr class="cross-line">
        			<p class="trending-message">Three most demanded meals, just a click to order.</p>
                    
                    <?php
                    //This line of code helps to select the categories of food that are trending and they are no more than three
            
                        $select = mysqli_query($db, "SELECT * FROM  trending_table ORDER BY food_trend DESC LIMIT 6");
                        $selected = mysqli_fetch_assoc($select);
                        foreach($select as $selected){
                            $choose = mysqli_query($db, "SELECT * FROM food_table WHERE id = '{$selected['id']}'");
                            $chosen = mysqli_fetch_assoc($choose);
                            if($chosen){
                    ?>
        			<div class="trending-container">
        				<img src="assets/css/images/<?php echo $chosen['food_image'];?>" alt="food" class="food-img">
        					<span class="product-name"><?php echo $chosen['food_name'];?></span>
        					<span class="price"><?php echo "₦ " . number_format($chosen['food_price'], 2);?></span>
        					<div class="trending-overlay">
        					<a href="food_details.php?id=<?php echo $chosen['id'];?>" class="add-to-cart">ORDER NOW</a>
        					</div>
        			</div>
                    <?php
                            }
                        }
                    ?>
        </div>
        	
        	<!-- This container carries the available foods -->
        	<div class="section-four" id="categories">
        			<h1 class="trending">Available Today</h1>
        			<hr class="cross-line">
        			<p class="trending-message">Select category to get your available food preference</p>
                
                <!-- This container carries the different food categories and shows results as per selection -->
        			<div class="categories-box">
        				 <a href="index.php#categories" class="cart-link active">All Cate</a>
                        <?php
                            $select = mysqli_query($db, "SELECT * FROM categories_tab");
                            $selected = mysqli_fetch_assoc($select);
                            foreach($select as $selected){
                        ?>
        				 <a href="index.php?category=<?php echo $selected['categories_name'];?>#categories" class="cart-link "><?php echo $selected['categories_name'];?></a>
                        <?php
                        }
                        ?>
        			</div>
                    
                <?php
                        //This is used to display food result based on categories selected.
                        if(isset($_GET['category']) && $_GET['category'] != ''){
                        $category = $_GET['category'];
                        $select = mysqli_query($db, "SELECT * FROM  food_table WHERE food_category = '$category' && status = 'available' ORDER BY food_name ASC LIMIT 12");
                        $selected = mysqli_fetch_assoc($select);
                        foreach($select as $selected){
                ?>
                    <div class="available-container">
        				<img src="assets/css/images/<?php echo $selected['food_image'];?>" alt="food" class="food-img">
        					<span class="product-name"><?php echo $selected['food_name'];?></span>
        					<span class="price"><?php echo "₦ " . number_format($selected['food_price'], 2);?></span>
        					<div class="available-overlay">
        					<a href="food_details.php?id=<?php echo $selected['id'];?>" class="add-to-cart">ORDER NOW</a>
        					</div>
                    </div>
                <?php
                        //This displays all categories of food if no selection is made category wise
                        }
                    }elseif(!isset($_GET['category'])){
                        $select = mysqli_query($db, "SELECT * FROM food_table WHERE status = 'available' ORDER BY food_name ASC LIMIT 12");
                        $selected = mysqli_fetch_assoc($select);
                        foreach($select as $selected){
                ?>
                        <div class="available-container">
        				<img src="assets/css/images/<?php echo $selected['food_image'];?>" alt="food" class="food-img">
        					<span class="product-name"><?php echo $selected['food_name'];?></span>
        					<span class="price"><?php echo "₦ " . number_format($selected['food_price'], 2);?></span>
        					<div class="available-overlay">
        					<a href="food_details.php?id=<?php echo $selected['id'];?>" class="add-to-cart">ORDER NOW</a>
        					</div>
                        </div>
                <?php
                        }
                    }
                ?>
        	</div>
        	<!-- <div class="see-more">
                <a href="food.php">See More</a>
            </div> -->
            <!--<a href="#" class="live-chat-btn"><i class="fas fa-comment-dots"></i>&nbsp; Live Chat</a>-->
            <?php
                include_once('includes/footer.php');
            ?>
        
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
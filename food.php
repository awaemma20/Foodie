<?php
include_once('includes/connection.php');
session_start();

if(isset($_GET['page']) && $_GET['page'] != ""){
    $page = $_GET['page'];
}else{
    $page = 1;
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
            <?php include_once('includes/head.php');?>
            <title>Foodie Shop</title>
    </head>
    <body>
        
            <!-- This keeps the header menu in the header_menu.php file to avoid repitition of codes -->
            <?php include_once('includes/header_menu.php');?>
        
            <div class="shop-container">
                <div class="food-shop-container">
                    <a href="index.php">&larr; Home</a>
                    <h1>Foods</h1>
                    <div class="search-form-container">
                        <form action="search.php" method="post">
                            <input type="text" name="search_field" required placeholder="Search">
                            <button type="submit" name="search"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <div class="cate-container">
                        <h3 class='cat-heading'>Categories</h3>
                        <a href="food.php?categories=all" class='cat-link' id="cat-link-active">All Foods</a>
                        <?php
                            $select = mysqli_query($db, "SELECT * FROM categories_tab ORDER BY categories_name ASC");
                            $selected = mysqli_fetch_assoc($select);
                            foreach($select as $selected){
                                $link_page = $selected['categories_name'];
                        ?>
                            <a href="food.php?categories=<?php echo $selected['categories_name'];?>" class='cat-link'><?php echo $selected['categories_name'];?></a>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="cate-container-food">
                        <?php
                            if(isset($_GET['categories'])){
                                echo "<h3 class='cat-heading'>Categories - {$_GET['categories']}</h3>";
                            }else{
                                echo "<h3 class='cat-heading'>Categories - All</h3>";
                            }
                        ?>
                        <?php
                            if(isset($_GET['categories']) && $_GET['categories'] != "all"){
                                $categories = $_GET['categories'];
                                
                                $pick = mysqli_query($db, "SELECT * FROM food_table WHERE food_category = '$categories' ORDER BY food_name ASC");
                                $picked = mysqli_fetch_assoc($pick);
                                foreach($pick as $picked){
                        ?>
                        <div class="food-display-boxes">
                            <div class="image-holder">
                                <img src="assets/css/images/<?php echo $picked['food_image']?>" alt="food-image">
                            </div>
                            <div class="name-holder">
                                <?php echo $picked['food_name'];?>
                            </div>
                            <div class="price-holder">
                                <span class="currency">N</span> <?php echo number_format($picked['food_price'], 2);?>
                            </div>
                            <div class="link-holder">
                                <a href="food_details.php?id=<?php echo $picked['id']?>">Add to Cart</a>
                            </div>
                        </div>
                        <?php
                                }
                            }elseif((isset($_GET['categories']) && $_GET['categories'] == "all") || !isset($_GET['categories'])){
                                $pick = mysqli_query($db, "SELECT * FROM food_table ORDER BY food_name ASC");
                                $picked = mysqli_fetch_assoc($pick);
                                foreach($pick as $picked){
                        ?>
                        <div class="food-display-boxes">
                            <div class="image-holder">
                                <img src="assets/css/images/<?php echo $picked['food_image']?>" alt="food-image">
                            </div>
                            <div class="name-holder">
                                <?php echo $picked['food_name'];?>
                            </div>
                            <div class="price-holder">
                                <span class="currency">N</span> <?php echo number_format($picked['food_price'], 2);?>
                            </div>
                            <div class="link-holder">
                                <a href="food_details.php?id=<?php echo $picked['id']?>">Add to Cart</a>
                            </div>
                        </div>
                            <?php
                                    }
                                }
                            ?>
                            <div class="navs-btn">
                                
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
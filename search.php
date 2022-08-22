<?php
include_once('includes/connection.php');
session_start();
if(!isset($_POST['search'])){
    header('location:food.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
            <?php include_once('includes/head.php');?>
            <title>Foodie Search Result</title>
    </head>
    <body>
        
            <!-- This keeps the header menu in the header_menu.php file to avoid repitition of codes -->
            <?php include_once('includes/header_menu.php');?>
        
            <div class="shop-container">
                <div class="food-shop-container">
                    <a href="food.php">&larr; Foods</a>
                    <h1>Search Result</h1>
                    <div class="search-form-container">
                        <form action="search.php" method="post">
                            <input type="search" name="search_field" required placeholder="Search">
                            <button type="submit" name="search"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <div class="cate-container">
                        <h3 class='cat-heading'>Categories</h3>
                        <a href="food.php?categories=all" class='cat-link' id="cat-link-active">All Foods</a>
                        <?php
                            $select = mysqli_query($db, "SELECT * FROM categories_tab");
                            $selected = mysqli_fetch_assoc($select);
                            foreach($select as $selected){
                        ?>
                            <a href="food.php?categories=<?php echo $selected['categories_name'];?>" class='cat-link'><?php echo $selected['categories_name'];?></a>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="cate-container-food">
                        <?php
                            if(isset($_POST['search'])){
                                echo "<h3 class='cat-heading'>Categories - {$_POST['search_field']}</h3>";
                                $search = mysqli_real_escape_string($db, $_POST['search_field']);
                                
                                $pick = mysqli_query($db, "SELECT * FROM food_table WHERE food_name LIKE '%$search%' || food_category LIKE '%$search%'");
                                
                                $num = mysqli_num_rows($pick);
                                if($num == 1){
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
                                }else{
                                    echo "<div class='error'>Sorry, the searched food isn't available!</div>";
                                }
                            }
                        ?>
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
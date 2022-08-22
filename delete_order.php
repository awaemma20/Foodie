<?php
include_once('includes/connection.php');
session_start();
if(!isset($_SESSION['user'])){
    header('Location:account.php');
}

if(isset($_GET['action']) && $_GET['action'] == "delete"){
if(isset($_GET['order_id'])){
    $user_order_id = $_GET['order_id'];
    
    mysqli_query($db, "DELETE FROM order_table WHERE order_id = $user_order_id");

    mysqli_query($db, "DELETE FROM order_list WHERE order_id = $user_order_id");

    $_SESSION['success'] = "<div class='success'>Order has been deleted!</div>";
    header('location: order.php');
}
}
?>
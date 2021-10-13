<?php
require 'includes/common.php';
if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $item_id=$_GET['id'];
    $user_id=$_SESSION['user_id'];
    $query="DELETE from orders where product_id='$item_id' && user_id='$user_id'";
    $result= mysqli_query($con, $query) or die("couldn't delete");
    header("location:cart.php");
}
?>



<?php
require 'db_connect.php';
session_start();

if (isset($_GET['cart_id'])) {
    $cart_id = $_GET['cart_id'];
    $delete_sql = "DELETE FROM cart WHERE id = $cart_id";
    mysqli_query($conn, $delete_sql);
}
header('Location: cart.php');
exit();
?>

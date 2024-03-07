<?php 
include "connect.php";
  if(isset($_GET['id'])) {
    // Handle the value of id as we can't get it directly from url
    $id = $connection->real_escape_string($_GET['id']);

    $sql = "DELETE FROM `products` WHERE id = $id";

    if($connection->query($sql)) {
        echo "Successfully deleted ";
    } else {
        echo "Failed to delete";
    }

    header("Location: view_products.php");
    exit();
  }
?>
<?php
include "connect.php";
  $fetch_data = mysqli_query($connection, "SELECT * FROM `cart`");
  
?>
<header class="header">
        <div class="header_body">
            <a href="index.php" class="logo">Tech</a>
            <nav class="navbar">
                <a href="index.php">Add Products</a>
                <a href="view_products.php">View Products</a>
                <a href="shop_products.php">Shop</a>
            </nav>
            <a href="cart.php" class="cart"><i class="fa-solid fa-cart-shopping"></i><span><sup><?php echo mysqli_num_rows($fetch_data); ?></sup></span></a>
            <!-- <div id="menu_btn" class="fas fa-bars"> -->

            </div>
        </div>
    </header>

<?php
include "connect.php";
if (isset($_POST['add_to_cart'])) {
    $products_name = $_POST['product_name'];
    $products_price = $_POST['product_price'];
    $products_image = $_POST['product_image'];
    $product_quantity = 1;
    // Don't Repeat Data
    $repeated_Date = mysqli_query($connection, "SELECT * FROM `cart` WHERE name = '$products_name'");
    if (mysqli_num_rows($repeated_Date) > 0) {
        $displayed_message =  "product has already added to cart";
    } else {
        // insert in cart table
        $insert_products = mysqli_query($connection, "INSERT INTO `cart` (name, price, image, quantity) VALUES ('$products_name', '$products_price', '$products_image', $product_quantity)");
        $displayed_message =  "Product Added to cart";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopify</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mogra&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php include "header.php"; ?>
    <div class="container">
        <?php
        if (isset($displayed_message)) {
            echo "<div class='display_message'>
                    <span>$displayed_message</span>
                    <i class='fa-solid fa-xmark' onclick='this.parentElement.style.display=`none`'></i>
                </div>";
        }

        ?>
        <section class="products">
            <h1 class="heading">Shopify </h1>
            <div class="product_container">
                <?php
                $select_products = mysqli_query($connection, "SELECT * from `products`");
                if (mysqli_num_rows($select_products) > 0) {
                    while ($fetch_product = mysqli_fetch_assoc($select_products)) {
                ?>
                        <form action="" method="post">
                            <div class="edit_form">
                                <img src="images/<?php echo $fetch_product['image'] ?>" alt="">
                                <h3><?php echo $fetch_product['name'] ?></h3>
                                <div class="price">Price : <?php echo $fetch_product['price'] ?> $</div>
                                <input type="hidden" name="product_name" value="<?php echo  $fetch_product['name']; ?>">
                                <input type="hidden" name="product_price" value="<?php echo  $fetch_product['price']; ?>">
                                <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                                <input type="submit" class="submit_btn cart_btn" value="Add to Cart" name="add_to_cart">
                            </div>
                        </form>
                <?php
                    }
                } else {
                    echo "<div class='empty_text'>No Products Available</div>";
                }
                ?>

            </div>
        </section>
    </div>
</body>

</html>
<?php
include "connect.php";
// Inserting 
if (isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'images/' . $product_image;

    $insert_query = mysqli_query($connection, "INSERT INTO `products` (name, price, image)  VALUES('$product_name', '$product_price', '$product_image')") or die("Failed");
    if ($insert_query) {
        move_uploaded_file($product_image_tmp, $product_image_folder);
        $displayed_message = "$product_name Inserted Successfully";
    } else {
        $displayed_message = "Failed to Insert $product_name";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Card</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mogra&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php include "header.php";
    ?>
    <div class="container">
        <?php
        if (isset($displayed_message)) {
            echo "<div class='display_message'>
            <span>$displayed_message</span>
            <i class='fa-solid fa-xmark' onclick='this.parentElement.style.display=`none`'></i>
        </div>";
        }
        ?>


        <section>
            <h3 class="heading">Add Products</h3>
            <form action="" class="add_product" method="post" enctype="multipart/form-data">
                <input name="product_name" type="text" placeholder="Enter Product Name" required class="input_fields">
                <input name="product_price" type="number" min="0" required class="input_fields" required placeholder="Enter Product Price">
                <input name="product_image" type="file" required class="input_fields" accept="image/png, image/jpg, image/jpeg">
                <input name="add_product" type="submit" value="Add Product" class="submit_btn" required>
            </form>
        </section>
    </div>
    <script src="js/main.js"></script>
</body>

</html>
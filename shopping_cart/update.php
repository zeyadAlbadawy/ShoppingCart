<?php include"connect.php";
  if(isset($_POST['submit'])) {
    $update_product_id = $_POST['update_product_id'];
    $update_product_name = $_POST['update_product_name'];
    $update_product_price = $_POST['update_product_price'];
    $update_product_image = $_FILES['update_product_image']['name'];
    $product_image_tmp = $_FILES['update_product_image']['tmp_name'];
    $update_product_image_folder = 'images/' . $update_product_image;

    // Update
    $update_query = "UPDATE `products` SET name='$update_product_name', price='$update_product_price', image='$update_product_image' WHERE id='$update_product_id'";
    if (mysqli_query($connection, $update_query)) {
        if(isset($_FILES['update_product_image'])) {
            move_uploaded_file($product_image_tmp, $update_product_image_folder);
        }
        echo "Done !";
        header('Location: view_products.php');
    } else {
        echo "Failed";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Products</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mogra&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php include "header.php";
    

    if (isset($_GET['id'])) {
        $id = $connection->real_escape_string($_GET['id']);
        $edit_query = mysqli_query($connection,  "SELECT * FROM `products` WHERE id = $id");
        if (mysqli_num_rows($edit_query) > 0) {
            $row= mysqli_fetch_assoc($edit_query);
    ?>
            <form action="" method="post" class="update_product product_container_box" enctype="multipart/form-data">
                <img src="images/<?php echo $row['image']; ?>" alt="">
                <input type="hidden" value="<?php echo $row['id']; ?>" name="update_product_id">
                <input type="text" class="input_fields fields" required value="<?php echo $row['name']; ?>" name="update_product_name">
                <input type="number" class="input_fields fields" required value="<?php echo $row['price']; ?>" name="update_product_price">
                <input type="file" class="input_fields fields"  accept="image/png, image/jpg, image/jpeg" name="update_product_image" >
                <div class="btns">
                    <input type="submit" class="edit_btn" value="Update" name="submit">
                    <a href="view_products.php" class="cancel_btn">Cancel</a>
                </div>
            </form>
    <?php
        }
    }
    ?>
</body>

</html>
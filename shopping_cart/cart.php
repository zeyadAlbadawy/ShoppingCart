<?php
include "connect.php";
$fetch_data = mysqli_query($connection, "SELECT * FROM `cart`");
if (isset($_POST['update_btn'])) {
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $update_quantity = mysqli_query($connection, "update `cart` set quantity = $update_value WHERE id = $update_id");
    if ($update_quantity) {
        header("Location:cart.php");
    }
}

if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    $delete_elm = mysqli_query($connection, "DELETE FROM `cart` WHERE id = $id");
}

if(isset($_GET['delete_all'])) {
    mysqli_query($connection, "DELETE FROM `cart`");
    header("Location: cart.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mogra&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php include "header.php"; ?>
    <div class="container">
        <section class="shopping_cart">
            <h1 class="heading">My Cart</h1>
            <?php
            $num = 1;
            $total_price = 0;
            if (mysqli_num_rows($fetch_data) > 0) {

                echo "<table>
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Product Price</th>
                                <th>Product Quantity</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
        ";
                while ($fetch_row = mysqli_fetch_assoc($fetch_data)) {
            ?>
                    <tr>
                        <td><?php echo $num++; ?></td>
                        <td><?php echo $fetch_row['name']; ?></td>
                        <td><img src="images/<?php echo $fetch_row['image']; ?>" alt=""></td>
                        <td><?php echo $fetch_row['price']; ?></td>
                        <td>
                            <form method="post">
                                <input name="update_quantity_id" type="hidden" value="<?php echo $fetch_row['id']; ?>">
                                <div class="quantity_box">
                                    <input name="update_quantity" type="number" min="1" value="<?php echo $fetch_row['quantity'] ?>">
                                    <input type="submit" class="update_quantity" value="Update" name="update_btn" style="cursor: pointer;">
                                </div>
                            </form>
                        </td>
                        <td>$<?php
                                echo number_format($fetch_row['quantity'] * $fetch_row['price']);
                                ?>
                        </td>
                        <td>
                            <a onclick="return confirm('Are you sure you wanna delete <?php echo $fetch_row['name']; ?>')" href="cart.php?remove=<?php echo $fetch_row['id'] ?>"><i class="fas fa-trash"></i> Remove</a>
                        </td>
                    </tr>
            <?php
                    $total_price = $total_price + $fetch_row['quantity'] * $fetch_row['price'];
                }
            } else {

                echo "<div class='empty_text'>Cart is Empty</div>";
            }
            ?>
            </tbody>
            </table>
            <?php
            if ($total_price > 0) {
                echo "
                <div class='table_bottom'>
                <a href='shop_products.php' class='bottom_btn'>
                    Continue Shopping
                </a>
                <h3 class='bottom_btn'> Grand total: $ $total_price<span> 
                </span></h3>
                <a href='checkout.php' class='bottom_btn'>Proceed to checkout</a>
            </div>";
            ?>
                <a href='cart.php?delete_all' class='delete_all_btn'>
                    <i class='fas fa-trash'></i>
                    Delete All
                </a>
            <?php
            } else {
                echo "";
            }
            ?>


        </section>
    </div>
</body>

</html>
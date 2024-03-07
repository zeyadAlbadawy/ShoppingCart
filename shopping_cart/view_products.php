<?php include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mogra&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <?php
    include "header.php";

    ?>

    <div class="container">
        <section class="display_product">
            <table>

                <tbody>
                    <?php
                    $sql = "SELECT * FROM `products`";
                    $res = $connection->query($sql);
                    $num = 1;
                    if ($res->num_rows > 0) {
                        echo "<thead>
                        <th>Serial Number</th>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Action</th>
                    </thead>";
                        while ($row = $res->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?php echo $num++; ?> </td>
                                <td><img src="images/<?php echo $row['image'] ?>" alt="<?php echo $row['name'] ?>"> </td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['price'] ?></td>
                                <td><a href="delete.php?id=<?php echo $row['id'] ?>" class="delete_product_btn" onclick="return confirm('Are you sure you wanna delete <?php echo $row['name'] ?> ')"> <i class="fa-solid fa-trash-can"></a></i>
                                    <a href="update.php?id=<?php echo $row['id'] ?>" class="update_product_btn"> <i class="fa-solid fa-pen-to-square"></i></a>
                                </td>

                            </tr>
                    <?php
                        }
                    } else {
                        echo "<div class='empty_text'>No Products Available</div>";
                    }
                    ?>

                </tbody>
            </table>
        </section>
    </div>
</body>

</html>
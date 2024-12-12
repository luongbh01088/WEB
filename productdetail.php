<?php
    include "Connect.php";

    // Lấy `id` sản phẩm từ URL
    $product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Truy vấn để lấy thông tin sản phẩm
    $sql = "SELECT * FROM Product WHERE product_id = $product_id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        $name = $product['name'];
        $description = $product['description'];
        $price = $product['price'];
        $stock_quantity = $product['stock_quantity'];
        $image_url = $product['image_url'];
    } else {
        echo "<p>Product not found!</p>";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="detail.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="logo">
            <h1>Men's Fashion Store</h1>
        </div>

        <!-- Navigation Bar -->
        <nav>
            <ul>
            <li><a href="home.php">Home</a></li>
                <li><a href="#productdetail.php">Product Details</a></li>
                <li><a href="cart.php">My Cart</a></li>
                <li><a href="contact.php">Contacts</a></li>
                <li><a href="login.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- Product Details Section -->
    <section class="product-details">
        <div class="product-info">
            <h2><?php echo htmlspecialchars($name); ?></h2>
            <img src="images/<?php echo htmlspecialchars($image_url); ?>" alt="<?php echo htmlspecialchars($name); ?>">
            <p><?php echo htmlspecialchars($description); ?></p>
            <p><b>Price: <?php echo number_format($price, 0, ',', '.'); ?> VNĐ</b></p>
            <p>Available Stock: <?php echo $stock_quantity; ?></p>

            <form action="cart.php" method="POST">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" value="1" min="1" max="<?php echo $stock_quantity; ?>">
                <button type="submit" class="btn btn-success">Add to Cart</button>
            </form>
        </div>

        <!-- Back to Home Link -->
        <a href="home.php" class="back-link">Back to Home</a>
    </section>

    <!-- Footer Section -->
    <footer>
        <div class="footer-content">
            <p>&copy; 2024 Men's Fashion Store. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>

<?php
    include "Connect.php";
    // Query to fetch products from the new table
    $sql = "SELECT * FROM Product LIMIT 6";
    $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Men's Fashion Store</title>
    <link rel="stylesheet" href="home.css">
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

    <!-- Main Section (Products) -->
    <section class="products">
        <h2>Featured Products</h2>
        <div class="product-container">
            <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row_product = mysqli_fetch_assoc($result)) {
                        $product_id = $row_product['product_id'];
                        $name = $row_product['name'];
                        $description = $row_product['description']; 
                        $price = $row_product['price'];
                        $image_url = $row_product['image_url'];
            ?>
            <form class="single_product" action="cart.php" method="POST">
                <h3><?php echo htmlspecialchars($name); ?></h3>
                <img src="images/<?php echo htmlspecialchars($image_url); ?>" alt="<?php echo htmlspecialchars($name); ?>">
                <p><?php echo htmlspecialchars($description); ?></p>
                <p><b>Price: <?php echo number_format($price, 0, ',', '.'); ?> USD</b></p>
                <a href="productdetail.php?id=<?php echo $product_id ?>" class="btn btn-info">Details</a>
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn btn-success">Add to Cart</button>
            </form>
            <?php
                    }
                } else {
                    echo "<p>No products found.</p>";
                }
                mysqli_close($conn);
            ?>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <div class="footer-content">
            <p>&copy; 2024 Men's Fashion Store. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>

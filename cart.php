<?php
session_start();

// Initialize the cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle adding product to cart
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'], $_POST['quantity'])) {
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    // Check if the product is already in the cart
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    } else {
        include "Connect.php";
        $sql = "SELECT * FROM Product WHERE product_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $product_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row_product = mysqli_fetch_assoc($result)) {
            $_SESSION['cart'][$product_id] = [
                'name' => $row_product['name'],
                'price' => $row_product['price'],
                'quantity' => $quantity,
                'image_url' => $row_product['image_url']
            ];
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}

// Handle removing a product
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    unset($_SESSION['cart'][$product_id]);
}

// Display the cart
$total = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="cart.css">
</head>

<body>
    <header>
        <div class="logo">
            <h1>Men's Fashion Store</h1>
        </div>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="#productdetail.php">Product Details</a></li>
                <li><a href="#cart.php">My Cart</a></li>
                <li><a href="contact.php">Contacts</a></li>
                <li><a href="login.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Your Cart</h1>
        <?php if (!empty($_SESSION['cart'])): ?>
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart'] as $id => $product): ?>
                        <tr>
                            <td><img src="images/<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>"></td>
                            <td><?php echo htmlspecialchars($product['name']); ?></td>
                            <td><?php echo number_format($product['price'], 0, ',', '.'); ?> VNĐ</td>
                            <td>
                                <form action="cart.php" method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                    <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>" min="1">
                                    <button type="submit">Update</button>
                                </form>
                            </td>
                            <td><?php echo number_format($product['price'] * $product['quantity'], 0, ',', '.'); ?> VNĐ</td>
                            <td><a href="cart.php?action=remove&id=<?php echo $id; ?>">Remove</a></td>
                        </tr>
                        <?php $total += $product['price'] * $product['quantity']; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p><b>Total:</b> <?php echo number_format($total, 0, ',', '.'); ?> VNĐ</p>
            <a href="checkout.php">Proceed to Checkout</a>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </main>

    <footer>
        <div class="footer-content">
            <p>&copy; 2024 Men's Fashion Store. All Rights Reserved.</p>
        </div>
    </footer>
</body>

</html>
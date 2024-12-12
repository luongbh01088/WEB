<?php
include "Connect.php"; // Kết nối cơ sở dữ liệu

// Xử lý thêm, cập nhật, hoặc xóa danh bạ
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        $contact_id = isset($_POST['contact_id']) ? intval($_POST['contact_id']) : null;
        $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : null;
        $address = isset($_POST['address']) ? trim($_POST['address']) : '';
        $phone_number = isset($_POST['phone_number']) ? trim($_POST['phone_number']) : '';

        if ($action == 'add' && $user_id && $address && $phone_number) {
            // Thêm mới danh bạ
            $sql = "INSERT INTO Contact (user_id, address, phone_number) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "iss", $user_id, $address, $phone_number);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } elseif ($action == 'update' && $contact_id && $address && $phone_number) {
            // Cập nhật danh bạ
            $sql = "UPDATE Contact SET address = ?, phone_number = ? WHERE contact_id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssi", $address, $phone_number, $contact_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } elseif ($action == 'delete' && $contact_id) {
            // Xóa danh bạ
            $sql = "DELETE FROM Contact WHERE contact_id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $contact_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
}

// Truy vấn hiển thị danh bạ
$sql = "SELECT c.contact_id, c.user_id, u.full_name AS user_name, c.address, c.phone_number 
        FROM Contact c
        JOIN User u ON c.user_id = u.user_id";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Management</title>
    <link rel="stylesheet" href="contact.css">
</head>

<body>

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
    <div class="container">
        <h1>Contact Management</h1>

        <!-- Form thêm mới danh bạ -->
        <form method="POST" action="" class="contact-form">
            <h2>Add New Contact</h2>
            <label for="user_id">User ID:</label>
            <input type="number" name="user_id" required><br>
            <label for="address">Address:</label>
            <input type="text" name="address" required><br>
            <label for="phone_number">Phone Number:</label>
            <input type="text" name="phone_number" required><br>
            <input type="hidden" name="action" value="add">
            <button type="submit" class="btn">Add Contact</button>
        </form>

        <hr>
        <table>
            <tr>
                <th>Contact ID</th>
                <th>User ID</th>
                <th>User Name</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['contact_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['address']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                    <td>
                        <!-- Edit Form -->
                        <form method="POST" action="" style="display:inline;">
                            <input type="hidden" name="contact_id" value="<?php echo $row['contact_id']; ?>">
                            <input type="hidden" name="address" value="<?php echo $row['address']; ?>">
                            <input type="hidden" name="phone_number" value="<?php echo $row['phone_number']; ?>">
                            <input type="hidden" name="action" value="update">
                            <button type="submit" class="btn edit-btn">Edit</button>
                        </form>
                        <!-- Delete Form -->
                        <form method="POST" action="" style="display:inline;">
                            <input type="hidden" name="contact_id" value="<?php echo $row['contact_id']; ?>">
                            <input type="hidden" name="action" value="delete">
                            <button type="submit" class="btn delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <?php mysqli_close($conn); ?>

    <footer>
        <div class="footer-content">
            <p>&copy; 2024 Men's Fashion Store. All Rights Reserved.</p>
        </div>
    </footer>
</body>

</html>
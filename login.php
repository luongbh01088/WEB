<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-size: 14px;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        input[type="Username"],
        input[type="Password"] {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
            transition: border-color 0.3s ease;
        }

        input[type="Username"]:focus,
        input[type="Password"]:focus {
            border-color: #4CAF50;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        .register-link {
            text-align: center;
            margin-top: 15px;
        }

        .register-link a {
            color: #4CAF50;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<script>
    function validateForm() {
        var x = document.getElementById("Username").value;
        if (x == null || x == "") {
            alert("Username can not be empty!");
            return false;
        }
    }
</script>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="" onsubmit="return validateForm()" method="POST">
            <div class="form-group">
                <label for="Username">Username:</label>
                <input type="Username" class="form-control" id="Username" placeholder="Enter your Username" name="Username">
            </div>
            <div class="form-group">
                <label for="Password">Password:</label>
                <input type="Password" class="form-control" id="Password" placeholder="Enter your Password" name="Password" required>
            </div>
            <button type="submit" name="submit" class="btn btn-success btn-block">Login</button>
            <div class="register-link">
                <p>Don't have an account? <a href="Register.php">Register here</a></p>
            </div>
        </form>
    </div>

    <?php
    include "Connect.php"; // Kết nối tới cơ sở dữ liệu

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy giá trị từ form
        $Username = $_POST["Username"];
        $Password = $_POST["Password"];

        // Sử dụng Prepared Statements để tránh SQL Injection
        $stmt = $conn->prepare("SELECT * FROM User WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $Username, $Password); // 'ss' là kiểu dữ liệu (string, string)
        $stmt->execute();
        $result = $stmt->get_result();

        // Kiểm tra kết quả truy vấn
        if ($result->num_rows > 0) {
            echo "<script>alert('You have logged in successfully!')</script>";
            header("Location: home.php");
            exit(); // Đảm bảo dừng kịch bản sau header
        } else {
            echo "<script>alert('Password or Username is incorrect, please try again!')</script>";
        }

        // Đóng statement và kết nối
        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>

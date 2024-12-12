<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus,
        input[type="email"]:focus {
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
        var y = document.getElementById("Email").value;
        if (x == null || x == "") {
            alert("Username can not be empty!");
            return false;
        } else if (y == null || y == "") {
            alert("Email can not be empty!");
            return false;
        }
    }
</script>

<body>
    <div class="login-container">
        <h2>Register</h2>
        <form action="" onsubmit="return validateForm()" method="POST">
            <div class="form-group">
                <label for="Username">Username:</label>
                <input type="text" class="form-control" id="Username" placeholder="Enter your Username" name="Username" >
            </div>
                
            <div class="form-group">
                <label for="Password">Password:</label>
                <input type="password" class="form-control" id="Password" placeholder="Enter your Password" name="Password" required>
            </div>
            
            <div class="form-group">
                <label for="Email">Email:</label>
                <input type="email" class="form-control" id="Email" placeholder="Enter your Email" name="Email" >
            </div>
            
            <div class="form-group">
                <label for="FullName">Full Name:</label>
                <input type="text" class="form-control" id="FullName" placeholder="Enter your FullName " name="FullName">
            </div>

            
            <button type="submit" name="submit" class="btn btn-success btn-block">Register</button>
            <div class="register-link">
                <p>Sign in to your account? <a href="Login.php">Login Now</a></p>
            </div>
        </form>
    </div>

    <?php
    include "Connect.php"; // Kết nối tới cơ sở dữ liệu

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ form
        $Email = $_POST["Email"];
        $Username = $_POST["Username"];
        $Password = $_POST["Password"];
        $FullName = $_POST["FullName"] ?? null;
     
        // Sử dụng Prepared Statements để tránh SQL Injection
        $stmt = $conn->prepare("INSERT INTO User (username, password, email, full_name) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $Username, $Password, $Email, $FullName);

        if ($stmt->execute()) {
            echo "<script>alert('Add successfully!')</script>";
        } else {
            echo "<script>alert('Add Error: " . $stmt->error . "')</script>";
        }

        // Đóng statement và kết nối
        $stmt->close();
        $conn->close();
    }
    ?>

</body>
</html>

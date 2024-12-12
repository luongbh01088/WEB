<?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "men";
 $conn = mysqli_connect($servername, $username, $password, $dbname);

 if (!$conn) {
     die("<script>alert('Connect Error !')</script>");
 } else {
     // die("<script>alert('Connect!')</script>");
 }
 
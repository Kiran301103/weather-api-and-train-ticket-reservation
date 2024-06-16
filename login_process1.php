<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    // Check the user's credentials in the database
    $conn = new mysqli("localhost", "root", "", "kiran");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            header("Location: index.html");
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "User not found.";
    }
    
    $conn->close();
}
?>

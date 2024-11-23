<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['signUpName']);
    $email = mysqli_real_escape_string($conn, $_POST['signUpEmail']);
    $password = mysqli_real_escape_string($conn, $_POST['signUpPassword']);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Encrypt password

    $check_email = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($check_email);

    if ($result->num_rows > 0) {
        echo "Email already exists. Try signing in!";
    } else {
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
        if ($conn->query($sql)) {
            echo "Sign Up successful! Please sign in.";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>

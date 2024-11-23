<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['signInEmail']);
    $password = mysqli_real_escape_string($conn, $_POST['signInPassword']);

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: dashboard.php"); // Redirect to a protected page
            exit();
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "Email not found! Please sign up.";
    }
}
?>

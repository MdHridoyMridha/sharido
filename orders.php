<?php
// Database connection
$host = 'localhost'; // Replace with your database host
$user = 'root'; // Replace with your database username
$password = ''; // Replace with your database password
$dbname = 'sharido'; // Replace with your database name

$conn = new mysqli($host, $user, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch orders from the database
$sql = "SELECT orders.id,users.id As user_id, users.name AS customer_name, users.phone AS 
customer_phone, users.address, products.name AS product_name, orders.quantity, 
orders.total_price, orders.order_date, orders.status FROM orders INNER JOIN users ON orders.user_id = users.id 
INNER JOIN products ON orders.product_id = products.id where users.id = orders.user_id ;";

$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard - SHARIDO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      
    </style>
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">SHARIDO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="orders.php" class="nav-link"><span class="badge text-bg-secondary-subtle">My Orders</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php" class="btn btn-danger ms-3">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">

        
<div class="container mt-5">
    <h2 class="mb-4">MY Orders</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Customer Phone</th>
                <th>Shipping Address</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Order Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['customer_name']}</td>
                            <td>{$row['customer_phone']}</td>
                            <td>{$row['address']}</td>
                            <td>{$row['product_name']}</td>
                            <td>{$row['quantity']}</td>
                            <td>{$row['total_price']}</td>
                            <td>{$row['order_date']}</td>
                            <td>{$row['status']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='9' class='text-center'>No orders found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>

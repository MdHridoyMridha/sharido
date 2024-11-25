<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

require 'db_connect.php';

// Fetch data from the database
$products = $conn->query("SELECT * FROM products");
$orders = $conn->query("SELECT * FROM orders");
$messages = $conn->query("SELECT * FROM messages");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="nav-link text-white">Welcome, <?= htmlspecialchars($_SESSION['admin_username']); ?>!</span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <h2 class="mb-4">Admin Dashboard</h2>

        <!-- Products Section -->
        <h3>Products</h3>
        <div class="mb-3">
            <a href="add_product.php" class="btn btn-primary">Add New Product</a>
        </div>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $products->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= htmlspecialchars($row['category']); ?></td>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= htmlspecialchars($row['price']); ?></td>
                    <td><?= htmlspecialchars($row['stock']); ?></td>
                    <td>
                        <a href="edit_product.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_product.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Orders Section -->
        <h3 class="mt-5">Orders</h3>
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Order ID</th>
            <th>Name</th>
            <th>Phone</th>
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
        // Fetch orders for the logged-in user
        $user_id = $_SESSION['user_id'];
        $sql_orders = "
            SELECT 
                o.id AS order_id, 
                o.name, 
                o.phone, 
                o.shipping_address, 
                p.name AS product_name, 
                o.quantity, 
                o.total_price, 
                o.order_date, 
                o.status 
            FROM 
                orders o 
            JOIN 
                products p 
            ON 
                o.product_id = p.id 
            WHERE 
                o.user_id = $user_id 
            ORDER BY 
                o.order_date DESC";
        $orders = $conn->query($sql_orders);

        if ($orders && $orders->num_rows > 0):
            while ($row = $orders->fetch_assoc()):
        ?>
        <tr>
            <td><?= $row['order_id']; ?></td>
            <td><?= htmlspecialchars($row['name']); ?></td>
            <td><?= htmlspecialchars($row['phone']); ?></td>
            <td><?= htmlspecialchars($row['shipping_address']); ?></td>
            <td><?= htmlspecialchars($row['product_name']); ?></td>
            <td><?= $row['quantity']; ?></td>
            <td><?= number_format($row['total_price'], 2); ?> tk</td>
            <td><?= date('d-m-Y H:i:s', strtotime($row['order_date'])); ?></td>
            <td><?= ucfirst($row['status']); ?></td>
        </tr>
        <?php 
            endwhile;
        else:
        ?>
        <tr>
            <td colspan="9" class="text-center">No orders found</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>


        <!-- Messages Section -->
        <h3 class="mt-5">Messages</h3>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Received At</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $messages->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= htmlspecialchars($row['email']); ?></td>
                    <td><?= htmlspecialchars($row['message']); ?></td>
                    <td><?= $row['created_at']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">© 2024 Admin Dashboard. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

require 'db_connect.php';

// Fetch data from the database
$products = $conn->query("SELECT * FROM products");

// Updated query for orders with JOINs
$orders = $conn->query("
    SELECT 
        orders.id, 
        users.name AS user_name, 
        orders.phone, 
        orders.shipping_address, 
        products.name AS product_name, 
        orders.quantity, 
        orders.total_price, 
        orders.order_date, 
        orders.status
    FROM orders
    LEFT JOIN users ON orders.user_id = users.id
    LEFT JOIN products ON orders.product_id = products.id
");

$messages = $conn->query("SELECT * FROM messages");

// Update order status
if (isset($_POST['update_status'])) {
    $order_id = intval($_POST['order_id']);
    $new_status = $_POST['status'];
    $update_status_sql = "UPDATE orders SET status = '$new_status' WHERE id = $order_id";
    $conn->query($update_status_sql);
    header("Location: admin_dashboard.php");
    exit();
}

// Remove an order
if (isset($_POST['remove_order'])) {
    $order_id = intval($_POST['order_id']);
    $remove_order_sql = "DELETE FROM orders WHERE id = $order_id";
    $conn->query($remove_order_sql);
    header("Location: admin_dashboard.php");
    exit();
}
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $orders->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= htmlspecialchars($row['user_name']); ?></td>
                    <td><?= htmlspecialchars($row['phone']); ?></td>
                    <td><?= htmlspecialchars($row['shipping_address']); ?></td>
                    <td><?= htmlspecialchars($row['product_name']); ?></td>
                    <td><?= $row['quantity']; ?></td>
                    <td><?= number_format($row['total_price'], 2); ?> tk</td>
                    <td><?= date('d-m-Y H:i:s', strtotime($row['order_date'])); ?></td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="order_id" value="<?= $row['id']; ?>">
                            <select name="status" class="form-select form-select-sm" style="width: auto; display: inline-block;" onchange="this.form.submit()">
                                <option value="pending" <?= $row['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                                <option value="completed" <?= $row['status'] === 'completed' ? 'selected' : ''; ?>>Completed</option>
                                <option value="cancelled" <?= $row['status'] === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                            </select>
                            <input type="hidden" name="update_status">
                        </form>
                    </td>
                    <td>
                        <form method="post" onsubmit="return confirm('Are you sure you want to remove this order?');" style="display:inline;">
                            <input type="hidden" name="order_id" value="<?= $row['id']; ?>">
                            <button type="submit" name="remove_order" class="btn btn-danger btn-sm">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
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

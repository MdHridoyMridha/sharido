<?php
require 'db_connect.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch cart items
$cart_sql = "SELECT c.id as cart_id, p.id as product_id, p.name, p.price, c.quantity, p.image 
             FROM cart c 
             JOIN products p ON c.product_id = p.id 
             WHERE c.user_id = $user_id";
$cart_result = mysqli_query($conn, $cart_sql);

$total_price = 0;

// Update quantity in the cart
if (isset($_POST['update_quantity'])) {
    $cart_id = intval($_POST['cart_id']);
    $new_quantity = intval($_POST['quantity']);
    if ($new_quantity > 0) {
        $update_sql = "UPDATE cart SET quantity = $new_quantity WHERE id = $cart_id";
        mysqli_query($conn, $update_sql);
    }
    header('Location: cart.php');
    exit();
}

// Place the order
if (isset($_POST['place_order'])) {
    // Fetch user details
    $user_sql = "SELECT name, phone, address FROM users WHERE id = $user_id";
    $user_result = mysqli_query($conn, $user_sql);
    $user = mysqli_fetch_assoc($user_result);

    // Check if the cart is empty
    if (mysqli_num_rows($cart_result) == 0) {
        echo "<div class='alert alert-danger'>Your cart is empty. Cannot place the order.</div>";
    } else {
        // Loop through each cart item and insert them into the orders table
        while ($cart_item = mysqli_fetch_assoc($cart_result)) {
            $product_id = $cart_item['product_id'];
            $quantity = $cart_item['quantity'];
            $price = $cart_item['price'];
            $subtotal = $price * $quantity;
            $total_price += $subtotal;

            // Insert product into the orders table
            $order_sql = "INSERT INTO orders (user_id, name, phone, shipping_address, product_id, quantity, total_price, status) 
                          VALUES ($user_id, '{$product['name']}', '{$user['phone']}', '{$user['address']}', $product_id, $quantity, $subtotal, 'pending')";
            if (!mysqli_query($conn, $order_sql)) {
                echo "<div class='alert alert-danger'>Failed to place the order for product ID $product_id. Please try again.</div>";
                exit();
            }
        }


        // Redirect to an order confirmation page
        header('Location: orders.php?user_id=' . $user_id);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart - SHARIDO</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
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
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="cart.php"><span class="badge text-bg-secondary-subtle">Cart</span></a></li>
                <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="orders.php">My Orders</a></li>
                <li class="nav-item"><a href="logout.php" class="btn btn-danger ms-3">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container my-4">
    <h2>My Cart</h2>
    <?php if (mysqli_num_rows($cart_result) > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($cart_result)): ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" width="50"></td>
                        <td><?php echo $row['price']; ?> tk</td>
                        <td>
                            <form method="post" action="cart.php">
                                <input type="hidden" name="cart_id" value="<?php echo $row['cart_id']; ?>">
                                <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" min="1" style="width: 70px;">
                                <button type="submit" name="update_quantity" class="btn btn-sm btn-primary">Update</button>
                            </form>
                        </td>
                        <td><?php echo $subtotal = $row['price'] * $row['quantity']; ?> tk</td>
                        <td>
                            <a href="remove_from_cart.php?cart_id=<?php echo $row['cart_id']; ?>" class="btn btn-danger btn-sm">Remove</a>
                        </td>
                    </tr>
                    <?php $total_price += $subtotal; ?>
                <?php endwhile; ?>
            </tbody>
        </table>
        <h4>Total: <?php echo $total_price; ?> tk</h4>
        <form method="post" action="cart.php">
            <button type="submit" name="place_order" class="btn btn-success"onclick="showPopup()">Place Order</button>
        </form>
    <?php else: ?>
        <p>Your cart is empty!</p>
    <?php endif; ?>
</div>

<!--popup-->
<script>
function showPopup() {
    alert("Order Placed successfully!");
}
</script>

</body>
</html>

<?php
require 'db_connect.php';
session_start();

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

// Update quantity
if (isset($_POST['update_quantity'])) {
    $cart_id = $_POST['cart_id'];
    $new_quantity = intval($_POST['quantity']);
    if ($new_quantity > 0) {
        $update_sql = "UPDATE cart SET quantity = $new_quantity WHERE id = $cart_id";
        mysqli_query($conn, $update_sql);
    }
    header('Location: cart.php');  // Redirect back to the same page
    exit();
}

// Place Order
if (isset($_POST['place_order'])) {
    // Fetch user details
    $user_sql = "SELECT name, phone FROM users WHERE id = $user_id";
    $user_result = mysqli_query($conn, $user_sql);
    
    if (mysqli_num_rows($user_result) > 0) {
        $user = mysqli_fetch_assoc($user_result);
    } else {
        die("Error: User details not found.");
    }

    // Get the total price and product details from cart
    $cart_items_sql = "SELECT product_id, quantity FROM cart WHERE user_id = $user_id";
    $cart_items_result = mysqli_query($conn, $cart_items_sql);

    // Check if the cart is empty
    if (mysqli_num_rows($cart_items_result) == 0) {
        die("Error: Cart is empty.");
    }

    // Insert order details into orders table
    $order_total_price = 0;
    $order_sql = "INSERT INTO orders (user_id, name, phone, total_price, status, created_at) 
                  VALUES ($user_id, '{$user['name']}', '{$user['phone']}', 0, 'pending', NOW())";
    
    if (mysqli_query($conn, $order_sql)) {
        $order_id = mysqli_insert_id($conn);  // Get the newly inserted order's ID

        // Insert order items from the cart
        while ($cart_item = mysqli_fetch_assoc($cart_items_result)) {
            $product_id = $cart_item['product_id'];
            $quantity = $cart_item['quantity'];

            // Fetch product price
            $product_sql = "SELECT price FROM products WHERE id = $product_id";
            $product_result = mysqli_query($conn, $product_sql);
            
            if (mysqli_num_rows($product_result) > 0) {
                $product = mysqli_fetch_assoc($product_result);
                $subtotal = $product['price'] * $quantity;
                $order_total_price += $subtotal;

                // Insert each product into the orders table (in the same row or a separate order_items table)
                $order_details_sql = "INSERT INTO order_items (order_id, product_id, quantity, price)
                                      VALUES ($order_id, $product_id, $quantity, $subtotal)";
                if (!mysqli_query($conn, $order_details_sql)) {
                    echo "Error inserting order details: " . mysqli_error($conn);
                }
            }
        }

        // Update the order with the total price
        $update_order_sql = "UPDATE orders SET total_price = $order_total_price WHERE id = $order_id";
        if (!mysqli_query($conn, $update_order_sql)) {
            echo "Error updating order total price: " . mysqli_error($conn);
        }

        // Clear the cart after placing the order
        $clear_cart_sql = "DELETE FROM cart WHERE user_id = $user_id";
        if (!mysqli_query($conn, $clear_cart_sql)) {
            echo "Error clearing the cart: " . mysqli_error($conn);
        }

        // Redirect to order confirmation page with order ID
        header('Location: order_confirmation.php?order_id=' . $order_id);
        exit();
    } else {
        echo "Error inserting order into orders table: " . mysqli_error($conn);
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
<div class="container my-4">
    <h2>My Cart</h2>
    <?php if (mysqli_num_rows($cart_result) > 0): ?>
        <form method="post" action="cart.php">
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
                                <form method="post" action="cart.php" style="display:inline-block;">
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
            <button type="submit" name="place_order" class="btn btn-success">Place Order</button>
        </form>
    <?php else: ?>
        <p>Your cart is empty!</p>
    <?php endif; ?>
</div>
</body>
</html>

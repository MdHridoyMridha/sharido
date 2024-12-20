<?php
require 'db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch jewelry products
$sql_products = "SELECT * FROM products WHERE category = 'Organic Products'";
$result_products = $conn->query($sql_products);

$products = [];
if ($result_products->num_rows > 0) {
    while ($row = $result_products->fetch_assoc()) {
        $products[] = $row;
    }
}

// Add product to cart
if (isset($_GET['add_to_cart'])) {
    $product_id = $_GET['add_to_cart'];

    // Check if the product is already in the cart
    $check_cart_sql = "SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id";
    $check_cart_result = mysqli_query($conn, $check_cart_sql);

    if (mysqli_num_rows($check_cart_result) > 0) {
        // Product exists in cart, update quantity
        $update_cart_sql = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = $user_id AND product_id = $product_id";
        if (!mysqli_query($conn, $update_cart_sql)) {
            die('Error updating cart: ' . mysqli_error($conn));
        }
    } else {
        // Product does not exist in cart, insert new
        $insert_cart_sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, 1)";
        if (!mysqli_query($conn, $insert_cart_sql)) {
            die('Error inserting to cart: ' . mysqli_error($conn));
        }
    }

    // Redirect to the same page after adding the product
    header('Location: organic.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jewelry - SHARIDO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: #fff;
            padding-top: 20px;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .card img {
            height: 300px;
            object-fit: cover;
        }
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
                        <a href="orders.php" class="nav-link">My Orders</a>
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
            <!-- Sidebar for Categories -->
            <div class="col-md-3 sidebar">
                <h5 class="text-center">Categories</h5>
                <a href="dashboard.php" onclick="filterCategory('all')">All Products</a>
                <a href="jewelry.php" onclick="filterCategory('jewelry')">Jewelry</a>
                <a href="home_decor.php" onclick="filterCategory('home-decor')">Home Decor</a>
                <a href="clothing.php" onclick="filterCategory('clothing')">Clothing</a>
                <a href="organic.php" onclick="filterCategory('organic')"><div class="p-3 mb-2 bg-secondary text-white"onclick="showPopup()">Organic Products</div></a>
                <a href="bag.php" onclick="filterCategory('bags')">Tote Bags</a>
            </div>

            <!-- Main Content Area -->
            <div class="col-md-9">
                <!-- Search Bar -->
                <div class="input-group my-4">
                    <input type="text" class="form-control" placeholder="Search for products..." id="searchInput"
                        onkeyup="searchProduct()">
                    <button class="btn btn-outline-secondary" type="button">Search</button>
                </div>

                <!-- Product Section -->
                <div class="row row-cols-1 row-cols-md-3 g-4" id="productContainer">
                    <?php foreach ($products as $product): ?>
                    <div class="col product-card" data-category="<?php echo $product['category']; ?>">
                        <div class="card">
                            <img src="images/<?php echo $product['image']; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $product['name']; ?></h5>
                                <p class="card-text"><?php echo $product['description']; ?></p>
                                <p><strong><?php echo $product['price']; ?> tk</strong></p>
                                <a href="organic.php?add_to_cart=<?php echo $product['id']; ?>" class="btn btn-outline-primary"onclick="showPopup()">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript for Category Filtering and Search -->
    <script>
        function filterCategory(category) {
            const products = document.querySelectorAll('.product-card');
            products.forEach(product => {
                if (category === 'all' || product.dataset.category === category) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }

        function searchProduct() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const products = document.querySelectorAll('.product-card');
            products.forEach(product => {
                const title = product.querySelector('.card-title').textContent.toLowerCase();
                if (title.includes(input)) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }
    </script>

     <!--popup-->
     <script>
function showPopup() {
    alert("Product added to cart successfully!");
}
</script>

    <!-- Footer Section -->
    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2024 SHARIDO. All Rights Reserved.</p>
        <p>Follow us on <a href="#" class="text-white">Facebook</a></p>
    </footer>
</body>

</html>

<?php
// Close database connection
$conn->close();
?>

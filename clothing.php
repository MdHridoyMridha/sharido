<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard - SHARIDO</title>
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
            height: 200px;
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
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="orders.html" class="nav-link">My Orders</a>
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
                <a href="#" onclick="filterCategory('all')">All Products</a>
                <a href="jewelry.php" onclick="filterCategory('jewelry')">Jewelry</a>
                <a href="home_decor.php" onclick="filterCategory('home-decor')">Home Decor</a>
                <a href="clothing.php" onclick="filterCategory('clothing')">Clothing</a>
                <a href="organic.php" onclick="filterCategory('organic')">Organic Products</a>
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
                    <!-- Product 1 -->
                    <div class="col product-card" data-category="Clothing">
                        <div class="card">
                            <img src="jewelery.png" class="card-img-top" alt="Jewelry">
                            <div class="card-body">
                                <h5 class="card-title">Handmade Jewelry</h5>
                                <p class="card-text">Elegant pearl jewelry perfect for every occasion.</p>
                                <p><strong>2000tk</strong></p>
                                <button class="btn btn-outline-primary">Add to Cart</button>
                            </div>
                        </div>
                    </div>

                    <!-- Product 2 -->
                    <div class="col product-card" data-category="Clothing">
                        <div class="card">
                            <img src="bucket.png" class="card-img-top" alt="Bucket">
                            <div class="card-body">
                                <h5 class="card-title">Traditional Bengali Bucket</h5>
                                <p class="card-text">Beautiful handmade bucket for your plants.</p>
                                <p><strong>450tk</strong></p>
                                <button class="btn btn-outline-primary">Add to Cart</button>
                            </div>
                        </div>
                    </div>

                    <!-- Product 3 -->
                    <div class="col product-card" data-category="Clothing">
                        <div class="card">
                            <img src="shari.png" class="card-img-top" alt="Saree">
                            <div class="card-body">
                                <h5 class="card-title">Traditional Saree</h5>
                                <p class="card-text">Authentic saree to embrace your cultural style.</p>
                                <p><strong>1300tk</strong></p>
                                <button class="btn btn-outline-primary">Add to Cart</button>
                            </div>
                        </div>
                    </div>

                    <!-- Product 4 -->
                    <div class="col product-card" data-category="Clothing">
                        <div class="card">
                            <img src="mehedi.png" class="card-img-top" alt="Mehedi">
                            <div class="card-body">
                                <h5 class="card-title">Pure Organic Mehedi</h5>
                                <p class="card-text">Organic Mehedi for natural coloring.</p>
                                <p><strong>120tk</strong></p>
                                <button class="btn btn-outline-primary">Add to Cart</button>
                            </div>
                        </div>
                    </div>

                    <!-- Product 5 -->
                    <div class="col product-card" data-category="Clothing">
                        <div class="card">
                            <img src="tote.webp" class="card-img-top" alt="Tote Bag">
                            <div class="card-body">
                                <h5 class="card-title">Handcrafted Tote Bag</h5>
                                <p class="card-text">Stylish tote bag for your daily needs.</p>
                                <p><strong>450tk</strong></p>
                                <button class="btn btn-outline-primary">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                     <!-- Product 6 -->
                     <div class="col product-card" data-category="Clothing">
                        <div class="card">
                            <img src="tote.webp" class="card-img-top" alt="Tote Bag">
                            <div class="card-body">
                                <h5 class="card-title">primium Tote Bag</h5>
                                <p class="card-text">Stylish tote bag for your daily needs.</p>
                                <p><strong>450tk</strong></p>
                                <button class="btn btn-outline-primary">Add to Cart</button>
                            </div>
                        </div>
                    </div>
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
     <!-- Footer Section -->
     <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2024 SHARIDO. All Rights Reserved.</p>
        <p>Follow us on <a href="*" class="text-white">Facebook</a></p>
    </footer>
</body>

</html>

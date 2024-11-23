<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHARIDO - Handmade Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .banner {
            height: 800px;
            background: url('images/sha.png') no-repeat center center;
            background-size: cover;
        }
        .product-card img {
            width: 100%;
            height: auto;
        }
    </style>
</head>

<body>

    <!-- Header Section -->
    <header class="bg-dark text-white">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="index.php">SHARIDO</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#products">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Home Section -->
    <section id="home" class="banner text-center text-white d-flex justify-content-center align-items-center">
        <div>
            <h1 class="display-4">Welcome to SHARIDO</h1>
            <p class="lead">Explore our unique handmade creations, crafted with love and care.</p>
            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#signModal">Shop Now</button>

        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Our Products</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <!-- Product 1 -->
                <div class="col">
                    <div class="card product-card">
                        <img src="images/jewelery.png" alt="Product 1" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Handmade Jewelry</h5>
                            <p class="card-text">Authentic pearl jewelry, perfect for any occasion.</p>
                            <p><strong>2000tk</strong></p>
                            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#signModal">Add to Cart</button>

                        </div>
                    </div>
                </div>
                <!-- Product 2 -->
                <div class="col">
                    <div class="card product-card">
                        <img src="images/bucket.png" alt="Product 2" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Traditional Bengali Bucket</h5>
                            <p class="card-text">A beautiful, handmade plant bucket with a traditional touch.</p>
                            <p><strong>450tk</strong></p>
                            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#signModal">Add to Cart</button>

                        </div>
                    </div>
                </div>
                <!-- Product 3 -->
                <div class="col">
                    <div class="card product-card">
                        <img src="images/hanging.png" alt="Product 3" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Handmade Wall Hangings</h5>
                            <p class="card-text">Add a cultural touch to your home with these wall decorations.</p>
                            <p><strong>550tk</strong></p>
                            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#signModal">Add to Cart</button>

                        </div>
                    </div>
                </div>
                <!-- Product 4 -->
                <div class="col">
                    <div class="card product-card">
                        <img src="images/shari.png" alt="Product 4" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Treditional Shari</h5>
                            <p class="card-text">Add a cultural touch in your daily life.</p>
                            <p><strong>1300tk</strong></p>
                            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#signModal">Add to Cart</button>

                        </div>
                    </div>
                </div>
                <!-- Product 5 -->
                <div class="col">
                    <div class="card product-card">
                        <img src="images/mehedi.png" alt="Product 5" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Pure Organic Mehedi</h5>
                            <p class="card-text">Use organic mehedi to get real color.</p>
                            <p><strong>120tk</strong></p>
                            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#signModal">Add to Cart</button>

                        </div>
                    </div>
                </div>
                <!-- Product 6 -->
                <div class="col">
                    <div class="card product-card">
                        <img src="images/tote.webp" alt="Product 6" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Tote Bag </h5>
                            <p class="card-text">Make your daily life productive.</p>
                            <p><strong>450tk</strong></p>
                            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#signModal">Add to Cart</button>

                        </div>
                    </div>
                </div>
                <!-- Product 7 -->
                <div class="col product-card" data-category="Tote Bags">
                    <div class="card">
                        <img src="images/tote5.jpg" class="card-img-top" alt="Mehedi">
                        <div class="card-body">
                            <h5 class="card-title">Pure cotton Tote bag</h5>
                            <p class="card-text">Stylish tote bag for your daily needs</p>
                            <p><strong>120tk</strong></p>
                            <button class="btn btn-outline-primary">Add to Cart</button>
                        </div>
                    </div>
                </div>
                  <!-- Product 8 -->
                  <div class="col product-card" data-category="jewelry">
                    <div class="card">
                        <img src="images/jew1.jpg" class="card-img-top" alt="jewelry">
                        <div class="card-body">
                            <h5 class="card-title">Elegent pearl Neclace</h5>
                            <p class="card-text">Elegant pearl jewelry perfect for every occasion.</p>
                            <p><strong>890tk</strong></p>
                            <button class="btn btn-outline-primary">Add to Cart</button>
                        </div>
                    </div>
                </div>
                 <!-- Product 6 -->
                 <div class="col product-card" data-category="Home Decor">
                    <div class="card">
                        <img src="images/hanging.png" class="card-img-top" alt="Home_Decor">
                        <div class="card-body">
                            <h5 class="card-title">primium Handmade Wall Hanger</h5>
                            <p class="card-text">Stylish Your house.</p>
                            <p><strong>450tk</strong></p>
                            <button class="btn btn-outline-primary">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </section>


    <!-- About Us Section -->
    
    <section id="about" class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-4">About SHARIDO</h2>
            <p>✨ Welcome to SHARIDO ✨
                Crafted with Heart, Inspired by Tradition 🌿
                
                At SHARIDO, we bring you exquisite handcrafted treasures that blend the timeless beauty of Bengali tradition with a touch of modern elegance. From pearl jewelry to handmade buckets, tote bags, and wall hangings, each piece is designed to elevate your lifestyle with authenticity and charm. 💫</p>
        </div>
    </section>

    <!-- Contact Section -->
    <!-- Contact Section -->
<section id="contact" class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Contact Us</h2>
        <form action="contact_process.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Your Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Your Message</label>
                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>
</section>


    <!-- Sign-In / Sign-Up Modal -->
    <div class="modal fade" id="signModal" tabindex="-1" aria-labelledby="signModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signModalLabel">Sign In or Sign Up</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs" id="signTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="sign-in-tab" data-bs-toggle="tab" href="#sign-in" role="tab" aria-controls="sign-in" aria-selected="true">Sign In</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="sign-up-tab" data-bs-toggle="tab" href="#sign-up" role="tab" aria-controls="sign-up" aria-selected="false">Sign Up</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="signTabsContent">
                       
                        <!-- Sign In Form -->
<div class="tab-pane fade show active" id="sign-in" role="tabpanel" aria-labelledby="sign-in-tab">
    <form method="POST" action="signin.php">
        <div class="mb-3">
            <label for="signInEmail" class="form-label">Email address</label>
            <input type="email" class="form-control" name="signInEmail" required>
        </div>
        <div class="mb-3">
            <label for="signInPassword" class="form-label">Password</label>
            <input type="password" class="form-control" name="signInPassword" required>
        </div>
        <button type="submit" class="btn btn-primary" name="login">Sign In</button>
    </form>
</div>

                        
                        <!-- Sign Up Form -->
                        <div class="tab-pane fade show active" id="sign-up" role="tabpanel" aria-labelledby="sign-up-tab">
                            <form method="POST" action="signup.php">
                              <div class="mb-3">
                            <label for="signUpName" class="form-label">Name</label>
                          <input type="text" class="form-control" name="signUpName" required>
                           </div>
                          <div class="mb-3">
                             <label for="signUpEmail" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="signUpEmail" required>
                             </div>
                                <div class="mb-3">
                                  <label for="signUpPassword" class="form-label">Password</label>
                                  <input type="password" class="form-control" name="signUpPassword" required>
                         </div>
                             <button type="submit" class="btn btn-primary">Sign Up</button>
                                 </form>
              

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <!-- Footer Section -->
    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2024 SHARIDO. All Rights Reserved.</p>
        <p>Follow us on <a href="*" class="text-white">Facebook</a></p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

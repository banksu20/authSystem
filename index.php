<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a href="index.php" class="navbar-brand navbar-brand-custom">Auth System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="NavbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="#navbarNav">
            <ul class="navbar-nav ms-auto">
                 <li class="nav-item">
                    <a href="index.php" class="nav-link">Home</a>
                 </li>
                 <li class="nav-item">
                    <a href="login.html" class="nav-link">Sign In</a>
                 </li>
                 <li class="nav-item">
                    <a href="register.html" class="btn btn-primary" role="button">Sign Up</a>
                 </li>
            </ul>
        </div>
    </div>
    </nav>

    <div class="main-content">
        <div class="container">
            <div class="hero-section">
                <h1>Welcome to my World</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae cum explicabo soluta vitae minima consequatur velit cupiditate asperiores, iure eos repellat dolorem impedit nostrum assumenda harum doloremque ad consectetur dignissimos!</p>
                <div>
                    <a href="login.html" class="btn btn-success btn-lg btn-custom">Sign In</a>
                    <a href="register.html" class="btn btn-primary btn-lg btn-custom">Create an account</a>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer mt-auto">
        <div class="container">
            <span>&copy; <?php echo date("Y"); ?> Auth System</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</body>
</html>
<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true){
        header("location: login.html");
        exit;
    }


    $username = htmlspecialchars($_SESSION['username']);

?>
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
        <a href="index.php" class="navbar-brand navbar-brand-custom">AuthSystem</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="NavbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="#navbarNav">
            <ul class="navbar-nav ms-auto">
                 <li class="nav-item">
                    <a href="index.php" class="nav-link">Welcome, <?= $username; ?></a>
                 </li>
                 <li class="nav-item">
                    <a class="btn btn-danger" id="logoutButton" >Logout</a>
                 </li>
            </ul>
        </div>
    </div>
    </nav>

    <div class="container mt-5">
        <div class="card bg-secondary-subtle" role="alert">
            <div class="card-body">
                <h4 class="alert-heading">Welcome, <?= $username; ?></h4>
                <p>This is your dashboard</p>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
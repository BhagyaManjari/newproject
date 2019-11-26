<?php
/**
 * Created by PhpStorm.
 * User: tharinduranaweera
 * Date: 5/28/19
 * Time: 2:16 PM
 */

session_start();

if (isset($_POST['submit'])) {

    require ('./utils/Post.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $url = "http://localhost/DistributedSystemsMiddleware/loginuser.php";

    $params = "username=".$username."&password=".$password;

    $response = createPostRequest($url, $params);

    $name = json_decode($response, true)["username"];

    $_SESSION['username'] = $name;

    if ($name != null) {
        header("Location:managefood.php");
        exit();
    }

}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Login</title>
    <!-- Favicon -->
    <link href="./assets/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="./assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="./assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="./assets/css/argon.css?v=1.0.0" rel="stylesheet">
</head>

<body class="bg-default">
<div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
        <div class="container px-4">
            <a class="navbar-brand" href="./login.php">
                <h1 style="color: white">Foodies</h1>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-collapse-main">
                <!-- Collapse header -->
                <div class="navbar-collapse-header d-md-none">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="./login.php">
                                <img src="./assets/img/brand/blue.png">
                            </a>
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Navbar items -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="./register.php">
                            <i class="ni ni-circle-08"></i>
                            <span class="nav-link-inner--text">Register</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="./login.php">
                            <i class="ni ni-key-25"></i>
                            <span class="nav-link-inner--text">Login</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6">
                        <h1 class="text-white">Welcome!</h1>
                        <p class="text-lead text-light">Use these awesome forms to login or create new account in your project for free.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <h1>Sign In</h1>
                        </div>
                        <form role="form" action="login.php" method="post">
                            <div class="form-group mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" name="username" placeholder="Username" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" name="password" placeholder="Password" type="password">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-primary my-4">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">

                    </div>
                    <div class="col-6 text-right">
                        <a href="./register.php" class="text-light"><small>Create new account</small></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
<footer class="py-5">
    <div class="container">
        <div class="row align-items-center justify-content-xl-between">
            <div class="col-xl-6">
                <div class="copyright text-center text-xl-left text-muted">
                    &copy; 2018 <a href="managefood.php" class="font-weight-bold ml-1" target="_blank">Foodie</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Argon Scripts -->
<!-- Core -->
<script src="./assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="./assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- Argon JS -->
<script src="./assets/js/argon.js?v=1.0.0"></script>
</body>

</html>

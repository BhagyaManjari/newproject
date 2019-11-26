<?php
/**
 * Created by PhpStorm.
 * User: tharinduranaweera
 * Date: 5/28/19
 * Time: 6:21 PM
 */

session_start();

require ('./utils/Post.php');

if (isset($_GET['id']) && isset($_GET['productid'])) {
    $id = $_GET['id'];
    $pid = $_GET['productid'];

    $_SESSION['orderid'] = $id;

    $orderurl = "http://localhost/DistributedSystemsMiddleware/getorderbyid.php";
    $producturl = "http://localhost/DistributedSystemsMiddleware/getproductbyid.php";

    $orderresponse = createPostRequest($orderurl, "id=".$id);
    $productresponse = createPostRequest($producturl, "id=".$pid);

    $orderarr = json_decode($orderresponse, true);
    $productarr = json_decode($productresponse, true);

    $shoulddisplay = true;
}

if (isset($_POST['status'])) {
    $url = "http://localhost/DistributedSystemsMiddleware/updatestatus.php";

    $response = createPostRequest($url, "id=".$_SESSION['orderid']."&status=".$_POST['status']);

    $arr = json_decode($response);

    $shoulddisplay = false;

    header("Location:manageorders.php");
    exit();
}




?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Order Info</title>
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

<body>
<!-- Sidenav -->
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="./managefood.php">
            <h1 style="color: black">Foodie</h1>
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ni ni-bell-55"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="./assets/img/theme/team-1-800x800.jpg">
              </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome!</h6>
                    </div>
                    <a href="./examples/profile.html" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>My profile</span>
                    </a>
                    <a href="./examples/profile.html" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>Settings</span>
                    </a>
                    <a href="./examples/profile.html" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>Activity</span>
                    </a>
                    <a href="./examples/profile.html" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>Support</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#!" class="dropdown-item">
                        <i class="ni ni-user-run"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="./index.html">
                            <img src="./assets/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="./managefood.php">
                        <i class="ni ni-tv-2 text-primary"></i> Manage Foods
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./manageorders.php">
                        <i class="ni ni-planet text-blue"></i> Manage Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./login.php">
                        <i class="ni ni-key-25 text-info"></i> Login
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./register.php">
                        <i class="ni ni-circle-08 text-pink"></i> Register
                    </a>
                </li>
            </ul>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
        </div>
    </div>
</nav>
<!-- Main content -->
<div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./index.html">User profile</a>
            <!-- Form -->
            <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
                <div class="form-group mb-0">
                </div>
            </form>
            <!-- User -->
            <ul class="navbar-nav align-items-center d-none d-md-flex">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="./assets/img/theme/team-4-800x800.jpg">
                </span>
                            <div class="media-body ml-2 d-none d-lg-block">
                                <span class="mb-0 text-sm  font-weight-bold">Temp User</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">

                        <a href="#!" class="dropdown-item">
                            <i class="ni ni-user-run"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Header -->
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 100px; background-image: url(./assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->

    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
        <div class="row">

            <div class="col-xl-12 order-xl-12">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Order details</h3>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <form action="orderinfo.php" method="post">
                            <h6 class="heading-small text-muted mb-4">Buyer information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Username</label>
                                            <input type="text" id="input-username" name="username" class="form-control form-control-alternative" placeholder="Username" value="<?php echo $orderarr['buyer_username'] ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Address -->
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-address">Address</label>
                                            <input id="input-address" name="address" class="form-control form-control-alternative" placeholder="Home Address" value="<?php echo $orderarr['address'] ?>" type="text" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-city">City</label>
                                            <input type="text" id="input-city" name="city" class="form-control form-control-alternative" placeholder="City" value="<?php echo $orderarr['city'] ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <h6 class="heading-small text-muted mb-4">Item information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Item No</label>
                                            <input type="text" id="input-first-name" name="item_no" class="form-control form-control-alternative" placeholder="First name" value="<?php echo $orderarr['product_id'] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-last-name">Quantity</label>
                                            <input type="text" id="input-last-name" name="quantity" class="form-control form-control-alternative" placeholder="Last name" value="<?php echo $orderarr['quantity'] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-last-name">Price</label>
                                            <input type="text" id="input-last-name" name="price" class="form-control form-control-alternative" placeholder="Last name" value="<?php echo $orderarr['total_price'] ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <!-- Description -->
                            <h6 class="heading-small text-muted mb-4">Order status</h6>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <input type="text" id="input-last-name" name="status" class="form-control form-control-alternative" placeholder="Status" value="<?php echo $orderarr['confirm_status'] ?>">
                                </div>
                            </div>
                            <div class="col-12 text-right">
                                <input type="submit" value="Update" class="btn btn-sm btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <footer class="footer">
            <div class="row align-items-center justify-content-xl-between">
                <div class="col-xl-6">
                    <div class="copyright text-center text-xl-left text-muted">
                        &copy; 2018 <a href="managefood.php" class="font-weight-bold ml-1" target="_blank">Foodie</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<!-- Argon Scripts -->
<!-- Core -->
<script src="./assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="./assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- Argon JS -->
<script src="./assets/js/argon.js?v=1.0.0"></script>
</body>

</html>

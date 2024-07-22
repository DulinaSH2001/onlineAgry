<!-- plugins:css -->
<link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
<link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
<!-- endinject -->
<!-- plugin css for this page -->
<!-- End plugin css for this page -->
<!-- inject:css -->
<link rel="stylesheet" href="css/style.css">
<!-- endinject -->
<link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
    <?php include 'connect.php'; ?>
    <div class="container-scroller">
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo me-5" href="dashboard.php"><img src="images/newlogo3.png" class="me-2"
                        alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="dashboard.php"><img src="images/logo.png"
                        alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="ti-view-list"></span>
                </button>
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item nav-search d-none d-lg-block">
                        <div class="input-group">
                            <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                                <span class="input-group-text" id="search">
                                    <i class="ti-search"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now"
                                aria-label="search" aria-describedby="search">
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item dropdown me-1">


                    </li>
                    <li class="nav-item dropdown">

                    </li>
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                            <img src="images/faces/face28.jpg" alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">

                            <a class="dropdown-item" href=".././login.php">
                                <i class="ti-power-off text-primary"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="ti-view-list"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">
                            <i class="ti-shield menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                            aria-controls="ui-basic">
                            <i class="ti-palette menu-icon"></i>
                            <span class="menu-title">Product management </span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="addproduct.php">add
                                        product </a></li>
                                <li class="nav-item"> <a class="nav-link" href="producttable.php">product table </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ui-asic" aria-expanded="false"
                            aria-controls="ui-basic">
                            <i class="ti-bookmark-alt menu-icon"></i>
                            <span class="menu-title">Category Management </span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-asic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="addcategory.php">add
                                        Category </a></li>
                                <li class="nav-item"> <a class="nav-link" href="add_subcategory.php">Add
                                        Sub Category</a></li>
                                <li class="nav-item"> <a class="nav-link" href="category_table.php">
                                        Category Table</a></li>
                                <li class="nav-item"> <a class="nav-link" href="sub_category_table.php">
                                        SubCategory Table</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basi" aria-expanded="false"
                            aria-controls="ui-basi">
                            <i class="ti-book menu-icon"></i>
                            <span class="menu-title">Orders Management</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basi">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="New_oredrs.php">New Orders</a></li>
                                <li class="nav-item"> <a class="nav-link" href="tracking_manage.php">Tracking
                                        Orders</a></li>
                                <li class="nav-item"> <a class="nav-link" href="completed_orders.php">Complete
                                        Orders</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basi2" aria-expanded="false"
                            aria-controls="ui-basi2">
                            <i class="ti-book menu-icon"></i>
                            <span class="menu-title">Banner Management</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basi2">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="add_banner_form.php">Add Banner</a></li>
                                <li class="nav-item"> <a class="nav-link" href="manage_banner.php">Manage Banners</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                </ul>
            </nav>
            <!-- partial -->
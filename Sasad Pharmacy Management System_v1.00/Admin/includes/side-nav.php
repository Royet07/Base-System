<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primar" style="background-color: rgba(44,62,80);">
    <!-- Brand Logo -->
    <span href="#" class="animated swing">
        <div class="d-flex ml-2 mt-2" style="width: 100%;">
            <img src="../Assets/images/bg.png" alt="Sasad Logo" style="width: 60px; height: 60px;">
            <div>
                <p class="text-wrap text-left text-bold text-white flex-wrap mt-1 ml-2">
                    Sasad Pharmacy Management System
                </p>
            </div>

        </div>
    </span>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="nav-header">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header text-uppercase" id="bg-color">
                    <h6>
                        <?php
                        if ($_SESSION['AccountType'] == 1) { ?>
                            Admin:
                        <?php } else if ($_SESSION['AccountType'] == 2) { ?>
                            Staff:
                        <?php } else { ?>
                            Client:
                        <?php }

                        if (isset($_SESSION['Fullname'])) {
                            echo $_SESSION['Fullname'];
                        }
                        ?>
                    </h6>
                </li>
                <?php if($_SESSION['AccountType'] == 1 || $_SESSION['AccountType'] == 2) { ?>
                <li class="nav-header text-uppercase" id="bg-color">Home</li>
                <li class="nav-item">
                    <a href="../admin/home.php" class="nav-link">
                        <i class="nav-icon fa fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header text-uppercase" id="bg-color">Manage Records</li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>
                            Product
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-poll-people"></i>
                        <p>
                            Supplier
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>
                            Stock Entry
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-cabinet-filing"></i>
                        <p>
                            Category
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-album-collection"></i>
                        <p>
                            Brand
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-clipboard-list-check"></i>
                        <p>
                            Records
                        </p>
                    </a>
                </li>
                <li class="nav-header text-uppercase" id="bg-color">History</li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-hourglass-half"></i>
                        <p>
                            Sales History
                        </p>
                    </a>
                </li>
                <li class="nav-header text-uppercase" id="bg-color">Settings</li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-badge-sheriff"></i>
                        <p>
                            Pharmacy Settings
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-user-lock"></i>
                        <p>
                            User Settings
                        </p>
                    </a>
                </li>
                <!-- <li class="nav-header text-uppercase" id="bg-color">Manage Users</li>
                    <?php
                    $grp_level = $_SESSION['AccountType'];
                    if ($grp_level == 1) {
                    ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-lock"></i>
                                <p>
                                    Staff Accounts
                                </p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../admin/add-user.php" class="nav-link">
                                        <i class="nav-icon fa fa-plus"></i>
                                        <p>New</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../admin/manage-user.php" class="nav-link">
                                        <i class="nav-icon fa fa-address-book"></i>
                                        <p>Manage</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php
                    }
                    if ($grp_level == 2) {
                    ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-lock"></i>
                                <p>
                                    Client Accounts
                                </p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../admin/add-client.php" class="nav-link">
                                        <i class="nav-icon fa fa-plus"></i>
                                        <p>New</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../admin/manage-client.php" class="nav-link">
                                        <i class="nav-icon fa fa-address-book"></i>
                                        <p>Manage</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php
                    } } else { ?>
                        <li class="nav-item">
                        <a href="../admin/Inventory.php" class="nav-link">
                            <i class="nav-icon fa fa-box-open"></i>
                            <p>
                                Monthly Payables
                            </p>
                        </a>
                    </li>
                <?php } ?> -->

                
                <li class="nav-header text-uppercase" id="bg-color">Settings Session</li>
                <li class="nav-item" style="height: 5rem;">
                    <a href="./Login/logout.php" class="nav-link">
                        <i class="nav-icon fa fa-power-off"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<?php
include './includes/header.php';
include '../DB_folder/db_connection.php';
?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: rgba(62,88,113);">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#">
                        <i class="fas fa-power-off"></i>
                    </a>
                </li> -->
            </ul>
        </nav>
        <!-- /.navbar -->
        <?php include './includes/side-nav.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0" style="color: rgb(31,108,163);"><span class="fa fa-tachometer-alt"></span>
                                Dashboard</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <!-- fix for small devices only -->
                        <div class="clearfix hidden-md-up"></div>
                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1"><i class="fal fa-chart-line" ></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Daily Sales</span>
                                    <span class="info-box-number">
                                        <?php
                                            echo "₱ 0.00";
                                        ?>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- fix for small devices only -->
                        <div class="clearfix hidden-md-up"></div>
                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger elevation-1"><i class="fal fa-boxes-alt" ></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Product Line</span>
                                    <span class="info-box-number">
                                        <?php
                                            echo "0";
                                        ?>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- fix for small devices only -->
                        <div class="clearfix hidden-md-up"></div>
                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-success elevation-1"><i class="fal fa-box-open" ></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Product On Hand</span>
                                    <span class="info-box-number">
                                        <?php
                                            echo "0";
                                        ?>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- fix for small devices only -->
                        <div class="clearfix hidden-md-up"></div>
                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fal fa-engine-warning" ></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Cretical Medicine</span>
                                    <span class="info-box-number">
                                        <?php
                                            echo "0";
                                        ?>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- fix for small devices only
                        <div class="clearfix hidden-md-up"></div>
                        <div class="col-md-12 d-flex flex-wrap">
                            <div class="col-md-12 d-flex flex-wrap">
                                <h3 class="col-md-12 d-flex flex-wrap mt-3">
                                    <small>Monthly Task</small>
                                </h3>
                            </div>
                            <div class="col-md-12">
                                <table id="dtHorizontalExampleSS" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Month</th>
                                            <th>Description</th>
                                            <th>Created By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // $dateNow = date('Y');
                                        // $sql = "SELECT *, a.lname, a.fname FROM monthly_task LEFT JOIN admin a ON created_by = a.id WHERE DATE_FORMAT( `date_created` , '%Y' ) = $dateNow ORDER BY month ASC";

                                        // if ($result = $query = $con->query($sql)) {
                                        //     if (mysqli_num_rows($query) > 0) {
                                        //         while ($row = $query->fetch_assoc()) {
                                        // ?>
                                        //             <tr>
                                        //                 <th style="font-weight: 600;">
                                        //                     <?php
                                        //                     $date =  date('F Y', strtotime($row['month']));
                                        //                     echo $date;
                                        //                     ?>
                                        //                 </th>
                                        //                 <th class="text-sm" style="font-weight: 400;"><span id="goru"><?php echo $row['description']; ?></span></th>
                                        //                 <th class="text-sm" style="font-weight: 400;">
                                        //                     <?php
                                        //                     echo $row['fname'] . ' ' . $row['lname'];
                                        //                     ?>
                                        //                 </th>
                                        //             </tr>
                                        // <?php
                                        //         }
                                        //     }
                                        // }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div> -->
                    </div>
                </div>
                <!-- /.row -->
                <!-- /.row (main row) -->
        </div>
        <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <?php include './includes/footer.php'; ?>

    </div>
    <!-- /.content-wrapper -->
    </div>
    <!-- jQuery -->
    <script src="../Scripts/js/jquery.min.js"></script>
    <script src="../Scripts/js/bootstrap.bundle.min.js"></script>
    <!-- Charts -->
    <script src="../Contents/chart.js/Chart.min.js"></script>
    <script src="../Scripts/js/adminlte.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../Contents/datatables/datatables/jquery.dataTables.min.js"></script>
    <script src="../Contents/datatables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- <script src="../asset/tables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../asset/tables/datatables-buttons/js/buttons.bootstrap4.min.js"></script> -->

</body>

</html>
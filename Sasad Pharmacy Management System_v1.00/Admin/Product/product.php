<?php
include './includes/header.php';
require "../db_folder/db_connection.php";
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
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- /.navbar -->
        <?php include './includes/side-nav.php'; ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0" style="color: rgb(31,108,163);"><span class="fa fa-box-open"></span>
                                Inventory</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Inventory</li>
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
                    <div class="card card-info">
                        <!-- form start -->
                        <div class="card-body">
                            <?php
                            if (isset($_SESSION['error'])) {
                                echo "
                                        <div class='alert alert-danger alert-dismissible'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <h4><i class='fas fa-info-circle'></i> Error!</h4>
                                        " . $_SESSION['error'] . "
                                        </div>
                                    ";
                                unset($_SESSION['error']);
                            }

                            if (isset($_SESSION['success'])) {
                                echo "
                                        <div class='alert alert-success alert-dismissible'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <h4><i class='fas fa-check'></i> Success!</h4>
                                        " . $_SESSION['success'] . "
                                        </div>
                                    ";
                                unset($_SESSION['success']);
                            }
                            ?>
                            <div class="row">
                                <!-- Filter Date Range -->
                                <form name="date_filter" id="date_filter" class="col-md-12 form-inline" method="POST" action="">
                                    <div class="col-md-12 d-flex flex-wrap mt-5">
                                        <div class="col-md-12 d-flex flex-wrap text-center">
                                            <a href="./inventory_function/tot_print_report.php" type="button" class="btn btn-success  ml-2 mr-2 mt-2" title="Refresh"><span class="fa fa-print"> Print Reports<span></a>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-md-12 mt-4" style="border-left: 1px solid #ddd;">
                                    <table id="dtHorizontalExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Product/Inventory Code</th>
                                                <th>Item Description</th>
                                                <th>Address</th>
                                                <th>Code</th>
                                                <th>Remarks</th>
                                                <th>Date Created</th>
                                                <th>Inventory Valuation Method</th>
                                                <th>Unit Price</th>
                                                <th>Quantity in Stocks</th>
                                                <th>Unit of Measurement</th>
                                                <th>Total Weight/Volume</th>
                                                <th>Total Cost</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sum_totalCost = 0;
                                            $userLogID = $_SESSION['admin_id'];
                                            $sql = "SELECT id, product_code, item_description, address, code, remarks, inv_valMethod, unit_price, qty_stocks, UoM, tot_weightVolume, tot_cost, date_created, created_by FROM product 
                                                WHERE date(date_created) IS NULL OR date(date_created) IS NOT NULL
                                                ORDER BY date_created ASC";

                                            if ($result = $query = $con->query($sql)) {
                                                if (mysqli_num_rows($query) > 0) {
                                                    while ($row = $query->fetch_assoc()) {
                                                        $row_month = date_format(date_create($row['date_created']), "Y-m");
                                                        $sum_totalCost += $row['tot_cost'];
                                            ?>
                                                        <tr>
                                                            <td><?php echo $row['product_code']; ?></td>
                                                            <td><?php echo $row['item_description']; ?></td>
                                                            <td><?php echo $row['address']; ?></td>
                                                            <td><?php echo $row['code']; ?></td>
                                                            <td><?php echo $row['remarks']; ?></td>
                                                            <td>
                                                                <?php
                                                                $date =  date('F Y', strtotime($row['date_created']));
                                                                echo $date;
                                                                ?>
                                                            </td>
                                                            <td><?php echo $row['inv_valMethod']; ?></td>
                                                            <td><?php echo $row['unit_price']; ?></td>
                                                            <td><?php echo $row['qty_stocks']; ?></td>
                                                            <td><?php echo $row['UoM']; ?></td>
                                                            <td><?php echo $row['tot_weightVolume']; ?></td>
                                                            <td>
                                                                <?php
                                                                echo number_format($row['tot_cost'], 2, '.', ',');
                                                                ?>
                                                            </td>
                                                        </tr>
                                            <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <div class="col-md-12 d-flex justify-content-end font-weight-bold text-secondary">
                                        <?php 
                                            echo 'Total Cost: ₱'.' '.number_format($sum_totalCost, 2, '.', ',');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
        </div>
        <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        <?php include './includes/footer.php'; ?>
    </div>
    <!-- /.content-wrapper -->
    </div>

    <!-- MODAL BEGIN -->
    <!-- ============================================= -->

    <!-- ADD MODAL -->
    <div class="modal fade" id="modal_add_product" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Add New Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_product_form" method="POST">
                        <div id="modal_body" class="form-group col-md-12 text-center btn-danger" style="display:none;">
                            <h6 id="modal_body" style="display:none;"></h6>
                        </div>
                        <div class="col-md-12 d-flex flex-wrap  ">
                            <input type="hidden" id="product_id_modal" name="product_id_modal">
                            <div class="form-group col-md-12">
                                <label for="pcode_modal">Product/Inventory Code</label>
                                <input type="text" name="pcode_modal" id="pcode_modal" class="form-control" placeholder="Product/Inventory Code" required>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex flex-wrap  ">
                            <div class="form-group col-md-12">
                                <label for="itemdesc_modal">Item Description</label>
                                <textarea name="itemdesc_modal" id="itemdesc_modal" class="form-control" rows="2" cols="12" placeholder="Item Description" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex flex-wrap  ">
                            <div class="form-group col-md-12">
                                <label for="address_modal">Address</label>
                                <textarea name="address_modal" id="address_modal" class="form-control" rows="2" cols="12" placeholder="Address" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex flex-wrap  ">
                            <div class="form-group col-md-12">
                                <label for="code_modal">Code</label>
                                <input type="text" name="code_modal" id="code_modal" class="form-control" placeholder="Code" required>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex flex-wrap  ">
                            <div class="form-group col-md-12">
                                <label for="remarks_modal">Remarks</label>
                                <textarea name="remarks_modal" id="remarks_modal" class="form-control" rows="2" cols="12" placeholder="Remarks" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex flex-wrap  ">
                            <div class="form-group col-md-12">
                                <label for="inv_valMethod_modal">Inventory Valuation Method</label>
                                <textarea name="inv_valMethod_modal" id="inv_valMethod_modal" class="form-control" rows="2" cols="12" placeholder="Inventory Valuation Method" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex flex-wrap  ">
                            <div class="form-group col-md-6">
                                <label for="unit_price_modal">Unit Price</label>
                                <input type="text" name="unit_price_modal" id="unit_price_modal" class="form-control" onkeypress='return event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)' placeholder="Unit Price" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="qty_stocks_modal">Quantity in Stocks</label>
                                <input type="text" name="qty_stocks_modal" id="qty_stocks_modal" class="form-control" onkeypress='return event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)' placeholder="Unit Price" required>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex flex-wrap  ">
                            <div class="form-group col-md-6">
                                <label for="uom_modal">Unit of Measurement</label>
                                <input type="text" name="uom_modal" id="uom_modal" class="form-control" placeholder="Unit of Measurement" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tot_weight_modal">Total Weight/Volume</label>
                                <input type="text" name="tot_weight_modal" id="tot_weight_modal" class="form-control" onkeypress='return event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)' placeholder="Weight/Volume" required>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-start" style="display: none;">
                            <button type="submit" name="add_new_client" id="submit-form" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-start">
                    <label for="submit-form" class="btn btn-primary" tabindex="0">Save</label>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- EDIT MODAL -->
    <div class="modal fade" id="modal_edit_product" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Update Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_client_form" method="POST">
                        <input type="hidden" id="update_pid_modal" name="update_pid_modal">
                        <div class="col-md-12 d-flex flex-wrap  ">
                            <input type="hidden" id="product_id_modal" name="product_id_modal">
                            <div class="form-group col-md-12">
                                <label for="update_pcode_modal">Product/Inventory Code</label>
                                <input type="text" name="update_pcode_modal" id="update_pcode_modal" class="form-control" placeholder="Product/Inventory Code" required>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex flex-wrap  ">
                            <div class="form-group col-md-12">
                                <label for="update_itemdesc_modal">Item Description</label>
                                <textarea name="update_itemdesc_modal" id="update_itemdesc_modal" class="form-control" rows="2" cols="12" placeholder="Item Description" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex flex-wrap  ">
                            <div class="form-group col-md-12">
                                <label for="update_address_modal">Address</label>
                                <textarea name="update_address_modal" id="update_address_modal" class="form-control" rows="2" cols="12" placeholder="Address" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex flex-wrap  ">
                            <div class="form-group col-md-12">
                                <label for="update_code_modal">Code</label>
                                <input type="text" name="update_code_modal" id="update_code_modal" class="form-control" placeholder="Code" required>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex flex-wrap  ">
                            <div class="form-group col-md-12">
                                <label for="update_remarks_modal">Remarks</label>
                                <textarea name="update_remarks_modal" id="update_remarks_modal" class="form-control" rows="2" cols="12" placeholder="Remarks" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex flex-wrap  ">
                            <div class="form-group col-md-12">
                                <label for="update_inv_valMethod_modal">Inventory Valuation Method</label>
                                <textarea name="update_inv_valMethod_modal" id="update_inv_valMethod_modal" class="form-control" rows="2" cols="12" placeholder="Inventory Valuation Method" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex flex-wrap  ">
                            <div class="form-group col-md-6">
                                <label for="update_unit_price_modal">Unit Price</label>
                                <input type="text" name="update_unit_price_modal" id="update_unit_price_modal" class="form-control" onkeypress='return event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)' placeholder="Unit Price" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="update_qty_stocks_modal">Quantity in Stocks</label>
                                <input type="text" name="update_qty_stocks_modal" id="update_qty_stocks_modal" class="form-control" onkeypress='return event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)' placeholder="Unit Price" required>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex flex-wrap  ">
                            <div class="form-group col-md-6">
                                <label for="update_uom_modal">Unit of Measurement</label>
                                <input type="text" name="update_uom_modal" id="update_uom_modal" class="form-control" placeholder="Unit of Measurement" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="update_tot_weight_modal">Total Weight/Volume</label>
                                <input type="text" name="update_tot_weight_modal" id="update_tot_weight_modal" class="form-control" onkeypress='return event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)' placeholder="Weight/Volume" required>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer justify-content-start">
                        <button type="submit" name="update_product" id="update_product" id="submit-form" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- ./wrapper -->

    <!-- DELETE MODAL -->
    <div id="delete_modal_incomeTax" class="modal animated rubberBand delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="../asset/img/sent.png" alt="" width="50" height="46">
                    <h3>Are you sure want to delete?</h3>
                    <input type="hidden" name="del_pid_modal" id="del_pid_modal" class="form-control-sm">
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button data-id="" id="delete_product" class="btn delete btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript" rel="stylesheet">
        $('document').ready(function() {
            $(".alert").fadeIn(900).fadeOut(4900);

            $('#dtHorizontalExample').DataTable({
                "scrollX": true
            });
            $('.dataTables_length').addClass('bs-select');
        });
    </script>

    <script>
        $(document).ready(function() {

            //Focus input on modal Show [UPDATE Product]
            $('#modal_edit_product').on('shown.bs.modal', function() {
                $('#update_pcode_modal').focus();
            })

            //Focus input on modal Show [ADD NEW Product]
            $('#modal_add_product').on('shown.bs.modal', function() {
                $('#pcode_modal').focus();
            })

            //ADD NEW PRODUCT
            $("#add_product_form").on('submit', (function(e) {
                e.preventDefault();
                $.ajax({
                    url: '../admin/inventory_function/add-inventory.php',
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        var jsonData = JSON.parse(response);
                        if (jsonData.success == "1") {
                            alert('Record Successfully Added.');
                            location.href = "./Product_entry.php";
                        } else {
                            alert('Error Adding Record.');
                        }
                    },
                    error: function() {
                        //error message
                        alert('Error Adding Record.');
                    }
                });
            }));

            //GET DELETE Income Tax BY ID
            $(function() {
                $('#delete_modal_incomeTax').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget); /*Button that triggered the modal*/
                    var id = button.data('id');
                    var modal = $(this);
                    modal.find('#del_pid_modal').val(id);
                    $("#delete_product").attr("data-id", id);
                });
            });

            //GET DISPLAY INCOME TAX on POPUP MODAL
            $(function() {
                $('#modal_edit_product').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget); /*Button that triggered the modal*/
                    var product_id = button.data('id');
                    var modal = $(this);

                    $.ajax({
                        url: "../admin/inventory_function/allRecords-inventory.php",
                        type: "POST",
                        cache: false,
                        data: {
                            id: product_id
                        },
                        success: function(dataResult) {
                            var result = JSON.parse(dataResult);
                            if (result.success == 1) {
                                //Update Fields
                                modal.find('#update_pid_modal').val(result.id);
                                modal.find('#update_pcode_modal').val(result.product_code);
                                modal.find('#update_itemdesc_modal').val(result.item_description);
                                modal.find('#update_address_modal').val(result.address);
                                modal.find('#update_code_modal').val(result.code);
                                modal.find('#update_remarks_modal').val(result.remarks);
                                modal.find('#update_inv_valMethod_modal').val(result.inv_valMethod);
                                modal.find('#update_unit_price_modal').val(result.unit_price);
                                modal.find('#update_qty_stocks_modal').val(result.qty_stocks);
                                modal.find('#update_uom_modal').val(result.UoM);
                                modal.find('#update_tot_weight_modal').val(result.tot_weightVolume);
                            } else {
                                alert("Error Retrieving Data.");
                            }
                        }
                    });
                });
            });

            //UPDATE PRODUCT
            $(document).on("click", "#update_product", function() {
                $.ajax({
                    url: '../admin/inventory_function/update-inventory.php',
                    type: "POST",
                    cache: false,
                    data: {
                        update_pid_modal: $('#update_pid_modal').val(),
                        update_pcode_modal: $('#update_pcode_modal').val(),
                        update_itemdesc_modal: $('#update_itemdesc_modal').val(),
                        update_address_modal: $('#update_address_modal').val(),
                        update_code_modal: $('#update_code_modal').val(),
                        update_remarks_modal: $('#update_remarks_modal').val(),
                        update_inv_valMethod_modal: $('#update_inv_valMethod_modal').val(),
                        update_unit_price_modal: $('#update_unit_price_modal').val(),
                        update_qty_stocks_modal: $('#update_qty_stocks_modal').val(),
                        update_uom_modal: $('#update_uom_modal').val(),
                        update_tot_weight_modal: $('#update_tot_weight_modal').val()
                    },
                    success: function(dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        if (dataResult.success == 1) {
                            $('#modal_edit_product').modal().hide();
                            alert('Data Updated Successfully !');
                            location.reload();
                        } else {
                            alert('Data Failed to Update !');
                            location.reload();
                        }
                    }
                });
            });


            //DELETE INCOME TAX
            $(document).on("click", "#delete_product", function() {
                var $ele = $(this).parent().parent();
                var ids = $(this).attr("data-id")
                $.ajax({
                    url: "../admin/inventory_function/delete-inventory.php",
                    type: "POST",
                    cache: false,
                    data: {
                        id: ids
                    },
                    success: function(dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        $('#delete_modal_incomeTax').modal().hide();
                        if (dataResult.status == 1) {
                            alert('Data Deleted Successfully !');
                            location.reload();
                        } else {
                            alert("Error.");
                        }
                    }
                });
            });

            //UPDATE CLIENT PHOTO
            $('#profileImage1').change(function(event) {
                var filePath = $('#profileImage1').val();

                $('#vb').val(filePath);
            });

            $(document).on('click', '.photo', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                getRow(id);
            });

            function getRow(id) {
                var path = '../asset/img/';
                $.ajax({
                    type: 'POST',
                    url: "../admin/lessor_list_function/lessor-row.php",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('.id').val(response.Id);
                        $('#id').val(response.Id);
                        $('#display_Image').attr('src', path + response.photo);
                        $('#vb').val(response.photo);
                        $('#old').val(response.photo);
                        $('.fullname').html(response.firstname + ' ' + response.lastname);
                    },
                    error: function() {
                        alert("Error.");
                    }
                });
            }

        });
    </script>
    <script>
        //UPDATE Lessor PHOTO
        function triggerClick(e) {
            document.querySelector('#profileImage').click();
        }

        function displayImage(e) {
            if (e.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(e.files[0]);
            }
        }

        function triggerClick1(e) {
            document.querySelector('#profileImage1').click();
        }

        function displayImage1(e) {
            if (e.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('#display_Image').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(e.files[0]);
            }
        }
    </script>

    <script src="../asset/js/bootstrap.bundle.min.js"></script>
    <script src="../asset/js/adminlte.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../asset/tables/datatables/jquery.dataTables.min.js"></script>
    <script src="../asset/tables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- <script src="../asset/tables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../asset/tables/datatables-buttons/js/buttons.bootstrap4.min.js"></script> -->
    <script>
        $(function() {
            $("#example1").DataTable();
        });
    </script>
</body>

</html>
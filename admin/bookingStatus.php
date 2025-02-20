<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>dataUser</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">

</head>

<body id="page-top">
    <?php
    session_start();
    include("./php/connect.php");
    if (empty($_SESSION['User'])) {
        header("location:login.php");
    }
    $sql = "SELECT *,TIMESTAMPDIFF(SECOND, outDate, NOW()) AS timeDiff FROM booking";
    $result = mysqli_query($link,$sql);
    foreach($result as $value) {
        if($value['timeDiff']>0 AND $value['status'] == 'รอชำระ'){
            $id = $value['idRoom'];
            $idBooking = $value['idBooking'];
            $sql = "UPDATE typeroom 
            JOIN booking ON typeroom.idTypeRoom = booking.idRoom
            SET 
            booking.status = 'ยกเลิกการจอง',
            typeroom.status = 'ว่าง'
            WHERE
            typeroom.idTypeRoom = '$id' AND booking.idBooking = '$idBooking'";
            $result= mysqli_query($link,$sql);
        }
    }
    ?>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon ">
                    <i class="fas fa-user"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>

            <!-- Divider -->
            <div >
                <hr class="sidebar-divider ">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">
                        <i class="fas fa-fw fa-home"></i>
                        <span>หน้าหลัก</span></a>
                </li>
            </div>

            <div>
                <hr class="sidebar-divider ">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="dataUser.php">
                        <i class="fas fa-fw fa-user"></i>
                        <span>ข้อมูลลูกค้า</span></a>
                </li>
            </div>
            <div>
                <hr class="sidebar-divider ">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="dataBed.php">
                        <i class="fas fa-fw fa-bed"></i>
                        <span>ข้อมูลห้องพัก</span></a>
                </li>
            </div>
            <div>
                <hr class="sidebar-divider ">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="addRoom.php">
                        <i class="fas fa-fw fa-plus"></i>
                        <span>เพิ่มห้องพัก</span></a>
                </li>
            </div>
            <div class="bg-light bg-light shadow-lg bg-body-tertiary">
                <hr class="sidebar-divider ">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="bookingStatus.php">
                        <i class="fas fa-fw fa-check text-primary"></i>
                        <span class="text-primary">สถานะการจอง</span></a>
                </li>
            </div>
            <hr class="sidebar-divider">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['User']; ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>

                <!-- Begin Page Content -->
                <div class="container">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <?php
                            $sql = "SELECT *,TIMESTAMPDIFF(SECOND, bookingDate, outDate) AS timeDiff,(booking.status) AS booking_status FROM booking
                            INNER JOIN typeroom ON booking.idRoom = typeroom.idTypeRoom
                            INNER JOIN user ON booking.idUser = user.idUser
                            ORDER BY 
                            CASE `booking_status`
                            WHEN 'รอชำระ' THEN 1
                            WHEN 'ยกเลิกการจอง' THEN 2
                            WHEN 'ชำระแล้ว' THEN 3
                            END";
                            $result = mysqli_query($link, $sql);
                        ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">ข้อมูลลูกค้า</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center;">
                                    <thead>
                                        <tr>
                                            <th width="10%">ลำดับ</th>
                                            <th>idRoom</th>
                                            <th>ชื่อผู้ใช้</th>
                                            <th>status</th>
                                            <th>ราคารวม</th>
                                            <th>วันที่เช็คอิน</th>
                                            <th>วันที่เช็คเอ้าท์</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th width="10%">ลำดับ</th>
                                            <th>idRoom</th>
                                            <th>ชื่อผู้ใช้</th>
                                            <th>status</th>
                                            <th>ราคารวม</th>
                                            <th>วันที่เช็คอิน</th>
                                            <th>วันที่เช็คเอ้าท์</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            $i = 1;
                                            foreach ($result as $value) {
                                            $cDay = $value['timeDiff'] / (1000 * 60 * 60 * 24);
                                            $cDay = $cDay*1000;
                                        ?>
                                        <tr>
                                            <td width="10%"><?php echo $i++; ?></td>
                                            <td><?php echo $value['idRoom']; ?></td>
                                            <td id="tdUser"><?php echo $value['userName']; ?></td>
                                            <?php
                                            if($value['booking_status'] == 'ชำระแล้ว'){
                                            ?>
                                            <td><button idBooking="<?php echo $value['idBooking']; ?>" id="<?php echo$value['idRoom']; ?>"  class="btn-bk btn btn-success" disabled><?php echo $value['booking_status']; ?></button></td>
                                            <?php
                                            }
                                            else if($value['booking_status'] == 'รอชำระ'){
                                            ?>
                                            <td><button idBooking="<?php echo $value['idBooking']; ?>" id="<?php echo$value['idRoom']; ?>"  class="btn-bk btn btn-warning"><?php echo $value['booking_status']; ?></button></td>
                                            <?php
                                            }
                                            else if($value['booking_status'] == 'ยกเลิกการจอง'){
                                            ?>
                                            <td><button idBooking="<?php echo $value['idBooking']; ?>" id="<?php echo$value['idRoom']; ?>"  class="btn-bk btn btn-danger" disabled><?php echo $value['booking_status']; ?></button></td>
                                            <?php
                                            }
                                            ?>
                                            <td><?php echo number_format($cDay*$value['price']);?></td>
                                            <td><?php echo $value['bookingDate']; ?></td>
                                            <td><?php echo $value['outDate'];?></td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
                

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">คุณต้องการออกจากใช่ไหม</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                    <a class="btn btn-primary" href="./php/logout.php">ตกลง</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script src="./js/bookingStatus.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
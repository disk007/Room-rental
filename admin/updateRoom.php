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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script defer src="./js/updateRoom.js"></script>
    <link rel="stylesheet" href="./css/addRoom.css">
</head>

<body id="page-top">
    <?php
    session_start();
    include("./php/connect.php");
    if (empty($_SESSION['User'])) {
        header("location:login.php");
        if (empty($_GET['id'])) {
            header("location:dataBed.php");
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
            <div>
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
            <div class="bg-light bg-light shadow-lg bg-body-tertiary">
                <hr class="sidebar-divider ">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="dataBed.php">
                        <i class="fas fa-fw fa-bed text-primary"></i>
                        <span class="text-primary">ข้อมูลห้องพัก</span></a>
                </li>
            </div>
            <div>
                <hr class="sidebar-divider ">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="addRoom.php">
                        <i class="fas fa-fw fa-plus "></i>
                        <span>เพิ่มห้องพัก</span></a>
                </li>
            </div>
            <div>
                <hr class="sidebar-divider ">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="bookingStatus.php">
                        <i class="fas fa-fw fa-check"></i>
                        <span>สถานะการจอง</span></a>
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

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

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
                <div class="d-flex justify-content-center">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">รายละเอียดห้องพัก</h6>
                        </div>
                        <?php
                        include("./php/connect.php");

                        $id = $_GET['id'];
                        $dir = "./img/imgRoom/";
                        $path = "./img/imgDetail/";
                        $typeBed = ['เตียงเดียว','เตียงคู่','เตียงรวม'];
                        $typeRoom = ['ห้องแอร์','ห้องพัดลม'];
                        // $sql0 = "SELECT * FROM user WHERE idUser = '$id'";
                        // $result0 = mysqli_query($link, $sql0);
                        // $row = mysqli_fetch_array($result0);
                        $sql = "SELECT *
                            FROM room
                            INNER JOIN picture ON room.idRoom = picture.idpicture
                            INNER JOIN typeroom ON room.idRoom = typeroom.idtyperoom
                            WHERE room.idRoom = '$id'";
                        $result = mysqli_query($link, $sql);
                        $value = mysqli_fetch_array($result);
                        $pictureDe = explode(",", $value['pictureDetail']);
                        ?>

                        <div class="card-body">
                            <form action="./php/editRoom.php" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
                                <div class="form-group mb-4 input-control">
                                    <label for="nameRoom">ชื่อห้องพัก</label>
                                    <input type="text" class="form-control bg-white" id="nameRoom" name="nameRoom" style="width: 500px;" value="<?php echo $value['nameRoom']; ?>" required>
                                    <span class="error1"></span>
                                </div>
                                <div class="form-group ">
                                    <div class="form-row">
                                        <div class="col mb-2 input-control">
                                            <label for="typeRoom">ประเภทห้องพัก</label>
                                            <select class="custom-select" name="typeRoom" id="typeRoom" required>
                                                <option value="<?php echo $value['typeRoom']; ?>"  selected><?php echo $value['typeRoom']; ?></option>
                                                <?php
                                                for($i=0; $i<count($typeRoom); $i++){
                                                    if($typeRoom[$i] != $value['typeRoom']){
                                                ?>
                                                    <option value="<?php echo $typeRoom[$i]; ?>"><?php echo $typeRoom[$i]; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>

                                            </select>
                                            <div class="invalid-feedback">
                                                กรุณาเลือกประเภทห้องพัก
                                            </div>
                                        </div>
                                        <div class="col mb-2 input-control">
                                            <label for="typebed">ประเภทเตียง</label>
                                            <select class="custom-select" name="typeBed" id="typebed" required>
                                                <option value="<?php echo $value['typeBed']; ?>" selected><?php echo $value['typeBed']; ?></option>
                                                <?php
                                                for($i=0; $i<count($typeBed); $i++){
                                                    if($typeBed[$i] != $value['typeBed']){
                                                ?>
                                                    <option value="<?php echo $typeBed[$i]; ?>"><?php echo $typeBed[$i]; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>

                                            </select>
                                            <div class="invalid-feedback">
                                                กรุณาเลือกประเภทเตียง
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="form-row d-flex justify-content-center">
                                        <div class="col-md-6 mb-3 mr-3 input-control">
                                            <label for="price">ราคา</label>
                                            <input type="number" class="form-control bg-white" name="price" id="price" aria-describedby="emailHelp" value="<?php echo $value['price']; ?>" required>
                                            <span class="error1"></span>
                                        </div>
                                        <?php
                                        if ($value['parking'] == 1) {     ?>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="car" name="car" checked >
                                                <label class="form-check-label" for="inlineCheckbox1" style="color: #646F73;">ที่จอดรถ</label>
                                            </div>
                                        <?php } else {
                                        ?>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="car" name="car">
                                                <label class="form-check-label" for="inlineCheckbox1" style="color: #646F73;">ที่จอดรถ</label>
                                            </div>
                                        <?php }
                                        if (($value['wifi'] == 1)) {
                                        ?>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="wifi" name="wifi" checked >
                                                <label class="form-check-label" for="inlineCheckbox2" style="color: #646F73;">WIFI</label>
                                            </div>
                                        <?php } else {
                                        ?>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="wifi" name="wifi" >
                                                <label class="form-check-label" for="inlineCheckbox2" style="color: #646F73;">WIFI</label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="picture-topic ">
                                    <div class="text-center">รูปภาพหน้าปก</div>
                                    <div class="img d-flex justify-content-center mb-3">
                                        <img  class="img-all" style="width: 330px;height: 230px; text-align: center;" id="img-all" src="<?php echo $dir . $value['picture']; ?>" alt="">
                                        
                                    </div>
                                    <div class="form-group">
                                    <div class="form-row input-control">
                                        <div class="col mb-2 mx-1 mr-1">
                                            <input type="file" id="img"  class="form-control  custom-file-input" name="img" accept="image/*" value="<?php $value['picture']; ?>" style="cursor: pointer;" >
                                            <label class="custom-file-label" for="img">เลือกรูปภาพ</label>
                                        </div>
                                    </div>
                                </div>
                                    <div class="text-center">รูปภาพเพิ่มเติม</div>
                                    <div class="img-ano d-flex justify-content-around flex-wrap mb-3" id="img-ano">
                                        <?php
                                        foreach ($pictureDe as $image) {
                                        ?>
                                            <img  id="m1" style="width: 120px;height: 80px;" class="img-all" src="<?php echo $path . $image; ?>" alt="Image 1">
                                        <?php } ?>
                                        <div class="invalid-feedback">
                                                กรุณาเลือกเลือกรูปภาพเพิ่มเติม
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <div class="form-row input-control">
                                        <div class="col mb-2 mx-1 mr-1">
                                            <input type="file" id="imgDetail" class="form-control  custom-file-input" name="imgDetail[]" accept="image/*" multiple style="cursor: pointer;" >
                                            <label class="custom-file-label" for="imgDetail">เลือกรูปภาพเพิ่ม</label>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="form-group input-control">
                                    <label for="detail">รายละเอียด</label>
                                    <textarea class="form-control bg-white" id="detail" name="detail" rows="5" required><?php echo $value['detail']; ?></textarea>
                                    <span class="error1"></span>
                                </div>
                                <input type="text" name="id" id="" value="<?php echo $_GET['id']; ?>" hidden>
                                <button type="submit" id="edit" class="btn btn-primary btn-block" name="edit" disabled>แก้ไขห้องพัก</button>
                            </form>

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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</body>

</html>
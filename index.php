<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script defer src="./js/index.js"></script>
    <script src="https://code.jquery.com/jquery-6.5.1.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Home</title>
</head>

<body>
    <?php
    session_start();
    include("./php/connect.php");

    ?>
    <section class="navbar">
        <div class="logo">
            <a href="index.php"><img src="./logo/02.png" alt="" style="width: 120px; height:100px;"></a>
        </div>
        <ul>

            <?php if (isset($_SESSION['userName'])) {
            ?>
                <div class="dropdown">
                    <div>
                        <button id="dropdownBtn" class="dropbtn"><?php echo $_SESSION['userName']; ?></button>
                    </div>

                    <div id="myDropdown" class="dropdown-content">
                        <a href="./html/dataUser.php"><i class="fa-regular fa-user"></i>&nbsp;ข้อมูลส่วนตัว</a>
                        <a href="./html/history.php"><i class="fa-solid fa-clock-rotate-left"></i>&nbsp;ประการจอง</a>
                        <a href="./php/logout.php"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;ออกจากระบบ</a>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <a href="./html/login.php">
                    <li class="si">sign in</li>
                </a>
                <a href="./html/register.php">
                    <li class="re">Register</li>
                </a>
            <?php
            }
            ?>
        </ul>
    </section>
    <header>
        <div class="header-info">
            <h1>ระบบจองห้องโรงแรม</h1>
            <div class="header-search">
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                    <select name="typeRoom" id="" class="select">
                        <option value="" disabled selected>ประเภทห้อง</option>
                        <option value="ห้องพัดลม">ห้องพัดลม</option>
                        <option value="ห้องแอร์">ห้องแอร์</option>
                    </select>
                    <select name="typeBed" id="" class="select">
                        <option value="" disabled selected>ประเภทเตียง</option>
                        <option value="เตียงเดียว">เตียงเดียว</option>
                        <option value="เตียงคู่">เตียงคู่</option>
                        <option value="เตียงรวม">เตียงรวม</option>
                    </select>
                    <input type="submit" value="ค้นหา" class="select" name="sumit">
                </form>
            </div>
        </div>
    </header>
    <div id="overlay">
        <img id="zoomed-image" src="" alt="Zoomed Image">
    </div>
    <?php
    if (isset($_POST['sumit']) && $_SERVER["REQUEST_METHOD"] == "POST") {
        $typeRoom = null;
        $typeBed = null;
        $dir = "./admin/img/imgRoom/";
        $path = "./admin/img/imgDetail/";
        $whereClause = ""; // เตรียมเงื่อนไข WHERE เริ่มต้น

        if (isset($_POST['typeRoom'])) {
            $typeRoom = $_POST['typeRoom'];
            $whereClause .= " typeroom.typeRoom = '$typeRoom'";
        }
        if (isset($_POST['typeBed'])) {
            $typeBed = $_POST['typeBed'];
            if ($whereClause != "") {
                $whereClause .= " AND ";
            }
            $whereClause .= " typeroom.typeBed = '$typeBed'";
        }

        $sql = "SELECT *
                FROM room
                INNER JOIN picture ON room.idRoom = picture.idPicture
                INNER JOIN typeroom ON room.idRoom = typeroom.idTypeRoom";

        if ($whereClause != "") {
            $sql .= " WHERE $whereClause";
        }
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) > 0) {
            $i = 0;
            foreach ($result as $value) {
                $pictureDe = explode(",", $value['pictureDetail']);
                if ($value['status'] == 'ว่าง') {

    ?>
                    <form action="./html/room.php" method="get">
                        <input type="text" name="idRoom" id="" value="<?php echo $value['idRoom']; ?>" hidden>
                        <?php if (isset($_SESSION['idUser'])) { ?>
                            <input type="text" name="idUser" id="" value="<?php echo $_SESSION['idUser']; ?>" hidden>
                        <?php } ?>
                        <div class="content">
                            <div class="picture-topic">
                                <div class="img">
                                    <img title="คลิกเพื่อขยายรูปภาพ" class="img-all" id="img-all" src="<?php echo $dir . $value['picture']; ?>" alt="">
                                </div>

                                <div class="img-ano" id="img-ano">
                                    <?php
                                    foreach ($pictureDe as $image) {
                                    ?>
                                        <img title="คลิกเพื่อขยายรูปภาพ" id="m1" class="img-all" src="<?php echo $path . $image; ?>" alt="Image 1">
                                    <?php } ?>
                                </div>

                            </div>

                            <div class="detail">
                                <div class="att">
                                    <span><?php echo $value['typeRoom']; ?></span>
                                    <span><?php echo $value['typeBed']; ?></span>
                                    <?php
                                    if ($value['wifi'] == 1) {
                                    ?>
                                        <span>Wifi ฟรี</span>
                                    <?php }
                                    if ($value['parking'] == 1) {
                                    ?>
                                        <span>ที่จอดรถฟรี</span>
                                    <?php
                                    }
                                    ?>
                                    <div class="de">
                                        <?php echo $value['detail']; ?>
                                    </div>

                                </div>

                            </div>
                            <div class="de-price">
                                <div class="night">ราคาต่อคืน</div>
                                <div class="price">฿ <?php echo number_format($value['price']); ?></div>
                                <div class="de-room">
                                    <input type="submit" value="ดูรายละเอียดห้อง">
                                </div>


                            </div>
                        </div>
                    </form>

                <?php
                }
            }
        } else {
        ?>
                <div style="font-size: 40px; margin-top:40px; text-align:center; color:red;font-weight:bold;">ไม่พบข้อมูลที่ค้นหา</div>
    <?php    }
    } else {
        $dir = "./admin/img/imgRoom/";
        $path = "./admin/img/imgDetail/";
        $sql = "SELECT *
            FROM room
            INNER JOIN picture ON room.idRoom = picture.idPicture
            INNER JOIN typeroom ON room.idRoom = typeroom.idTypeRoom";
        $result = mysqli_query($link, $sql);
        $i = 0;
        foreach ($result as $value) {
            $pictureDe = explode(",", $value['pictureDetail']);
            if ($value['status'] == 'ว่าง') {

                ?>
                <form action="./html/room.php" method="get">
                    <input type="text" name="idRoom" id="" value="<?php echo $value['idRoom']; ?>" hidden>
                    <?php if (isset($_SESSION['idUser'])) { ?>
                        <input type="text" name="idUser" id="" value="<?php echo $_SESSION['idUser']; ?>" hidden>
                    <?php } ?>
                    <div class="content">
                        <div class="picture-topic">
                            <div class="img">
                                <img title="คลิกเพื่อขยายรูปภาพ" class="img-all" id="img-all" src="<?php echo $dir . $value['picture']; ?>" alt="">
                            </div>

                            <div class="img-ano" id="img-ano">
                                <?php
                                foreach ($pictureDe as $image) {
                                ?>
                                    <img title="คลิกเพื่อขยายรูปภาพ" id="m1" class="img-all" src="<?php echo $path . $image; ?>" alt="Image 1">
                                <?php } ?>
                            </div>

                        </div>

                        <div class="detail">
                            <div class="att">
                                <span><?php echo $value['typeRoom']; ?></span>
                                <span><?php echo $value['typeBed']; ?></span>
                                <?php
                                if ($value['wifi'] == 1) {
                                ?>
                                    <span>Wifi ฟรี</span>
                                <?php }
                                if ($value['parking'] == 1) {
                                ?>
                                    <span>ที่จอดรถฟรี</span>
                                <?php
                                }
                                ?>
                                <div class="de">
                                    <?php echo $value['detail']; ?>
                                </div>

                            </div>

                        </div>
                        <div class="de-price">
                            <div class="night">ราคาต่อคืน</div>
                            <div class="price">฿ <?php echo number_format($value['price']); ?></div>
                            <div class="de-room">
                                <input type="submit" value="ดูรายละเอียดห้อง">
                            </div>


                        </div>
                    </div>
                </form>

    <?php
            }
        }
    }
    ?>
    <!-- <div class="content">
        <div class="picture-topic">
            <div class="img">
                <img title="คลิกเพื่อขยายรูปภาพ" class="img-all" id="img-all" src="https://plus.unsplash.com/premium_photo-1674676471380-1258cb31b3ac?q=80&w=2009&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
            </div>
            <div class="img-ano" id="img-ano">
                <img title="คลิกเพื่อขยายรูปภาพ" id="m1" class="img-all" src="https://images.unsplash.com/photo-1445019980597-93fa8acb246c?q=80&w=2074&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Image 1">
                <img title="คลิกเพื่อขยายรูปภาพ" id="m2" class="img-all" src="https://plus.unsplash.com/premium_photo-1674676471380-1258cb31b3ac?q=80&w=2009&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Image 2">
                <img title="คลิกเพื่อขยายรูปภาพ" id="m3" class="img-all" src="https://plus.unsplash.com/premium_photo-1674676471380-1258cb31b3ac?q=80&w=2009&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Image 3">
                <img title="คลิกเพื่อขยายรูปภาพ" id="m4" class="img-all" src="https://plus.unsplash.com/premium_photo-1674676471380-1258cb31b3ac?q=80&w=2009&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Image 4">
                <img title="คลิกเพื่อขยายรูปภาพ" id="m5" class="img-all" src="https://plus.unsplash.com/premium_photo-1674676471380-1258cb31b3ac?q=80&w=2009&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Image 5">

            </div>
        </div>
        <div class="detail">
            <div class="att">
                <span>ห้องแอร์</span>
                <span>เตียงคู่</span>
                <span>Wi-Fi ฟรี</span>
                <span>ที่จอดรถฟรี</span>
                <div class="de">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta beatae quo velit distinctio accusantium. Velit corporis explicabo enim non, minima modi exercitationem provident quasi fugit esse cum, saepe ipsa dolorem.
                </div>
            </div>

        </div>
        <div class="de-price">
            <div class="night">ราคาต่อคืน</div>
            <div class="price"> ฿ 2,437</div>
            <div class="de-room">
                <input type="submit" value="ดูรายละเอียดห้อง">
            </div>

        </div>
    </div> -->
    <div class="previous-next">
        <div>
            <a class="a1" href="#">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
        </div>
    </div>
</body>

</html>
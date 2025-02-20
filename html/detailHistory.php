<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/history.css">
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <title>room</title>
</head>

<body>
    <?php
    include "navbar.php";

    if (isset($_POST['btn-history'])) {
        $idRoom = $_POST['idRoom'];
        $id = $_POST['idUser'];
        $idBooking = $_POST['idBooking'];
        // $sql0 = "SELECT * FROM user WHERE idUser = '$id'";
        // $result0 = mysqli_query($link, $sql0);
        // $row = mysqli_fetch_array($result0);

    ?>
        <div id="overlay">
            <img id="zoomed-image" src="" alt="Zoomed Image">
        </div>
        <div class="content">
            <div class="con-flex">
                <div class="menu-left">
                    <div class="dataUser ">
                        <a href="dataUser.php">
                            <i class="fa-solid fa-user"></i>&nbsp;&nbsp;ข้อมูลลูกค้า
                        </a>
                    </div>
                    <div class="history">
                        <a href="history.php" class="active">
                            <i class="fa-solid fa-clock-rotate-left"></i>&nbsp;&nbsp;ประวัติการจอง
                        </a>
                    </div>
                    <div class="logout">
                        <a href="../php/logout.php">
                            <i class="fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp;ออกจากระบบ
                        </a>
                    </div>
                </div>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="menu-right">
                    <div class="topic">รายละเอียดการจอง</div>
                    <?php
                    $dir = "../admin/img/imgRoom/";
                    $path = "../admin/img/imgDetail/";
                    $sql = "SELECT *,booking.idRoom,(booking.status)AS statusBooking,
                    CONCAT(DAY(booking.outDate),' / ',MONTH(booking.outDate),' / ',YEAR(booking.outDate)) AS dayout,
                    CONCAT(DAY(booking.bookingDate),' / ',MONTH(booking.bookingDate),' / ',YEAR(booking.bookingDate)) AS dayBooking,
                    TIMESTAMPDIFF(SECOND, bookingDate, outDate) AS timeDiff
                    FROM booking
                    INNER JOIN picture ON booking.idRoom = picture.idPicture
                    INNER JOIN typeroom ON booking.idRoom = typeroom.idTypeRoom
                    WHERE booking.idUser =  '$id' AND booking.idRoom = '$idRoom' AND booking.idBooking = '$idBooking' ";
                    $result = mysqli_query($link, $sql);
                    $value = mysqli_fetch_array($result);
                        $pictureDe = explode(",", $value['pictureDetail']);
                        $cDay = $value['timeDiff'] / (1000 * 60 * 60 * 24);
                        $cDay = $cDay * 1000;
                    ?>
                        <br>
                            <input type="text" name="idRoom" id="" value="<?php echo $value['idRoom']; ?>" hidden>
                            <?php if (isset($_SESSION['idUser'])) { ?>
                                <input type="text" name="idUser" id="" value="<?php echo $_SESSION['idUser']; ?>" hidden>
                            <?php } ?>
                            <div class="cont">
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
                                <div class="in-out" style="text-align: center;">
                                    <div class="in"><span style="color: black;">วันที่เช็คอิน :</span> <?php echo $value['dayBooking']; ?></div><br>
                                    <div class="in"><span style="color: black;">วันที่เช็คเอ้าท์ :</span> <?php echo $value['dayout']; ?></div><br>
                                    <div class="ning"><?php echo $cDay, " คืน " . number_format($cDay * $value['price']) . " ฿"; ?></div><br>
                                    <div class="status" style="font-size: 20px; font-weight: bold;">
                                        สถานะ :
                                        <span id="status" class="<?php echo ($value['statusBooking'] == 'ชำระแล้ว') ? 'status-su' : (($value['statusBooking'] == 'รอชำระ') ? 'status-wa' : 'status-da'); ?>">
                                            <?php echo $value['statusBooking']; ?>
                                        </span>
                                    </div><br>
                                    <?php
                                    if ($value['statusBooking'] == 'รอชำระ') {
                                    ?>
                                        <button idBooking="<?php echo $value['idBooking']; ?>" id="<?php echo $value['idTypeRoom']; ?>" name="cancle" class="btn-bk btn-danger">ยกเลิกการจอง</button>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        <br>
                        <div class="detail">
                            <div style="font-size:20px;color:black; text-align:left;font-weight:bold;margin-bottom:10px;">รายละเอียด</div>
                            <div class="text-de" ><?php echo $value['detail']; ?></div><br>
                            <div style="font-size:20px;color:black; text-align:left;font-weight:bold;border-top: 1px solid silver; padding-top:20px;">สิ่งที่อำนวยความสะดวก</div><br>
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
                        </div><br>
                </div>
            </div>
        </div>
    <?php } else {
        header("location:../index.php");
    }
    ?>
    <!-- <script defer src="../js/history.js"></script> -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="../js/cancleBooking.js"></script>
    
</body>

</html>
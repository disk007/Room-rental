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

    if (isset($_SESSION['idUser'])) {
        $id = $_SESSION['idUser'];
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
                    <div class="topic"><i class="fa-solid fa-clock-rotate-left"></i>&nbsp;&nbsp;ประวัติการจอง</div>
                    <?php
                    $dir = "../admin/img/imgRoom/";
                    $path = "../admin/img/imgDetail/";
                    $sql = "SELECT picture.picture,booking.idRoom,typeroom.price,(booking.status)AS statusBooking,idBooking,
                    CONCAT(DAY(booking.outDate),' / ',MONTH(booking.outDate),' / ',YEAR(booking.outDate)) AS dayout,
                    CONCAT(DAY(booking.bookingDate),' / ',MONTH(booking.bookingDate),' / ',YEAR(booking.bookingDate)) AS dayBooking,
                    TIMESTAMPDIFF(SECOND, bookingDate, outDate) AS timeDiff
                    FROM booking
                    INNER JOIN picture ON booking.idRoom = picture.idPicture
                    INNER JOIN typeroom ON booking.idRoom = typeroom.idTypeRoom
                    WHERE booking.idUser =  '$id' 
                    ORDER BY 
                    CASE `statusBooking`
                    WHEN 'รอชำระ' THEN 1
                    WHEN 'ยกเลิกการจอง' THEN 2
                    WHEN 'ชำระแล้ว' THEN 3
                    END";
                    $result = mysqli_query($link, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        $i = 0;
                        foreach ($result as $value) {
                            $cDay = $value['timeDiff'] / (1000 * 60 * 60 * 24);
                            $cDay = $cDay * 1000;
                    ?>
                            <form action="./detailHistory.php" method="post">
                                <input type="text" name="idRoom" id="" value="<?php echo $value['idRoom']; ?>" hidden>
                                <input type="text" name="idBooking" id="" value="<?php echo $value['idBooking']; ?>" hidden>
                                <?php if (isset($_SESSION['idUser'])) { ?>
                                    <input type="text" name="idUser" id="" value="<?php echo $_SESSION['idUser']; ?>" hidden>
                                <?php } ?>
                                <div class="cont" >
                                    <div class="picture-topic">
                                        <div class="img">
                                            <img title="คลิกเพื่อขยายรูปภาพ" class="img-all" id="img-all" src="<?php echo $dir . $value['picture']; ?>" alt="">
                                        </div>
                                    </div>
                                    <div class="in-out" style="text-align: center;">
                                        <div class="in"><span style="color: black;">วันที่เช็คอิน :</span> <?php echo $value['dayBooking']; ?></div><br>
                                        <div class="in"><span style="color: black;">วันที่เช็คเอ้าท์ :</span> <?php echo $value['dayout']; ?></div><br>
                                        <div class="ning"><?php echo $cDay, " คืน " . number_format($cDay * $value['price']) . " ฿"; ?></div><br>
                                        <div class="status" style="font-size: 20px; font-weight: bold;">
                                            สถานะ :
                                            <span class="<?php echo ($value['statusBooking'] == 'ชำระแล้ว') ? 'status-su' : (($value['statusBooking'] == 'รอชำระ') ? 'status-wa' : 'status-da'); ?>">
                                                <?php echo $value['statusBooking']; ?>
                                            </span>
                                        </div><br>
                                        <div class="btn-de"><button type="submit" name="btn-history">ดูรายละเอียด</button></div>
                                    </div>
                                </div>
                            </form>
                        <?php
                        }
                    } else {
                        ?>
                        <div style="font-size: 20px; margin-top:40px; text-align:center; color:red;font-weight:bold;">ไม่มีประการจอง</div>
                    <?php    } ?>
                </div>
            </div>
        </div>
        <div class="previous-next">
        <div>
            <!-- <a class="a1" href="#">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a> -->
        </div>
    </div>
    <?php } else {
        echo "<script>
			$(document).ready(function() {
				Swal.fire({
					title: 'คุณยังไม่ได้เข้าสู่ระบบ!',
					text: 'คุณต้องเข้าสู่ระบบก่อน',
					icon: 'warning',
					timer: 5000,
					showConfirmButton: false
				});
			})
		</script>";
        header("refresh:2; url=../index.php");
    }
    ?>
    <script defer src="../js/history.js"></script>
</body>

</html>
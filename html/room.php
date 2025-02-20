<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/room.css">
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <script defer src="../js/room.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.3/dist/flatpickr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>room</title>
</head>

<body>
    <?php
    if(isset($_GET['idUser'])) {
        include("../php/connect.php");
        include "navbar.php";

        $idRoom = $_GET['idRoom'];
        $dir = "../admin/img/imgRoom/";
        $path = "../admin/img/imgDetail/";
        $id = $_GET['idUser'];
        $sql0 = "SELECT * FROM user WHERE idUser = '$id'";
        $result0 = mysqli_query($link, $sql0);
        $row = mysqli_fetch_array($result0);
        $sql = "SELECT *
            FROM room
            INNER JOIN picture ON room.idRoom = picture.idpicture
            INNER JOIN typeroom ON room.idRoom = typeroom.idtyperoom
            WHERE room.idRoom = '$idRoom'";
        $result = mysqli_query($link, $sql);
        $value = mysqli_fetch_array($result);
        $pictureDe = explode(",", $value['pictureDetail']); 

        ?>
        <div id="overlay">
            <img id="zoomed-image" src="" alt="Zoomed Image">
        </div>
        <div class="box">
            <div class="item1">
                <div class="content">
                    <div class="img">
                        <img title="คลิกเพื่อขยายรูปภาพ" class="img1 img-all" id="img1" src="<?php echo $dir.$value['picture']; ?>" alt="">
                    </div>
                    <div class="img-ano " id="img-ano">
                    <?php foreach ($pictureDe as $image) { ?>
                        <img class="img-all" title="คลิกเพื่อขยายรูปภาพ" id="m1" src="<?php echo $path.$image ; ?>" alt="Image 1">
                        <?php }?>
                    </div>
                    
                    <hr>
                    <h3>ชื่อห้อง  : <span style="border: none; color:red"><?php echo $value['nameRoom']; ?></span></h3>
                    <div class="detail">
                        <h3>รายละเอียด</h3>
                        <?php echo $value['detail']; ?>
                    </div>
                    <hr>
                    <div class="att">
                        <h3>สิ่งอำนวยความสะดวก</h3>
                        <span><?php echo $value['typeRoom']; ?></span>
                        <span><?php echo $value['typeBed']; ?></span>
                        <?php
                            if($value['wifi']==1) {
                        ?>
                        <span>Wifi ฟรี</span>
                        <?php } 
                            if($value['parking']==1){
                        ?>
                        <span>ที่จอดรถฟรี</span>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="item2">
                <div class="content">
                    <div class="booking">
                        <h1>การจอง</h1>
                        <div class="form-booking">
                            <form action="../php/bookingRoom.php" method="post" id="form">
                                <div>
                                    <div class="name">
                                    <label for="firstName">ชื่อ : </label>
                                    <input type="text" name="firstName" id="firstName" value="<?php echo $row['firstName'] ; ?>" disabled>&nbsp;&nbsp;&nbsp;
                                    <label for="firstName">นามสกุล : </label>
                                    <input type="text" name="firstName" id="firstName" value="<?php echo $row['lastName']; ?>" disabled>
                                </div>
                                <div class="check">
                                    <label for="in">เช็คอิน :</label>
                                    <input type="date" id="in" name="in">&nbsp;&nbsp;&nbsp;
                                    <label for="out">เช็คเอ้า :</label>
                                    <input type="date" id="out" name="out">
                                    
                                </div>
                                <div class="error" id="error"></div>
                                <div class="price" >
                                    ราคาต่อคืน ฿ <?php echo number_format($value['price']); ?>
                                </div>
                                <div id="priceNinght">
                                    
                                </div>
                                <input type="text" name="price" id="price" value="<?php echo $value['price']; ?>" hidden>
                                <input type="text" name="idRoom" id="" value="<?php echo $idRoom; ?>" hidden>
                                <input type="text" name="idUser" id="" value="<?php echo $id; ?>" hidden>
                                <div class="btn-booking">
                                    <input type="submit" value="จองตอนนี้" name="booking">
                                </div>
                                </div>
                            
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    <?php } 
        else{
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
</body>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.3/dist/flatpickr.min.js"></script>
</html>
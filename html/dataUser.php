<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dataUser.css">
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <script defer src="../js/dataUser.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>room</title>
</head>

<body>
    <?php
    include "navbar.php";
    if (isset($_SESSION['idUser'])) {


        $id = $_SESSION['idUser'];
        $sql0 = "SELECT * FROM user WHERE idUser = '$id'";
        $result0 = mysqli_query($link, $sql0);
        $row = mysqli_fetch_array($result0);

    ?>
        <div class="content">
            <div class="con-flex">
                <div class="menu-left">
                    <div class="dataUser ">
                        <a href="dataUser.php" class="active">
                            <i class="fa-solid fa-user"></i>&nbsp;&nbsp;ข้อมูลลูกค้า
                        </a>
                    </div>
                    <div class="history">
                        <a href="history.php">
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
                    <form action="../php/editUser.php" method="post" id="formEdit">
                        <div class="btn-edit">
                            <button type="submit" id="editData"><i class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp;แก้ไขข้อมูล</button>
                        </div>
                        <div class="name">
                            <label for="firstName">ชื่อ : </label>&nbsp;&nbsp;
                            <input type="text" name="firstName" id="firstName" value="<?php echo $row['firstName']; ?>" disabled>&nbsp;&nbsp;&nbsp;
                            <label for="lastName">นามสกุล : </label>&nbsp;&nbsp;
                            <input type="text" name="lastName" id="lastName" value="<?php echo $row['lastName']; ?>" disabled>
                        </div>
                        <div class="user">
                            <label for="UserName">ชื่อผู้ใช้ : </label>&nbsp;&nbsp;
                            <input type="text" name="userName" id="userName" value="<?php echo $row['userName']; ?>" disabled>
                        </div>
                        <div class="submit-edit">
                            <input type="submit" value="บันทึกข้อมูล" id="editUser" name="editUser" hidden>
                        </div>
                    </form>

                </div>
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
</body>

</html>
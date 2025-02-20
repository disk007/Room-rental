<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
if (isset($_POST['login']) && $_POST['User']!=null && $_POST['password']!=null) {
	session_start();
	$User= $_POST['User'];
	$password = $_POST['password'];
	include("connect.php");
	$sql = "SELECT * FROM user WHERE userName = '$User' ";
	$result = mysqli_query($link, $sql);
	$row = mysqli_Fetch_array($result);
		if ($row) {
			if (password_verify($password, $row['password'])) {
				$_SESSION['userName'] = $row['userName'];
				$_SESSION['idUser'] = $row['idUser'];
				echo "<script>
			$(document).ready(function() {
				Swal.fire({
					title: 'ยินดีต้อนรับ!',
					text: 'เข้าสู่ระบบสำเร็จ!',
					icon: 'success',
					timer: 5000,
					showConfirmButton: false
				});
			})
		</script>";
				header("refresh:2; url=../index.php");
				// header('location:../page/index.php');

			} else {
				echo "<script>
			$(document).ready(function() {
				Swal.fire({
					title: 'รหัสผ่านไม่ถูกต้อง!',
					text: 'กรุณาลองใหม่อีกครั้ง!',
					icon: 'error',
					timer: 5000,
					showConfirmButton: false
				});
			})
		</script>";
				header("refresh:2; url=../html/login.php");
			}
		} else {
			echo "<script>
			$(document).ready(function() {
				Swal.fire({
					title: 'ไม่พบชื่อบัญชีผู้ใช้งาน!',
					text: 'กรุณาลงทะเบียนก่อน!',
					icon: 'warning',
					timer: 5000,
					showConfirmButton: false
				});
			})
		</script>";
			header("refresh:2; url=../html/login.php");
		}
	
}
else{
	 header('location:../html/login.php');
}

?>
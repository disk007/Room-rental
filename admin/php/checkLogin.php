<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
if (isset($_POST['login'])) {
    session_start();
	include("connect.php");

	$User = $_POST['User'];
	$password = $_POST['password'];

	$sql="SELECT * FROM admin WHERE username='$User' AND password='$password'";
	$result=mysqli_query($link,$sql);
	$row = mysqli_fetch_array($result);
	if($row){
		$_SESSION['User'] = $row['username'];
		$_SESSION['id'] = $row['id'];
		echo "<script>
			$(document).ready(function() {
		Swal.fire({
			title: 'ยินดีต้อนรับ!',
			text: 'เข้าสู่ระบบสำเร็จ!',
			icon: 'success',
			timer: 2000,
			showConfirmButton: false
		});
		})
		</script>";
		header("refresh:2; url=../index.php");

			} 
		else {
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
			header('refresh:2; ../login.php');
		}
	}
	else{
		header('Location: ../html/login.php');
	}
	
?>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php 
    session_start();
    session_destroy();
    echo "<script>
			$(document).ready(function() {
				Swal.fire({
					title: 'ออกจากระบบ!',
					text: 'สำเร็จ!',
					icon: 'success',
					timer: 5000,
					showConfirmButton: false
				});
			})
		</script>";
        header("refresh:2; url=../login.php");
?>

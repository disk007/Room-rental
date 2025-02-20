<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
	if(isset($_POST['booking'])){
		include ("connect.php");
        $date = date("H:i:s", strtotime("10:00:00"));
        $idUser = $_POST['idUser'];
        $idRoom = $_POST['idRoom'];
        $inDate = $_POST['in']." ".$date;
        $outDate = $_POST['out']." ".$date;
        
        echo $idUser,",", $idRoom,",", $inDate,"," ,$outDate;
        

        $sql = "INSERT INTO booking(idRoom,bookingDate,outDate,idUser,status) VALUES('$idRoom','$inDate','$outDate','$idUser','รอชำระ')";
        $result = mysqli_query($link,$sql);
        $sql = "UPDATE typeRoom SET status = 'ไม่ว่าง' WHERE idTypeRoom = '$idRoom' ";
        $result = mysqli_query($link,$sql);
    
        if($result){
            echo "<script>
            $(document).ready(function() {
            Swal.fire({
            title: 'สำเร็จ!',
            text: 'เพิ่มการจองสำเร็จ!',
            icon: 'success',
            timer: 2000,
            showConfirmButton: false
        });
        })
        </script>";
        header("refresh:2; url=../index.php");
        }
        else{
                echo "ไม่เรียบร้อย";  
        }
	}
    else{
         header("location:../index.php");
    }

?>
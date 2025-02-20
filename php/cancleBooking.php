<?php
    if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST['id']) AND isset($_POST['idBooking'])){
        include ("connect.php");
        $id = $_POST['id'];
        $idBooking = $_POST['idBooking'];

        $sql = "UPDATE booking
        JOIN typeroom ON booking.idroom = typeroom.idTypeRoom
        SET 
        booking.status = 'ยกเลิกการจอง',
        typeroom.status = 'ว่าง'
        WHERE
            typeroom.idTypeRoom = '$id' AND booking.idBooking = '$idBooking'";
        $result=mysqli_query($link,$sql);
        if($result){
            echo "<script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'สำเร็จ!',
                    text: 'ยกเลิกการจองสำเร็จ!',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
            })
            </script>";
            header("refresh:2; url=../html/detailHistory.php");
        }
        else{
            echo "ไม่สำเร็จ";
        }

    }
    else{
        header('location:../index.php');
    }

?>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST['id']) AND isset($_POST['idBooking'])){
        include ("connect.php");
        $id = $_POST['id'];
        $idBooking = $_POST['idBooking'];

        $sql = "UPDATE booking
        JOIN typeroom ON booking.idroom = typeroom.idTypeRoom
        SET 
        booking.status = 'ชำระแล้ว',
        typeroom.status = 'ว่าง'
        WHERE
            typeroom.idTypeRoom = '$id' AND booking.idBooking = '$idBooking'";
        $result=mysqli_query($link,$sql);
        if($result){
            echo "สำเร็จ";
        }
        else{
            echo "ไม่สำเร็จ";
        }

    }
?>
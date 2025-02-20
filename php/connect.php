<?php
	$link = mysqli_connect("localhost", "root");
    mysqli_set_charset($link,'utf8');
    $result = mysqli_query($link, "USE miniproject");

	// if (!$result) {
	//     // ถ้าการเลือกใช้ฐานข้อมูลไม่สำเร็จ
	//     echo "การเลือกใช้ฐานข้อมูลล้มเหลว: " . mysqli_error($link);
	// }
    // else{
    //     echo "การเลือกใช้ฐานข้อมูลสำเร็จ";
    // }
?>
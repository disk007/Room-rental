<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
	if(isset($_POST['add'])){

        session_start();
		include ("connect.php");

        $nameRoom = $_POST['nameRoom'];
        $typeRoom = $_POST['typeRoom'];
        $typeBed = $_POST['typeBed'];
        $typeRoom = $_POST['typeRoom'];
        $price = $_POST['price'];
        $car = false;
        $wifi = false;
        $detail = $_POST['detail'];
        date_default_timezone_set("Asia/Bangkok");
		$date=date("Y-m-d H:i:s");

        if($typeRoom=="ari"){
            $typeRoom = "ห้องแอร์";
        }
        else{
            $typeRoom = "ห้องพัดลม";
        }
        if($typeBed == "1"){
            $typeBed = "เตียงเดียว";
        }
        elseif($typeBed == "2"){
            $typeBed = "เตียงคู่";
        }
        elseif($typeBed == "3"){
            $typeBed = "เตียงรวม";
        }
        if(isset($_POST['car'])){
            $car = true;   
        }
        if(isset($_POST['wifi'])){
            $wifi = true;   
        }
        $dir = "../img/imgRoom/";
        $status = "ว่าง";

		$sql = "SELECT * FROM room WHERE nameRoom = '$nameRoom' ";
        $result = mysqli_query($link,$sql);
        if (mysqli_num_rows($result)>0) {
                echo "<script>
                $(document).ready(function() {
                        Swal.fire({
                                title: 'ชื่อห้องซ้ำ !',
                                text: 'กรุณาลองใหม่อีกครั้ง!',
                                icon: 'error',
                                timer: 5000,
                                showConfirmButton: false
                        });
                })
        </script>";
        header("refresh:2; url=../addRoom.php");
        }
        else{
		$dir = "../img/imgRoom/";
        $nameImg = rand(0,microtime(true)).'-'.$_FILES["img"]["name"];
		$fileImage = $dir.$nameImg;
		$img = $_FILES["img"]["name"];

        echo $img."<br>";
        $imgDetail = $_FILES['imgDetail']['name'];
        $image_tmp = $_FILES['imgDetail']['tmp_name'];
        $location = "../img/imgDetail/";
        // ดึงข้อมูลรูปภาพจากฐานข้อมูล
		
		if (move_uploaded_file($_FILES["img"]["tmp_name"], $fileImage)) {
			null;
		}
		else{
			echo "เกิดข้อผิดพลาดในการอัพโหลดไฟล์ของคุณ";
		}
        $nameImgDetail= [];
        foreach ($imgDetail as $key => $val){
            $fileImageDetail = rand(0,microtime(true)).'-'.$val;
            $targetPath = $location.$fileImageDetail;
            move_uploaded_file($_FILES['imgDetail']['tmp_name'][$key],"$targetPath");
            $nameImgDetail[] = $fileImageDetail;
        }
        
        $allNameImgDetail = implode(",",$nameImgDetail);
        // echo $allNameImgDetail."<br>";
        $sql = "INSERT INTO picture(picture,pictureDetail) VALUES('$nameImg','$allNameImgDetail');";
        $result = mysqli_query($link,$sql);


		$sql = "INSERT INTO room(nameRoom,createdAt) 
    			VALUES('$nameRoom','$date');";

    	 $result = mysqli_query($link,$sql);

         $sql = "INSERT INTO typeroom(typeRoom,typeBed,price,detail,wifi,parking,status) 
    			VALUES('$typeRoom','$typeBed','$price','$detail','$wifi','$car','$status');";
    	 $result = mysqli_query($link,$sql);
            if($result){
                echo "<script>
                $(document).ready(function() {
            Swal.fire({
                title: 'สำเร็จ!',
                text: 'เพิ่มห้องพักสำเร็จ!',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            });
            })
            </script>";
            header("refresh:2; url=../addRoom.php");
            }
            else{
                    echo "ไม่เรียบร้อย";  
            }
        }
	}
    else{
         header("location:../index.php");
    }

?>
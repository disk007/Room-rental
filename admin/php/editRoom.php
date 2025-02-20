<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    if(isset($_POST['edit'])){
        session_start();
		include ("connect.php");
        $id = $_POST['id'];
        $nameRoom = $_POST['nameRoom'];
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
            $typeRoom = $_POST['typeRoom'];
            $typeBed = $_POST['typeBed'];
            $typeRoom = $_POST['typeRoom'];
            $price = $_POST['price'];
            $car = false;
            $wifi = false;
            $detail = $_POST['detail'];
            date_default_timezone_set("Asia/Bangkok");
            $date=date("Y-m-d H:i:s");
            echo $id."<br>";
            if(isset($_POST['car'])){
                $car = true;   
            }
            if(isset($_POST['wifi'])){
                $wifi = true;   
            }
            $chImg = 0;
            $chImgDe = 0;
            if( $_FILES["img"]["name"]){
                $chImg = 1;
            }
            if($_FILES['imgDetail']['name'][0]){
                $chImgDe = 1;
            }

            $location = "../img/imgDetail/";
            $dir = "../img/imgRoom/";
            
            $nameImg = rand(0,microtime(true)).'-'.$_FILES["img"]["name"];
            $fileImage = $dir.$nameImg;
            $img = $_FILES["img"]["name"];

            echo $img."<br>";
            $imgDetail = $_FILES['imgDetail']['name'];
            $image_tmp = $_FILES['imgDetail']['tmp_name'];
            $location = "../img/imgDetail/";
            // ดึงข้อมูลรูปภาพจากฐานข้อมูล
            
            

            if($chImgDe == 1){
                $sql = "SELECT * FROM picture WHERE idPicture='$id'";
                $result = mysqli_query($link, $sql);
                $value = mysqli_fetch_array($result);
                $pictureDe = explode(",", $value['pictureDetail']);
                
                foreach ($pictureDe as $image) {
                    $imgNew = $location.$image;
                    if (unlink($imgNew)) {
                        null;
                    }
                    else{
                        echo "ไม่สามารถลบได้";
                    }   
                }
                $nameImgDetail= [];
                foreach ($imgDetail as $key => $val){
                    $fileImageDetail = rand(0,microtime(true)).'-'.$val;
                    $targetPath = $location.$fileImageDetail;
                    move_uploaded_file($_FILES['imgDetail']['tmp_name'][$key],"$targetPath");
                    $nameImgDetail[] = $fileImageDetail;
                }
                $allNameImgDetail = implode(",",$nameImgDetail);
                $sql="UPDATE picture SET pictureDetail='$allNameImgDetail' WHERE idPicture='$id'";
                $result=mysqli_query($link,$sql);
            }
            if($chImg == 1){
                $sql = "SELECT * FROM picture WHERE idPicture='$id'";
                $result = mysqli_query($link, $sql);
                $value = mysqli_fetch_array($result);
                $imgNew = $dir.$value['picture'];
                    if (unlink($imgNew)) {
                        echo "ลบไฟล์สำเร็จ.";
                    } else {
                        echo "ไม่สามารถลบไฟล์ได้.";
                    }
                if (move_uploaded_file($_FILES["img"]["tmp_name"], $fileImage)) {
                    null;
                }
                else{
                    echo "เกิดข้อผิดพลาดในการอัพโหลดไฟล์ของคุณ";
                }
                $sql="UPDATE picture SET picture='$nameImg' WHERE idPicture='$id'";
                $result=mysqli_query($link,$sql);
            }
            
            $sql = "UPDATE room
            JOIN typeroom ON room.idroom = typeroom.idTypeRoom
            SET 
            room.nameRoom = '$nameRoom',
            room.createdAt = '$date',
            typeroom.typeRoom = '$typeRoom',
            typeroom.typeBed = '$typeBed',
            typeroom.price = '$price',
            typeroom.detail = '$detail',
            typeroom.wifi = '$wifi',
            typeroom.parking = '$car'
            WHERE
                room.idRoom = '$id' AND typeroom.idTypeRoom = '$id'";
            $result=mysqli_query($link,$sql);

            if($result){
                echo "<script>
                            $(document).ready(function() {
                                Swal.fire({
                                    title: 'สำเร็จ!',
                                    text: 'อัตเดตห้องสำเร็จ',
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            })
                        </script>";
                    header("refresh:2; url=../dataBed.php");
                }
            else{
                echo "<script>
                            $(document).ready(function() {
                                Swal.fire({
                                    title: 'ล้มเหลว',
                                    text: 'ไม่สำเร็จ',
                                    icon: ''error'',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            })
                        </script>";
                    header("refresh:2; url=../dataBed.php");
            }
        }
    }
    else{
        header("location:../dataBed.php");
    }
?>
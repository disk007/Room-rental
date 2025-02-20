<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    include ("connect.php");
    $id = $_GET['id'];
    if(isset($_GET['id'])){
        session_start();
		
        $dirImg = "../img/imgRoom/";
        $dirImgDe = "../img/imgDetail/";
        echo $id."<br>";
        $sql = "SELECT * FROM typeroom WHERE idTypeRoom = '$id' AND status = 'ไม่ว่าง' ";
        $result = mysqli_query($link,$sql);
        $row = mysqli_fetch_array($result);
        if($row['status']){
            echo "<script>
                    $(document).ready(function() {
                        Swal.fire({
                            title: 'ไม่สำเร็จ!',
                            text: 'เนื่องจากห้องนี้มีการจองอยู่',
                            icon: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    })
                </script>";
            header("refresh:2; url=../dataBed.php");
        }
        else{
            $sql ="SELECT * FROM picture WHERE idPicture = '$id' ";
            $result = mysqli_query($link,$sql);
            $value = mysqli_fetch_array($result);
            $imgNew = $dirImg.$value['picture'];
                if (unlink($imgNew)) {
                    echo "ลบไฟล์สำเร็จ.";
                } else {
                    echo "ไม่สามารถลบไฟล์ได้.";
                }
            $pictureDe = explode(",", $value['pictureDetail']); 
            foreach ($pictureDe as $image) {
                $imgNew = $dirImgDe.$image;
                if (unlink($imgNew)) {
                    null;
                }
                else{
                    echo "ไม่สามารถลบได้";
                }
            }
            $sql = "DELETE room, typeroom, picture
                    FROM room
                    JOIN typeroom ON room.idroom = typeroom.idTypeRoom
                    JOIN picture ON room.idroom = picture.idPicture
                    WHERE room.idRoom = '$id' AND typeroom.idTypeRoom = '$id'";
            $result = mysqli_query($link,$sql);
            
            echo "<script>
                    $(document).ready(function() {
                        Swal.fire({
                            title: 'สำเร็จ!',
                            text: 'ลบห้องสำเร็จ',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    })
                </script>";
            header("refresh:2; url=../dataBed.php");

        }
    }
    else{
        header("location:../dataBed.php");
    }
?>
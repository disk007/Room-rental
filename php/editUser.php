<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php

session_start();
// echo $_POST['firstName'];
if($_POST['firstName']!=null && $_POST['lastName']!=null && $_POST['userName']!=null){
    include("connect.php");
    $id = $_SESSION['idUser'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $userName = $_POST['userName'];
    $sql = "SELECT * FROM user WHERE userName = '$userName' AND idUser != $id";
    $result = mysqli_query($link,$sql);
    if (mysqli_num_rows($result)>0) {
        echo "<script>
        $(document).ready(function() {
                Swal.fire({
                        title: 'Usernameซ้ำ !',
                        text: 'กรุณาลองใหม่อีกครั้ง!',
                        icon: 'error',
                        timer: 5000,
                        showConfirmButton: false
            });
        })
    </script>";
    header("refresh:2; url=../html/dataUser.php");
    }
    else{
        $sql = "UPDATE user SET firstName = '$firstName', lastName = '$lastName', userName = '$userName' WHERE idUser = '$id'";
        $result = mysqli_query($link,$sql);
        if($result){
            echo "<script>
            $(document).ready(function() {
                    Swal.fire({
                            title: 'สำเร็จ!',
                            text: 'อัพเดทชื่อสำเร็จ!',
                            icon: 'success',
                            timer: 5000,
                            showConfirmButton: false
                    });
            })
            </script>";
        header("refresh:2; url=../html/dataUser.php");
        }
        else{
                echo "<script>
                $(document).ready(function() {
                        Swal.fire({
                                title: 'ผิดพลาด!',
                                text: 'กรุณาลองใหม่อีกครั้ง!',
                                icon: 'error',
                                timer: 5000,
                                showConfirmButton: false
                        });
                })
        </script>";
        header("refresh:2; url=../html/editUser.php");
        }
    }

}
else{
    header('location:../index.php');
}

?>
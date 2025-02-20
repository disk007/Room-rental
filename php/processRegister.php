<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    if (isset($_POST['register'])) {
        include ("connect.php");

        $fName=$_POST['fName'];
        $lName=$_POST['lName'];
        $User=$_POST['User'];
        $password=$_POST['password'];
        $date=date("Y-m-d");

        $sql = "SELECT * FROM user WHERE userName = '$User' ";
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
        header("refresh:2; url=../html/register.php");
        }
        else{
                $pwd = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO user(firstName,lastName,userName,password,createdAt) VALUES('$fName','$lName','$User','$pwd','$date');";

                $result = mysqli_query($link,$sql);
                if($result){
                        echo "<script>
                        $(document).ready(function() {
                                Swal.fire({
                                        title: 'ยินดีต้อนรับ!',
                                        text: 'สมัครสมาชิกสำเร็จ!',
                                        icon: 'success',
                                        timer: 5000,
                                        showConfirmButton: false
                                });
                        })
                        </script>";
                    header("refresh:2; url=../html/login.php");
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
                header("refresh:2; url=../index.php");
                }
                        
            }
        }
        else{
            header('Location: ../index.php');
        }
?>

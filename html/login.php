<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>login</title>
</head>

<body>
    <div class="log-in">
        <div class="container">
            <div class="div-img" style="text-align: center;">
            <a href="../index.php">
                <img style="width: 180px; height:150px;" src="../logo/02.png" alt="" title="ไปหน้าหลัก">
            </a>
            </div>
            
            <form action="../php/checkLogin.php" method="post" id="form">
                <div class="input-box">
                    <input type="text" placeholder="Username" id="User" name="User">
                    <span class="error"></span>
                </div>
                <div class="input-box">
                    <input type="password" name="password" id="pwd" placeholder="Password" class="input" >
                    <span class="error"></span>
                </div>
                <input type="submit" value="Sign in" class="btn" id="btn" name="login">
            </form><br>
            <a href="./register.php" class="register">Register</a>
        </div>
    </div>
</body>

</html>
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
            <h1>Admin</h1>
            <form action="./php/checkLogin.php" method="post" id="form">
                <div class="input-box">
                    <input type="text" placeholder="Username" id="User" name="User">
                    <span class="error"></span>
                </div>
                <div class="input-box">
                    <input type="password" name="password" id="pwd" placeholder="Password" class="input">
                    <span class="error"></span>
                </div>
                <input type="submit" value="Sign in" class="btn" id="btn" name="login">
            </form>
        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/register.css">
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <script defer src="../js/register.js"></script>
    <title>Register</title>
</head>

<body>
    <div class="item">
        <div class="content">
            <div class="form">
                <div class="topic">
                    form Register
                </div>
                <form action="../php/processRegister.php" method="post" id="form">
                    <div class="data">
                        <div class="input-control">
                            <label for="">First Name </label> <br>
                            <input type="text" name="fName" id="fName" placeholder="First Name"><br>
                            <span class="error"></span>
                        </div>
                        <div class="input-control">
                            <label for="">Last Name</label> <br>
                            <input type="text" name="lName" id="lName" placeholder="Last Name"><br>
                            <span class="error"></span>
                        </div>
                        <div class="input-control">
                            <label for="">User Name</label> <br>
                            <input type="text" name="User" id="User" placeholder="User Name"><br>
                            <span class="error"></span>
                        </div>
                        <div class="input-control">
                            <label for="">Password</label> <br>
                            <input type="password" name="password" id="pwd" placeholder="Password"><br>
                            <span class="error"></span>
                        </div>
                        <div class="input-control">
                            <label for="">Confirm Password</label> <br>
                            <input type="password" name="cPwd" id="cPwd" placeholder="Confirm Password"><br>
                            <span class="error"></span>
                        </div>
                        <input type="submit" value="Register" id="register" class="register" name="register" disabled>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
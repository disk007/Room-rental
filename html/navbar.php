<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    .navbar {
        display: flex;
        background-color: #2f2626;
        padding: 1%;
    }

    ul {
        display: flex;
        width: 100%;
        justify-content: right;
        align-items: center;
        list-style: none;
        text-decoration: none;
    }

    ul a li {
        /* margin: 0 1rem; */
        padding: 10px 20px 10px 20px;
        border-radius: 10px;
    }

    ul .si {
        font-size: 18px;
        font-weight: bold;
        background-color: #0cbf59;
        transition: 0.5s;
    }

    ul .re {
        font-size: 18px;
        font-weight: bold;
        background-color: #F62217;
        transition: 0.5s;
        margin-left: 1%;
    }

    ul .si:hover {
        background-color: #099746;
    }

    ul .re:hover {
        background-color: #c61b12;
    }

    ul a {
        color: #fff;
        text-decoration: none;
        margin-left: 1%;
    }

    .logo {
        display: flex;
        width: 20%;
        justify-content: center;
        align-items: center;
    }
    /* สไตล์สำหรับ Dropdown */
.dropdown {
    color: #fff;
    margin-right: 1%;
    position: relative;
    display: inline-block;
    
}
.dropdown button{
    background-color:#2f2626;
    border: none;
    padding: 10px 20px 10px 20px;
    font-size: 18px;
    font-weight: bold;
    color: #fff;
    cursor: pointer;
    border: 1px solid white;
    border-radius: 10px;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
    right: 0%;
    top: 55px;
    border-radius: 5px;
    font-size: 18px;
}

.show {
    display: block;
}

/* สไตล์สำหรับ Option */
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: #f1f1f1;
}
</style>
<?php
    session_start();
    include("../php/connect.php");
        
    ?>
<section class="navbar">
    <div class="logo">
        <a href="../index.php"><img src="../logo/02.png" alt="" style="width: 120px; height:100px;"></a>
    </div>
    <ul>
    <?php if(isset($_SESSION['userName'])) {
             ?>
                <div class="dropdown">
                    <div>
                        <button id="dropdownBtn" class="dropbtn"><?php echo $_SESSION['userName']; ?></button>
                    </div>
                    
                    <div id="myDropdown" class="dropdown-content">
                        <a href="./dataUser.php"><i class="fa-regular fa-user"></i>&nbsp;ข้อมูลส่วนตัว</a>
                        <a href="./history.php"><i class="fa-solid fa-clock-rotate-left"></i>&nbsp;ประการจอง</a>
                        <a href="../php/logout.php"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;ออกจากระบบ</a>
                    </div>
                </div>
            <?php
                }
                else{
            ?>
                    <a href="./html/login.php">
                        <li class="si">sign in</li>
                    </a>
                    <a href="./html/register.php">
                        <li class="re">Register</li>
                    </a>
            <?php
                }
            ?>
    </ul>
</section>
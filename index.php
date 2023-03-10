<?php require('connection.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h2>Watch world</h2>
        <nav>
            <a href="index.php">Home</a>
            <a href="index.php">blog</a>
            <a href="index.php">Contact</a>
            <a href="index.php">About us</a>
        </nav>
        <!----session hello---->
        <?php
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
            echo "
            <div class='user'> 
            Welcome $_SESSION[username]-<a href='logout.php'>LOGOUT</a>
            </div>";
        } else {
            echo "
            <div class='sign-in-up'>
            <button type='button' onclick='popup(\"login-popup\")'>LOGIN</button>
            <button type='button' onclick='popup(\"register-popup\")'>REGISTER</button>
        </div>
        ";
        }

        ?>



    </header>
    <div class="popup-container" id="login-popup">
        <div class="popup">
            <form method="post" action="login_register.php">
                <h2>
                    <span>USER LOGIN</span>
                    <button type="reset" onclick="popup('login-popup')">x</button>

                </h2>
                <label>Username:</label><br>
                <input type="text" name="email_username"><br>
                <label>Password:</label><br>
                <input type="password" name="password">
                <button type="submit" class="login-button" name="login">LOGIN</button>
            </form>

        </div>
    </div>


    <div class="popup-container" id="register-popup">
        <div class="register popup">
            <form method="post" action="login_register.php">
                <h2>
                    <span>USER Registeration</span>
                    <button type="reset" onclick="popup('register-popup')">x</button>

                </h2>
                <label>Full Name:</label><br>
                <input type="text" name="fullname"><br>
                <label>Username:</label><br>
                <input type="text" name="username"><br>
                <label>Email:</label><br>
                <input type="email" name="email">
                <label>Password:</label><br>
                <input type="password" name="password">

                <button type="submit" class="signup-btn" name="register">Register</button>
            </form>

        </div>
    </div>


    <?php
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
        echo "<h1 style='text-align:center; margin-top:200px;' '> welcome to the website- $_SESSION[username]</h1>";
    }
    ?>


    <script>
        function popup(popup_name) {
            get_popup = document.getElementById(popup_name);
            if (get_popup.style.display == "flex") {
                get_popup.style.display = "none";
            } else {
                get_popup.style.display = "flex";
            }

        }
    </script>


</body>

</html>
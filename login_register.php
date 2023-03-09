<?php


require('connection.php');
session_start();


//for login
if (isset($_POST['login'])) {
    $query = "SELECT * FROM `user_table` WHERE `email`='$_POST[email_username]' OR `username`='$_POST[email_username]'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $result_fetch = mysqli_fetch_assoc($result);
            if (password_verify($_POST['password'], $result_fetch['password'])) {
                //if pass matched
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $result_fetch['username'];
                header("location: index.php");
            } else {
                //if pss not matched.
                echo "
<script>
    alert('Incorrect password !!');
    window.location.href = 'index.php';
</script>";
            }
        } else {
            echo "
<script>
    alert('login succesfull.');
    window.location.href = 'index.php';
</script>";
        }
    } else {
        echo "
<script>
    alert('Sorry!! the querry cant be run');
    window.location.href = 'index.php';
</script>";
    }
}





//for registeration
if (isset($_POST['register'])) {
    $user_exist_query = "SELECT * FROM `user_table` WHERE `username`='$_POST[username]' or `email`='$_POST[email]'";
    $result = mysqli_query($conn, $user_exist_query);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $result_fetch = mysqli_fetch_assoc($result);
            if ($result_fetch['username'] == $_POST['username']) {
                echo "
<script>
    alert('$result_fetch[username] - username already registered');
    window.location.href = 'index.php';
</script>";
            } else {
                echo "
<script>
    alert('$result_fetch[email] - E-mail already registered.');
    window.location.href = 'index.php';
</script>";
            }
        } else {
            //pass encrypt blowfish.
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $query = "INSERT INTO `user_table`(`fullname`, `username`, `email`, `password`) VALUES ('$_POST[fullname]','$_POST[username]','$_POST[email]','$password')";
            if (mysqli_query($conn, $query)) {
                //if data inserted then display this
                echo "
<script>
    alert('Registeration Successfull');
    window.location.href = 'index.php';
</script>";
            }
        }
    } else {
        //if data can not be inserted
        echo "
<script>
    alert('cannot run the query');
    window.location.href = 'index.php';
</script>";
    }
}

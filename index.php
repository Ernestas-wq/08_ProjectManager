<?php
session_start();
$str = file_get_contents('users.json');
$users = json_decode($str, true);



if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['login']) && !empty($_POST['username'])
&& !empty($_POST['password'])) {
    // print_r($_POST['username']);
    // print_r($_POST['password']);

    foreach($users as $user => $v) {

        //  print_r($users[$k]). '<br>';
        // echo $k . ' <br>';
        // echo $k . " " . $v['password'] . " " . $v['app_user'] . "<br>";
        if($_POST['username'] === $user && $_POST['password'] === $v['password']){
            $app_user = $v['app_user'] ? true : false;
            $_SESSION['logged_in'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = $user;
            $_SESSION['app_user'] = $app_user;
        }
        }

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Manager</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body  class="d-flex flex-column vh-100">


    <div class="container d-flex flex-column align-items-center">
    <h1 class="text-center mt-5 display-1 text-primary">Project Manager</h1>
    <?php
    if(isset($_GET['action']) and $_GET['action'] === 'logout') {
        session_start();
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        unset($_SESSION['logged_in']);
        unset($_SESSION['app_user']);
    }

    ?>
    <?php


    if($_SESSION['logged_in'] === true) {
        echo '<a class="userUI__link" href="index.php?action=logout">Logout</a>';
        print_r($_SESSION['app_user']);
    }
    else {
    echo '<form class="login" action="index.php" method="POST">
        <input type="hidden" name="login" value="y">
        <div class="input-container">
            <input type="text" id="username" name="username" autocomplete="off" required>
            <label for="username" class="label-name">
                <span class="content-name">Enter your username</span>
            </label>
        </div>
        <div class="input-container">
            <input type="password" id="password" name="password" autocomplete="off" required>
            <label for="password" class="label-name">
                <span class="content-name">Enter your password </span>
            </label>
        </div>
        <button type="Submit" class="btn btn-dark" id="login">Login</button>
    </form>
</div>';
    }
?>




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="js/validate.js"></script>
</body>

</html>
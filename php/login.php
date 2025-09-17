<?php

include_once "config.php";
session_start();
if(isset($_SESSION['admin_id'])){
    header("location: admin_dashboard.php");
}elseif(isset($_SESSION['user_id'])){
    header("location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RCOE</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="wrapper">
        <section class="form login">
            <header>RCOE LIBRARY</header>
            <form action="#">
                <div class="error-text"></div>
                <div class="field input">
                    <label for="">Email Address</label>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="field input">
                    <label for="">Password</label>
                    <input id="pass" type="password" name="password" placeholder="Enter your password" required>
                    <i id="eye" class="fas fa-eye"></i>
                </div>
                <div class="field button">
                    <input type="submit" value="Login">
                </div>
            </form>
            <div class="link">Not yet signed up? <a href="index.php">Signup now</a></div>
        </section>
    </div>
</body>

<script src="../javascript/password.js"></script>
<script src="../javascript/login.js"></script>

</html>
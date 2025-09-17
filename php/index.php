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
        <section class="form signup">
            <header>RCOE LIBRARY</header>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="error-text"></div>
                
                <div class="field input">
                    <label for="">Name</label>
                    <input type="text" placeholder="Enter your name" name="name" required>
                </div>
                <div class="field input">
                    <label for="">Email Address</label>
                    <input type="email" placeholder="Enter your email" name="email" required>
                </div>
                <div class="more-details" id="uin-num">
                    <div class="field input">
                        <label for="">UIN</label>
                        <input type="text" placeholder="UIN" name="uin" required>
                    </div>
                    <div class="field input">
                        <label for="">Mobile Number</label>
                        <input type="text" placeholder="Mobile number" name="number" required>
                    </div>
                </div>
                <div class="more-details" id="select">
                    <div class="field input">
                        <label for="">Year</label>
                        <select name="year" required>
                            <option selected>---SELECT---</option>
                            <option>First Year</option>
                            <option>Second Year</option>
                            <option>Third Year</option>
                            <option>Fourth Year</option>
                        </select>
                    </div>
                    <div class="field input">
                        <label for="">Branch</label>
                        <select name="branch" required>
                            <option selected>---SELECT---</option>
                            <option>ECS</option>
                            <option>EXTC</option>
                            <option>Computer Engineering</option>
                            <option>AI&DS</option>
                            <option>Mechinical Engineering</option>
                            <option>Civil Engineering</option>
                        </select>
                    </div>
                </div>
                <div class="field input">
                    <label for="">Password</label>
                    <input id="pass" type="password" placeholder="Set your password" name="password" required>
                    <i class="fas fa-eye" id="eye"></i>
                </div>
                <div class="field input">
                    <label for="">Confirm Password</label>
                    <input id="cpass" type="password" placeholder="Confirm your password" name="confirm_password" required>
                    <i class="fas fa-eye" id="ceye"></i>
                </div>
                <div class="field image">
                    <label for="">Select Image</label>
                    <input  type="file" name="image" accept="image/jpg, image/jpeg, image/png">
                </div>
                <div class="field button">
                    <input type="submit" value="Sign Up">
                </div>
            </form>
            <div class="link">Already signed up? <a href="login.php">Login now</a></div>
        </section>
    </div>
</body>

<script src="../javascript/password.js"></script>
<script src="../javascript/signup.js"></script>
<script>
    function adjustLayout() {
        const screenWidth = window.innerWidth;
        const moreDetail = document.getElementById("uin-num");
        const selectDetail = document.getElementById("select");

        if (screenWidth < 450) {
            moreDetail.classList.remove("more-details");
            selectDetail.classList.remove("more-details");
        } else {
            moreDetail.classList.add("more-details");
            selectDetail.classList.add("more-details");
        }
    }

adjustLayout();

    window.addEventListener("resize", adjustLayout);
</script>

</html>
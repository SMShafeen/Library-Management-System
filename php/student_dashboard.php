<?php

include_once "config.php";
session_start();
$student_id = $_SESSION['student_id'];
$student_name = $_SESSION['student_name'];
$student_email = $_SESSION['student_email'];
if(!isset($student_id)){
    header("location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <!-- Boxicons link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- CSS file link -->
    <link rel="stylesheet" href="../css/student_style.css">
</head>
<body>

    <?php include 'student_base_layout.php'; ?>

    <!-- Main Content -->
    <div class="content">

        <main>
            <div class="header">
                <div class="left">
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Admin</a></li>
                        /
                        <li><a href="#" class="active">Dashboard</a></li>
                    </ul>
                </div>
            </div>
    
            <!-- Insights -->
                <!-- Student's Details  -->
        <div class="stu-info">
            <?php
                $student_query = mysqli_query($conn, "SELECT * FROM users WHERE ID = $student_id") OR die("Query Failed!");
                if(mysqli_num_rows($student_query) > 0){
                    $fetch_student = mysqli_fetch_assoc($student_query);
                }
            ?>
          <!-- Info box one  -->
          <div class="info--box__one info-box">
            <div class="sub-info-col">
              <p class="sub-info-colhead">Student</p>
              <p class="sub-info-colhead"><?php echo $fetch_student['Name']; ?></p>
              <div class="pfp-box">
                <img src="../uploaded_image/<?php echo $fetch_student['Profile_Picture']; ?>" alt="" class="pfp-img" />
              </div>
            </div>
            <?php
                $student_Bquery = mysqli_query($conn, "SELECT * FROM borrowed_book WHERE User_ID = $student_id") OR die("Query Failed!");
                $bb_count = mysqli_num_rows($student_Bquery);
                if(mysqli_num_rows($student_Bquery) > 0){
                    $fetch_bb = mysqli_fetch_assoc($student_Bquery);
                }
            ?>
            <div class="stu-info--data">
              <div class="info--borrow__data">
                <p>Borrowed Books</p>
                <p><?php echo $bb_count ?></p>
              </div>
              <div class="info--fine__data">
                <p>Total Fine</p>
                <p>40</p>
              </div>
            </div>
          </div>
          <!-- Info box two -->
          <div class="info--box__two info-box">
            <h3 class="info--box__heading">Profile Detail</h3>
            <hr class="info--box__hr" />
            <div class="info__uin">
              <p class="info__uin--title">UIN</p>
              <p class="info__uin--data"><?php echo $fetch_student['UIN']; ?></p>
            </div>
            <!-- student data  -->
            <div class="stu--data stu--data-inp info-flex">
              <div class="stu--data-inp">
                <p>Department :</p>
                <p>Roll No :</p>
                <p>Year :</p>
              </div>
              <div class="stu--data-out">
                <p><?php echo $fetch_student['Branch']; ?></p>
                <p>24</p>
                <p><?php echo $fetch_student['Year']; ?></p>
              </div>
            </div>
          </div>
        </div>
            <br>
            <!-- End of Insights -->

        </main>
        
    </div>

    <!-- JavaScript file link -->
    <script src="../javascript/student_script.js"></script>
</body>
</html>
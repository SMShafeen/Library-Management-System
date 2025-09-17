<?php

include_once "config.php";
session_start();
$admin_id = $_SESSION['admin_id'];
$admin_name = $_SESSION['admin_name'];
$admin_email = $_SESSION['admin_email'];
if(!isset($admin_id)){
    header("location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Boxicons link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- CSS file link -->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

    <?php include 'admin_base_layout.php'; ?>

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
                <a href="#" class="report">
                    <i class='bx bx-cloud-download' ></i>
                    <span>Download CSV</span>
                </a>
            </div>
    
            <!-- Insights -->
            <ul class="insights">
                <li>
                    <?php
                        $select_student = mysqli_query($conn, "SELECT * FROM users WHERE User_Type = 'student'") or die("Query Failed!");
                        $number_of_student = mysqli_num_rows($select_student);
                    ?>
                    <i class='bx bx-user'></i>
                    <span class="info">
                        <h3><?php echo $number_of_student; ?></h3>
                        <p>Students</p>
                    </span>
                </li>
                <li>
                    <?php
                        $select_admin = mysqli_query($conn, "SELECT * FROM users WHERE User_Type = 'admin'") or die("Query Failed!");
                        $number_of_admin = mysqli_num_rows($select_admin);
                    ?>
                    <i class='bx bx-user'></i>
                    <span class="info">
                        <h3><?php echo $number_of_admin; ?></h3>
                        <p>Admins</p>
                    </span>
                </li>
                <li>
                    <?php
                        $select_users = mysqli_query($conn, "SELECT * FROM users") or die("Query Failed!");
                        $total_users = mysqli_num_rows($select_users);
                    ?>
                    <i class='bx bx-group'></i>
                    <span class="info">
                        <h3><?php echo $total_users; ?></h3>
                        <p>Total Users</p>
                    </span>
                </li>
                <li>
                    <?php
                        $select_defaulter = mysqli_query($conn, "SELECT * FROM defaulter_list") or die("Query Failed!");
                        $total_defaulter = mysqli_num_rows($select_defaulter);
                    ?>
                    <i class='bx bx-user-pin'></i>
                    <span class="info">
                        <h3><?php echo $total_defaulter; ?></h3>
                        <p>Defaulters</p>
                    </span>
                </li>
                <li>
                    <?php
                        $select_books = mysqli_query($conn, "SELECT * FROM book") or die("Query Failed!");
                        $total_books = mysqli_num_rows($select_books);
                    ?>
                    <i class='bx bx-book'></i>
                    <span class="info">
                        <h3><?php echo $total_books; ?></h3>
                        <p>Total Books</p>
                    </span>
                </li>
                <li>
                    <?php
                        $select_bbook = mysqli_query($conn, "SELECT * FROM borrowed_book") or die("Query Failed!");
                        $total_bbook = mysqli_num_rows($select_bbook);
                    ?>
                    <i class='bx bx-book'></i>
                    <span class="info">
                        <h3><?php echo $total_bbook; ?></h3>
                        <p>Issued Books</p>
                    </span>
                </li>
                <li>
                    <?php
                        $select_Abbook = mysqli_query($conn, "SELECT * FROM borrowed_book WHERE Return_Status = 'Active'") or die("Query Failed!");
                        $total_Abbook = mysqli_num_rows($select_Abbook);
                    ?>
                    <i class='bx bx-book'></i>
                    <span class="info">
                        <h3><?php echo $total_Abbook; ?></h3>
                        <p>Active Borrow</p>
                    </span>
                </li>
                <!-- <li>
                    <?php
                        // $select_Cdlist = mysqli_query($conn, "SELECT * FROM defaulter_list WHERE Payment_Status != 'Pending'") or die("Query Failed!");
                        // $total_Cdlist = mysqli_num_rows($select_Cdlist);
                    ?>
                    <i class='bx bx-book'></i>
                    <span class="info">
                        <h3><?php //echo $total_Cdlist; ?></h3>
                        <p>Fine Paid</p>
                    </span>
                </li> -->
            </ul>
            <br>
            <!-- End of Insights -->

        </main>
        
    </div>

    <!-- JavaScript file link -->
    <script src="../javascript/admin_script.js"></script>
</body>
</html>
<?php

include_once "config.php";
session_start();

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

$admin_id = $_SESSION['admin_id'];
$admin_name = $_SESSION['admin_name'];
$admin_email = $_SESSION['admin_email'];
if(!isset($admin_id)){
    header("location: login.php");
}

function sanitize($value){
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}

function incrementBorrow($conn, $user_id){
    $incrementBorrow = mysqli_query($conn, "UPDATE users SET Active_Borrow = Active_Borrow + 1, Total_Borrow = Total_Borrow + 1 WHERE ID = $user_id");
}

function decrementBorrow($conn, $user_id){
    $decrementBorrow = mysqli_query($conn, "UPDATE users SET Active_Borrow = Active_Borrow - 1 WHERE ID = $user_id");
}

function incrementQuantity($conn, $book_id){
    $incrementQuantity = mysqli_query($conn, "UPDATE book SET Available_Copies = Available_Copies + 1 WHERE ID = $book_id");
}

function decrementQuantity($conn, $book_id){
    $decrementQuantity = mysqli_query($conn, "UPDATE book SET Available_Copies = Available_Copies - 1 WHERE ID = $book_id");
}

date_default_timezone_set('Asia/Kolkata');

// Format the date and time as needed
$currentDate = new DateTime();
// $kolkataDateTime = $currentDateTime->format('Y-m-d H:i:s');

$currentDate->modify('+10 days');

$returnDate = $currentDate->format("d-m-Y");

$dead_line_date = new DateTime();
$dead_line_date->modify('+11 days');
$deadLine = $dead_line_date->format("d-m-Y");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Boxicons link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <!-- CSS Data Tables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.semanticui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
    
    <!-- CSS file link -->
    <link rel="stylesheet" href="../css/admin_style.css">
    
    <!-- JS Data Tables -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.semanticui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.js"></script>

    
</head>
<body style="background:;">

    <?php include 'admin_base_layout.php'; ?>

    <div class="content">
        <main>
            <div class="header">
                <div class="left">
                    <h1>Admin Profile</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Admin</a></li>
                        /
                        <li><a href="#" class="active">Profile</a></li>
                    </ul>
                </div>
            </div>

            <div class="success-message"></div>
            <div class="error-message"></div>

            <!-- Update user section starts -->

            <?php
                $profile_query = mysqli_query($conn, "SELECT * FROM users WHERE ID = $admin_id");
                if(mysqli_num_rows($profile_query) > 0){
                    while($fetch_profile = mysqli_fetch_assoc($profile_query)){
            ?>
            <section class="profile-detail">
                <form action="" method="post" enctype="multipart/form-data">
                    <h3>Profile</h3>
                    <div class="error-text"></div>
                    <img src="../uploaded_image/<?php echo $fetch_profile['Profile_Picture']; ?>">
                        <input type="hidden" class="box" name="update_id" value="<?php echo $fetch_profile['ID']; ?>">
                    <div class="field">
                        <label for="title">Name:</label>
                        <input type="text" class="box" name="update_name" value="<?php echo $fetch_profile['Name']; ?>" placeholder="enter name" required>
                    </div>
                    <div class="field">
                        <label for="title">Email:</label>
                        <input type="text" class="box" min="0" name="update_email" value="<?php echo $fetch_profile['Email']; ?>" placeholder="enter email">
                    </div>
                    <div class="more-details" id="field-set-3">
                        <div class="field">
                            <label for="title">Number:</label>
                            <input type="text" class="box" min="0" name="update_number" value="<?php echo $fetch_profile['Number']; ?>" placeholder="enter number">
                        </div>
                        <div class="field">
                            <label for="title">UIN:</label>
                            <input type="text" class="box" min="0" name="update_uin" value="<?php echo $fetch_profile['UIN']; ?>" placeholder="enter UIN">
                        </div>
                    </div>
                    <div class="more-details" id="field-set-2">
                        <div class="field">
                            <label for="title">User Type:</label>
                            <select name="user_type" class="box">
                                <option>---SELECT User Type---</option>
                                <option selected style="background:grey;color:#fff;pointer-events:none;"><?php echo $fetch_profile['User_Type']; ?></option>
                                <option>student</option>
                                <option>admin</option>
                            </select>
                        </div>
                        <div class="field">
                            <label for="title">Status:</label>
                            <input style="pointer-events:none;" type="text" value="<?php echo $fetch_profile['Status']; ?>" class="box" min="0" name="status">
                        </div>
                    </div>
                    <input type="submit" class="btn" name="add_book" value="update" style="margin-top:10px; width:100%">
                    <!-- <input type="reset" id="close-update" class="option-btn" name="cancel" value="update password" style="margin-top:10px; margin-left:5px;"> -->
                    <!-- <a href="admin_profile.php?update=" class="option-btn" name="passBox" style="margin-top:5px; width:100%">Update Password</a> -->
                    <button class="option-btn" name="passBox" style="margin-top:5px; width:100%">Update Password</button>
                </form>
            </section>
            <?php  
                    }
                }
            ?>
            
            <!-- Update user section ends -->
            
            <!-- Password update section starts -->

            <?php
                if(isset($_POST['passBox'])){
            ?>
            <section class="update">
                <form action="" method="post" enctype="multipart/form-data">
                    <h3>Update Password</h3>
                    <div class="error-text"></div>
                    <div class="field">
                        <label for="title">Old Password:</label>
                        <input type="password" class="box" min="0" name="isbn" placeholder="previous password">
                    </div>
                    <div class="field">
                        <label for="title">New Password:</label>
                        <input type="password" class="box" min="0" name="uin" placeholder="set password">
                    </div>
                    <div class="field">
                        <label for="title">Confirm New Password:</label>
                        <input type="password" class="box" min="0" name="borrow_date" value="" placeholder="confirm new password">
                    </div>
                    <input type="submit" class="btn" name="get_details" value="update" style="margin-top:10px;">
                    <input type="reset" id="close-update" class="option-btn" name="get_details" value="Cancel" style="margin-top:10px;">
                </form>
            </section>
            <?php
                }
            ?>
            
            <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if(isset($_POST['get_details'])){
                $isbn = mysqli_real_escape_string($conn, sanitize($_POST['isbn']));
                $uin = mysqli_real_escape_string($conn, sanitize($_POST['uin']));
                $borrow_date = mysqli_real_escape_string($conn, sanitize($_POST['borrow_date']));
                $due_date = mysqli_real_escape_string($conn, sanitize($_POST['due_date']));
                $dead_line = mysqli_real_escape_string($conn, sanitize($_POST['dead_line']));
                    
                if(!empty($isbn) && !empty($uin)){
                    $student_query = mysqli_query($conn, "SELECT * FROM users WHERE UIN = '$uin'") OR die("Query Failed!");
                    if(mysqli_num_rows($student_query) > 0){
                        $fetch_student = mysqli_fetch_assoc($student_query);
                        $book_query = mysqli_query($conn, "SELECT * FROM book WHERE ISBN = '$isbn'") OR die("Query Failed!");
                        if(mysqli_num_rows($book_query) > 0){
                            $fetch_book = mysqli_fetch_assoc($book_query);

                            $user_id = $fetch_student['ID'];
                            $name = $fetch_student['Name'];
                            $email = $fetch_student['Email'];
                            $number = $fetch_student['Number'];
                            $uin = $fetch_student['UIN'];
                            $branch = $fetch_student['Branch'];
                            $year = $fetch_student['Year'];
                            $activeBorrow = $fetch_student['Active_Borrow'];
                            $totalBorrow = $fetch_student['Total_Borrow'];

                            $book_id = $fetch_book['ID'];
                            $title = $fetch_book['Book_Title'];
                            $author = $fetch_book['Book_Author'];
                            $publication = $fetch_book['Book_Publication'];
                            $isbn = $fetch_book['ISBN'];
                            $genre = $fetch_book['Genre'];
                            $department = $fetch_book['Department'];
                            $avlc = $fetch_book['Available_Copies'];
                            $tltc = $fetch_book['Total_Copies'];
                            
            ?>
                <section class="get-details">
                    <div class="detail-error-text"></div>
                    <div class="detail-box">
                        <div class="student">
                            <h3>Student Details</h3>
                            <p>Name : <span><?php echo $name; ?></span></p>
                            <p>Email : <span><?php echo $email; ?></span></p>
                            <p>Number : <span><?php echo $number; ?></span></p>
                            <p>UIN : <span><?php echo $uin; ?></span></p>
                            <p>Branch : <span><?php echo $branch; ?></span></p>
                            <p>Year : <span><?php echo $year; ?></span></p>
                            <p>Active Borrow : <span><?php echo $activeBorrow; ?></span></p>
                        </div>
                        <div class="book">
                            <h3>Book Deatils</h3>
                            <p>Title : <span><?php echo $title; ?></span></p>
                            <p>Author : <span><?php echo $author; ?></span></p>
                            <p>Publication : <span><?php echo $publication; ?></span></p>
                            <p>ISBN : <span><?php echo $isbn; ?></span></p>
                            <p>Genre : <span><?php echo $genre; ?></span></p>
                            <p>Department : <span><?php echo $department; ?></span></p>
                            <p>Available : <span><?php echo $avlc.'/'.$tltc; ?></span></p>
                        </div>
            <?php
                        if($activeBorrow > 3){
                            echo "<script>
                                    const errBox = document.querySelector('.detail-error-text');
                                    errBox.style.display = 'block';
                                    errBox.textContent = 'Cannot issue book as the student has exceeded the number of borrows!';
                                </script>";
                            }elseif($avlc == 0){
                                echo "<script>
                                        const errBox = document.querySelector('.detail-error-text');
                                        errBox.style.display = 'block';
                                        errBox.textContent = 'This book is currently unavailable!';
                                    </script>";
                        }
                    }else{
                        echo "<script>
                            const errBox = document.querySelector('.error-text');
                            errBox.style.display = 'block';
                            errBox.textContent = 'This book does not exist in our record or wrong ISBN!';
                        </script>";
                        exit;
                    }
                }else{
                    echo "<script>
                        const errBox = document.querySelector('.error-text');
                        errBox.style.display = 'block';
                        errBox.textContent = 'This UIN is not registered yet or wrong UIN!';
                    </script>";
                    exit;  
                }
            ?>
                    </div>
                    <div class="button">
                        <form action="" method="post">
                            <input type="hidden" name= "user_id" value="<?php echo $user_id; ?>">
                            <input type="hidden" name= "book_id" value="<?php echo $book_id; ?>">
                            <input type="hidden" name= "active_borrow" value="<?php echo $activeBorrow; ?>">
                            <input type="hidden" name= "total_borrow" value="<?php echo $totalBorrow; ?>">
                            <input type="hidden" name= "isbn" value="<?php echo $isbn; ?>">
                            <input type="hidden" name= "borrow_date" value="<?php echo $borrow_date; ?>">
                            <input type="hidden" name= "due_date" value="<?php echo $due_date; ?>">
                            <input type="hidden" name= "dead_line" value="<?php echo $dead_line; ?>">
                            <input type="hidden" name= "avlc" value="<?php echo $avlc; ?>">
                            <input type="submit" class="btn" name="issue_now" value="Issue Now">
                            <button class="option-btn">Cancel</button>
                        </form>
                    </div>
                </section>
            <?php
                }else{
                    echo "<script>
                            const errBox = document.querySelector('.error-text');
                            errBox.style.display = 'block';
                            errBox.textContent = 'Please enter the details!';
                        </script>";
                }
            }
        }
            ?>
            <br>

            <?php
                if(isset($_POST['issue_now'])){
                    $insert_user_id = mysqli_real_escape_string($conn, sanitize($_POST['user_id']));
                    $insert_book_id = mysqli_real_escape_string($conn, sanitize($_POST['book_id']));
                    $insert_active_borrow = mysqli_real_escape_string($conn, sanitize($_POST['active_borrow']));
                    $insert_total_borrow = mysqli_real_escape_string($conn, sanitize($_POST['total_borrow']));
                    $insert_borrow_date = mysqli_real_escape_string($conn, sanitize($_POST['borrow_date']));
                    $insert_due_date = mysqli_real_escape_string($conn, sanitize($_POST['due_date']));
                    $insert_dead_line = mysqli_real_escape_string($conn, sanitize($_POST['dead_line']));
                    $insert_avlc = mysqli_real_escape_string($conn, sanitize($_POST['avlc']));
                    
                    if($insert_active_borrow < 3){
                        if($insert_avlc == 0){
                            echo "<script>
                                    const sBox = document.querySelector('.error-message');
                                    sBox.style.display = 'block';
                                    sBox.textContent = 'Book is currently unavailable!!';
                                </script>";
                        }else{
                            $insert = "INSERT INTO borrowed_book (User_ID, Book_ID, Borrow_Date, Due_Date, Dead_Line) VALUES ('$insert_user_id', '$insert_book_id', '$insert_borrow_date', '$insert_due_date', '$insert_dead_line')";
                            $query = mysqli_query($conn, $insert);
                            if($query){
                                decrementQuantity($conn, $insert_book_id);
                                incrementBorrow($conn, $insert_user_id);
                                echo "<script>
                                        const sBox = document.querySelector('.success-message');
                                        sBox.style.display = 'block';
                                        sBox.textContent = 'A book has been issued!';
                                    </script>";
                            }
                        }
                    }else{
                        echo "<script>
                                    const sBox = document.querySelector('.error-message');
                                    sBox.style.display = 'block';
                                    sBox.textContent = 'Cannot issue book as student has exceeded the number of borrows!';
                                </script>";
                    }
                }
            ?>

            <!-- Password Update section ends -->
            
            <br>
        </main>
    </div>
    <!-- Update user section starts -->

    <?php
            if(isset($_GET['update'])){
                $update_id = $_GET['update'];
                $update_query = mysqli_query($conn, "SELECT * FROM book WHERE ID = $update_id");
                if(mysqli_num_rows($update_query) > 0){
                    while($fetch_profile = mysqli_fetch_assoc($update_query)){
                        ?>
        <section class="update">
            <form action="" method="post" enctype="multipart/form-data">
                <h3 style="margin-bottom:1rem;">edit book details</h3>
                <div class="error-text"></div>
                <input type="hidden" class="box" name="update_id" value="<?php echo $fetch_profile['ID']; ?>">
                <input type="text" class="box" name="update_title" value="<?php echo $fetch_profile['Book_Title']; ?>" placeholder="book title" required>
                <input type="text" class="box" min="0" name="update_author" value="<?php echo $fetch_profile['Book_Author']; ?>" placeholder="book author">
                <input type="text" class="box" min="0" name="update_publication" value="<?php echo $fetch_profile['Book_Publication']; ?>" placeholder="book publication">
                <div class="more-details" id="field-set-3">
                    <input type="number" class="box" min="0" name="update_year" value="<?php echo $fetch_profile['Published_Year']; ?>" placeholder="published year">
                    <select name="update_department" class="box">
                        <option>---Select Department---</option>
                        <option selected style="background:grey;color:#fff;pointer-events:none;"><?php echo $fetch_profile['Department']; ?></option>
                        <option>EXTC</option>
                        <option>ECS</option>
                        <option>Comps</option>
                        <option>AI&DS</option>
                        <option>Mech</option>
                        <option>Civil</option>
                        <option>Comps and AI&DS</option>
                        <option>Comps, AI&DS and ECS</option>
                        <option>Comps and ECS</option>
                        <option>AI&DS and ECS</option>
                        <option>EXTC and ECS</option>
                        <option>All Department</option>
                    </select>
                </div>
                <div class="more-details" id="field-set-1">
                    <input type="text" class="box" name="update_isbn" value="<?php echo $fetch_profile['ISBN']; ?>" placeholder="ISBN number">
                    <select name="update_genre" class="box">
                        <option>---Select Genre---</option>
                        <option selected style="background:grey;color:#fff;pointer-events:none;"><?php echo $fetch_profile['Genre']; ?></option>
                        <option>Electrical Engineering</option>
                        <option>Electronics Engineering</option>
                        <option>Communication Engineering</option>
                        <option>Computer Science and Engineering</option>
                        <option>Artificial Intelligence</option>
                        <option>Data Science</option>
                        <option>Machine Learning</option>
                        <option>Mechanical Engineering</option>
                        <option>Civil Engineering</option> 
                    </select>
                </div>
                <div class="more-details" id="field-set-2">
                    <!-- <input type="text" class="box" min="0" name="price" placeholder="enter genre"> -->
                    <input type="number" value="<?php echo $fetch_profile['Available_Copies']; ?>" class="box" min="0" name="update_avlc" placeholder="enter available copies">
                    <input type="number" value="<?php echo $fetch_profile['Total_Copies']; ?>" class="box" min="0" name="update_tltc" placeholder="enter total copies">
                    </div>
                <input type="submit" class="btn" name="add_book" value="update" style="margin-top:10px; margin-right:5px;">
                <input type="reset" id="close-update" class="option-btn" name="cancel" value="cancel" style="margin-top:10px; margin-left:5px;">
                <!-- <button id="close-update" class="option-btn" name="cancle" style="margin-top:10px; margin-left:5px;">cancle</button> -->
            </form>
        </section>
            <?php  
                    }
                }
            }
            ?>

            <!-- Update user section ends -->

</body>
<script src="../javascript/admin_script.js"></script>
<script>

    new DataTable('#tableData');
    
    const menuItems = document.querySelector(".side-menu li:not(:nth-child(2))");
    const manageBooks = document.querySelector(".side-menu li:nth-child(2)");
    menuItems.classList.remove("active");
    manageBooks.classList.add("active");
    
    const updateBox = document.querySelector(".update"),
    closeBtn = document.querySelector('#close-update');
    if(closeBtn){
        closeBtn.onclick = ()=> {
            updateBox.style.display = 'none';
            window.location.href = 'admin_profile.php';
        };
    }

    function adjustLayout() {
        const screenWidth = window.innerWidth;
        const moreDetail = document.getElementById("field-set-1");
        
        if (screenWidth < 450) {
            moreDetail.classList.remove("more-details");
        } else {
            moreDetail.classList.add("more-details");
        }
    }
    
    adjustLayout();
    
    window.addEventListener("resize", adjustLayout);    

</script>
</html>
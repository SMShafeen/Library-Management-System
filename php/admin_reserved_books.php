<?php

include_once "config.php";
session_start();
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

$currentDate = new DateTime();
// $kolkataDateTime = $currentDateTime->format('Y-m-d H:i:s');

$currentDate->modify('+11 days');

$dueDate = $currentDate->format("d-m-Y");
$date = date("d-m-Y");
// $currDate = new DateTime();
// $date = $currDate->format("d-m-Y");

$dl_query = mysqli_query($conn, "SELECT * FROM borrowed_book");
while($fetch_bb = mysqli_fetch_assoc($dl_query)){
    $dead_line = $fetch_bb['Dead_Line'];
    if($date == $dead_line){
        $sql_dl = mysqli_query($conn, "UPDATE borrowed_book SET Return_Status = 'Pending' WHERE Dead_Line = '$date'") OR die("Query Failed!");
    }
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM borrowed_book WHERE ID = $delete_id") OR die("Query Failed");
    header("location: admin_reserved_books.php");
}

?>
<!-- <select class="box" name="return_status">
    <option>Active</option>
    <option>Expired</option>
    <option>Returned on 23-04-2024</option>
</select> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reserved Books</title>

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
                    <h1>Manage Reserved Books</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Admin</a></li>
                        /
                        <li><a href="#" class="active">Reserved Books</a></li>
                    </ul>
                </div>
                <a href="#" class="report">
                    <i class='bx bx-cloud-download' ></i>
                    <span>Download CSV</span>
                </a>
            </div>
            
            <div class="error-message"></div>

            <!-- User table section starts -->

            <div class="table-data" style="margin-top:20px;">
                <table id="tableData" class="ui celled table table-striped hover" style="width:100%;">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Student Name</th>
                            <th>UIN</th>
                            <th>Book Title</th>
                            <th>ISBN</th>
                            <th>Borrow Date</th>
                            <th>Due Date</th>
                            <th>Return Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql_bb = mysqli_query($conn, "SELECT * FROM borrowed_book");
                            if(mysqli_num_rows($sql_bb) > 0){
                                $srno = 0;
                                while($bb_row = mysqli_fetch_assoc($sql_bb)){
                                    $srno += 1;
                                    $sql_u = mysqli_query($conn, "SELECT * FROM users WHERE ID = {$bb_row['User_ID']}");
                                    $u_row = mysqli_fetch_assoc($sql_u);
                                    $sql_b = mysqli_query($conn, "SELECT * FROM book WHERE ID = {$bb_row['Book_ID']}");
                                    $b_row = mysqli_fetch_assoc($sql_b);
                                    echo "<tr>
                                            <td>".$srno."</td>
                                            <td>".$u_row['Name']."</td>
                                            <td>".$u_row['UIN']."</td>
                                            <td>".$b_row['Book_Title']."</td>
                                            <td>".$b_row['ISBN']."</td>
                                            <td>".$bb_row['Borrow_Date']."</td>
                                            <td>".$bb_row['Due_Date']."</td>
                                            <td>".$bb_row['Return_Status']."</td>
                                            <td>
                                                <a href='admin_reserved_books.php?update=".$bb_row['ID']."' class='option-btn' style='margin-right: 3px;'>Edit</a>
                                                <a href='admin_reserved_books.php?delete=".$bb_row['ID']."' class='delete-btn' onclick='return confirm(`Are you sure you want to delete this record?`);' style='margin-left: 3px;'>Delete</a>
                                            </td>
                                        </tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- User table section ends -->

            <br>
        </main>
    </div>

    <!-- Update user section starts -->

    <?php
        if(isset($_GET['update'])){
            $update_id = $_GET['update'];
            $update_query = mysqli_query($conn, "SELECT * FROM borrowed_book WHERE ID = $update_id");
            if(mysqli_num_rows($update_query) > 0){
                while($fetch_update = mysqli_fetch_assoc($update_query)){
                    $user_query = mysqli_query($conn, "SELECT * FROM users WHERE ID = {$fetch_update['User_ID']}");
                    $user_row = mysqli_fetch_assoc($user_query);
                    $book_query = mysqli_query($conn, "SELECT * FROM book WHERE ID = {$fetch_update['Book_ID']}");
                    $book_row = mysqli_fetch_assoc($book_query);
    ?>
        <section class="update">
            <form action="" method="post" enctype="multipart/form-data">
                <h3>borrow details</h3>
                <div class="error-text"></div>
                <div class="success-message"></div>
                <input type="hidden" class="box" name="update_id" value="<?php echo $fetch_update['ID']; ?>">
                <input type="hidden" class="box" name="update_user_id" value="<?php echo $fetch_update['User_ID']; ?>">
                <input type="hidden" class="box" name="update_book_id" value="<?php echo $fetch_update['Book_ID']; ?>">
                <div class="more-details" id="field-set-1">
                    <div class="field">
                        <label for="title">Name:</label>
                        <input disabled type="text" class="box" name="name" value="<?php echo $user_row['Name']; ?>">
                    </div>
                    <div class="field">
                        <label for="title">Email:</label>
                        <input disabled type="text" class="box" min="0" name="email" value="<?php echo $user_row['Email']; ?>">
                    </div>
                </div>
                <div class="more-details" id="field-set-2">
                    <div class="field">
                        <label for="title">Number:</label>
                        <input disabled type="text" class="box" min="0" name="number" value="<?php echo $user_row['Number']; ?>">
                    </div>
                    <div class="field">
                        <label for="title">UIN:</label>
                        <input disabled type="text" class="box" min="0" name="uin" value="<?php echo $user_row['UIN']; ?>">
                    </div>
                </div>
                <div class="more-details" id="field-set-3">
                    <div class="field">
                        <label for="title">Year:</label>
                        <input disabled type="text" class="box" min="0" name="year" value="<?php echo $user_row['Year']; ?>">
                    </div>
                    <div class="field">
                        <label for="title">Branch:</label>
                        <input disabled type="text" class="box" min="0" name="branch" value="<?php echo $user_row['Branch']; ?>">
                    </div>
                </div>
                <div class="more-details" id="field-set-4">
                    <div class="field">
                        <label for="title">Book Title:</label>
                        <input disabled type="text" class="box" min="0" name="book_title" value="<?php echo $book_row['Book_Title']; ?>">
                    </div>
                    <div class="field">
                        <label for="title">ISBN:</label>
                        <input disabled type="text" value="<?php echo $book_row['ISBN']; ?>" class="box" min="0" name="ISBN">
                    </div>
                </div>
                <div class="more-details" id="field-set-4">
                    <div class="field">
                        <label for="title">Borrow Date:</label>
                        <input disabled type="text" class="box" min="0" name="borrow_date" value="<?php echo $fetch_update['Borrow_Date']; ?>">
                    </div>
                    <div class="field">
                        <label for="title">Due Date:</label>
                        <input disabled type="text" value="<?php echo $fetch_update['Due_Date']; ?>" class="box" min="0" name="due_date">
                        <input disabled type="hidden" value="<?php echo $fetch_update['Dead_Line']; ?>" class="box" min="0" name="dead_line">
                    </div>
                </div>
                <div class="more-details" id="field-set-4">
                    <div class="field">
                        <label for="title">Total Borrow:</label>
                        <input disabled type="text" class="box" min="0" name="total_borrow" value="<?php echo $user_row['Total_Borrow']; ?>">
                    </div>
                    <div class="field">
                        <label for="title">Active Borrow:</label>
                        <input disabled type="text" value="<?php echo $user_row['Active_Borrow']; ?>" class="box" min="0" name="active-borrow">
                    </div>
                </div>
                <div class="field">
                    <label for="title">Borrow Status:</label>
                    <select name="update_status" class="box" required>
                        <option selected style="background:grey;color:#fff;pointer-events:none;"><?php echo $fetch_update['Return_Status']; ?></option>
                        <option>Active</option>
                        <option>Pending</option>
                        <option value="Returned on <?php echo $date; ?>">Returned</option>
                    </select>
                </div>
                <input type="submit" class="btn" name="update_bd" value="update" style="margin-top:10px; margin-right:5px;">
                <input type="reset" id="close-update" class="option-btn" name="cancel" value="cancel" style="margin-top:10px; margin-left:5px;">
                <!-- <button id="close-update" class="option-btn" style="margin-top:10px;">cancel</button> -->
            </form>
        </section>
    <?php  
            }
        }
    }
    ?>

    <?php
        // $dead_line = mysqli_real_escape_string($conn, sanitize($_POST['dead_line']));
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $bb_id = mysqli_real_escape_string($conn, sanitize($_POST['update_id']));
            $user_id = mysqli_real_escape_string($conn, sanitize($_POST['update_user_id']));
            $book_id = mysqli_real_escape_string($conn, sanitize($_POST['update_book_id']));
            $borrow_status = mysqli_real_escape_string($conn, sanitize($_POST['update_status']));
            $borrow_date = mysqli_real_escape_string($conn, sanitize($_POST['borrow_date']));
            $due_date = mysqli_real_escape_string($conn, sanitize($_POST['due_date']));

            if(isset($_POST['update_bd'])){
                $sql_update = mysqli_query($conn, "UPDATE borrowed_book SET Return_Status = '$borrow_status' WHERE ID = $update_id") OR die("Query Failed!");
                if($sql_update){
                    echo "<script>
                        setTimeout(()=>{
                            window.location.href = 'admin_reserved_books.php';
                        }, 1000);
                        const sBox = document.querySelector('.success-message');
                        sBox.style.display = 'block';
                        sBox.textContent = 'Student borrow status updated successfully!';
                    </script>";
                }
                if($borrow_status == "Pending"){
                    $newDueDate = new DateTime($due_date);
                    $newCurrentDate = new DateTime($date);
                    $interval = $newCurrentDate->diff($newDueDate);
                    $daysLate = $interval->days;
                    $finePerDay = 2;
                    $fine = $finePerDay * $daysLate;
                    $row_exist = mysqli_query($conn, "SELECT * FROM defaulter_list WHERE BB_ID = $bb_id AND User_ID = $user_id AND Book_ID = $book_id");
                    if(mysqli_num_rows($row_exist) > 0){
                        if(!empty($output)){
                            // header("location :admin_reserved_books.php");
                            echo "<script>
                            const errBox = document.querySelector('.error-text');
                            errBox.style.display = 'block';
                            errBox.textContent = 'Student already exist in defaulter list!';
                            </script>";
                        }
                    }else{
                        $query = "INSERT INTO defaulter_list (BB_ID, User_ID, Book_ID, Fine) VALUES ($bb_id ,$user_id, $book_id, $fine)";
                        $sql_defaulter = mysqli_query($conn, $query);
                    }
                }else{
                    // $delete_query = mysqli_query($conn, "DELETE FROM defaulter_list WHERE BB_ID = $bb_id AND User_ID = $user_id AND Book_ID = $book_id");
                }
                if($borrow_status != "Active" && $borrow_status != "Pending"){
                    incrementQuantity($conn, $book_id);
                    decrementBorrow($conn, $user_id);
                }
            }
        }
    ?>

    <!-- Update user section ends -->

</body>
<script src="../javascript/admin_script.js"></script>
<script>
    new DataTable('#tableData');
    
    const menuItems = document.querySelector(".side-menu li:not(:nth-child(5))");
    const manageUsers = document.querySelector(".side-menu li:nth-child(5)");
    menuItems.classList.remove("active");
    manageUsers.classList.add("active");

    const updateBox = document.querySelector(".update"),
    closeBtn = document.querySelector('#close-update');
    if(closeBtn){
        closeBtn.onclick = ()=> {
            updateBox.style.display = 'none';
            window.location.href = 'admin_reserved_books.php';
        };
    }

    function adjustLayout() {
        const screenWidth = window.innerWidth;
        const moreDetail1 = document.getElementById("field-set-1");
        const moreDetail2 = document.getElementById("field-set-2");
        const moreDetail3 = document.getElementById("field-set-3");
        const moreDetail4 = document.getElementById("field-set-4");

        if (screenWidth < 450) {
            moreDetail1.classList.remove("more-details");
            moreDetail2.classList.remove("more-details");
            moreDetail3.classList.remove("more-details");
            moreDetail4.classList.remove("more-details");
        } else {
            moreDetail1.classList.add("more-details");
            moreDetail2.classList.add("more-details");
            moreDetail3.classList.add("more-details");
            moreDetail4.classList.add("more-details");
        }
    }

    adjustLayout();

    window.addEventListener("resize", adjustLayout);

</script>
</html>
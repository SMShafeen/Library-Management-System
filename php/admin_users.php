<?php

include_once "config.php";
session_start();
$admin_id = $_SESSION['admin_id'];
$admin_name = $_SESSION['admin_name'];
$admin_email = $_SESSION['admin_email'];
if(!isset($admin_id)){
    header("location: login.php");
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM users WHERE ID = $delete_id") OR die("Query Failed");
    header("location: admin_users.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>

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
                    <h1>Manage Users</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Admin</a></li>
                        /
                        <li><a href="#" class="active">Manage Users</a></li>
                    </ul>
                </div>
                <a href="#" class="report">
                    <i class='bx bx-cloud-download' ></i>
                    <span>Download CSV</span>
                </a>
            </div>

            <!-- User table section starts -->

            <div class="table-data" style="margin-top:20px;">
                <table id="tableData" class="ui celled table table-striped hover" style="width:100%;">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Name</th>
                            <th>Year</th>
                            <th>Branch</th>
                            <th>UIN</th>
                            <th>User Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = mysqli_query($conn, "SELECT * FROM users");
                            if(mysqli_num_rows($sql) > 0){
                                $srno = 0;
                                while($fetch = mysqli_fetch_assoc($sql)){
                                    $srno = $srno + 1;
                                    echo "<tr>
                                            <td>".$srno."</td>
                                            <td>".$fetch['Name']."</td>
                                            <td>".$fetch['Year']."</td>
                                            <td>".$fetch['Branch']."</td>
                                            <td>".$fetch['UIN']."</td>
                                            <td>".$fetch['User_Type']."</td>
                                            <td>
                                                <a href='admin_users.php?update=".$fetch['ID']."' class='option-btn' style='margin-right: 3px;'>Edit</a>
                                                <a href='admin_users.php?delete=".$fetch['ID']."' onclick='return confirm(`Are you sure you want to delete this user?`);' class='delete-btn' style='margin-left: 3px;'>Delete</a>
                                            </td>
                                        </tr>";
                                }
                            }else{
                                echo "<script>console.log('no records found');</script>";
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
            $update_query = mysqli_query($conn, "SELECT * FROM users WHERE ID = $update_id");
            if(mysqli_num_rows($update_query) > 0){
                while($fetch_update = mysqli_fetch_assoc($update_query)){
    ?>
        <section class="update">
            <form action="" method="post" enctype="multipart/form-data">
                <h3>edit student details</h3>
                <div class="error-text"></div>
                <img src="../uploaded_image/<?php echo $fetch_update['Profile_Picture']; ?>">
                    <input type="hidden" class="box" name="update_id" value="<?php echo $fetch_update['ID']; ?>">
                <div class="field">
                    <label for="title">Name:</label>
                    <input type="text" class="box" name="update_name" value="<?php echo $fetch_update['Name']; ?>" placeholder="enter name" required>
                </div>
                <div class="field">
                    <label for="title">Email:</label>
                    <input type="text" class="box" min="0" name="update_email" value="<?php echo $fetch_update['Email']; ?>" placeholder="enter email">
                </div>
                <div class="more-details" id="field-set-3">
                    <div class="field">
                        <label for="title">Number:</label>
                        <input type="text" class="box" min="0" name="update_number" value="<?php echo $fetch_update['Number']; ?>" placeholder="enter number">
                    </div>
                    <div class="field">
                        <label for="title">UIN:</label>
                        <input type="text" class="box" min="0" name="update_uin" value="<?php echo $fetch_update['UIN']; ?>" placeholder="enter UIN">
                    </div>
                </div>
                <div class="more-details" id="field-set-1">
                    <div class="field">
                        <label for="title">Year:</label>
                        <select name="update_year" class="box" required>
                            <option>---SELECT YEAR---</option>
                            <option selected style="background:grey;color:#fff;pointer-events:none;"><?php echo $fetch_update['Year']; ?></option>
                            <option>First Year</option>
                            <option>Second Year</option>
                            <option>Third Year</option>
                            <option>Fourth Year</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="title">Branch:</label>
                        <select name="update_branch" class="box">
                            <option>---SELECT BRANCH---</option>
                            <option selected style="background:grey;color:#fff;pointer-events:none;"><?php echo $fetch_update['Branch']; ?></option>
                            <option>ECS</option>
                            <option>EXTC</option>
                            <option>Computer Engineering</option>
                            <option>AI and DS</option>
                            <option>Mechinical Engineering</option>
                            <option>Civil Engineering</option>
                        </select>
                    </div>
                </div>
                <div class="more-details" id="field-set-2">
                    <div class="field">
                        <label for="title">User Type:</label>
                        <select name="user_type" class="box">
                            <option>---SELECT User Type---</option>
                            <option selected style="background:grey;color:#fff;pointer-events:none;"><?php echo $fetch_update['User_Type']; ?></option>
                            <option>student</option>
                            <option>admin</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="title">Status:</label>
                        <input style="pointer-events:none;" type="text" value="<?php echo $fetch_update['Status']; ?>" class="box" min="0" name="status">
                    </div>
                </div>
                <input type="submit" class="btn" name="add_book" value="update" style="margin-top:10px; margin-right:5px;">
                <input type="reset" id="close-update" class="option-btn" name="cancel" value="cancel" style="margin-top:10px; margin-left:5px;">
                <!-- <button id="close-update" class="option-btn" style="margin-top:10px;">cancel</button> -->
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
<script src="../javascript/admin_manage_users.js"></script>
<script>
    new DataTable('#tableData');
    
    const menuItems = document.querySelector(".side-menu li:not(:nth-child(7))");
    const manageUsers = document.querySelector(".side-menu li:nth-child(7)");
    menuItems.classList.remove("active");
    manageUsers.classList.add("active");

    const updateBox = document.querySelector(".update"),
    closeBtn = document.querySelector('#close-update');
    if(closeBtn){
        closeBtn.onclick = ()=> {
            updateBox.style.display = 'none';
            window.location.href = 'admin_users.php';
        };
    }

    function adjustLayout() {
        const screenWidth = window.innerWidth;
        const moreDetail1 = document.getElementById("field-set-1");
        const moreDetail2 = document.getElementById("field-set-2");
        const moreDetail3 = document.getElementById("field-set-3");

        if (screenWidth < 450) {
            moreDetail1.classList.remove("more-details");
            moreDetail2.classList.remove("more-details");
            moreDetail3.classList.remove("more-details");
        } else {
            moreDetail1.classList.add("more-details");
            moreDetail2.classList.add("more-details");
            moreDetail3.classList.add("more-details");
        }
    }

    adjustLayout();

    window.addEventListener("resize", adjustLayout);

</script>
</html>
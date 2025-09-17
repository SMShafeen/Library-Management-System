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
    <title>Manage Defaulter List</title>

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
    <link rel="stylesheet" href="../css/table.css">
    
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
                    <h1>Defaulter List</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Admin</a></li>
                        /
                        <li><a href="#" class="active">Defaulter List</a></li>
                    </ul>
                </div>
                <a href="#" class="report">
                    <i class='bx bx-cloud-download' ></i>
                    <span>Download CSV</span>
                </a>
            </div>

            <!-- User table section starts -->

            <div class="table-data" style="margin-top:20px;">
            <main class="table">
        <section class="table_header"><h1>Customer's Orders</h1></section>
        <section class="table_body">
            <table id="myTable" class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Location</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><img src="images/pic-1.png" alt="">Mohammad</td>
                        <td>Mumbai</td>
                        <td>17-03-2024</td>
                        <td><p class="status delivered">Delivered</p></td>
                        <td><strong>$100/-</strong></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><img src="images/pic-2.png" alt="">Mohammad</td>
                        <td>Mumbai</td>
                        <td>17-03-2024</td>
                        <td><p class="status shipped">Shipped</p></td>
                        <td><strong>$100/-</strong></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><img src="images/pic-3.png" alt="">Mohammad</td>
                        <td>Mumbai</td>
                        <td>17-03-2024</td>
                        <td><p class="status delivered">Delivered</p></td>
                        <td><strong>$100/-</strong></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td><img src="images/pic-4.png" alt="">Mohammad</td>
                        <td>Mumbai</td>
                        <td>17-03-2024</td>
                        <td><p class="status pending">Pending</p></td>
                        <td><strong>$100/-</strong></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td><img src="images/pic-5.png" alt="">Mohammad</td>
                        <td>Mumbai</td>
                        <td>17-03-2024</td>
                        <td><p class="status delivered">Delivered</p></td>
                        <td><strong>$100/-</strong></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td><img src="images/pic-6.png" alt="">Mohammad</td>
                        <td>Mumbai</td>
                        <td>17-03-2024</td>
                        <td><p class="status pending">Pending</p></td>
                        <td><strong>$100/-</strong></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td><img src="images/author-1.jpg" alt="">Mohammad</td>
                        <td>Mumbai</td>
                        <td>17-03-2024</td>
                        <td><p class="status cancelled">Cancelled</p></td>
                        <td><strong>$100/-</strong></td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td><img src="images/author-2.jpg" alt="">Mohammad</td>
                        <td>Mumbai</td>
                        <td>17-03-2024</td>
                        <td><p class="status delivered">Delivered</p></td>
                        <td><strong>$100/-</strong></td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td><img src="images/author-3.jpg" alt="">Mohammad</td>
                        <td>Mumbai</td>
                        <td>17-03-2024</td>
                        <td><p class="status shipped">Shipped</p></td>
                        <td><strong>$100/-</strong></td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td><img src="images/author-4.jpg" alt="">Mohammad</td>
                        <td>Mumbai</td>
                        <td>17-03-2024</td>
                        <td><p class="status cancelled">Cancelled</p></td>
                        <td><strong>$100/-</strong></td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td><img src="images/author-5.jpg" alt="">Mohammad</td>
                        <td>Mumbai</td>
                        <td>17-03-2024</td>
                        <td><p class="status cancelled">Cancelled</p></td>
                        <td><strong>$100/-</strong></td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td><img src="images/author-6.jpg" alt="">Mohammad</td>
                        <td>Mumbai</td>
                        <td>17-03-2024</td>
                        <td><p class="status delivered">Delivered</p></td>
                        <td><strong>$100/-</strong></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
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
                <input type="text" class="box" name="update_name" value="<?php echo $fetch_update['Name']; ?>" placeholder="enter name" required>
                <input type="text" class="box" min="0" name="update_email" value="<?php echo $fetch_update['Email']; ?>" placeholder="enter email">
                <div class="more-details" id="field-set-3">
                    <input type="text" class="box" min="0" name="update_number" value="<?php echo $fetch_update['Number']; ?>" placeholder="enter number">
                    <input type="text" class="box" min="0" name="update_uin" value="<?php echo $fetch_update['UIN']; ?>" placeholder="enter UIN">
                </div>
                <div class="more-details" id="field-set-1">
                    <select name="update_year" class="box" required>
                        <option>---SELECT YEAR---</option>
                        <option selected style="background:grey;color:#fff;pointer-events:none;"><?php echo $fetch_update['Year']; ?></option>
                        <option>First Year</option>
                        <option>Second Year</option>
                        <option>Third Year</option>
                        <option>Fourth Year</option>
                    </select>
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
                <div class="more-details" id="field-set-2">
                    <!-- <input type="text" class="box" min="0" name="price" placeholder="enter genre"> -->
                    <select name="user_type" class="box">
                        <option>---SELECT User Type---</option>
                        <option selected style="background:grey;color:#fff;pointer-events:none;"><?php echo $fetch_update['User_Type']; ?></option>
                        <option>student</option>
                        <option>admin</option>
                    </select>
                    <input style="pointer-events:none;" type="text" value="<?php echo $fetch_update['Status']; ?>" class="box" min="0" name="status">
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
<script src="../javascript/table.js"></script>
<script src="../javascript/admin_manage_users.js"></script>
<script>
    new DataTable('#tableData');
    
    const menuItems = document.querySelector(".side-menu li:not(:nth-child(2))");
    const manageUsers = document.querySelector(".side-menu li:nth-child(2)");
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
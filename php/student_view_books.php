<?php

include_once "config.php";
session_start();
$student_id = $_SESSION['student_id'];
$student_name = $_SESSION['student_name'];
$student_email = $_SESSION['student_email'];
if(!isset($student_id)){
    header("location: login.php");
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM book WHERE ID = $delete_id") OR die("Query Failed");
    header("location: admin_manage_books.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Books</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Boxicons link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <!-- CSS Data Tables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.semanticui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
    
    <!-- CSS file link -->
    <link rel="stylesheet" href="../css/student_style.css">
    
    <!-- JS Data Tables -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.semanticui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.js"></script>

    
</head>
<body style="background:;">

    <?php include 'student_base_layout.php'; ?>

    <div class="content">
        <main>
            <div class="header">
                <div class="left">
                    <h1>View Books</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Student</a></li>
                        /
                        <li><a href="#" class="active">View Books</a></li>
                    </ul>
                </div>
            </div>

            <!-- Book table section starts -->

            <div class="table-data">
            <br>
                <table id="tableData" class="ui celled table table-striped hover" style="width:100%; margin-top:10px;">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Publication</th>
                            <th>Department</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = mysqli_query($conn, "SELECT * FROM book");
                            if(mysqli_num_rows($sql) > 0){
                                $srno = 0;
                                while($fetch = mysqli_fetch_assoc($sql)){
                                    $srno = $srno + 1;
                                    echo "<tr>
                                            <td>".$srno."</td>
                                            <td>".$fetch['Book_Title']."</td>
                                            <td>".$fetch['Book_Author']."</td>
                                            <td>".$fetch['Book_Publication']."</td>
                                            <td>".$fetch['Department']."</td>
                                            <td>".$fetch['Available_Copies']."/".$fetch['Total_Copies']."</td>
                                            <td>
                                                <a href='student_view_books.php?update=".$fetch['ID']."' class='option-btn' style='margin-right: 3px;'>Detail</a>
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

            <!-- Book table section ends -->
            
            <br>
        </main>
    </div>
    <!-- Update user section starts -->

    <?php
            if(isset($_GET['update'])){
                $update_id = $_GET['update'];
                $update_query = mysqli_query($conn, "SELECT * FROM book WHERE ID = $update_id");
                if(mysqli_num_rows($update_query) > 0){
                    while($fetch_update = mysqli_fetch_assoc($update_query)){
                        ?>
        <section class="update">
            <form action="" method="post" enctype="multipart/form-data">
                <h3 style="margin-bottom:1rem;">book details</h3>
                <div class="error-text"></div>
                <input disabled type="hidden" class="box" name="update_id" value="<?php echo $fetch_update['ID']; ?>">
                <div class="field">
                    <label for="title">Title:</label>
                    <input disabled type="text" class="box" name="update_title" value="<?php echo $fetch_update['Book_Title']; ?>">
                </div>
                <div class="field">
                    <label for="title">Author:</label>
                    <input disabled type="text" class="box" min="0" name="update_author" value="<?php echo $fetch_update['Book_Author']; ?>">        
                </div>
                <div class="field">
                    <label for="title">Publication:</label>
                    <input disabled type="text" class="box" min="0" name="update_publication" value="<?php echo $fetch_update['Book_Publication']; ?>">
                </div>
                <div class="more-details" id="update-field-set-1">
                    <div class="field">
                        <label for="title">Year:</label>
                        <input disabled type="number" class="box" min="0" name="update_year" value="<?php echo $fetch_update['Published_Year']; ?>">
                    </div>
                    <div class="field">
                    <label for="title">Department:</label>
                    <input disabled type="text" class="box" min="0" name="update_department" value="<?php echo $fetch_update['Department']; ?>">
                </div>
                </div>
                <div class="more-details" id="update-field-set-2">
                    <div class="field">
                        <label for="title">ISBN:</label>
                        <input disabled type="text" class="box" name="update_isbn" value="<?php echo $fetch_update['ISBN']; ?>">
                    </div>
                    <div class="field">
                        <label for="title">Genre:</label>
                        <input disabled type="text" class="box" name="update_genre" value="<?php echo $fetch_update['Genre']; ?>">
                    </div>
                </div>
                <div class="more-details" id="update-field-set-3">
                    <!-- <input type="text" class="box" min="0" name="price" placeholder="enter genre"> -->
                    <div class="field">
                        <label for="title">Available Copies:</label>
                        <input disabled type="number" value="<?php echo $fetch_update['Available_Copies']; ?>" class="box" min="0" name="update_avlc">
                    </div>
                    <div class="field">
                        <label for="title">Total Copies:</label>
                        <input disabled type="number" value="<?php echo $fetch_update['Total_Copies']; ?>" class="box" min="0" name="update_tltc">
                    </div>
                </div>
                <input type="reset" style="width:100%;" id="close-update" class="option-btn" name="cancel" value="cancel">
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
<script src="../javascript/student_script.js"></script>
<script>
    new DataTable('#tableData');
    
    const menuItems = document.querySelector(".side-menu li:not(:nth-child(3))");
    const manageBooks = document.querySelector(".side-menu li:nth-child(3)");
    menuItems.classList.remove("active");
    manageBooks.classList.add("active");
    
    const updateBox = document.querySelector(".update"),
    closeBtn = document.querySelector('#close-update');
    if(closeBtn){
        closeBtn.onclick = ()=> {
            updateBox.style.display = 'none';
            window.location.href = 'student_view_books.php';
        };
    }

    function adjustLayout() {
        const screenWidth = window.innerWidth;
        const moreDetail1 = document.getElementById("field-set-1");
        const moreDetail2 = document.getElementById("field-set-2");
        const moreDetail3 = document.getElementById("field-set-3");
        const uMoreDetail1 = document.getElementById("update-field-set-1");
        const uMoreDetail2 = document.getElementById("update-field-set-2");
        const uMoreDetail3 = document.getElementById("update-field-set-3");
        
        if (screenWidth < 450) {
            moreDetail1.classList.remove("more-details");
            moreDetail2.classList.remove("more-details");
            moreDetail3.classList.remove("more-details");
            uMoreDetail1.classList.remove("more-details");
            uMoreDetail2.classList.remove("more-details");
            uMoreDetail3.classList.remove("more-details");
        } else {
            moreDetail1.classList.add("more-details");
            moreDetail2.classList.add("more-details");
            moreDetail3.classList.add("more-details");
            uMoreDetail1.classList.add("more-details");
            uMoreDetail2.classList.add("more-details");
            uMoreDetail3.classList.add("more-details");
        }
    }
    
    adjustLayout();
    
    window.addEventListener("resize", adjustLayout);    

</script>
</html>
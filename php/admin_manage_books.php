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
    $delete_query = mysqli_query($conn, "DELETE FROM book WHERE ID = $delete_id") OR die("Query Failed");
    header("location: admin_manage_books.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Books</title>

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
                    <h1>Manage Books</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Admin</a></li>
                        /
                        <li><a href="#" class="active">Manage Books</a></li>
                    </ul>
                </div>
                <a href="#" class="report">
                    <i class='bx bx-cloud-download' ></i>
                    <span>Download CSV</span>
                </a>
            </div>

            <!-- Add book section starts -->

            <section class="add-books">
                <form action="" method="post" enctype="multipart/form-data">
                    <h3>add book</h3>
                    <?php
                        // if(isset($error_text)){
                        //     foreach($error_text as $error_text){
                        //         // echo "<div class='error-text'>".$error_text."</div>";
                        //         // echo "<script>console.log('empty fields!');</script>";
                        //     }
                        // }
                        // else{
                        //     echo "<div class='error-text'>msg not set</div>";
                        // }
                    ?>
                    <div class="error-text"></div>
                    <input type="text" class="box" name="title" placeholder="enter book title">
                    <input type="text" class="box" min="0" name="author" placeholder="enter book author">
                    <input type="text" class="box" min="0" name="publication" placeholder="enter book publication">
                    <div class="more-details" id="field-set-1">
                        <input type="number" class="box" min="0" name="year" placeholder="enter published year">
                        <select name="department" class="box">
                            <option selected>---Select Department---</option>
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
                    <div class="more-details" id="field-set-2">
                        <input type="number" class="box" min="0" name="isbn" placeholder="enter ISBN">
                        <!-- <input type="text" class="box" min="0" name="price" placeholder="enter genre"> -->
                        <select name="genre" class="box">
                            <option selected>---Select Genre---</option>
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
                    <div class="more-details" id="field-set-3">
                        <input type="number" class="box" min="0" name="available_copies" placeholder="enter available copies">
                        <input type="number" class="box" min="0" name="total_copies" placeholder="enter total copies">
                    </div>
                    <input type="submit" class="btn" name="add_book" value="add book" style="margin-top:10px;">
                </form>
            </section>

            <!-- Add book section ends -->

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
                                                <a href='admin_manage_books.php?update=".$fetch['ID']."' class='option-btn' style='margin-right: 3px;'>Edit</a>
                                                <a href='admin_manage_books.php?delete=".$fetch['ID']."' class='delete-btn' onclick='return confirm(`Are you sure you want to delete this book?`);' style='margin-left: 3px;'>Delete</a>
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
                <h3 style="margin-bottom:1rem;">edit book details</h3>
                <div class="error-text"></div>
                <input type="hidden" class="box" name="update_id" value="<?php echo $fetch_update['ID']; ?>">
                <div class="field">
                    <label for="title">Title:</label>
                    <input type="text" class="box" name="update_title" value="<?php echo $fetch_update['Book_Title']; ?>" placeholder="book title" required>
                </div>
                <div class="field">
                    <label for="title">Author:</label>
                    <input type="text" class="box" min="0" name="update_author" value="<?php echo $fetch_update['Book_Author']; ?>" placeholder="book author">        
                </div>
                <div class="field">
                    <label for="title">Publication:</label>
                    <input type="text" class="box" min="0" name="update_publication" value="<?php echo $fetch_update['Book_Publication']; ?>" placeholder="book publication">
                </div>
                <div class="more-details" id="update-field-set-1">
                    <div class="field">
                        <label for="title">Year:</label>
                        <input type="number" class="box" min="0" name="update_year" value="<?php echo $fetch_update['Published_Year']; ?>" placeholder="published year">
                    </div>
                    <div class="field">
                    <label for="title">Department:</label>
                    <select name="update_department" class="box">
                        <option>---Select Department---</option>
                        <option selected style="background:grey;color:#fff;pointer-events:none;"><?php echo $fetch_update['Department']; ?></option>
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
                </div>
                <div class="more-details" id="update-field-set-2">
                    <div class="field">
                        <label for="title">ISBN:</label>
                        <input type="text" class="box" name="update_isbn" value="<?php echo $fetch_update['ISBN']; ?>" placeholder="ISBN number">
                    </div>
                    <div class="field">
                        <label for="title">Genre:</label>
                        <select name="update_genre" class="box">
                            <option>---Select Genre---</option>
                            <option selected style="background:grey;color:#fff;pointer-events:none;"><?php echo $fetch_update['Genre']; ?></option>
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
                </div>
                <div class="more-details" id="update-field-set-3">
                    <!-- <input type="text" class="box" min="0" name="price" placeholder="enter genre"> -->
                    <div class="field">
                        <label for="title">Available Copies:</label>
                        <input type="number" value="<?php echo $fetch_update['Available_Copies']; ?>" class="box" min="0" name="update_avlc" placeholder="enter available copies">
                    </div>
                    <div class="field">
                        <label for="title">Total Copies:</label>
                        <input type="number" value="<?php echo $fetch_update['Total_Copies']; ?>" class="box" min="0" name="update_tltc" placeholder="enter total copies">
                    </div>
                </div>
                <input type="submit" class="btn" name="add_book" value="update">
                <input type="reset" id="close-update" class="option-btn" name="cancel" value="cancel">
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
<script src="../javascript/admin_manage_books.js"></script>
<script src="../javascript/admin_manage_books2.js"></script>
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
            window.location.href = 'admin_manage_books.php';
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
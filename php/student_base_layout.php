<!-- Sidebar -->
<div class="sidebar">
        <a href="#" class="logo">
            <img src="../images/logo.png" alt="" class="logo">
            <div class="logo-name"><span>RC</span>OE</div>
        </a>
        <ul class="side-menu">
            <li class="active"><a href="student_dashboard.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="student_profile.php"><i class='bx bx-user' ></i>Profile</a></li>
            <li><a href="student_view_books.php"><i class='bx bx-book-open'></i>View Books</a></li>
            <li><a href="student_borrowed_books.php"><i class='bx bxs-book-bookmark' ></i>Borrow History</a></li>
        </ul>
        <ul class="side-menu">
            <li><a href="logout.php" class="logout"><i class='bx bx-log-out-circle'></i>Logout</a></li>
        </ul>
    </div>
    <!-- End of sidebar -->

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <?php
            $query = mysqli_query($conn, "SELECT * FROM users WHERE ID = $student_id");
            if(mysqli_num_rows($query) > 0){
                $fetch_info = mysqli_fetch_assoc($query);
            }
        ?>
        <nav>
            <i class='bx bx-menu' id="menu-btn"></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <a href="#" class="notification">
                <i class='bx bx-bell' ></i>
                <span class="count">12</span>
            </a>
            <a href="student_profile.php" class="profile">
                <img src="../uploaded_image/<?php echo $fetch_info['Profile_Picture']; ?>" alt="">
            </a>
        </nav>
        <!-- End of navbar -->
    </div>
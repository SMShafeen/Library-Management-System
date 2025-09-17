<?php

include_once "config.php";
session_start();

function sanitize($value){
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
$title = mysqli_real_escape_string($conn, sanitize($_POST['title']));
$author = mysqli_real_escape_string($conn, sanitize($_POST['author']));
$publication = mysqli_real_escape_string($conn, sanitize($_POST['publication']));
$year = mysqli_real_escape_string($conn, sanitize($_POST['year']));
$department = mysqli_real_escape_string($conn, sanitize($_POST['department']));
$isbn = mysqli_real_escape_string($conn, sanitize($_POST['isbn']));
$genre = mysqli_real_escape_string($conn, sanitize($_POST['genre']));
$available_copies = mysqli_real_escape_string($conn, sanitize($_POST['available_copies']));
$total_copies = mysqli_real_escape_string($conn, sanitize($_POST['total_copies']));

    // if(isset($_POST['add_book'])){
        if(!empty($title) && !empty($available_copies) && !empty($total_copies)){
            if($department === "---Select Department---"){
                echo "Please select department!";
            }elseif($genre === "---Select Genre---"){
                echo "Please select genre!";
            }else{
                $sql = "INSERT INTO book (Book_Title, Book_Author, Book_Publication, Published_Year, Department, ISBN, Genre, Available_Copies, Total_Copies) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "sssssssss", $param_title, $param_author, $param_publication, $param_year, $param_department, $param_isbn, $param_genre, $param_avlc, $param_tltc);
                $param_title = $title;
                $param_author = $author;
                $param_publication = $publication;
                $param_year = $year;
                $param_department = $department;
                $param_isbn = $isbn;
                $param_genre = $genre;
                $param_avlc = $available_copies;
                $param_tltc = $total_copies;
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    echo "Success!";
                    mysqli_stmt_close($stmt);
                }else{
                    echo "Could not add the book! Please try again!";
                }
            }
        }else{
            echo "Please fill the required fields!";
        }
    // }
}

?>
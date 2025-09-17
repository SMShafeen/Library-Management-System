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

    $update_id = $_POST['update_id'];
    $update_title = mysqli_real_escape_string($conn, sanitize($_POST['update_title']));
    $update_author = mysqli_real_escape_string($conn, sanitize($_POST['update_author']));
    $update_publication = mysqli_real_escape_string($conn, sanitize($_POST['update_publication']));
    $update_year = mysqli_real_escape_string($conn, sanitize($_POST['update_year']));
    $update_department = mysqli_real_escape_string($conn, sanitize($_POST['update_department']));
    $update_isbn = mysqli_real_escape_string($conn, sanitize($_POST['update_isbn']));
    $update_genre = mysqli_real_escape_string($conn, sanitize($_POST['update_genre']));
    $update_avlc = mysqli_real_escape_string($conn, sanitize($_POST['update_avlc']));
    $update_tltc = mysqli_real_escape_string($conn, sanitize($_POST['update_tltc']));

// if(isset($_POST['add_book'])){
    if(!empty($update_title) && !empty($update_avlc) && !empty($update_tltc)){
        if($update_department === "---Select Department---"){
            echo "Please select department!";
        }elseif($update_genre === "---Select Genre---"){
            echo "Please select genre!";
        }else{
            $update_sql = "UPDATE book SET Book_Title = ?, Book_Author = ?, Book_Publication = ?, Published_Year = ?, Department = ?, ISBN = ?, Genre = ?, Available_Copies = ?, Total_Copies = ? WHERE ID = ?";
            $update_stmt = mysqli_prepare($conn, $update_sql);
            mysqli_stmt_bind_param($update_stmt, "ssssssssss", $param_u_title, $param_u_author, $param_u_publication, $param_u_year, $param_u_department, $param_u_isbn, $param_u_genre, $param_u_avlc, $param_u_tltc, $param_u_id);
            $param_u_title = $update_title;
            $param_u_author = $update_author;
            $param_u_publication = $update_publication;
            $param_u_year = $update_year;
            $param_u_department = $update_department;
            $param_u_isbn = $update_isbn;
            $param_u_genre = $update_genre;
            $param_u_avlc = $update_avlc;
            $param_u_tltc = $update_tltc;
            $param_u_id = $update_id;
            if(mysqli_stmt_execute($update_stmt)){
                    mysqli_stmt_store_result($update_stmt);
                    echo "Success!";
                    mysqli_stmt_close($update_stmt);
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
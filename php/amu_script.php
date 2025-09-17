<?php

session_start();
include_once "config.php";

function sanitize($value){
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}

function validatePhoneNumber($phone){
    $regex_num = '/^\d{10}$/';
    return preg_match($regex_num, $phone);
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $update_id = $_POST['update_id'];
    $update_name = mysqli_real_escape_string($conn, sanitize($_POST['update_name']));
    $update_email = mysqli_real_escape_string($conn, sanitize($_POST['update_email']));
    $update_number = mysqli_real_escape_string($conn, sanitize($_POST['update_number']));
    $update_uin = mysqli_real_escape_string($conn, sanitize($_POST['update_uin']));
    $update_year = mysqli_real_escape_string($conn, sanitize($_POST['update_year']));
    $update_branch = mysqli_real_escape_string($conn, sanitize($_POST['update_branch']));
    $user_type = mysqli_real_escape_string($conn, sanitize($_POST['user_type']));
    $status = mysqli_real_escape_string($conn, sanitize($_POST['status']));
    
    if(!empty($update_name) && !empty($update_email) && !empty($update_uin) && !empty($update_number) && !empty($update_year) && !empty($update_branch)){
        
        $sql_email = mysqli_prepare($conn, "SELECT Email FROM users WHERE Email = ?");
        mysqli_stmt_bind_param($sql_email, "s", $update_email);
        mysqli_stmt_execute($sql_email);
        mysqli_stmt_store_result($sql_email);
        
        $sql_uin = mysqli_prepare($conn, "SELECT UIN FROM users WHERE UIN = ?");
        mysqli_stmt_bind_param($sql_uin, "s", $update_uin);
        mysqli_stmt_execute($sql_uin);
        mysqli_stmt_store_result($sql_uin);
        
        $sql_number = mysqli_prepare($conn, "SELECT Number FROM users WHERE Number = ?");
        mysqli_stmt_bind_param($sql_number, "s", $update_number);
        mysqli_stmt_execute($sql_number);
        mysqli_stmt_store_result($sql_number);
        
        if(mysqli_stmt_num_rows($sql_email) > 1){
            echo "$update_email - This email already exist!";
            mysqli_stmt_close($sql_email);
        }elseif(mysqli_stmt_num_rows($sql_uin) > 1){
            echo "$update_uin - This UIN already exist!";
            mysqli_stmt_close($sql_uin);
        }elseif(mysqli_stmt_num_rows($sql_number) > 1){
            echo "$update_number - This number already exist!";
            mysqli_stmt_close($sql_number);
        }else{
            
            if(!filter_var($update_email, FILTER_VALIDATE_EMAIL)){
                echo "$update_email - This is not a valid email!";
            }elseif(!validatePhoneNumber($update_number)){
                echo "$update_number - This is not a valid number!";
            }elseif($update_year === '---SELECT YEAR---'){
                echo "Please select year!";
            }elseif($update_branch === '---SELECT BRANCH---'){
                echo "Please select branch!";
            }else{
                
                $update_query = "UPDATE users SET Name = ?, Email = ?, Number = ?, UIN = ?, Year = ?, Branch = ?, User_Type = ? WHERE ID = ?";
                $stmt = mysqli_prepare($conn, $update_query);
                mysqli_stmt_bind_param($stmt, "ssssssss", $param_u_name, $param_u_email, $param_u_number, $param_u_uin, $param_u_year, $param_u_branch, $param_user_type, $param_update_id);
                
                $param_u_name = $update_name;
                $param_u_email = $update_email;
                $param_u_number = $update_number;
                $param_u_uin = $update_uin;
                $param_u_year = $update_year;
                $param_u_branch = $update_branch;
                $param_user_type = $user_type;
                $param_update_id = $update_id;
                
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    echo "Success!";
                    mysqli_stmt_close($stmt);
                }else{
                    echo "Could not update the user! Please try again!";
                }
            }
        }
    }else{
        echo "All input field are required!";
    }
    mysqli_close($conn);  
}

    ?>
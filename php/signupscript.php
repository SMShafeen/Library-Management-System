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

function validateEmail($Vemail){
    // $regex_email = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
    $regex_email = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    // $regex_email = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    return preg_match($regex_email, $Vemail);
}

$name = mysqli_real_escape_string($conn, sanitize($_POST['name']));
$email = mysqli_real_escape_string($conn, sanitize($_POST['email']));
$number = mysqli_real_escape_string($conn, sanitize($_POST['number']));
$uin = mysqli_real_escape_string($conn, sanitize($_POST['uin']));
$year = mysqli_real_escape_string($conn, sanitize($_POST['year']));
$branch = mysqli_real_escape_string($conn, sanitize($_POST['branch']));
$password = mysqli_real_escape_string($conn, sanitize($_POST['password']));
$cpassword = mysqli_real_escape_string($conn, sanitize($_POST['confirm_password']));

$image = $_FILES['image']['name'];
$random_num = rand(time(), 10000000);
$image_name = 'new_img_' . time() . '_' . $random_num . '_' . $image;
$image_tmp_name = $_FILES['image']['tmp_name'];
$image_size = $_FILES['image']['size'];
$image_folder = '../uploaded_image/' . $image_name;

if(!empty($name) && !empty($email) && !empty($number) && !empty($uin) && !empty($year) && !empty($branch) && !empty($password) && !empty($cpassword)){

    $sql_email = mysqli_prepare($conn, "SELECT Email FROM users WHERE Email = ?");
    mysqli_stmt_bind_param($sql_email, "s", $email);
    mysqli_stmt_execute($sql_email);
    mysqli_stmt_store_result($sql_email);
    
    $sql_number = mysqli_prepare($conn, "SELECT Number FROM users WHERE Number = ?");
    mysqli_stmt_bind_param($sql_number, "s", $number);
    mysqli_stmt_execute($sql_number);
    mysqli_stmt_store_result($sql_number);
    
    $sql_uin = mysqli_prepare($conn, "SELECT UIN FROM users WHERE UIN = ?");
    mysqli_stmt_bind_param($sql_uin, "s", $uin);
    mysqli_stmt_execute($sql_uin);
    mysqli_stmt_store_result($sql_uin);
    
    if(mysqli_stmt_num_rows($sql_email) > 0){
        echo "$email - This email already exist!";
        mysqli_stmt_close($sql_email);
    }elseif(mysqli_stmt_num_rows($sql_number) > 0){
        echo "$number - This number already exist!";
        mysqli_stmt_close($sql_number);
    }elseif(mysqli_stmt_num_rows($sql_uin) > 0){
        echo "$uin - This UIN already exist!";
        mysqli_stmt_close($sql_uin);
    }else{
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            if(!validateEmail($email)){
                echo "$email - This is not a valid email!";
            }
        }elseif(!validatePhoneNumber($number)){
            echo "$number - This is not a valid number!";
        }elseif($year === '---SELECT---'){
            echo "Please select year!";
        }elseif($branch === '---SELECT---'){
            echo "Please select branch!";
        }elseif(strlen($password) < 8){
            echo "Password must be of atleast 8 characters!";
        }elseif($password != $cpassword){
            echo "Password should match!";
        }elseif($image_size > 2000000){
            echo "Image size is too large!";
        }else{
            
            $insert = "INSERT INTO users (Name, Email, Number, UIN, Year ,Branch, Password, Profile_Picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $insert);
            mysqli_stmt_bind_param($stmt, "ssssssss", $param_name, $param_email, $param_number, $param_uin, $param_year, $param_branch, $param_password, $param_image);
            
            $param_name = $name;
            $param_email = $email;
            $param_number = $number;
            $param_uin = $uin;
            $param_year = $year;
            $param_branch = $branch;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_image = (!empty($image)) ? $image_name : "";
                
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            if(isset($_FILES['image'])){
                move_uploaded_file($image_tmp_name, $image_folder);
            }
            echo "Success!";
            // header('location: login.php');
            mysqli_stmt_close($stmt);
        }
    }
}else{
    echo "All input field are required!";
}
mysqli_close($conn);  
?>
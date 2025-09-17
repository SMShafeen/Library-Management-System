<?php

session_start();
include_once "config.php";

function sanitize($value){
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}

$email = mysqli_real_escape_string($conn, sanitize($_POST['email']));
$password = mysqli_real_escape_string($conn, sanitize($_POST['password']));

if(!empty($email) && !empty($password)){

    $sql = mysqli_prepare($conn, "SELECT Email, Password FROM users WHERE Email = ?");
    mysqli_stmt_bind_param($sql, "s", $param_email);
    $param_email = $email;
    if(mysqli_stmt_execute($sql)){
        mysqli_stmt_store_result($sql);
        if(mysqli_stmt_num_rows($sql) > 0){
            mysqli_stmt_bind_result($sql, $email, $hashed_password);
            if(mysqli_stmt_fetch($sql)){
                if(password_verify($password, $hashed_password)){
                    $select = mysqli_query($conn, "SELECT * FROM users Where Email = '$email'");
                    $fetch = mysqli_fetch_assoc($select);
                        // echo var_dump($fetch);
                    if($fetch['User_Type'] === 'admin'){
                        $_SESSION['admin_id'] = $fetch['ID'];
                        $_SESSION['admin_name'] = $fetch['Name'];
                        $_SESSION['admin_email'] = $fetch['Email'];
                        $_SESSION['loggedin'] = true;
                        echo "Admin Set!";
                    }elseif($fetch['User_Type'] === 'student'){
                        $_SESSION['student_id'] = $fetch['ID'];
                        $_SESSION['student_name'] = $fetch['Name'];
                        $_SESSION['student_email'] = $fetch['Email'];
                        $_SESSION['student_uin'] = $fetch['UIN'];
                        $_SESSION['loggedin'] = true;
                        echo "Student Set!";
                    }
                    $cstatus = "Active";
                    $status = mysqli_query($conn, "UPDATE users SET status = '{$cstatus}' WHERE ID = {$fetch['ID']}");
                
                }else{
                    echo "Wrong password!";
                }
            }
        }else{
            echo "$email - This email is not registered yet!";
        }

    }
}
    
//     if(mysqli_stmt_num_rows($sql_uin) > 0){
//         echo "$uin - This UIN already exist!";
//         mysqli_stmt_close($sql_uin);
//     }elseif(mysqli_stmt_num_rows($sql_number) > 0){
//         echo "$number - This number already exist!";
//         mysqli_stmt_close($sql_number);
//     }else{
        
//         if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
//             echo "$email - This is not a valid email!";
//         }elseif(!validatePhoneNumber($number)){
//             echo "$number - This is not a valid number!";
//         }elseif($year === '---SELECT---'){
//             echo "Please select year!";
//         }elseif($branch === '---SELECT---'){
//             echo "Please select branch!";
//         }elseif(strlen($password) < 8){
//             echo "Password must be of atleast 8 characters!";
//         }else{
            
//             $insert = "INSERT INTO users (Name, Email, UIN, Number, Year ,Branch, Password, Profile_Picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
//             $stmt = mysqli_prepare($conn, $insert);
//             mysqli_stmt_bind_param($stmt, "ssssssss", $param_name, $param_email, $param_uin, $param_number, $param_year, $param_branch, $param_password, $param_image);
            
//             $param_name = $name;
//             $param_email = $email;
//             $param_uin = $uin;
//             $param_number = $number;
//             $param_year = $year;
//             $param_branch = $branch;
//             $param_password = password_hash($password, PASSWORD_DEFAULT);
//             $param_image = (!empty($image)) ? $image_name : "";
                
//             mysqli_stmt_execute($stmt);
//             mysqli_stmt_store_result($stmt);
//             if(isset($_FILES['image'])){
//                 move_uploaded_file($image_tmp_name, $image_folder);
//             }
//             echo "Success!";
//             // header('location: login.php');
//             mysqli_stmt_close($stmt);
//         }
//     }
// }else{
//     echo "All input field are required!";
// }
// mysqli_close($conn);  
// ?>
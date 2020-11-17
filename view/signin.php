<?php

$errors = [];
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){


    require("config.php");
    
    function cleanInput($data){ //sanitize data 
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $email = cleanInput($_POST['email']);
    $password = cleanInput($_POST['password']);
    $loginQuery = "SELECT user_id, password FROM users WHERE email = ? LIMIT 1";

    if(empty($email)){
        $errors['email'] = "Email Required";
    }
    if(empty($password)){
        $errors['password'] = "Password Required";
    }

    //if no errors check if credentials are valid
    if(count($errors)===0){

        $stmt = $conn->prepare($loginQuery);
        $stmt->bind_param('s', $email);
        $stmt->execute();

        $return = $stmt->get_result();
        $user = $return->fetch_assoc();
        
        //Verifying Email
        if(password_verify($password, $user['password'])){ 
            $user_id = $user['user_id'];
            $_SESSION['user_id'] = $user_id;
            $_SESSION['email'] = $email;
            $_SESSION['source'] = "logIn";
            header("Location:profile.php");  
        }
        else{
            $errors['login'] = "Invalid Credentials";
        }
    }
    else{
        
        $error['dbError'] = "Database Error!";
        exit();
    }
}
?>

<?php

$errors = [];
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){


    $require("config.php");

    function cleanInput($data){ //sanitize data 
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $loginQuery = "SELECT email, password FROM users WHERE email = ? AND password = ? LIMIT 1";
    $email = cleanInput(_POST['email']);
    $password = cleanInput(_POST['password']);

    if(empty($email)){
        $errors['email'] = "Username Required";
    }
    if(empty($password)){
        $errors['password'] = "Password Required";
    }

    //if no errors check if credentials are valid
    if(count($errors)===0){

    $stmt = $conn->prepare($loginQuery);
    $stmt = bind_param('ss', $email, $password);
    $stmt = store_result();
    $return = $stmt->get_result();
    $user = $return->fetch_assoc();

    $hash_pass = $user['password'];
    $user_id = $user['id'];
    //Verifying Email
    if(password_verify($password, $hash_pass)){ 
    
        $_SESSION['id'] = $user_id;
        $_SESSION['email'] = $email;
        $_SESSION['source'] = "login";
        header("Location:profile.php");
        exit();       
    }
    else{
        $error['invalidEP'] = "Invalid Email or Invalid Password or Invali Email and Password!"
    }
    $stmt->close()
}
else{
    
    $error['dbError'] = "Database Error!";
    exit();
}















?>

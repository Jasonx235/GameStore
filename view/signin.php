<?php

$errors = [];

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
    $loginQuery = "SELECT * FROM users WHERE email = ? LIMIT 1";

    if(empty($email)){
        $errors['email'] = "Username Required";
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
        $user_id = $user['id'];
        $_SESSION['id'] = $user_id;
        $_SESSION['email'] = $email;
        $_SESSION['source'] = "logIn";
        header("Location:profile.php");
        exit();       
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

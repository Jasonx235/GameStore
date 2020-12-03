<?php

$errors = []; //empty errors array
session_start(); //start session

if($_SERVER["REQUEST_METHOD"] == "POST"){ //check if request method is POST


    require("config.php"); //make sure config is working properly
    
    function cleanInput($data){ //sanitize data 
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $email = cleanInput($_POST['email']);
    $password = cleanInput($_POST['password']);
    $loginQuery = "SELECT user_id, password FROM users WHERE email = ? LIMIT 1"; //login query

     //if empty
    if(empty($email)){
        $errors['email'] = "Email Required";
    }
    if(empty($password)){
        $errors['password'] = "Password Required";
    }

    //if no errors, check if credentials are valid
    if(count($errors)===0){

        $stmt = $conn->prepare($loginQuery); //prepare
        $stmt->bind_param('s', $email); //bind
        $stmt->execute(); //execute

        $return = $stmt->get_result();
        $user = $return->fetch_assoc(); //put data in associative array
        
        //Verifying Email
        if(!$user) { //check user email
            $errors['login'] = "Invalid Credentials";
        }
        else if(password_verify($password, $user['password'])){ //check password

            $user_id = $user['user_id']; //make new session with user id and email
            $_SESSION['user_id'] = $user_id;
            $_SESSION['email'] = $email;

            $adminQuery = "SELECT admin FROM users WHERE user_id = ?"; //check if user is admin
            $stmt = $conn->prepare($adminQuery); //prepare
            $stmt->bind_param('i', $_SESSION['user_id']); //bind
            $stmt->execute(); //execute
            $isAdmin = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //get results
            $_SESSION['isAdmin'] = $isAdmin;
            $_SESSION['source'] = "logIn";
            if(isset($_SESSION['guest'])) {
                unset($_SESSION['guest']); //if user logs in while being a guest, unset guest
            }
            header("Location:../profile.php"); //go to profile
        }
        else {
            $errors['login'] = "Invalid Credentials"; //else give error
        }
    }
    else{
        
        $error['dbError'] = "Database Error!"; //database error
        exit();
    }
}
?>

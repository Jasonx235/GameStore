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

  if($_SESSION['edit'] == 'name') {
    $firstname = cleanInput($_POST['firstname']);
    $lastname = cleanInput($_POST['lastname']);
  }

  if($_SESSION['edit'] == 'phone') {
    $phoneNumber = cleanInput($_POST['phoneNumber']);
  }

  if($_SESSION['edit'] == 'address') {
    $street = cleanInput($_POST['street']);
    $city = cleanInput($_POST['city']);
    $state = cleanInput($_POST['state']);
    $zip = cleanInput($_POST['zip']);
  }
  
  if($_SESSION['edit'] == 'password') {
    $password = cleanInput($_POST['password']);
    $passwordCHECK = cleanInput($_POST['passwordCHECK']);
    //all patterns needed
    $patternPass = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/";
    //Minimum eight characters, at least one letter, one number and one special character:
    if($password !== $passwordCHECK){
      $errors['rePass'] = "Password doesn't match!";
    }
    if(!preg_match($patternPass, $password)){
      $errors['password'] = "Password must be minimum eight characters, at least one letter, one number and one special character!"; 
    }
  }

  if($_SESSION['edit'] == 'email') {
    $email = cleanInput($_POST['email']);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $errors['email'] = "Incorrect email format!";
    }
    $queryCheck = "SELECT email FROM users WHERE email=? LIMIT 1";
        
    //Checking if Aleady signed up
    $stmt = $conn->prepare($queryCheck);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($email);
    if($stmt->num_rows>0){
      $errors['signedUP'] = "Email already exits!";
    }
  }

  if(count($errors) > 0) {
    $_SESSION['errors'] = $errors;
    header("Location:../changeInfo.php?change=".$_SESSION['edit']);
    exit();
  }

  else if(count($errors) === 0){

    if($_SESSION['edit'] == 'name') {
      $queryName = "UPDATE users SET FIRST_NAME = ?, LAST_NAME = ? WHERE user_id = ?";
      $stmt2 = $conn->prepare($queryName);
      $stmt2->bind_param('ssi', $firstname, $lastname, $_SESSION['user_id']);
      if($stmt2->execute()) {

        $_SESSION['firstname'] = $firstname; // setting the session variables
        $_SESSION['lastname'] = $lastname;
        
        header("Location:../profile.php");
            
      }
    }

    if($_SESSION['edit'] == 'password') {
      $password = password_hash($password, PASSWORD_DEFAULT);
      $queryPassword = "UPDATE users SET PASSWORD = ? WHERE user_id = ?";
      $stmt2 = $conn->prepare($queryPassword);
      $stmt2->bind_param('si', $password, $_SESSION['user_id']);
      if($stmt2->execute()) {
  
        header("Location:../profile.php");
            
      }
    }

    if($_SESSION['edit'] == 'email') {
      $queryEmail = "UPDATE users SET email = ? WHERE user_id = ?";
      $stmt2 = $conn->prepare($queryEmail);
      $stmt2->bind_param('si', $email, $_SESSION['user_id']);
      if($stmt2->execute()) {
  
        header("Location:../profile.php");
            
      }
    }

    if($_SESSION['edit'] == 'phone') {
      $queryPhone = "UPDATE users SET PHONE_NUM WHERE user_id = ?";
      $stmt2 = $conn->prepare($queryPhone);
      $stmt2->bind_param('si', $phoneNumber, $_SESSION['user_id']);
      if($stmt2->execute()) {
  
        header("Location:../profile.php");
            
      }
    }

    if($_SESSION['edit'] == 'phone') {
      $queryAddress = "UPDATE users SET state = ?, zip = ?, city = ?, street = ? WHERE user_id = ?";
      $stmt2 = $conn->prepare($queryAddress);
      $stmt2->bind_param('ssssi', $state, $zip, $city, $street, $_SESSION['user_id']);
      if($stmt2->execute()) {
  
        header("Location:../profile.php");
            
      }
    }
    unset($_SESSION['edit']);
  }
}

?>
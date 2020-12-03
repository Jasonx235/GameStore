<?php
$errors = []; //empty errors array
session_start(); //start session
if($_SERVER["REQUEST_METHOD"] == "POST"){ //check if reuqest method is POST

  require("config.php"); //make sure config is working properly

  function cleanInput($data){ //sanitize data 
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  }

  if($_SESSION['edit'] == 'name') { //if user wants to edit name
    $firstname = cleanInput($_POST['firstname']);
    $lastname = cleanInput($_POST['lastname']);
  }

  if($_SESSION['edit'] == 'phone') { //if user wants to edit phone number
    $phoneNumber = cleanInput($_POST['phoneNumber']);
  }

  if($_SESSION['edit'] == 'address') { //if user wants to edit address
    $street = cleanInput($_POST['street']);
    $city = cleanInput($_POST['city']);
    $state = cleanInput($_POST['state']);
    $zip = cleanInput($_POST['zip']);
  }
  
  if($_SESSION['edit'] == 'password') { //if user wants to change password
    $password = cleanInput($_POST['password']);
    $passwordCHECK = cleanInput($_POST['passwordCHECK']);
    //all patterns needed
    $patternPass = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/";
    //Minimum eight characters, at least one letter, one number and one special character:
    if($password !== $passwordCHECK){
      $errors['rePass'] = "Password doesn't match!";
    }
    if(!preg_match($patternPass, $password)){ //if password doesnt match the pattern
      $errors['password'] = "Password must be minimum eight characters, at least one letter, one number and one special character!"; 
    }
  }

  if($_SESSION['edit'] == 'email') { //if user wants to change email
    $email = cleanInput($_POST['email']);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ //make sure its correct format
      $errors['email'] = "Incorrect email format!";
    }
    $queryCheck = "SELECT email FROM users WHERE email=? LIMIT 1"; //make sure email doesn't already exists
        
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
  //if there are errors, refresh page
  if(count($errors) > 0) {
    $_SESSION['errors'] = $errors;
    header("Location:../changeInfo.php?change=".$_SESSION['edit']); //return to same page
    exit();
  }

  else if(count($errors) === 0){ //if no errors

    if($_SESSION['edit'] == 'name') { //if user wants to change name
      $queryName = "UPDATE users SET FIRST_NAME = ?, LAST_NAME = ? WHERE user_id = ?"; //update user's name
      $stmt2 = $conn->prepare($queryName); //prepare
      $stmt2->bind_param('ssi', $firstname, $lastname, $_SESSION['user_id']); //bind
      if($stmt2->execute()) { //if execute is successful, set sessions and redirect to profile

        $_SESSION['firstname'] = $firstname; // setting the session variables
        $_SESSION['lastname'] = $lastname;
        
        header("Location:../profile.php");
            
      }
    }

    if($_SESSION['edit'] == 'password') { //if user wants to change password
      $password = password_hash($password, PASSWORD_DEFAULT); //hash the password
      $queryPassword = "UPDATE users SET PASSWORD = ? WHERE user_id = ?"; //update the password
      $stmt2 = $conn->prepare($queryPassword); //prepare
      $stmt2->bind_param('si', $password, $_SESSION['user_id']); //bind
      if($stmt2->execute()) { //if execute is successful, redirect to profile
  
        header("Location:../profile.php");
            
      }
    }

    if($_SESSION['edit'] == 'email') { //if user wants to change email
      $queryEmail = "UPDATE users SET email = ? WHERE user_id = ?"; //update email
      $stmt2 = $conn->prepare($queryEmail); //prepare
      $stmt2->bind_param('si', $email, $_SESSION['user_id']); //bind
      if($stmt2->execute()) { //if execute is successful, redirect 
  
        header("Location:../profile.php");
            
      }
    }

    if($_SESSION['edit'] == 'phone') { //if user wants to change phone number
      $queryPhone = "UPDATE users SET PHONE_NUM WHERE user_id = ?"; //update phone number
      $stmt2 = $conn->prepare($queryPhone); //prepare
      $stmt2->bind_param('si', $phoneNumber, $_SESSION['user_id']); //bind
      if($stmt2->execute()) { //if execute is successful, redirect to profile
  
        header("Location:../profile.php");
            
      }
    }

    if($_SESSION['edit'] == 'address') { //if user wants to change the address
      $queryAddress = "UPDATE users SET state = ?, zip = ?, city = ?, street = ? WHERE user_id = ?"; //update address
      $stmt2 = $conn->prepare($queryAddress); //prepare
      $stmt2->bind_param('ssssi', $state, $zip, $city, $street, $_SESSION['user_id']); //bind
      if($stmt2->execute()) { //if execute is successful, redirect to profile
  
        header("Location:../profile.php");
            
      }
    }
    unset($_SESSION['edit']); //unset edit once user is done editing
  }
}

?>
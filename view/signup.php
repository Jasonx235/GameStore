<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Sessions needs to be added
  
    require("config.php");

    echo "1\n";
    function cleanInput($data){ //sanitize data 
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    echo "2\n";
    $firstname = cleanInput($_POST['firstname']);
    $lastname = cleanInput($_POST['lastname']);
    $phoneNumber = cleanInput($_POST['phoneNumber']);
    $street = cleanInput($_POST['street']);
    $city = cleanInput($_POST['city']);
    $state = cleanInput($_POST['state']);
    $zip = cleanInput($_POST['zip']);
    $email = cleanInput($_POST['email']);
    $password = cleanInput($_POST['password']);
    $passwordCHECK = cleanInput($_POST['passwordCHECK']);
    echo "3\n";
    //all patterns needed
    $patternPass = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/";
    //Minimum eight characters, at least one letter, one number and one special character:
    echo "4\n";
    //UPdate Querey
    $queryCheck = "SELECT email FROM users WHERE email=? LIMIT 1";
    $query = "INSERT INTO users(PASSWORD, FIRST_NAME, LAST_NAME, PHONE_NUM, STREET, CITY, STATE, ZIP, EMAIL) VALUES(?,?,?,?,?,?,?,?,?)";

    $errors = [];
    echo "5\n";
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $errors['email'] = "Incorrect email format!";
      echo "filter_var\n";
      exit();
    }

    elseif($password != $passwordCHECK){
      $errors['rePass'] = "Password doesn't match!";
      echo "password\n";
      exit();
    }

    elseif(!preg_match($patternPass, $password)){
      $errors['password'] = "Password must be minimum eight characters, at least one letter, one number and one special character!";
      echo "pregmatch\n";
      exit();
    }

    else{
      //Checking if Aleady signed up
      $stmt = $conn->prepare($queryCheck);
      $stmt->bind_param('s', $email);
      $stmt->execute();
      $stmt->bind_result($email);
      $stmt->store_result();
      if($stmt->num_rows>0){
        $errors['signedUP'] = "Account already exits!";
        exit();
      }
      else{
      $stmt = $conn->prepare($query); 
      //Order can be changed
      $stmt->bind_param('sssssssss', $password, $firstname, $lastname, $phoneNumber, $street, $city, $state, $zip, $email);
      $stmt->execute();
      $_SESSION['firstname'] = $firstname; // setting the session variables
			$_SESSION['lastname'] = $lastname;
			$_SESSION['email'] = $email;
      $_SESSION['phone'] = $phoneNumber;
      $_SESSION['password'] = $password;
      $_SESSION["street"] = $street;
      $_SESSION["city"] = $city;
      $_SESSION["state"] = $state;
      $_SESSION["zip"] = $zip;
      $_SESSION["errors"] = $errors;
			$_SESSION['source'] = "signUp";


      header("Location:profile.php");
			exit();
    }
  }
}
else{


  header("Location:register.php");
	exit();

}
?>
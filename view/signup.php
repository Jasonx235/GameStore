<?php
    //need to include connect
    //Sessions needs to be added
    //Post submission

    function cleanInput($data){ //sanitize data 
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $firstname = cleanInput($_POST['firsname']);
    $lastname = cleanInput($_POST['lastname']);
    $phoneNumber = cleanInput($_POST['phoneNumber']);
    $address = cleanInput($_POST['address']);
    $email = cleanInput($_POST['email']);
    $password = cleanInput($_POST['password']);
    $passwordCHECK = cleanInput($_POST['passwordCHECK']);

    //all patterns needed
    $patternPass = "^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$";
    //Minimum eight characters, at least one letter, one number and one special character:
    
    //UPdate Querey
    $queryCheck = "SELECT ... FROM ... WHERE ... = ? LIMIT 1";
    $query = "INSERT";

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    //invalid email message
    }
    else if($password != $passwordCHECK){
    //Passwords do not match message
    }
    else if(!preg_match($patternPass, $password)){
    //Password do not have correct format message
    }
    else{
      //Checking if Aleady signed up
      $stmt = $conn->prepare()
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $stmy->bind_result($email);
      $stmt->store_result();
      if($stmt->num_rows>0){
        //Aready Sign UP message
      }
      else{
      $stmt = $conn->prepare($query); 
      //Order can be changed
      $stmt->bind_param("ssssss", $firstname, $lastname, $phoneNumber, $phoneNumber, $address, $email, $password);
      if($stmt->execute()){
        //Sucessful message
      }
      else{
        //Unsuccessful message
      }


      //SESSIONS stuff
    }
    ?>
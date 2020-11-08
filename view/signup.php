<?php

    //Sessions needs to be added

  $errors = [];

    function cleanInput($data){ //sanitize data 
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

	if(isset($_POST['submit'])){
    $firstname = cleanInput($_POST['firsname']);
    $lastname = cleanInput($_POST['lastname']);
    $phoneNumber = cleanInput($_POST['phoneNumber']);
    $address = cleanInput($_POST['address']);
    $email = cleanInput($_POST['email']);
    $password = cleanInput($_POST['password']);

    //all patterns needed
    $patternPass = "^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$^";
    $patternEmail;// needs to be done

    //Tentative to change
    if(empty($firstname)) {
      $errors['firstname'] = "First Name Input Required";
    }
    if(empty($lastname)) {
        $errors['lastname'] = "Last Name Input Required";
      }
    if(empty($phoneNumber)) {
        $errors['phoneNumber'] = "Phone Number Input Required";
    }
    if(empty($address)) {
        $errors['address'] = "Address Input Required";
      }
    if(empty($email)) {
        $errors['email'] = "Email Input Required";
    }
    if(empty($password)) {
        $errors['password'] = "Password Input Required";
    }
    elseif(!preg_match($pattern, $password)){
        $errors['password'] = "Please follow Pasword formatting";
    }
    else
    $bool = true;
    }
    ?>
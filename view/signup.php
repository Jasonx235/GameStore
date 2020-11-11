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
    $patternPass = "^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$";
    //Minimum eight characters, at least one letter, one number and one special character:
    
    $patternUsername = "^[a-zA-Z0-9]([._-](?![._-])|[a-zA-Z0-9]){3,18}[a-zA-Z0-9]$";
    //5 to 20 characers
    //all alphanumeric
    //allow (.), (_), (-), cant be at begining or end, no consecutive

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))&&!preg_match($patternUsername)
   
    ?>
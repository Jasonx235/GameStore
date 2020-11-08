<?php
  $errors = [];
  $bool = false;
	if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $cleanUsername = htmlspecialchars($username);
    $cleanPassword = htmlspecialchars($password);

    $pattern = "^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$^";

    if(empty($cleanUsername)) {
      $errors['username'] = "Username Input Required";
    }

    if(empty($cleanPassword)) {
        $errors['password'] = "Password Input Required";
    }
    elseif(!preg_match($pattern, $cleanPassword)){
        $errors['password'] = "Please follow Pasword formatting";
    }
    else
    $bool = true;
       

    
  
    }
    ?>
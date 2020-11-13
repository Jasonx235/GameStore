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

    $email = cleanInput(_POST['email']);
    $password = cleanInput(_POST['password']);

    //Checking if any results exist
    $loginQuery= "SELECT email, password FROM users WHERE email = ? AND password = ? LIMIT 1";
    $stmt = $conn->prepare($loginQuery);
    $stmt = bind_param('ss', $email, $password);
    $stmt = store_result();
    if($stmt->num_rows >0){ 
        if($stmt->fetch()){
            $checkQuery = "SELECT user_id FROM users WHERE email = '". $email . "'";
            $stmt = $conn->prepare($checkQuery);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $return = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            if($result){
                foreach($result as $r){
                    $_SESSION['id'] = $r['user_id'];
                }
                $_SESSION['email'] = $email;
                $_SESSION['source'] = "login";
                header("Location:profile.php");
                exit();
            }
        }
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

<?php
    include_once "config.php";

    $firstname = "hi";
    $lastname = "hi";
    $phoneNumber = "hi";
    $street = "hi";
    $city = "hi";
    $state = "hi";
    $zip = "hi";
    $email = "hi";
    $password = "hi";

    $query = "INSERT INTO users(PASSWORD, FIRST_NAME, LAST_NAME, PHONE_NUM, STREET, CITY, STATE, ZIP, EMAIL) VALUES(?,?,?,?,?,?,?,?,?)";

    //INSERT INTO `users`(`USER_ID`, `PASSWORD`, `FIRST_NAME`, `LAST_NAME`, `PHONE_NUM`, `STREET`, `CITY`, `STATE`, `ZIP`, `EMAIL`) VALUES ()
    echo "<h1 style='color: white'>".$query."</h1>";
    $stmt = $conn->prepare($query); 
    //Order can be changed
    $stmt->bind_param('sssssssss', $password, $firstname, $lastname, $phoneNumber, $street, $city, $state, $zip, $email);
    if($stmt->execute()) {
        echo "completed";
    } else{
        echo "Error";
    }
?>
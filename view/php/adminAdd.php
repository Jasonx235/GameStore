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

  $name = cleanInput($_POST['name']);
  $price = cleanInput($_POST['price']);

  $queryCheck = "SELECT name FROM products WHERE name=? LIMIT 1"; //query to check if game already exists
        
  //Checking if Aleady signed up
  $stmt = $conn->prepare($queryCheck);
  $stmt->bind_param('s', $name);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($name);
  if($stmt->num_rows>0){
    $errors['exists'] = "Game Aleardy Exists!";
    $_SESSION['errors'] = $errors;
  }

  if(count($errors) === 0){ //if no errors

    $query = "INSERT INTO products(name, price) VALUES(?,?)"; //insert name and price into table
      
    $stmt2 = $conn->prepare($query); //prepare query
        
    $stmt2->bind_param('sd', $name, $price); //bind
        
    if($stmt2->execute()) { //if execute is successful

        $product_id = $conn->insert_id;
        $_SESSION['product_id'] = $product_id;
        //inserts and redirects the admin to add a picture for the game
        header("Location:gamePic.php");
          
    }
    else {
      //if there is a problem with the database, return error
      $errors['db_error'] = "Database error";
      $_SESSION['errors'] = $errors;
    }
  }
}
?>
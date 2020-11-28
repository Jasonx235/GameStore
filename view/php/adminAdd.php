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

  $name = cleanInput($_POST['name']);
  $price = cleanInput($_POST['price']);

  $queryCheck = "SELECT name FROM products WHERE name=? LIMIT 1";
        
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

  if(count($errors) === 0){

    $query = "INSERT INTO products(name, price) VALUES(?,?)";
      
    $stmt2 = $conn->prepare($query); 
        
    $stmt2->bind_param('sd', $name, $price);
        
    if($stmt2->execute()) {

        $product_id = $conn->insert_id;
        $_SESSION['product_id'] = $product_id;

        header("Location:gamePic.php");
          
    }
    else {
      $errors['db_error'] = "Database error";
      $_SESSION['errors'] = $errors;
    }
  }
}
?>
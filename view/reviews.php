<?php
$errors = [];
if($_SERVER["REQUEST_METHOD"] == "POST"){

    function cleanInput($data){ //sanitize data 
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $review = cleanInput($_POST['review']);
    $product_id = $_SESSION['product_id'];
    $queryCheck = "SELECT REVIEW_ID FROM reviews WHERE user_id = ? AND product_id = ? LIMIT 1";
    $stmt = $conn->prepare($queryCheck);
    $stmt->bind_param('ii', $_SESSION['user_id'], $product_id);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows>0){
        $errors['reviewExist'] = "You already reviewed this item!";
        $_SESSION['errors'] = $errors;
    }
    else{
        $query = "INSERT INTO reviews (product_id, review_info, user_id) VALUES (?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isi",$product_id, $review, $_SESSION['user_id']);
        $stmt->execute();
    }
    header("Location:products_page.php?product_id=$product_id");
    exit();
        
}

?>
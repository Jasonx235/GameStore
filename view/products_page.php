<!DOCTYPE html>

<?php
session_start();
require("php/config.php");
include 'php/reviews.php';
if(!isset($_SESSION['source']) && !isset($_SESSION['guest']))
{
    header("Location:index.php");
    exit();
}

if(!isset($_GET['product_id'])) {
    header("Location:games.php");
    exit();
}

$product_id = $_GET['product_id'];
$_SESSION['product_id'] = $product_id;

$query = "SELECT name, price FROM products WHERE product_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
if($result){
    foreach($result as $r){
        $_SESSION['name'] =  $r['name'];
        $_SESSION['price'] = $r['price'];
    }
}

if(isset($_SESSION['guest'])) {

    if(isset($_GET['add_to_cart'])){

        $product_id = htmlspecialchars($_GET['product_id']);

        if(!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        if(!in_array($product_id, $_SESSION['cart'])) {
            $_SESSION['cart'][] = (int)$product_id;
            header("Location:cart.php");
        }
        else {
            $errors['alreadyExist'] = "Item Already in the cart!";

        }
    }

}
else {

    if(isset($_GET['add_to_cart'])){
        $queryCheck = "SELECT product_id FROM shopping_cart WHERE user_id = ? AND product_id = ? LIMIT 1";
            
        //Checking if game is already in cart
        $stmt = $conn->prepare($queryCheck);
        $stmt->bind_param('ii', $_SESSION['user_id'], $product_id);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows>0){
        $errors['alreadyExist'] = "Item Already in the cart!";
        }
        else{
            $query = "INSERT INTO shopping_cart (user_id, product_id, total) VALUES (?,?,?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("iid", $_SESSION['user_id'], $product_id,$_SESSION['price']);
            $stmt->execute();
            header("Location:cart.php");
        }
    }
}

$query = "SELECT REVIEW_INFO FROM reviews WHERE product_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $product_id);
$stmt->execute();
$reviews = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

?>

<html lang="en" class="text-primary">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <script src="https://kit.fontawesome.com/ed9be0132c.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">


        <link
        rel="stylesheet"
        href="stylesheet/navbar.css"
        />
        <link
        rel="stylesheet"
        href="stylesheet/footer.css"
        />
        <link
        rel="stylesheet"
        href="stylesheet/main.css"
        />
        <link
        rel="stylesheet"
        href="stylesheet/products_page.css"
        />
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

        <title>Product</title>
    </head>
        <?php include 'components/navbar.php';?>

        <div class="container">

            <img src="images/placeholder.png" alt="product" class="product">
            <div class="card text-center text-white bg-danger mb-3" style="max-width: 21rem;">
                <div class="card-body">
                    <p class="card-text">Product Name: <?php echo $_SESSION['name']; ?> </p>
                    <p class="card-text">Price: <?php echo "$".$_SESSION['price']; ?> </p>
                </div>
                <div class="card-body text_white">
                    <a href="games.php" style="color: white !important;" class="card-link">Back</a>
                    <a href=<?php echo "products_page.php?add_to_cart=true&product_id=".$product_id; ?> style="color: white !important;" class="card-link">Add to Cart</a>
                </div>
            </div>

            <?php 
                if(count($errors) > 0):
                ?>
                    <?php 
                        foreach($errors as $e => $message):
                    ?>
                        <div class="d-flex justify-content-center">
                            <h5 class="bg-danger"><?php echo $message; ?></h5>
                        </div>
                    <?php
                        endforeach;
                    ?>
                <?php endif; ?>
                
                <?php if(!isset($_SESSION['guest'])) { ?>
                    <h5 id="review">Type a review:</h5>
                    <form id="form" action="products_page.php" method="post">
                            <textarea class="html-text-box" type="text" name="review" required></textarea>
                            <br>
                            <button name="submit" type="submit" id="form-submit">Submit</button>
                    </form>

                    <?php if(isset($_SESSION['errors'])): ?>
                        <div class="d-flex justify-content-center">
                            <h5 class="bg-danger"> <?php echo ''.implode(" " , $_SESSION['errors']); ?></h5>
                            <?php unset($_SESSION['errors']); ?>
                        </div>
                    <?php endif; ?>
                <?php } else { ?>
                    <h3 style="text-align: center;">You must be logged in to review!</h3>
                <?php } ?>

                <?php if(count($reviews) > 0) { ?>
                <h3>Reviews</h3>
                <?php foreach($reviews as $row) { ?>
                    <p class="review text-white bg-danger"> <?php echo $row['REVIEW_INFO']; ?> </p>
                <?php } ?>
                <?php } else { ?>
                <h3 class="text-center">No reviews for this product yet.</h4>
            <?php } ?>
                
        </div>

        <div style="margin-bottom: 75px;"></div>

        <?php include 'components/footer.html';?>

    </body>



</html>
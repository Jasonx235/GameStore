<!DOCTYPE html>

<?php
require("config.php");
if(!isset($_SESSION['source']))
{
    header("Location:index.php");
    exit();
}

if(!isset($_GET['product_id'])) {
    header("Location:games.php");
    exit();
}

$product_id = $_GET['product_id'];

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

    <body>

        <?php include 'components/navbar.php';?>

        <div class="container">

        <img src="images/placeholder.png" alt="Avatar" class="avatar">
            <div class="card text-center text-white bg-danger mb-3" style="max-width: 21rem;">
                <div class="card-body">
                    <p class="card-text">Product Name: <?php echo $_SESSION['name']; ?> </p>
                    <p class="card-text">Price: <?php echo "$".$_SESSION['price']; ?> </p>
                </div>
                <div class="card-body text_white">
                    <a href="games.php" style="color: white !important;" class="card-link">Back</a>
                    <a href="#" style="color: white !important;" class="card-link">Add to Cart</a>
                </div>
            </div>

        </div>

        <?php include 'components/footer.html';?>

    </body>



</html>
<!DOCTYPE html>

<?php
require("php/config.php");
if(!isset($_SESSION['source']) && !isset($_SESSION['guest'])) //Checking if user is logged in or guest
{
    header("Location:index.php");
    exit();
}

// if(!isset($_SESSION'confirm'])) {
//     header("Location:checkout.php");
//     exit();
// }

$query = "DELETE FROM shopping_cart WHERE user_id = ?"; // delete all item for users shopping cart after checkout
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id'] );
$stmt->execute();

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
        href="stylesheet/confirm.css"
        />
        <!-- <link
        rel="stylesheet"
        href="stylesheet/main.css"
        />
        <link
        rel="stylesheet"
        href="stylesheet/cart.css"
        /> -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

        <title>Checkout</title>
    </head>

    <body>

        <?php include 'components/navbar.php';?>

    

        <div style="margin-bottom: 50px;"></div>
        <h2>Thank you for shopping at GamerStore, you will be redirected back to the homepage in 5 seconds. </h2>
        <?php 
        unset($_SESSION['guest']); //unsetting guest
        unset($_SESSION['cart']); //unsetting guest cart
        ?>
        <?php header( "refresh:5;url=index.php" );?>
                    

        <?php include 'components/footer.html';?>

    </body>



</html>
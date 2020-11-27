<!DOCTYPE html>

<?php
require("config.php");
if(!isset($_SESSION['source']) && !isset($_SESSION['guest']))
{
    header("Location:index.php");
    exit();
}

//HERE!!!!!!!!!!!!
if(isset($_SESSION['guest'])) {
    $query = "SELECT name, price FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $_SESSION['cart']);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
else{
    $query = "SELECT products.product_id, products.name, products.price FROM products INNER JOIN shopping_cart ON 
    products.product_id = shopping_cart.product_id WHERE shopping_cart.user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}



if(isset($_GET['delete']) && isset($_GET['product_id'])){


	$query = "DELETE FROM shopping_cart WHERE product_id = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_GET['product_id'] );
	$stmt->execute();
	
	header("Location:cart.php");
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
        href="stylesheet/cart.css"
        />
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

        <title>Cart</title>
    </head>

    <body>

        <?php include 'components/navbar.php';?>

        <div class="container">
            <h3>My Cart</h3>
            <div class="d-flex justify-content-center">
                <a href="games.php" class="buttons pulse"><i class="fas fa-arrow-circle-left"></i> Continue Shopping</a>
                <a href="checkout.php" class="buttons pulse">Checkout <i class="fas fa-arrow-circle-right"></i> </a>
            </div>
            <?php if(count($result) > 0) { ?>
                <div class="row">
                    <?php
                    foreach($result as $row) {
                    ?>
                        <div class="card bg-danger text-white col-sm-4 col-md-5">
                            <img class="card-img-top" src="images/placeholder.png" alt="placeholder">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                <p class="card-text"> <?php echo $row['price']; ?></p>
                            </div>
                            <div class="card-footer">
                                <a class ="a" href=<?php echo "cart.php?delete=true&product_id=".$row['product_id']; ?>>Remove</a>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            <?php } else { ?>
                <h4> No Items in the cart.</h4>
            <?php } ?>
        </div>

        <div style="margin-bottom: 120px;"></div>

        <?php include 'components/footer.html';?>

    </body>



</html>
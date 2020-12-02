<!DOCTYPE html>

<?php
require("php/config.php");
if(!isset($_SESSION['source']) && !isset($_SESSION['guest']))
{
    header("Location:index.php");
    exit();
}
$rowDisplay = 6;

if(isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = htmlspecialchars($_GET['page']);
} else {
    $current_page = 1;
}

$offset = ($current_page-1) * $rowDisplay;

$count_query = "SELECT product_id FROM products";
$stmt = $conn->prepare($count_query);
$stmt->execute();
$stmt->store_result();
$results = $stmt->num_rows;

if($results > $rowDisplay) {
    $total_pages = ceil($results / $rowDisplay);
}
else {
    $total_pages = 1;
}

$query = "SELECT pictures.picture_path, products.product_id, products.name, products.price FROM products INNER JOIN pictures WHERE pictures.product_id = products.product_id LIMIT ?, ?";

$nextQuery = "SELECT product_id, name, price FROM products LIMIT ?, ?";

$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $offset, $rowDisplay);
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);


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
        href="stylesheet/products.css"
        />
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

        <title>Store</title>
    </head>

    <body>

        <?php include 'components/navbar.php';?>

        <?php if(isset($_SESSION['isAdmin'])) {

        if($_SESSION['isAdmin'] == true) {
            ?>
            <div class="float-right">
                <a href="addgame.php" class="buttons pulse"> Add Game</a>
            </div>
        <?php   }
        } ?>

        <div class="container">

            <h3>Games and Consoles</h3>
            <div class="row">
                <?php if(count($result) > 0) { ?>
                   <?php foreach($result as $row) { ?>
                    <a href=<?php echo "products_page.php?product_id=".$row['product_id']; ?>>
                        <div class="col-sm-5 col-md-6">
                            <div class="card bg-dark text_white" style="width: 18rem;">
                                <img src=<?php echo $row['picture_path'] ?> class="card-img-top" alt="placeholder">
                                <div class="card-body">
                                <p class="card-text">Product: <?php echo $row['name']; ?> </p>
                                <p class="card-text">Price: <?php echo "$".$row['price']; ?> </p>
                                </div>
                            </div>
                        </div>
                    </a>
                   <?php } ?>
                <?php } ?>
            </div>
            <div class="d-flex justify-content-center">
            <?php if($current_page > 1) { ?>
                    <a href=<?php echo "games.php?page=".($current_page-1); ?> class="buttons pulse">Previous</a>
            <?php }

            if($current_page < $total_pages) { ?>
                    <a href=<?php echo "games.php?page=".($current_page+1); ?> class="buttons pulse">Next</a>
            <?php } ?>
                </div>
        </div>

        <div style="margin-bottom: 120px;"></div>

        <?php include 'components/footer.html';?>

    </body>



</html>
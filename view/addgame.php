<!DOCTYPE html>
<?php

include 'php/adminAdd.php';
$errors = [];
if(!isset($_SESSION['source']) && !isset($_SESSION['guest'])) //checking if login or logined with guest privelge
{
    header("Location:index.php");
    exit();
}
if(isset($_SESSION['guest'])) { //Guest check 
    header("Location:games.php");
    exit();
}

if(isset($_SESSION['isAdmin'])) { //Admin check
    if($_SESSION['isAdmin'] == false) {
        header("Location:games.php");
        exit();
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
        href="stylesheet/profile.css"
        />
        <link
        rel="stylesheet"
        href="stylesheet/addgame.css"
        />
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

        <title>Add New game</title>
    </head>

    <body>

        <?php include 'components/navbar.php';?> <!--Add game into database if you are admin -->

        <div class="container"> 
        <h3>Add New Game</h3>
        <form id="form" action="addgame.php" method="post">   
        <fieldset>
                <input name ="name" placeholder="Game Name" type="text" tabindex="2" required>
            </fieldset>
            <fieldset>
                <input name ="price" placeholder="Price" type="number" step="any" tabindex="2" required>
            </fieldset>
            <fieldset>
                <button name="submit" type="submit" id="form-submit">Add</button>
            </fieldset>

                <?php if(isset($_SESSION['errors'])): ?> <!-- Displaying errors-->
                    <div class="d-flex justify-content-center">
                        <h5 class="bg-danger text-white"> <?php echo ''.implode(" " , $_SESSION['errors']); ?></h5>
                        <?php unset($_SESSION['errors']); ?>
                    </div>
                <?php endif; ?>
            
            <h6><a href="games.php">Back<a></h6> <!-- Back Button -->
        </form>
        </div>

        <div style="margin-bottom: 120px;"></div>

        <?php include 'components/footer.html';?>
    </body>



</html>
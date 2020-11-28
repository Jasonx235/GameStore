<!DOCTYPE html>
<?php
include 'php/changeInfoLogic.php';
if(!isset($_SESSION['source']))
{
    header("Location:index.php");
    exit();
}

if(isset($_SESSION['guest'])) {
    header("Location:games.php");
    exit();
}

if(!isset($_GET['change']))
{
    header("Location:profile.php");
    exit();
}

?>
<html lang="en" class="text-primary">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <script src="https://kit.fontawesome.com/ed9be0132c.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

        <link 
        rel = "stylesheet"
        href="stylesheet/login_reg.css"
        />

        <title>Edit Information</title>

    </head>

    <body>
        <div class="container">
        <form id="form" action="changeInfo.php" method="POST">
            <h3>Edit Information</h3>

            <?php if($_GET['change'] == "name"): ?>
                <fieldset>
                    <input name="firstname" placeholder="First Name" type="text" tabindex="1" autofocus required>
                </fieldset>
                <fieldset>
                    <input name="lastname" placeholder="Last Name" type="text" tabindex="2" autofocus required>
                </fieldset>
                <?php $_SESSION['edit'] = "name"; ?>
            <?php endif ?>
            <?php if($_GET['change'] == "email"): ?>
                <fieldset>
                    <input name="email" placeholder="Your Email Address" type="email" tabindex="3" required>
                </fieldset>
                <?php $_SESSION['edit'] = "email"; ?>
            <?php endif ?>
            <?php if($_GET['change'] == "phone"): ?>
                <fieldset>
                    <input name="phoneNumber" placeholder="Your Phone Number" type="tel" tabindex="4" required>
                </fieldset>
                <?php $_SESSION['edit'] = "phone"; ?>
            <?php endif ?>
            <?php if($_GET['change'] == "password"): ?>
                <fieldset>
                    <input name="password" placeholder="Password" type="password" tabindex="5" required>
                </fieldset>
                <small class="form-text text-muted">Minimum eight characters, at least one letter, one number and one special character</small>
                <fieldset>
                    <input name="passwordCHECK" placeholder="Retype password" type="password" tabindex="6" required>
                </fieldset>
                <?php $_SESSION['edit'] = "password"; ?>
            <?php endif ?>
            <?php if($_GET['change'] == "address"): ?>
                <fieldset>
                    <input name="street" placeholder="Street" type="text" tabindex="7" required>
                </fieldset>
                <fieldset>
                    <input  name="city" placeholder="City" type="text" tabindex="8" required>
                </fieldset>
                <fieldset>
                    <input name="state" placeholder="State" type="text" tabindex="9" required>
                </fieldset>
                <fieldset>
                    <input name="zip" placeholder="ZIP Code" type="text" tabindex="10" required>
                </fieldset>
                <?php $_SESSION['edit'] = "address"; ?>
            <?php endif ?>
            <fieldset>
                <button name="submit" type="submit" id="form-submit" >Submit</button>
            </fieldset>

            <?php 

			if(isset($_SESSION['errors'])):
		    ?>
			  <div class="alert alert-danger"> <?php echo ''.implode(" " , $_SESSION['errors']); ?></div>
                <?php unset($_SESSION['errors']); ?>
            <?php endif; ?>

            <h6><a href="profile.php">Back<a></h6>
        </form>
        </div>

        <div style="margin-bottom: 120px;"></div>

        <?php include 'components/footer.html';?>

    </body>

</html>
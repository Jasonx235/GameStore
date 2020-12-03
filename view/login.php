<!DOCTYPE html>

<?php
include 'php/signin.php';

if(isset($_SESSION['source'])) //Checking if user if logged in
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
        rel="stylesheet"
        href="stylesheet/login_reg.css"
        />

        <title>Login</title>

    </head>

    <body> <!-- Input information to login -->
        <div class="container">
        <form id="form" action="login.php" method="post">
            <h3>Login</h3>
            <fieldset>
                <input name ="email" placeholder="Your Email Address" type="email" tabindex="2" required>
            </fieldset>
            <fieldset>
                <input name ="password" placeholder="Password" type="password" tabindex="2" required>
            </fieldset>
            <fieldset>
                <button name="submit" type="submit" id="form-submit">Login</button>
            </fieldset>
                   <?php 

			if(count($errors) > 0): //Displaying errors to user
		    ?>
				<?php 
					foreach($errors as $e => $message): //looping through each messsage
				?>
					<div class="alert alert-danger"> <?php echo $message; ?> </div>
				<?php
					endforeach;
				?>
            <?php endif; ?>
            
            <h6><a href="index.php">Back<a></h6>
        </form>
        </div>

        <div style="margin-bottom: 120px;"></div>

        <?php include 'components/footer.html';?>

    </body>

</html>
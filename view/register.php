<!DOCTYPE html>
<?php

include 'php/signup.php'; //include signup/register logic

if(isset($_SESSION['source'])) //if user is already logged in, go back to profile
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

        <title>Sign Up</title>

    </head>

    <body>
        <div class="container">
        <!-- Form -->
        <form id="form" action="register.php" method="post">
            <h3>Sign Up</h3>
            <!-- Personal Info -->
            <h4>Personal Information:</h4>
            <fieldset>
                <!-- Input first name -->
                <input name="firstname" placeholder="First Name" type="text" tabindex="1" required autofocus>
            </fieldset>
            <fieldset>
                <!-- Input last name -->
                <input name="lastname" placeholder="Last Name" type="text" tabindex="2" required autofocus>
            </fieldset>
            <fieldset>
                <!-- Input email -->
                <input name="email" placeholder="Your Email Address" type="email" tabindex="3" required>
            </fieldset>
            <fieldset>
                <!-- Input phone number -->
                <small class="form-text text-muted">xxx.xxx.xxxx or xxx-xxx-xxxx</small>
                <input name="phoneNumber" placeholder="Your Phone Number" type="tel" tabindex="4" required>
            </fieldset>
            <fieldset>
                <!-- Input password -->
                <input name="password" placeholder="Password" type="password" tabindex="5" required>
                <small class="form-text text-muted">Minimum eight characters, at least one letter, one number and one special character</small>
            </fieldset>
            
            <fieldset>
                <!-- Re-input password -->
                <input name="passwordCHECK" placeholder="Retype password" type="password" tabindex="6" required>
            </fieldset>
            <!-- Address -->
            <h4>Shipping Address:</h4>
            <fieldset>
                <!-- Input street -->
                <input name="street" placeholder="Street" type="text" tabindex="7" required>
            </fieldset>
            <fieldset>
                <!-- Input city -->
                <input  name="city" placeholder="City" type="text" tabindex="8" required>
            </fieldset>
            <fieldset>
                <!-- Input state -->
                <input name="state" placeholder="State" type="text" tabindex="9" required>
            </fieldset>
            <fieldset>
                <!-- Input zip -->
                <input name="zip" placeholder="ZIP Code" type="text" tabindex="10" required>
            </fieldset>
            <fieldset>
                <!-- Submit -->
                <button name="submit" type="submit" id="form-submit" >Sign Up</button>
            </fieldset>

            <?php 

			if(count($errors) > 0): //if there are errors, print the errors
		    ?>
				<?php 
					foreach($errors as $e => $message):
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
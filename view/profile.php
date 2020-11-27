<!DOCTYPE html>

<?php
require("config.php");
if(!isset($_SESSION['source']))
{
    header("Location:index.php");
    exit();
}

if(isset($_SESSION['guest'])) {
    header("Location:games.php");
    exit();
}


$query = "SELECT first_name, last_name, email, phone_num, street, city, state, zip FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
if($result){
    foreach($result as $r){
        $_SESSION['firstname'] =  $r['first_name'];
        $_SESSION['lastname'] = $r['last_name'];
        $_SESSION['email'] = $r['email'];
        $_SESSION['phoneNumber'] = $r['phone_num'];
        $_SESSION['street'] =  $r['street'];
        $_SESSION['city'] =  $r['city'];
        $_SESSION['state'] =  $r['state'];
        $_SESSION['zip'] =  $r['zip'];
    }
}

$pic = "SELECT picture_path FROM pictures WHERE user_id = ?";
$stmt = $conn->prepare($pic);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
if($result){
    foreach($result as $r){
        $picPath = $r["picture_path"];
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
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

        <title>Profile</title>
    </head>

    <body>

        <?php include 'components/navbar.php';?>

        <div class="container">
            <h3>Profile</h3>
            <img src=<?php echo $picPath ?> alt="Avatar" class="avatar">
            <div class="card text-center text-white bg-danger mb-3" style="max-width: 21rem;">
                <div class="card-header">Personal Information</div>
                <div class="card-body">
                    <p class="card-text">First Name: <?php echo $_SESSION['firstname']; ?> </p>
                    <p class="card-text">Last Name: <?php echo $_SESSION['lastname']; ?> </p>
                    <p class="card-text">Email: <?php echo $_SESSION['email']; ?> </p>
                    <p class="card-text">Phone Number: <?php echo $_SESSION['phoneNumber']; ?> </p>
                    <p class="card-text">Address: <?php echo $_SESSION['street'].", ".$_SESSION['city'].", ".$_SESSION['state'].", ".$_SESSION['zip'] ; ?> </p>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <a class="profilepic" href="profilePic.php">Change Profile Picture</a>
                <div class="dropdown">
                    <button class="dropbtn">Change Info</button>
                    <div class="dropdown-content">
                        <a href="changeInfo.php?change=name">Name</a>
                        <a href="changeInfo.php?change=password">Password</a>
                        <a href="changeInfo.php?change=email">Email</a>
                        <a href="changeInfo.php?change=address">Address</a>
                        <a href="changeInfo.php?change=phone">Phone Number</a>
                    </div>
                </div>
            </div>

        </div>

        <div style="margin-bottom: 120px;"></div>

        <?php include 'components/footer.html';?>

    </body>



</html>
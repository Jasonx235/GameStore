<!DOCTYPE html>
<?php
session_start();
require("config.php");
$errors = [];
if(!isset($_SESSION['source']))
{
    header("Location:index.php");
    exit();
}
if(isset($_SESSION['guest'])) {
    header("Location:games.php");
    exit();
}

if(isset($_FILES["photo"]["type"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK){

    $save_dir = "images/";
    $target = $save_dir.basename($_FILES["photo"]['name']);
    
    $fileType = pathinfo($target,PATHINFO_EXTENSION);
    $allowedFormat = array("jpg", "JPG", "png", "gif");

    // var_dump($_FILES);
    // exit();

    if(!in_array($fileType, $allowedFormat)){
        $errors['format'] = "Format Not Allowed!";
    }
    else if(!move_uploaded_file($_FILES["photo"]["tmp_name"], $target)) {
        $errors['problem'] = "Problem Uploading!";
    }
    else{
        switch($_FILES["photo"]["error"]){
            case UPLOAD_ERR_INI_SIZE:
                $errors['large1'] = "File is too large!";
            break;
            case UPLOAD_ERR_FORM_SIZE:
                $errors['large2'] = "File is too large!";
            break;
            case UPLOAD_ERR_NO_FILE:
                $errors['nofile'] = "No file was uploaded!";
            break;
        }
    }
    if(count($errors) === 0) {
        $query = "SELECT picture_path FROM pictures WHERE user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $_SESSION['user_id']);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows>0){
            $query = "UPDATE pictures SET picture_path= ? WHERE user_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('si', $target, $_SESSION['user_id']);
            if($stmt->execute()){
                header("Location:profile.php");
            }
        }
        else{
            $query = "INSERT INTO pictures (picture_path, user_id) VALUES (?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('si', $target, $_SESSION['user_id']);
            if($stmt->execute()){
                header("Location:profile.php");
            }
        }
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

        <title>Profile Picture</title>
    </head>

    <body>

        <?php include 'components/navbar.php';?>

        <div class="container">

            <h3>Upload Profile Picture</h3>
            <form action="profilePic.php" method="post" enctype="multipart/form-data">
                <div class="form d-flex justify-content-center">
                    <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
                    <label for="photo">Upload a Photo</label>
                    <input type="file" name="photo" id="photo" value="" />
                </div>
                <br>
                <div class="form d-flex justify-content-center">
                    <input type="submit" name="uploadPic" value="upload picture" />
                </div>
            </form>
            
            <?php if(count($errors) > 0):
                ?>
                    <div class="d-flex justify-content-center">
                        <h5 class="bg-danger"><?php echo ''.implode(" " , $errors); ?></h5>
                    </div>
                <?php endif; ?>

        </div>

        <div style="margin-bottom: 120px;"></div>

        <?php include 'components/footer.html';?>

    </body>



</html>
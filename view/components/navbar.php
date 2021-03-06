<!-- Navigation Bar -- Sticky -->
<nav class="navbar sticky-top navbar-dark navbar-expand-lg">
    <a class="navbar-brand" href="games.php"><i class="fas fa-gamepad"></i> GameStore</a>
    <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon "></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ml-auto">
      <?php 
        //check if user is not logged in or is a guest
        if(!isset($_SESSION['source']) && !isset($_SESSION['guest'])) {
      ?>
        <a class="nav-item nav-link active" href="login.php"> Login <span class="sr-only">(current)</span></a>
        <a class="nav-item nav-link" href="register.php"> Sign Up</a>

        <?php 
       }
        //if user is not a guest, display cart, profile, store, logout, home
        else if(!isset($_SESSION['guest'])) {
      ?>

        <a <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') { echo 'class="nav-item nav-link active"'; } else { echo 'class="nav-item nav-link"'; } ?> href="index.php"><i class="fas fa-home"></i> Home <span class="sr-only">(current)</span></a>
        <a <?php if (basename($_SERVER['PHP_SELF']) == 'profile.php') { echo 'class="nav-item nav-link active"'; } else { echo 'class="nav-item nav-link"'; } ?> href="profile.php"><i class="fas fa-user-alt"></i> Profile</a>
        <a <?php if (basename($_SERVER['PHP_SELF']) == 'cart.php') { echo 'class="nav-item nav-link active"'; } else { echo 'class="nav-item nav-link"'; }  ?> href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a>
        <a <?php if (basename($_SERVER['PHP_SELF']) == 'games.php') { echo 'class="nav-item nav-link active"'; } else { echo 'class="nav-item nav-link"'; }  ?> href="games.php"><i class="fas fa-store"></i> Store</a>
        <a class="nav-item nav-link" href="php/logout.php"><i class="fas fa-sign-out-alt"></i> Sign Out</a>

        <?php }  
          //if user is a guest, only display cart, store and home
          else{ ?>
            <a <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') { echo 'class="nav-item nav-link active"'; } else { echo 'class="nav-item nav-link"'; } ?> href="index.php"><i class="fas fa-home"></i> Home <span class="sr-only">(current)</span></a>
            <a <?php if (basename($_SERVER['PHP_SELF']) == 'cart.php') { echo 'class="nav-item nav-link active"'; } else { echo 'class="nav-item nav-link"'; }  ?> href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a>
            <a <?php if (basename($_SERVER['PHP_SELF']) == 'games.php') { echo 'class="nav-item nav-link active"'; } else { echo 'class="nav-item nav-link"'; }  ?> href="games.php"><i class="fas fa-store"></i> Store</a>
            <?php } ?>

      </div>
    </div>
</nav>
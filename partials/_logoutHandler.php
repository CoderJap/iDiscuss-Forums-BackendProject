<?php 
    session_start();
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    //   echo '<div class="alert my-0 alert-success alert-dismissible fade show" role="alert">
    //   <strong>Success!</strong> You have loggedIn successfully!
    //   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    // </div>';
    echo'<div class="alert  my-0 alert-dark" role="alert">
    Welcome-&nbsp;'.$_SESSION['useremail']. '<button class="btn mx-3 btn-outline-success" type="submit"><a href="/forum/logout.php">Logout</a></button>
  </div>';
    }
    ?>
<!doctype html>
<html lang="en">

<head>
  
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>iDiscuss-ThreadList</title>


<body>
  <?php  include 'partials/_dbconnect.php'; ?>
    <?php  include 'partials/_header.php'; ?>
    <?php  include 'partials/_logoutHandler.php';?>
    <div class="container">
    <?php
    $id=$_GET['catid'];
    $sql="SELECT * FROM `categories` WHERE category_id=$id";
    $result = mysqli_query($con,$sql);
    while($row=mysqli_fetch_assoc($result)){
        $catname=$row['category_name'];
        $catdesc=$row['category_desc'];

       echo ' <div class="alert alert-success" role="alert">
  <h4 class="alert-heading">'.$catname.' Forums </h4>
  <p>'.$catdesc.'</p>
  <hr>
  <p class="mb-0">Guidelines. Warn About Adult Content. Do not spam. Do Not Bump Posts. Do Not Offer to Pay for Help. Do Not Offer to Work For Hire. Do Not Post About Commercial Products. Do Not Create Multiple Accounts (Sockpuppets) When creating links to other resources.</p>
  <a href="#" class="btn btn-success my-3">Learn More </a>
</div>';
    }
    ?>

    <h2 class="text-center"> Start Discussions</h2>
    <?php
     if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
       echo '<form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Problem Title</label>
            <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Write your concern in a very short and crisp manner.</div>
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Elaborate your concern</label>
            <input type="text" class="form-control" name="desc" id="desc">
        </div>
        <button type="submit" class="btn btn-success">Submit Thread </button>
    </form>';
     }
     else{
      echo ' <div class="container">
      <p class="lead text-center">You are not logged in. Pls login to be able to start a discussion.</p>
      </div>';
     }

    ?>
    <?php
    $showAlert=false;
    $method=$_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
      $th_title=$_POST['title'];
      $th_desc=$_POST['desc'];

    // insertion query of thread into db 
    $sql="INSERT INTO `threads` ( `thread_title`, `thread_desc`, `cat_id`, `user_id`, `timestamp`) VALUES ( '$th_title', '$th_desc', '$id', '0', current_timestamp())";
    $result=mysqli_query($con,$sql);
    $showAlert=true;
    
    if($showAlert){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Your thread has been added wait for the community to respond.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
  }
    ?>
    <h2 class="text-center"> Browse Questions </h2>
    <?php
    $noThread=true;
    $id=$_GET['catid'];
    $sql="SELECT * FROM `threads` WHERE cat_id=$id";
    $result = mysqli_query($con,$sql);
    while($row=mysqli_fetch_assoc($result)){
      $noThread=false;
        $thread_id=$row['thread_id'];
        $title=$row['thread_title'];
        $desc=$row['thread_desc'];
        $thread_time=$row['timestamp'];
        echo '
    <div class="media">
  <img src="img/user.webp"width=54px class="mr-3" alt="...">
  <div class="media-body">
  <p class="font-weight-bold my-0 mt-2 ">Anonymus User at '.$thread_time.'</p>
    <h5 class="mt-0 my-0"><a href="thread.php?threadid='.$thread_id.'" style="text-decoration: none;" class="text-dark">'.$title.'</a></h5>
    <p class="my-0 ">'.$desc.'</p>
  </div>
</div>';
    }
    if($noThread){
      echo'<div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">No Threads found </h1>
        <p class="lead"> Be the first one to start a thread over here. </p>        
      </div>';
    }
    ?>
    </div>
    
    <!-- <div class="media">
  <img src="img/user.webp"width=65px height=65px class="mr-3" alt="...">
  <div class="media-body">
    <h5 class="mt-0">Media heading</h5>
    <p>Will you do the same for me? It's time to face the music I'm no longer your muse. Heard it's beautiful, be the judge and my girls gonna take a vote. I can feel a phoenix inside of me. Heaven is jealous of our love, angels are crying from up above. Yeah, you take me to utopia.</p>
  </div>
</div> -->
    
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>
</html>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>iDiscuss-Thread</title>
    
  </head>
  <body>
    
    <?php  include 'partials/_dbconnect.php'; ?>
    <?php  include 'partials/_header.php'; ?>
    <?php  include 'partials/_logoutHandler.php';?>
    <div class="container">
    <?php
    $id=$_GET['threadid'];
    $sql="SELECT * FROM `threads` WHERE thread_id=$id";
    $result = mysqli_query($con,$sql);
    while($row=mysqli_fetch_assoc($result)){
        $title=$row['thread_title'];
        $desc=$row['thread_desc'];

       echo ' <div class="alert alert-success" role="alert">
  <h4 class="alert-heading">'.$title.' </h4>
  <p>'.$desc.'</p>
  <hr>
  <p> <b>Posted by: Harry </b></p>
</div>';
    } 
    ?>
    
     
    <h2 class="text-center"> Post Comments</h2>
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
      echo '<form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
      <div class="mb-3">
      <label for="content" class="form-label">Write your comment.</label>
      <input type="text" class="form-control" id="content" name="content" aria-describedby="emailHelp">
  </div>
  <button type="submit" class="btn btn-success">Post Comment</button>
   </form>';
    }
    else{
     echo ' <div class="container">
     <p class="lead text-center">You are not logged in. Pls login to be able to post a comment.</p>
     </div>';
    }

   ?>
   <?php
    $showAlert=false;
    $method=$_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
      $com_content=$_POST['content'];

    // insertion query of comment into db 
    $sql="INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ( '$com_content', '$id', '0', current_timestamp())";
    $result=mysqli_query($con,$sql);
    $showAlert=true;
    if($showAlert){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Your comment has been added. 
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
  }
    ?>
    <h2 class="text-center"> Discussions </h2>

    <?php
    $noComment=True;
    $id=$_GET['threadid'];
    $sql="SELECT * FROM `comments` WHERE thread_id=$id";
    $result = mysqli_query($con,$sql);
    while($row=mysqli_fetch_assoc($result)){
        $noComment=false;
        $com_id=$row['comment_id'];
        $content=$row['comment_content'];
        $comment_time=$row['comment_time'];
        echo '
    <div class="media">
  <img src="img/user.webp"width=54px class="mr-3" alt="...">
  <div class="media-body">
  <p class="font-weight-bold my-0 ">Anonymus User at '.$comment_time.'</p>
    <p>'.$content.'</p>
  </div>
</div>';
    }
    if($noComment){
      echo'<div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">No Comments found </h1>        
      </div>';
    }
    ?>
    </div>

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









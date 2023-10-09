<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome To iDiscuss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
      <?php
    include 'partials/_header.php';
    ?> 
    <?php
   if(isset($_GET['signupsuccess'])){
    echo '<div class="alert my-0 alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your account has been signed up successfully!You can login now
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
   } 
    ?>
    
    <?php  include'partials/_logoutHandler.php';?>
     <div id="carouselExample" class="carousel slide">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://source.unsplash.com/random/2700×600/?coding,tech" style="height: 600px;" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://source.unsplash.com/random/2700×600/?programming,code" style="height: 600px;" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://source.unsplash.com/random/2700×600/?apple,coding" style="height: 600px;" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
    <div class="container">
    <h1 class="text-center">iDiscuss - Browse Categories </h1>
    <div class="row">
    <?php
    $servername="localhost";
    $username="root";
    $password="";
    $database="idiscuss";
    $con = mysqli_connect($servername, $username, $password, $database);

    $sql="SELECT * FROM `categories`";
    $result=mysqli_query($con,$sql);
    while($row=mysqli_fetch_assoc($result)){
        $id=$row['category_id'];
        $cat=$row['category_name'];
        $desc=$row['category_desc'];
        echo '
        <div class="col-md-4 ">
            <div class="card" style="width: 18rem;">
                <img src="https://source.unsplash.com/random/300×300/?'.$cat.',coding" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><a href="threadlist.php?catid='.$id.'">'.$cat.'</a></h5>
                    <p class="card-text">'.substr($desc,0,90).'...</p>
                    <a href="threadlist.php?catid='.$id.'" class="btn btn-primary">View Threads</a>
                </div>
            </div>
        </div>';
        
    }
    ?>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>
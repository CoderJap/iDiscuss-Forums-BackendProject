<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>iDiscuss-Login</title>
  </head>
  <body>
    <?php  include'partials/_header.php';?>
    <?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include 'partials/_dbconnect.php';
        $log_email=$_POST['loginemail'];
        $log_pass=$_POST['loginpass'];

        $sql="SELECT * FROM `users`where user_email='$log_email'";
        $result=mysqli_query($con,$sql);
        $numRows=mysqli_num_rows($result);
        if($numRows==1){
            $row=mysqli_fetch_assoc($result);
            if(password_verify($log_pass,$row['user_pass'])){
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['useremail']=$log_email;
                // echo"logged in success";
                header("location:/forum/");
                exit();
            }
            else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Failed!</strong> login failed,incorrect password 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';

            }
        }
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed!</strong> login failed,incorrect email address
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';



        }
    ?>
    <h1 class="text-center">Login To your account</h1>
    <div class="container">
    <form action="/forum/login.php"method="POST">
  <div class="form-group">
    <label for="loginemail">Enter your Email address</label>
    <input type="email" class="form-control" id="loginemail"  name="loginemail" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="loginpass">Enter your Password</label>
    <input type="password" class="form-control" id="loginpass" name="loginpass">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
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
    -->
  </body>
</html>
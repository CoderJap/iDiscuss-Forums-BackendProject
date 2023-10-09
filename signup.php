<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>iDiscuss-Signup</title>
  </head>
  <body>
    <?php 
    include'partials/_header.php';
    $showError="false";
    $exist="false";
    $showAlert=false;
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include'partials/_dbconnect.php';
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        $cpass=$_POST['cpass'];
        // $exist=false;
        $sqlExist="SELECT * FROM `users` WHERE user_email='$email'";
        $result=mysqli_query($con,$sqlExist);
        $num=mysqli_num_rows($result);
        if($num>0){
            $exist="This email is already in use";
            echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Failed!</strong> '.$exist.'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';

        }
        else{
            if($pass==$cpass){
                $hash=password_hash($pass,PASSWORD_DEFAULT);
                $sql="INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`) VALUES ( '$email', '$hash', current_timestamp())";
                $result=mysqli_query($con,$sql);
                if($result){
                    $showAlert=true;
                    header("location:/forum/index.php?signupsuccess=true");
                }

            }
            else{
                $showError="Passwords doesnt match";
                echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Failed!</strong> '.$showError.'
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';

            }
        }


    }
    
    ?>
    <h1 class="text-center">Signup to iDiscuss</h1>
    <div class="container">
    <form action="/forum/signup.php"method="POST" >
  <div class="form-group">
    <label for="email">Enter your Email address</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" >
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="pass">Enter your password</label>
    <input type="password" class="form-control"  name="pass" id="pass"  >
  </div>
  <div class="form-group">
    <label for="cpass">Confirm your password</label>
    <input type="password" class="form-control" id="cpass" name="cpass" >
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
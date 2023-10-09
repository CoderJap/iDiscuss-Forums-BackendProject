<?php
  include '_dbconnect.php';

 echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">
 <div class="container-fluid">
   <a class="navbar-brand" href="/forum/">iDiscuss</a>
   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul class="navbar-nav me-auto mb-2 mb-lg-0">
       <li class="nav-item">
         <a class="nav-link active" aria-current="page" href="/forum">Home</a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="about.php">About</a>
       </li>
       <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           Categories
         </a>
         <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
         $sql="SELECT category_id,category_name FROM `categories`";
         $result=mysqli_query($con,$sql);
         while($row=mysqli_fetch_assoc($result)){
          $catname=$row['category_name'];
          $catid=$row['category_id'];
          echo '<li><a class="dropdown-item" href="threadlist.php?catid='.$catid.'">'.$catname.'</a></li>';
         }
         echo '
         </ul>
       </li>
       <li class="nav-item">
       <a class="nav-link" href="contact.php">Contact</a>
     </li>
     </ul>
     <form class="d-flex" action="search.php" method="get">
       <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
       <button class="btn btn-outline-success" type="submit">Search</button>
     </form>
       <button class="btn btn-outline-success" type="submit"><a href="login.php">Login</a></button>
       <button class="btn btn-outline-success" type="submit"><a href="signup.php">Signup</a></button>
   </div>
 </div>
</nav>';
?>
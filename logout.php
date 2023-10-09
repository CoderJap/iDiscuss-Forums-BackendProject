<?php
session_start();

session_unset();
header("location:logoutpage.php");
session_destroy();
exit();
?>
<?php
session_start();
session_unset();
session_destroy();
SetCookie("login", ""); //удаляются cookie с логином    
SetCookie("password", ""); //удаляются cookie с паролем 
header ("Location: /homepage.php");
?>
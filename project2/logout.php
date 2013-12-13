<!DOCTYPE>
<html>
    <head>
        <!--
Name: Sam Welch
Date:December 11th ,2013
Purpose: This page(logout.php) allows users to log out of the site . 
-->
        <title>Logout</title>
<?php
$past = time() - 100; 
 //this removes the cookie 
 setcookie('ID',gone,$past); 
 setcookie('pass',gone,$past); 
 header("Location: index.php"); 
?>
    </head>
    <body>
    </body>
</html>

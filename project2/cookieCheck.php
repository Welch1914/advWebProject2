
<?php
//Name: Sam Welch
//Date: December 11th,2013 
//Purpose: This is used to validate a users cookies, to confirm that they are logged in.
require_once('connectvars.php');
$dbc= mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
//if cookies are set, you can continue on, and cookies are reset. If not, you are sent to the index page.
if(isset($_COOKIE['ID']) && isset($_COOKIE['pass']))
 {    
    //cookies are reset
     $username = $_COOKIE['ID'];
     $password = $_COOKIE['pass'];
     //username and password are checked against the database.
     $query1 = "SELECT username FROM user_info_blog WHERE username = '$username' AND password=('$password');";
     $query2 = "SELECT password FROM user_info_blog WHERE username = '$username' AND password=('$password');";
     $runquery1 = mysqli_query($dbc, $query1);
     $runquery2 = mysqli_query($dbc, $query2);
     //if you have a password and username that are valid, then you can continue what you were doing. If not, you are sent to the index page.
       if (mysqli_num_rows($runquery1) == 1 && mysqli_num_rows($runquery2) == 1)
       {
       }
       else
       {
            header("Location: index.php");
       }
 }
 else
 {
     header("Location: index.php");
 }
?>

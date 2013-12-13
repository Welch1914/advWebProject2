<!DOCTYPE>
<!--
Name: Sam Welch
Date:December 8th ,2013
Purpose: This page(login.php) let users log in to the site. 
-->
<html>
    <head>
        <meta charset= "utf-8" />
        <title>Bloggington Post - Login</title>
<?php
//gathers the database constraints
require_once('connectvars.php');
$dbc= mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// if cookies are set, then you can by pass this screen and go straight to the home page.
  if(isset($_COOKIE['ID']) && isset($_COOKIE['pass']))
 {   
     $username = $_COOKIE['ID']; 
     $password = $_COOKIE['pass'];
     header("Location: home.php");  
 }
        
 //if submit is pressed, it checks for the username and password against the database. if succesfull, the user logs in
        if(isset($_POST['submit']))
        {
             $username = trim($_POST['username']);
             $password = trim($_POST['password']);
            
            //checks if all fields are filled in
            if(!empty($username) && !empty($password))
            {                
                $query1 = "SELECT username FROM user_info_blog WHERE username = '$username' AND password=('$password');";
                $query2 = "SELECT password FROM user_info_blog WHERE username = '$username' AND password=('$password');";
                $runquery1 = mysqli_query($dbc, $query1);
                $runquery2 = mysqli_query($dbc, $query2);
                
                //sets the users cookies
                if (mysqli_num_rows($runquery1) == 1 && mysqli_num_rows($runquery2) == 1)
                {
                  setcookie('ID', $username,time()+ 60*60*24); 
                  setcookie('pass', $password,time()+ 60*60*24);	     
                  header("Location: home.php"); 
                } 
                else
                {
                    echo '<p>Username or password incorrect</p>';
                }  
            }
            else
            {
              echo 'TPlease fill in all fields .';   
            }
            
        
        
    }
?>
    </head>
    <div id="logo">
          <img src="media/images/logo.png">
      </div><!--end of logo-->
    <body>
        <!--This link allows users to go the the signup page to create an account-->
        <p>Not a member?<a href ="signup.php">Sign Up!</a></p>
        <!--This form is where users fill in the username and password so that they login-->
            <form  method="post" enctype="text"action="<?php echo $_SERVER['PHP_SELF']; ?>" >
            <label for="score">User Name</label>
            <input type="text" id="username" name="username" maxlength="20" value="<?php if (!empty($username)) echo $username; ?>" /><br />
            <label for="score">Password</label>
            <input type="password" id="password" name="password" maxlength="20" value="<?php if (!empty($password)) echo $password; ?>" /><br />
            <input type='submit' name='submit' value='Sign In' />
            </form>
    </body>
</html>

<!DOCTYPE>
<!--
Name: Sam Welch
Date:December 11th ,2013
Purpose: This page(signup.php) this is where people can sign up to the site. 
-->
<html>
    <head>
        <title>Blog Post - Sign Up</title>
<?php
//collects the database constraints
require_once ('connectvars.php');

//if the submit button is pressed then it runs the inputs through error checking, and if success full, commits it to the database
if (isset($_POST['submit'])) 
{
    $dbc= mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $cPassword = trim($_POST['cPassword']);
    
    //makes sure that only standard characters can be used for the username and password fields
    if(!preg_match("/^[a-zA-Z0-9]{1,20}$/", $username))
    {
     echo"<p> Username must only be letters a-z, A-Z and numbers, to a limit of 30.</p>";
    }
    
    if(!preg_match("/^[a-zA-Z0-9]{1,20}$/", $password))
    {
     echo"<p> Password must only be letters a-z, A-Z and numbers, to a limit of 30.</p> ";
    }
    //double checks password 
    if($cPassword == $password)
    {
        $usercheck ="SELECT username FROM user_info_blog WHERE username = '$username'";
         $takenname = mysqli_query($dbc, $usercheck); 
         //makes sure the username is avalible
         if(mysqli_num_rows($takenname) == 0)
         {   
             //makes sure all fields are filled in and if succesful, writes to the database
                 if (!empty($firstName) && !empty($lastName) && !empty($username) && !empty($password))
                 {
                     $query2 = "INSERT INTO user_info_blog(username, password, firstName, lastName) VALUES ('$username', '$password','$firstName','$lastName')";
                      mysqli_query($dbc, $query2);  
                    echo 'Thank you for signing up';
                    $firstName = "";
                    $lastName = "";
                    $username = "";
                    $password = "";
                    $cPassword = "";
                    mysqli_close($dbc);
                }
                else
                {
                    echo '<p>Please fill out all fields.</p>';   
                }
          }
          else
          {
            echo '<p>Username is unavalible</p>';   
          }   
    }
    else{
        echo '<p> Please confirm password </p>'; 
        $password = "";
        $cPassword = "";
    }
    
}    
?>
    </head>
    <body>
      <div id="logo">
          <img src="media/images/logo.png">
      </div><!--end of logo-->
      <!--THis is the sign up form. The user input all their information into this form, then submits it for testing and writing to the database.-->
      <div id ="signUpForm">
        <form method="post" enctype="text" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" maxlength="30" value="<?php if (!empty($firstName)) echo $firstName; ?>" /><br />
            <label for="lastName">Last Name</label>
            <input type="text" id="lastName" name="lastName" maxlength="30" value="<?php if (!empty($lastName)) echo $lastName; ?>" /><br />
            <p>Username must only be letters a-z, A-Z and numbers, to a limit of 20'</p>
            <label for="username">User Name</label>
            <input type="text" id="username" name="username" maxlength="20" value="<?php if (!empty($username)) echo $username; ?>" /><br />
            <p>Password must only be letters a-z, A-Z and numbers, to a limit of 20'</p>
            <label for="paswword">Password</label>
            <input type="password" id="password" name="password" maxlength="20" value="<?php if (!empty($password)) echo $password; ?>" /><br />
            <label for="cPassword">Confirm Password</label>
            <input type="password" id="cPassword" name="cPassword" maxlength="20" value="<?php if (!empty($cPassword)) echo $cPassword; ?>" /><br />
            <input type="submit" value="Sign Up" name="submit" />
        </form>
      </div>    
        <p><a href = "login.php">Back to login?</a></p>
    </body>
</html>
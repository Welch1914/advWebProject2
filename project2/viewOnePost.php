<!DOCTYPE>
<!--
Name: Sam Welch
Date:December 12th ,2013
Purpose: This page(viewOnePost.php) is where the user is brought to after clicking on a link title. They can comment only on this page. 
-->
<html>
    <head>
        <title>View Post</title>
        <?php
        
        
        //these connect the database constraints and checks to make sure the users in logged in.
         require_once('connectvars.php');
         require_once('cookieCheck.php');
         $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
         
         //displays the username
         echo "<p>'". $_COOKIE['ID'] ."' </p>";
       //sets username to the cookie ID
         $username = $_COOKIE['ID'];
         
//if the comment buttom is press then the comment is checked, and if succesful, is written to the database        
if(isset($_POST['submit']))
{   
        
        $comment = trim($_POST['comment']);  
        //sets the blogID to value recieved theough the URL
        $blogID =  $_POST['id'];
        
        //if comment is empty, user is notified. If it isn't, then the comment is written to the database
        if(!empty($comment))
        {
            
             $query = "INSERT INTO blog_comments(username, comments, blogID) VALUES ('$username', '$comment','$blogID')";
             mysqli_query($dbc, $query);   
             $comment = "";
             echo 'You have successfully commented. Go to <a href ="home.php">home</a>? </b>';
            
        }
        else 
        {
            
          echo "You didn't comment anything";  
        }
            
}

else
{
    //sets the blogID to the value recieved throught the URL
 $blogID =  $_GET['id'];  
}

        // the correct post from the database is selected and is created so that is can be read.
        $query3 = "SELECT * FROM posts WHERE ID =  $blogID ";
        $storage = mysqli_query($dbc, $query3);
        $blog = mysqli_fetch_array($storage);
        
        echo '<div id="newPost">';
        echo '<h3>' . $blog['title'] .'</h3>';
        echo '<h4>' . $blog['username'] .'</h4>'; 
        echo '<p>' .  $blog['post'] . '</p>';  
        echo '</div>';
    
        //the correct comments are selected from the database and displayed below the post
        $query4 = "SELECT * FROM blog_comments WHERE blogID = " . $blogID ."";
        $storage2 = mysqli_query($dbc, $query4);
        
echo '<div id="comment section">';
        while($blogComments = mysqli_fetch_array($storage2))
        {       
            echo '<div id="newComment">';
            echo '<h4>' . $blogComments['username'] .'</h4>'; 
            echo '<p>' .  $blogComments['comments'] . '</p>';  
            echo '</div>';
        }
echo '</div>'
        
        ?>
    </head>
    <body>
        <div id ="mainTitle">
        <h2>Blog Post - Post</h2>
        </div>
     <!--This form is where the user can create  new comment for a post-->
     <div id="comment">
        <form id="new_comment" enctype="test" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">  
            <textarea name="comment" id="comment" rows="5" cols="100" maxlength="150"><?php echo $comment; ?></textarea><br/> 
            <input type="hidden" name="id" value="<?php echo $blogID  ?>">
            <input type="submit" value="Comment" name="submit" />
            <h4><a href ="home.php">Home</a></h4>
        </form>  
    </div>
    </body>
</html>

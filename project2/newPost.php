<!DOCTYPE>
<!--
Name: Sam Welch
Date:December 11th ,2013
Purpose: This page(newPost.php) allows users to make new posts to the site . 
-->
<html>
    <head>
        <div id ="mainTitle">
        <h2>Blog Post - New Posts</h2>
        </div>
        <title>Blog Post - New Post</title>
<?php
   //these connect the database constraints and checks to make sure the users in logged in.     
    require_once('connectvars.php');
    require_once('cookieCheck.php');
    $dbc= mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
//displays the username
 echo "<p>'". $_COOKIE['ID'] ."' </p>";   
 
 //if the submit button is pressed, the users inputs are checked, and if successfull, are written to the database
    if(isset($_POST['Submit']))
    {
         $title = (trim($_POST['title']));
         $post = (trim($_POST['post']));
    
         //makes sure the the title is filled in. If it is, a check is made for the post area
        if(!empty($title))
        {
            //makes sure that the user filled in the post text area. If they have then it writes it to the database, and informs them of success
            if(!empty($post))
                {                    
                    $query1 = 'INSERT INTO posts (username, title, post, date) VALUES  ("' . $_COOKIE["ID"] . '","'.$title.'", "'.$post.'", NOW())';
                    mysqli_query($dbc, $query1);                        
                    echo "<p>Your post was submitted.</p>";
                    $title = "";
                    $post = "";
                    mysqli_close($dbc);
                }
               else
                   {
                    echo '<p>It seems you did not fill out the post area.</p>';
                   }
        }
         else
            {
             echo '<p>It seems you did not fill out the title.</p>';
            }
    
    }
?>
    </head>
    <body>
        
        
        <!--This is where the user can log out from the site-->
        <p><a href =" logout.php">Logout?</a></p>
        <!--This is the navigation bar-->
        <div id="nav">
            <nav id="menu">	
                <ul>
                    <li><a id="home1" href="home.php" title="Home">Home</a></li>
                    <li><a id="projects3" href="newPost.php" title="New Post">New Post</a></li>
                    <li><a id="services4" href="recentPosts.php" title="View Recent Posts">View Recent Posts</a></li>
                    <li><a id="about2" href="allPosts.php" title="View All Posts">Blogs</a></li>
                   
                   
								
		</ul>		
            </nav>
	</div><!--end of nav-->
        <!--This form is used to create new posts to the site-->
         <form id="new_post"  method="post" enctype="text" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                   <p>Title can only be 100 characters long</p>
                    <label for="title">Title:</label>
                    <input type="text" maxlength="100" id="title" name="title" value="<?php if (!empty($title)) echo $title; ?>" /><br/>
                    <p>Posts can only be 500 characters long</p>
                    <label for ="post"> Post:</label><br/>
                    <textarea name="post" id="post" rows="5" cols="100"><?php echo $post; ?></textarea><br/>
                    <input type="submit" value="Submit" name="Submit" />
                </form>
    </body>
</html>

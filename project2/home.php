<!DOCTYPE>
<html>
    <!--
Name: Sam Welch
Date:December 11th ,2013
Purpose: This page(home.php) this is where the user is brought upon logging in and where the user can view their most resent posts . 
-->
    <head>
        <title>Blog Post - Home</title>
<?php
//these connect the database constraints and checks to make sure the users in logged in.
require_once('connectvars.php');
require_once('cookieCheck.php');
$dbc= mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
?>
    </head>
    <body>
        <div id ="mainTitle">
        <h2>Blog Post - Home</h2>
        </div>
        <?php
        //displays the username
        echo "<p> Hello, '". $_COOKIE['ID'] ."' </p>";
        ?>
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
        <h2>Your Recent Posts:</h2>
        <?php
        
        // this area shos the users 8 most recent posts, for ease of checking
        
        // this div is where recent post are listed, to a limit of 20 posts
echo '<div id="recent posts">';
        $query1 = "SELECT * FROM posts WHERE username = '". $_COOKIE['ID'] ."' ORDER BY date DESC LIMIT 8";
        $storage = mysqli_query($dbc, $query1);
      while($blogTitle = mysqli_fetch_array($storage))
      {
          echo '<div id="blogTitle">';
          echo '<h3><a href = "viewOnePost.php?id='.$blogTitle['ID'].'">'. $blogTitle['title'] .'</a></h3>';
           echo '</div>';
            
      }
echo '</div>';
        ?>
        
        
    </body>
</html>
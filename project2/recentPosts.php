<!DOCTYPE>
<!--
Name: Sam Welch
Date:December 12th ,2013
Purpose: This page(recentPosts.php) is where the user can view the most recent posts . 
-->
<html>
    <head>
         <title>Blog Post - View Recent Posts</title>
<?php
//these connect the database constraints and checks to make sure the users in logged in.
 require_once('connectvars.php');
 require_once('cookieCheck.php');
 $dbc= mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

?>
    </head>
    <body>
        <div id ="mainTitle">
        <h2>Blog Post - Recent Posts</h2>
        </div>
        <?php
        //displays the username
        echo "<p> '". $_COOKIE['ID'] ."' </p>";
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
        <?php
        
 // this div is where recent post are listed, to a limit of 20 posts
echo '<div id="recent posts">';

$query1 = "SELECT * FROM posts ORDER BY date DESC Limit 20";
$storage = mysqli_query($dbc, $query1);
while($blog = mysqli_fetch_array($storage))
    {
        //each new post is put in a new div so the they can be easily organised
        echo '<div id="newPost">';
        echo '<h3><a href = "viewOnePost.php?id='.$blog['ID'].'">' . $blog['title'] . '</a></h3>';
        echo '<h4> By ' . $blog['username'] .'</h4>';   
        echo '</div>';
    }
echo '</div>';
        ?>
    </body>
</html>

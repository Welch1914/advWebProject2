<!DOCTYPE>
<!--
Name: Sam Welch
Date:December 8th ,2013
Purpose: This page(index.php) directs the user to either a desktop or mobile version, depending on the size of the user's screen, 
if the mobile site was avaliable. 
-->
<html>
    <head>
<?php
?>
        <title>Bloggington Post - Redirect page</title>
        <script type="text/javascript">
            if(screen.width <= 699)
                {
                    document.location = "mobileLog.php";                
                }
              else
              {
              	document.location = "login.php";  
              }                  
        </script>
        
    </head>
    <body>
    </body>
</html>
    
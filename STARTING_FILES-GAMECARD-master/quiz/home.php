<?php

    session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="home.css">
        <title>GAME GARD</title>
    
    
    </head>
    
    
    <body style="background-color: black;">
        <header>
            <div class="logo">Game Card</div>
        <div class="inscription">

        <?php 
            if($_SESSION["userId"]){
                echo ' <form action="extern/logout.ext.php" method="post">
    
                            <button type="submit" name="logout-submit" id="btn">LOG OUT</button>

                    </form> ' ;
                echo '<p><a href="MESSAGES/login.msg.php">PLAY</a></p>';
                echo '<p><a href="ACCOUNT/account.php" style="margin-top: 80px;">ACCOUNT</a></p>';
            }else{
                echo ' <p><a href="ACCOUNT/signup.php"  >SIGN UP</a></p> ';
                echo '<p><a href="ACCOUNT/login.php" style="margin-top: 30px;">LOG IN</a></p>';
            }
            
        ?>
            
        </div>
            
            
        
        </header>
        
        <div class="textgame">
            Come get a taste! <br>
            The Best Game <br> To Check Your Knowledge. <br>
            Impress Your Friends!
        
        </div>
        <div class="image">
            <img src="img-site/img.png">
        
        </div>
        

    </body>


</html>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="account.css">
    <title>SIGN UP</title>
</head>

<body>


    <div class="FORM">

        <div class="FORM-text">
            <header><a href="../home.php">Game Card</a></header>
   
           
            <img src="../img-site/bo.png" width="150px">
            <p>Best Score</p><br>
            <p></p>
            <h1>Account</h1>
            <?php
                if(isset($_GET["error"])){
                    if($_GET["error"] == "USERNAMETAKEN"){
                        echo '<p class="msg-erreur">Le nom d\'utilisateur est déja pris</p>';
                    }elseif($_GET["error"] == "usernamechangedSucess"){
                        echo '<p class="msg-update">Votre nom d\'utilisateur a bien été modifié</p>';
                    }elseif($_GET["error"] == "namechangedSucess"){
                        echo '<p class="msg-update">Votre prénom  a bien été modifié</p>';
                    }elseif($_GET["error"] == "dontdataExists"){
                        echo '<p class="msg-erreur">Veuillez bien remplir vos informations</p>';
                    }elseif($_GET["error"] == "dataIsNotValid"){
                        echo '<p class="msg-erreur">Veuillez bien vérifier vos informations</p>';
                    }elseif($_GET["error"] == "allDtachangedSucess"){
                        echo '<p class="msg-update">Félicitation, toutes vos informations ont été modifiés</p>';
                    }
                }
            
            
            
            ?>   
            <form action="../extern/account.ext.php" method="post">

                <label>update name</label> <br>
                <input type="text" name="prenom" placeholder="Modifier votre prenom" > <br>


                <label>update username</label> <br>
                <input type="text" name="username" placeholder="Modifier votre nom d'utilisateur">

                <br>


                <button type="submit" name="validate-submit">Valider</button>



            </form>
            <form action="../extern/account.ext.php" method="post">

                <button type="submit" name="delete-submit">Delete Account</button>
              
            </form>


        </div>

    </div>

</body>










</html>

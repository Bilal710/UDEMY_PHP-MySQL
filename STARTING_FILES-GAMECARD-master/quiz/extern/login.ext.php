<?php 

    if(isset($_POST["login-submit"])){
        require "dbh.ext.php";
        
        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = " SELECT * FROM gamecard WHERE username = '$username' OR email = '$username';";
        $res = mysqli_query($conn,$sql);
        if(!$res){
            header("location: ../ACCOUNT/login.php?error=sqlerror");
            exit();
        }else{
            // Renvoie un tableau associatif qui contient les clé et valeurs de notre table gamecard liées à la requete $sql
            if($row = mysqli_fetch_assoc($res)){

                // Vérification du mot de passe
                
                $checkedPassword = password_verify($password,$row["pwd"]);
                if($checkedPassword){
                    session_start();
                    $_SESSION["userId"] = $row["id"];
                    $_SESSION["name"] = $row["name"];
                    $_SESSION["username"] = $row["username"];
                    $_SESSION["bestscore"] = $row["bestscore"];
                    $_SESSION["status"] = $row["status"];

                    header("location: ../MESSAGES/login.msg.php?msg=sucessconnexion");
                    exit();
                }else{
                    header("location: ../ACCOUNT/login.php?error=wrongPassword");
                    exit();
                }
            }else{
                header("location: ../ACCOUNT/login.php?error=userdontexists");
                exit();
            }
        }

        mysqli_close($conn);

    }else{
        header("location: ../ACCOUNT/login.php");
        exit();
    }





?>
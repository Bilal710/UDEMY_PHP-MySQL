<?php  


    if(isset($_POST["signup-submit"])){
        require "dbh.ext.php";
        
        $name = $_POST["prenom"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $password2 = $_POST["password2"];

        if(!preg_match("/^[a-zA-Z0-9]*$/",$name)){
            header("location:../ACCOUNT/signup.php?error=invalidename");
            exit(); 
        }elseif(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
            header("location:../ACCOUNT/signup.php?error=invalideusername");
            exit(); 
        }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            header("location:../ACCOUNT/signup.php?error=invalidemail");
            exit(); 
        }elseif($password !== $password2){
            header("location:../ACCOUNT/signup.php?error=passworddontmatch");
            exit(); 
        }else{
            $sql = " SELECT * FROM gamecard WHERE username = '$username' ; ";
            $res = mysqli_query($conn,$sql); // Cette fonction nous permet d'exécuter la requete $sql
            // Dans le cas ou la requete ne fonctionne pas
            if(!$res){
                header("location:../ACCOUNT/signup.php?error=sqlerror");
                exit(); 
            }else{
                $resultCheck = mysqli_num_rows($res); // Compte le nombre de ligne du résultat de la requete
                if($resultCheck > 0){
                    header("location:../ACCOUNT/signup.php?error=userNameTaken");
                    exit();
                }else{
                    // Fonction de Hashage du mot de passe
                    $hashpassword = password_hash($password,PASSWORD_DEFAULT);
                    $sql = " INSERT INTO gamecard(name,username,email,pwd) VALUES ('$name','$username',
                    '$email','$hashpassword'); ";
                    $res = mysqli_query($conn,$sql);
                    if(!$res){
                        header("location:../ACCOUNT/signup.php?error=sqlerror");
                        exit(); 
                    }else{
                        header("location:../MESSAGES/signup.msg.php?message=Success");
                        exit(); 
                    }
                }
            }
            mysqli_close($conn);
        }

    }else{
        header("location:../ACCOUNT/signup.php");
        exit();
    
    }


?>
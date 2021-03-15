<?php 
    session_start();

    if(isset($_POST["delete-submit"])){
        require 'dbh.ext.php';
        $id = $_SESSION["userId"];
        $sql = " DELETE FROM gamecard WHERE id = $id ;";
        $res = mysqli_query($conn,$sql);
        if(!$res){
            header ("location: ../ACCOUNT/account.php?error=sqlerror");
            exit();
        }else{
            session_unset();
            session_destroy();
            header("location: ../MESSAGES/delete.msg.php?msg=deletesuccessfully");
            exit();
        }
    }elseif(isset($_POST["validate-submit"])){
        require 'dbh.ext.php';
        $id = $_SESSION["userId"];
        $name = $_POST["prenom"];
        $username = $_POST["username"];
        if(empty($name) && empty($username)){
            header("location: ../ACCOUNT/account.php?error=dontdataExists");
            exit();
        }else if(empty($name) && preg_match("/^[a-zA-Z0-9]*$/",$username)){
            $sql = " SELECT * FROM gamecard WHERE username = '$username';";
            $res = mysqli_query($conn,$sql);
            if(!$res){
                header ("location: ../ACCOUNT/account.php?error=sqlerror");
                exit();
            }else{
                $resultCheck = mysqli_num_rows($res);
                if($resultCheck > 0){
                    header ("location: ../ACCOUNT/account.php?error=USERNAMETAKEN");
                    exit();
                }else{
                    $sql = " UPDATE gamecard SET username = '$username' WHERE id = $id";
                    $res = mysqli_query($conn,$sql);
                    if(!$res){
                        header ("location: ../ACCOUNT/account.php?error=sqlerror");
                        exit();
                    }else{
                        header("location: ../ACCOUNT/account.php?error=usernamechangedSucess");
                        exit();
                    }
                    
                }
            }   
        }elseif(empty($username) && preg_match("/^[a-zA-Z0-9]*$/",$name)){
            $sql = " UPDATE gamecard SET name = '$name' WHERE id = $id; ";
            $res = mysqli_query($conn,$sql);
            if(!$res){
                header ("location: ../ACCOUNT/account.php?error=sqlerror");
                exit();
            }else{
                header("location: ../ACCOUNT/account.php?error=namechangedSucess");
                exit();
            }  
        }elseif(!preg_match("/^[a-zA-Z0-9]*$/",$name) && !preg_match("/^[a-zA-Z0-9]*$/",$username)){
            header("location: ../ACCOUNT/account.php?error=dataIsNotValid");
            exit();
        }elseif(preg_match("/^[a-zA-Z0-9]*$/",$name) && preg_match("/^[a-zA-Z0-9]*$/",$username)){

            $sql = " SELECT * FROM gamecard WHERE username = '$username';";
            $res = mysqli_query($conn,$sql);
            if(!$res){
                header ("location: ../ACCOUNT/account.php?error=sqlerror");
                exit();
            }else{
                $resultCheck = mysqli_num_rows($res);
                if($resultCheck > 0){
                    header ("location: ../ACCOUNT/account.php?error=USERNAMETAKEN");
                    exit();
                }else{
                    $sql = " UPDATE gamecard SET name = '$name', username = '$username' WHERE id = $id;";
                    $res = mysqli_query($conn,$sql);
                    if(!$res){
                        header ("location: ../ACCOUNT/account.php?error=sqlerror");
                        exit();
                    }else{
                        header("location: ../ACCOUNT/account.php?error=allDtachangedSucess");
                        exit();
                    }
                    
                }
            }
        }else{
            header("location: ../ACCOUNT/account.php?error=nameOrUserNameIsNotValid");
            exit();
        }
        
    mysqli_close($conn);

    }else{
        header("location: ../ACCOUNT/account.php");
        exit();
    }


?>
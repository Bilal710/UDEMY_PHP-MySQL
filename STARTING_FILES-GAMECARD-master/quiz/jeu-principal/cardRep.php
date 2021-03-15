<?php 

    session_start();
    require '../extern/dbh.ext.php';
    require 'afficheCarte.php';
    $id = $_SESSION["userId"];
    $theme = $_GET["theme"];

    // POUR LES CARTES SUIVANTES
    
    










    // INITIALISATION DE LA PREMIERRE CARTE

    $sql = " SELECT * FROM jeux_active WHERE id = $id AND theme = '$theme'; ";
    $res = mysqli_query($conn,$sql);
    if(!$res){
        header("location: cardRep.php?error=sqlerror");
        exit();
    }else{
        $resultCheck = mysqli_num_rows($res);

        if($resultCheck == 0){

            $ordreActuel = "";
            $ordreSuivant = ""; // L'ordre qui sera mémorisé si le joueur perds et revient plus tard dans le jeux

            $sql = " SELECT COUNT(*) FROM $theme; ";
            $res = mysqli_query($conn,$res);
            if(!$res){
                header("location: cardRep.php?error=sqlerror");
                exit();
            }else{
                $tab = mysqli_fetch_assoc($res);
                $taille = $tab["COUNT(*)"];
                for($i=1; $i <= $taille; $i++){
                    $ordreActuel.=$i."/";
                }
                $sql = " INSERT INTO jeux_active(id,ordreActuel,ordreSuivant,theme,nbrErreur,currentScore) VALUES($id,'$ordreActuel','$ordreSuivant','$theme',0,0); ";
                $res = mysqli_query($conn,$sql);
                if(!$res){
                    header("location: cardRep.php?error=sqlerror");
                    exit();
                }
            }
        }else{

        } 

        $sql = " SELECT * FROM jeux_active WHERE id = $id AND theme = '$theme'; ";
        $res = mysqli_query($conn,$sql);
        if(!$res){
            header("location: cardRep.php?error=sqlerror");
            exit();
        }else{
            $tab = mysqli_fetch_assoc($res);
            $ordreActuel = $tab["ordreActuel"];
            $ordreActuelExplode = explode("/",$ordreActuel); // 1/2/3.... devient [1,2,3,......]
            $a = $ordreActuelExplode[0]; // Nous permettra de chercher la bonne question dans la bonne table(Question 1)

            $sql = " SELECT  type,question FROM '$theme' WHERE id = $a;";
            $res = mysqli_query($conn,$sql);
            if(!$res){
                header("location: cardRep.php?error=sqlerror");
                exit();
            }else{
                $tab = mysqli_fetch_assoc($res); // On récupère un tableau associatif constitué de toutes les colonnes de notre table
                $question = $tab["question"];
                $type = $tab["type"];

                if($type == "qcm"){
                    $sql = "SELECT * FROM propositions WHERE questionId = $a AND theme = '$theme';";
                    $res = mysqli_query($conn,$sql);
                    if(!$res){
                        header("location: cardRep.php?error=sqlerror");
                        exit();
                    }else{
                        $tab = mysqli_fetch_assoc($res);
                        $prop1 = $tab["proposition1"];
                        $prop2 = $tab["proposition2"];
                        $prop3 = $tab["proposition3"];
                        afficherCarteProp($question,$prop1,$prop2,$prop3,$theme,$a);
                    }
                }else{
                    afficherCarteTexte($question,$theme,$a);
                }
            }

        }
    }


?>
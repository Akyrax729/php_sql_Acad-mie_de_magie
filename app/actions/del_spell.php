<?php
    include('../includes/function.php');

    if(isset($_GET['id'])){
        $id = htmlspecialchars($_GET['id']);

            // On créer une requete qui va nous permettre de vérifier si la fiche film appartien bien a l'utilisateur
            $requestRead = $bdd->prepare('  SELECT *
                                            FROM sort
                                            WHERE id = :id
                                            
                ');
            $requestRead->execute(array(
                    'id'    =>  $id
                ));
            // Pas besoin de bouche while parce qu'on a qu'une seule ligne a lire 
            $data = $requestRead->fetch();
            // Verification de l'utilisateur
            if($_SESSION['userid']==$data['user_id'] || $_SESSION['userid']== "1"){
                // Suppression du fichier en local
                if ($data['img']!= NULL){
                    unlink('../../assets/img/sort/' . $data['img']);
                }

                //ON EXECUTE LA REQUETE DELETE SI CA CORRESPOND
                $request = $bdd->prepare('  DELETE FROM sort
                                            WHERE id=:id
                                            ');

                $request->execute(['id' =>$id]);

                header('location:/académie_de_magie/index.php?success=3');
                exit();
            }else{
                header('location:/académie_de_magie/index.php');
            }

        }else{
            header('location:/académie_de_magie/index.php');
        }
        

   


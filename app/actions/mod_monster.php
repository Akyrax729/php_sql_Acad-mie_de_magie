<!-- REQUEST UPDATE -->
<!-- ----------- -->
<?php
    include('../includes/function.php');
    // Creation d'une condition, si un "id" est trouvé on reste sur la page sinon on retourne sur l'index
    if(isset($_GET['id'])){
        $id = htmlspecialchars($_GET['id']);

            // ----------REQUEST READ-----------
            // On créer une requete READ pour mettre les valeurs existante dans les champs de formulaire
            $requestRead = $bdd->prepare('  SELECT *
                                            FROM bestiaire
                                            WHERE id = :id'
                );

            $requestRead->execute(array(
                    'id'    =>  $id
                ));
            // Pas besoin de bouche while parce qu'on a qu'une seule ligne a lire 
            $data = $requestRead->fetch();

         
            // On vérifie si l'utilisateur est bien celui qui a créé la fiche
            if($_SESSION['userid']!=$data['user_id']){
                header("location:/académie_de_magie/index.php");

                
            }

    }else{
        header('location:/académie_de_magie/index.php');
    }

    


        // RECUPERATION DES DONNEES POST (POUR l'UPDATE)
        if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['annee'])){
            $name=sanitarize($_POST['name']);
            $description=sanitarize($_POST['description']);
            $date=sanitarize($_POST['annee']);
            $id=htmlspecialchars($_POST['id']);

            
            // REQUETE SQL POUR vérifier si la fiche appartient bien a l'utilisateur et pour plus tard que le nom du fichier appartenant a la fiche film concernée
            $request = $bdd->prepare('  SELECT id,img,user_id
                                        FROM bestiaire 
                                        WHERE id = ? '
        
            );

            $request->execute(array($id));

            $data = $request->fetch();

            // VERIFICATION si la fiche appartient bien a l'utilisateur
            if($_SESSION['userid'] == $data['user_id']){

                    // --------------TRAITEMENT DE L'IMAGE------------
                    //    Si le champ image est vide on fait la requête update sans l'image
                if($_FILES['image']['error'] === UPLOAD_ERR_NO_FILE){

                                // REQUETE UPDATE SANS IMG
                                $request = $bdd->prepare('  UPDATE bestiaire
                                SET name = :name, date=:date,description=:description
                                WHERE id = :id'
                            );

                        $request->execute(array(
                        'name' =>  $name,
                        'date'  =>  $date,
                        'description' =>  $description,
                        'id'    =>  $id
                        ));

                    header("location:/académie_de_magie/index.php?success=2");

                }else{
                    $imageName = sanitarize($_FILES['image']['name']);
                    $imageInfo = pathinfo($imageName);
                    $imageExt = $imageInfo['extension'];
                // Tableau qui va permettre de spécifier les extensions autorisées
                    $autorizedExt = ['png','jpeg','jpg','webp','bmp','svg'];

                // Verification de l'extention du fichier

                    if(in_array($imageExt,$autorizedExt)){
                        $img = time() . rand(1,1000) . "." . $imageExt;
                        // On stocke le fichier en local 
                        move_uploaded_file($_FILES['image']['tmp_name'],"../../assets/img/".$img);


                        unlink("../../assets/img/" . $data['img']);
                    
                    }else{
                        // echo 'location:/académie_de_magie/index.php?success=1';
                    }


                        // -----------REQUETE UPDATE---------------
                        $request = $bdd->prepare('  UPDATE bestiaire
                        SET name = :name, date=:date,description=:description,img=:img
                        WHERE id = :id'
                        );

                    $request->execute(array(
                    'name' =>  $name,
                    'date'  =>  $date,
                    'description' =>  $description,
                    'img'   =>  $img,
                    'id'    =>  $id
                    ));
                    // Renvois de l'utilisateur sur l'index aprés validation de formulaire
                    header("location:/académie_de_magie/index.php?success=2");

                }

            }else{
                header("location:.académie_de_magie/index.php");
            }

        }

  
?>

<?php 
    $title = "Modifier un monstre";
    include('../includes/head.php'); 
?>
<body>
    <?php include('../includes/nav.php') ?>
    <section id="log">
        <form action="mod_monster.php" method="POST" enctype="multipart/form-data">
            <label for="name">Entrez le nom de la créature</label>
            <input id="name" type="text" name="name" value="<?php echo $data['name'];?>">
            <label for="description">Entrez la description en min</label>
            <input id="description" type="text" name="description" value="<?php echo $data['description'];?>">
            <label for="type">Entrez le type de monstre :</label>
            <select name="id_type_fk" id="id_type_fk">
                <option <?php if($data['id_type_fk'] == "1") {echo "selected";} ?> value="1">Aquatique</option>
                <option <?php if($data['id_type_fk'] == "2") {echo "selected";} ?> value="2">Démoniaque</option>
                <option <?php if($data['id_type_fk'] == "3") {echo "selected";} ?> value="3">Mort-vivant</option>
                <option <?php if($data['id_type_fk'] == "4") {echo "selected";} ?> value="4">Mi-bête</option>
            </select>
            <input type="hidden" name="id" value="<?php echo $data['id'];?>">
            <label for="image">Choisissez une image</label>
            <input id="image" type="file" name="image">

            <button>Modifier</button>
        </form>
    </section>
</body>
</html>
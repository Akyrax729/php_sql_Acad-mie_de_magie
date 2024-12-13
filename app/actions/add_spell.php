<!-- REQUEST ADD -->
<!-- ----------- -->
<?php
    include('../includes/function.php');

        
        $requestElem = $bdd->prepare('  SELECT users.id, users.username, element.type, element.id_element
            FROM user_element
            LEFT JOIN users
            ON user_element.user_id = users.id
            LEFT JOIN element
            ON user_element.element_id = element.id_element
        ');

        $requestElem->execute(array());


        // RECUPERATION DES DONNEES POST
    if(isset($_POST['name']) && isset($_POST['id_type_fk'])){
        $name=sanitarize($_POST['name']);
        $type=sanitarize($_POST['id_type_fk']);

        

        //    Si le champ image est vide on lui attribut une valeur NULL
        if(empty($_FILES['image'])){
                $img = NULL;
        }else{
                $imageName = sanitarize($_FILES['image']['name']);
                $imageInfo = pathinfo($imageName);
                $imageExt = $imageInfo['extension'];
                // Tableau qui va permettre de spécifier les extensions autorisées
                $autorizedExt = ['png','jpeg','jpg','webp','bmp','svg','gif'];

                // Verification de l'extention du fichier

                if(in_array($imageExt,$autorizedExt)){
                $img = time() . rand(1,1000) . "." . $imageExt;
                move_uploaded_file($_FILES['image']['tmp_name'],"../../assets/img/sort/".$img);
                
        }}

        

        $bdd = new PDO('mysql:host=localhost;dbname=académie_de_magie;charset=utf8', 'root', '');

        $request = $bdd->prepare('  INSERT INTO sort (name,id_type_fk,user_id,img)
                                        VALUE (:name,:id_type_fk,:user_id,:img)
                                ');

        $request->execute(array(
            'name' =>  $name,
            'id_type_fk'  =>  $type,
            'user_id'=> $_SESSION['userid'],
            'img'   => $img,
        ));

        header('location:/Académie_de_magie/index.php?success=1');
        
    }
?>

<?php
    $title = "Ajouter un Sort";
    include('../includes/head.php'); 
 ?>
<body>
   
    <?php include('../includes/nav.php') ?>
    <section id="log">
        <form action="add_spell.php" method="POST" enctype="multipart/form-data">
            <label for="name">Entrez le nom du sort :</label>
            <input id="name" type="text" name="name">
            <label for="type">Entrez le type de sort :</label>
            

            <select name="id_type_fk" id="id_type_fk">
                <?php while($data = $requestElem->fetch()): ?>
                    <?php if($_SESSION['userid']==$data['id']): ?>
                        
                        <option value="<?= $data['id_element'] ?>"><?= $data['type'] ?></option>

                        <?php var_dump($data); ?>
                    <?php endif; ?>
                <?php endwhile ?>
                
            </select>
                    
            <label for="image">Choisissez une image</label>
            <input id="image" type="file" name="image">
            <button>Ajouter</button>
        </form>

    </section>
   
    
</body>
</html>
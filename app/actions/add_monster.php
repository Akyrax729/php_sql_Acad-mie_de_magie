<!-- REQUEST ADD -->
<!-- ----------- -->
<?php
    include('../includes/function.php');


    // RECUPERATION DES DONNEES POST
    if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['id_type_fk'])){
       $name=sanitarize($_POST['name']);
       $description=sanitarize($_POST['description']);
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
            move_uploaded_file($_FILES['image']['tmp_name'],"../../assets/img/creature/".$img);
            
       }}

    

    $bdd = new PDO('mysql:host=localhost;dbname=académie_de_magie;charset=utf8', 'root', '');

    $request = $bdd->prepare('  INSERT INTO bestiaire (name,id_type_fk,description,user_id,img)
                                VALUE (:name,:id_type_fk,:description,:user_id,:img)
                            ');

    $request->execute(array(
        'name' =>  $name,
        'id_type_fk'  =>  $type,
        'description' =>  $description,
        'user_id'=> $_SESSION['userid'],
        'img'   => $img,
    ));

    header('location:/Académie_de_magie/index.php?success=1');
    
}
?>

<?php
    $title = "Ajouter un monstre";
    include('../includes/head.php'); 
 ?>
<body>
   
    <?php include('../includes/nav.php') ?>
    <section id="log">
        <form action="add_monster.php" method="POST" enctype="multipart/form-data">
            <label for="name">Entrez le nom du monstre :</label>
            <input id="name" type="text" name="name">
            <label for="description">Entrez sa description :</label>
            <input id="description" type="text" name="description">
            <label for="type">Entrez le type de monstre :</label>
            <select name="id_type_fk" id="id_type_fk">
                <option value="1">Aquatique</option>
                <option value="2">Démoniaque</option>
                <option value="3">Mort-vivant</option>
                <option value="4">Mi-bête</option>
            </select>
            <label for="image">Choisissez une image</label>
            <input id="image" type="file" name="image">
            <button>Ajouter</button>
        </form>

    </section>
   
    
</body>
</html>
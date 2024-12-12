<?php 
    include "../app/includes/function.php";

    $request = $bdd->prepare('  SELECT users.id, users.username, bestiaire.id, bestiaire.name,bestiaire.description, bestiaire.img, type_de_creature.type
                                FROM bestiaire
                                LEFT JOIN users
                                ON user_id = users.id
                                LEFT JOIN type_de_creature
                                ON id_type_fk = type_de_creature.id
                            ');

    $request->execute(array());
?>

<?php 
    $title = "Académie de magie";
    include "../app/includes/head.php";
?>
<body>
    <?php 
        include "../app/includes/nav.php";

    ?>

    <section id="bestiaire">
        <a href="/Académie_de_magie/app/actions/add_monster.php">Ajouter un monstre</a>

        <div>
            <?php while ($data = $request->fetch()) :?>
                <article>
                    <?php if($data['img'] == "NULL"): ?>
                        <img src="../assets/img/image-missing-hi" alt="Image manquante">
                    <?php else: ?>
                        <img src="<?= "../assets/img/creature/".$data['img'] ?>" alt="<?= "Illustration de/d'".$data['name']?>">
                    <?php endif ?>
                    <div>
                        <h2><?= $data['name'] ?></h2>
                        <p><?= $data['description'] ?></p>
                        <p>Catégorie de la créature : <em> <?= $data['type'] ?></em></p>
                        <p>Fiche créé par : <em><?= $data['username'] ?></em></p>
                    </div>
                    <div class="cardModif">
                        <?php if(isset($_SESSION['userid'])):?>
                            <?php if($_SESSION["userid"] === $data["0"] || $_SESSION["userid"] == "1"): ?>
                                <a href="">Modifier</a>
                                <a href="">Supprimer</a>
                            <?php else: ?>
                                <div class="space"></div>
                            <?php endif ?>
                        <?php endif ?>
                    </div>
                </article>
            <?php endwhile ?>
        </div>
    </section>

</body>
</html>
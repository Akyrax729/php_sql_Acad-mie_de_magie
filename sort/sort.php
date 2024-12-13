<?php 
    include "../app/includes/function.php";

    $request = $bdd->prepare('  SELECT users.id, users.username, sort.id, sort.name, sort.img, element.type, element.id_element
                                FROM sort
                                LEFT JOIN users
                                ON user_id = users.id
                                LEFT JOIN element
                                ON id_type_fk = element.id_element
                            ');

    $request->execute(array());

    $requestElem = $bdd->prepare('  SELECT users.id, users.username, element.type
            FROM user_element
            LEFT JOIN users
            ON user_element.user_id = users.id
            LEFT JOIN element
            ON user_element.element_id = element.id_element
        ');

        $requestElem->execute(array());
        
?>

<?php 
    $title = "Académie de magie";
    include "../app/includes/head.php";
?>
<body>
    <?php 
        include "../app/includes/nav.php";

    ?>

    <section id="galery">
        <div>
            <a href="/Académie_de_magie/app/actions/add_spell.php">Ajouter un sort</a>
        </div>

        <div>
            <?php while ($data = $request->fetch()) :?>
                <article>
                    <?php if($data['img'] == "NULL"): ?>
                        <img src="../assets/img/image-missing-hi" alt="Image manquante">
                    <?php else: ?>
                        <img src="<?= "../assets/img/sort/".$data['img'] ?>" alt="<?= "Illustration de/d' ".$data['name']?>">
                    <?php endif ?>
                    <div>
                        <h2><?= $data['name'] ?></h2>
                        <p>Elément du sort : <em> <?= $data['type'] ?></em></p>
                        
                        <p>Fiche créé par : <em><?= $data['username'] ?></em></p>
                        <p>Spécialiste : 
                            <?php while($dataElem = $requestElem->fetch()): ?>
                                <?php if($data['type'] == $dataElem['type']): ?>
                                    <?= "<em>". $dataElem['username']. " . </em>"; ?>
                                <?php endif ?>     
                            <?php endwhile?>                        
                        </p>
                    </div>
                    <div class="cardModif">
                        <?php if(isset($_SESSION['userid'])):?>
                            <?php if($_SESSION["userid"] === $data["0"] || $_SESSION["userid"] == "1"): ?>
                                <a class="mod" href="">Modifier</a>
                                <a class="del" href="/académie_de_magie/app/actions/del_spell.php?id=<?= $data['id'] ?>">Supprimer</a>
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
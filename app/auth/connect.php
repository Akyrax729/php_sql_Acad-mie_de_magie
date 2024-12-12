<?php
    include('../includes/function.php');
    
    if($_SERVER['REQUEST_METHOD']==='POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $request = $bdd->prepare('  SELECT * 
                                    FROM users
                                    WHERE username=:username'
                                );

        $request->execute(array( 'username' => $username ));

        $data = $request->fetch();
        
        if(password_verify($password,$data['password'])){
            $_SESSION['userid']=$data['id'];
            header('location:/Académie_de_magie/index.php?success=5');
        }else{
            header('location:connect.php?error=1');
        }
    
    }
?>

<?php 
    $title = "Se connecter";
    include('../includes/head.php'); 
?>

<body>
    <?php include('../includes/nav.php') ?>
    <section id="log">
        <h1>Connexion</h1>
        <?php if(isset($_GET['error'])):?>
            <p class="error">Nom d'utilisateur ou mot de passe incorrect.</p>
        <?php endif?>
        <form action="connect.php" method="post">
            <div>
                <label for="username">Votre nom d'utilisateur : </label>
                <input type="text" name="username" id="username">
            </div>
            <div>
                <label for="password">Votre mot de passe : </label>
                <input type="password" name="password" id="password">
            </div>
            <button>Se connecter</button>
        </form>
    </section>
</body>
</html>
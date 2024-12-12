<header>
    <nav>
        <ul>
            <li><a href="/Académie_de_magie/index.php">Accueil</a></li>
        <?php if(!isset($_SESSION['userid'])): ?>
            <li><a href="/Académie_de_magie/app/auth/connect.php">Se connecter</a></li>
            <li><a href="/Académie_de_magie/app/auth/register.php">S'enregistrer</a></li>
        <?php else: ?>
            <li><a href="/Académie_de_magie/app/auth/disconnect.php">Se déconnecter</a></li>
        <?php endif; ?>
        </ul>
    </nav>
</header>
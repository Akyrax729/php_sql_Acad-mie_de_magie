<?php 
// Lancement de la session 
    session_start();

// Connexion à la base de donnée 
    $bdd = new PDO('mysql:host=localhost;dbname=académie_de_magie;charset=utf8', 'root', '');

// Fonction pour sécuriser les formulaires (ne pas utiliser sur les passwords)
    function sanitarize($input){
        return htmlspecialchars(trim(strtolower($input)));
    }
?>
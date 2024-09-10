<?php
    $host = "localhost"; // Adresse de l'hôte
    $dbname = "nom_de_la_base_de_donnees"; // Nom de la base de données
    $username = "nom_utilisateur"; // Nom d'utilisateur MySQL
    $password = "mot_de_passe"; // Mot de passe MySQL

    try {
        // Connexion à la base de données
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }
?>
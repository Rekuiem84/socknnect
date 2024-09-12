<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    // header('Location: login.php');
    exit();
}

// Inclure les classes nécessaires (supposons que User et Db sont dans des fichiers séparés)
include_once '../assets/classes/Db.php';
include_once '../assets/classes/User.php';

// Initialiser la connexion à la base de données et récupérer l'utilisateur connecté
$co = new Db();
$db = $co->dbCo("socknnect", "root", "root");

$user = new User('', '', '', '', '', '', '', ''); // Créer une instance de l'objet User vide
$user->getUser($_SESSION['id']); // Récupérer les informations de l'utilisateur connecté à partir de la session

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de l'utilisateur</title>
</head>
<body>
<form method="post">
<h2>Profil de <h2> <input id="nom" value="<?= ($_SESSION['nom']); ?>"/>

    <label for="email">Email : <input id="email" value="<?= ($_SESSION['email']); ?>"/></label>
    <label for="couleur">Couleur préférée : <input id="couleur" value="<?= ($_SESSION['couleur']); ?>"/></label>
    <label for="taille">Taille de chaussettes : <input id="taille" value="<?= ($_SESSION['taille']); ?>"/></label>
    <label for="matiere">Matière préférée : <input id="matiere" value="<?= ($_SESSION['matiere']); ?>"/></label>
    <label for="motif">Motif préféré : <input id="motif" value="<?= ($_SESSION['motif']); ?>"/></label>
    <label for="photo">Photo de profil : <img src="../user_photos/sock-1.webp" alt="pdp"></label>

    
</form>


<?php if ($user->getPhoto()): ?>
    <p><strong>Photo de profil : </strong></p>
    <img src="uploads/<?= ($_SESSION['photo']); ?>" alt="Photo de profil" width="150">
<?php else: ?>
    <p>Aucune photo de profil.</p>
<?php endif; ?>

</body>
</html>
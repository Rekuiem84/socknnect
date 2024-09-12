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

<h2>Profil de <?= ($_SESSION['nom']); ?></h2>

<p><strong>Email : </strong><?= ($_SESSION['email']); ?></p>
<p><strong>Couleur préférée : </strong><?= ($_SESSION['couleur']); ?></p>
<p><strong>Taille : </strong><?= ($_SESSION['taille']); ?></p>
<p><strong>Matière préférée : </strong><?= ($_SESSION['matiere']); ?></p>
<p><strong>Motif préféré : </strong><?= ($_SESSION['motif']); ?></p>

<?php var_dump($_SESSION); ?>

<?php if ($user->getPhoto()): ?>
    <p><strong>Photo de profil : </strong></p>
    <img src="uploads/<?= ($_SESSION['photo']); ?>" alt="Photo de profil" width="150">
<?php else: ?>
    <p>Aucune photo de profil.</p>
<?php endif; ?>

<a href="logout.php">Se déconnecter</a>

</body>
</html>
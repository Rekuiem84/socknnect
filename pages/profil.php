<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['is_connected'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    include "./redirect-index.php";
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
    <link rel='stylesheet' href='../assets/style/style.css' />
</head>
<body>
<?php
$page = "profil";
include "../include/header.php" ?>
 <div class="bg-accent-1 window form-cont">
      <h1>INSCRIPTION</h1>
      <form method="post">
        <div class="input-cont">
          <label for="nom">Pseudo</label>
          <input id="nom" value="<?= ($_SESSION['nom']); ?>"/>
        </div>
        <div class="input-cont">
          <label for="couleur">Couleur</label>
          <input id="couleur" value="<?= ($_SESSION['couleur']); ?>"/>
        </div>
        <div class="input-cont">
          <label for="taille">Taille</label>
          <input id="taille" value="<?= ($_SESSION['taille']); ?>"/>
        </div>
        <div class="input-cont">
          <label for="matiere">Matière</label>
          <input id="matiere" value="<?= ($_SESSION['matiere']); ?>"/>
        </div>
        <div class="input-cont">
          <label for="motif">Motif</label>
          <input id="motif" value="<?= ($_SESSION['motif']); ?>"/>
        </div>
        <div class="input-cont">
          <label for="email">Adresse email</label>
          <input id="email" value="<?= ($_SESSION['email']); ?>"/>
        </div>
        <div class="input-cont">
          <label class="label-photo" for="photo">Télécharger une photo</label>
          <div class="custom-file">
            <input type="file" id="photo" name="photo" accept="image/*" required>
            <label for="photo" class="file-label">Choisir une photo</label>
          </div>
        </div>
        <!-- Pour l'aperçu de l'image -->
        <div class="image-preview">
          <img src="" alt="Prévisualisation de l'image" id="imagePreview">
        </div>
        <button class="btn-submit" type="submit">Modifier mon profil</button>
      </form>
    </div>
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
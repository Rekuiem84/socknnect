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
include_once '../assets/classes/Form.php';

// Initialiser la connexion à la base de données et récupérer l'utilisateur connecté
$co = new Db();
$db = $co->dbCo("socknnect", "root", "root");

$user = new User('', '', '', '', '', '', '', ''); // Créer une instance de l'objet User vide
$user->getUser($_SESSION['id']); // Récupérer les informations de l'utilisateur connecté à partir de la session

$form = new Form();
$params = [];
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
if ($form->isSubmitted()) {

    $nom = $_POST["nom"];
    $couleur = $_POST["couleur"];
    $taille = $_POST["taille"];
    $matiere = $_POST["matiere"];
    $motif = $_POST["motif"];
    $email = $_POST["email"];
    
    $params = [$nom, $couleur, $taille, $matiere, $motif, $email, $_SESSION['id']];
    if ($form->isValidAnyForm($params)) {
        $user->setUser($nom, $couleur, $taille, $matiere, $motif, $email, $_SESSION['id']);
        header("Location: ./profil.php?success");
    } else { echo "Erreur de validation"; }
    
}

$page = "profil";
include "../include/header.php";
if (isset($_GET["success"])){
echo "<p class='popup'>Profil mis à jour avec succès</p>";
}
?>

 <div class="bg-accent-1 window form-cont">
      <h1>PROFIL</h1>
      <form method="POST">
        <div class="input-cont">
          <label for="nom">Pseudo</label>
          <input placeholder="nom" id="nom" name="nom" value="<?= ($_SESSION['nom']); ?>"/>
        </div>
        <div class="input-cont">
          <label for="couleur">Couleur</label>
          <input placeholder="couleur" id="couleur" name="couleur" value="<?= ($_SESSION['couleur']); ?>"/>
        </div>
        <div class="input-cont">
          <label for="taille">Taille</label>
          <input placeholder="taille" id="taille" name="taille" value="<?= ($_SESSION['taille']); ?>"/>
        </div>
        <div class="input-cont">
          <label for="matiere">Matière</label>
          <input placeholder="matiere" id="matiere" name="matiere" value="<?= ($_SESSION['matiere']); ?>"/>
        </div>
        <div class="input-cont">
          <label for="motif">Motif</label>
          <input placeholder="motif" id="motif" name="motif" value="<?= ($_SESSION['motif']); ?>"/>
        </div>
        <div class="input-cont">
          <label for="email">Adresse email</label>
          <input placeholder="email" id="email" name="email" value="<?= ($_SESSION['email']); ?>"/>
        </div>
        <!-- Pour l'aperçu de l'image -->
<!-- 
        <div class="img-cont"><img src="../user_photos/sock-3.webp" alt=""></div>
        <div class="input-cont">
          <label class="label-photo" for="photo">Modifier ma photo</label>
          <div class="custom-file">
            <input type="file" id="photo" name="photo" accept="image/*" value="<?= ($_SESSION['photo']); ?>">
            <label for="photo" class="file-label">Choisir une photo</label>
          </div>
        </div> -->
        <button class="btn-submit" type="submit">Modifier mon profil</button>
      </form>
    </div>
</main>
<script>
    const image = document.querySelector('.img-cont img');
    const photoInput = document.getElementById('photo');
    photoInput.addEventListener('change', function() {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
          image.setAttribute('src', event.target.result);
        }
        reader.readAsDataURL(file);
      }
    });

    // Utilisation de setTimeout pour masquer la popup après 5 secondes
    setTimeout(() => {
        const popup = document.querySelector('.popup');
        if (popup) {
            popup.style.display = 'none';  // Masque complètement la popup
        }
    }, 5000); // 5000 millisecondes = 5 secondes
  </script>
</body>
</html>
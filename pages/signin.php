<?php
require "../assets/classes/Db.php";
require "../assets/classes/Form.php";
require "../assets/classes/User.php";

$form = new Form;
$params = [];
$errors = [];
$message = "";

?>


<!DOCTYPE html>
<html lang='fr'>

<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Document</title>
  <meta name='description' content=''>
  <link rel='stylesheet' href='../assets/style/style.css' />
  <link rel='shortcut icon' type='image/png' href='' />
  <script src='' defer></script>
</head>

<body>
  <?php


if ($form->isSubmitted()) {

  $nom = $_POST["nom"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $couleur = $_POST["couleur"];
  $taille = $_POST["taille"];
  $matiere = $_POST["matiere"];
  $motif = $_POST["motif"];
  $photo = $_POST["photo"];
  
  if ($form->isValidUser()) {
    
    var_dump($form->isValidUser());
    $user = new user( $nom, $email, $password, $couleur, $taille, $matiere, $motif, $photo);

    $user->insertUser($nom, $email, $password, $couleur, $taille, $matiere, $motif, $photo);
    header("Location: ./login.php?success");
  } else {
    $errors = $form->getErrorsUser();
  }
}
  $page = "signin";
  include "../include/header.php" ?>
  <main>
    <div class="bg-accent-1 window form-cont">
      <h1>INSCRIPTION</h1>
      <form method="post">
      <div class="input-cont">
          <label for="nom">Pseudo</label>
          <input type="text" name="nom" id="nom" required>
        </div>
        <div class="input-cont">
          <label for="password">Mot de passe</label>
          <input type="password" name="password" id="password" required>
        </div>
        <div class="input-cont">
          <label for="couleur">Couleur</label>
          <input type="text" name="couleur" id="couleur" required>
        </div>
        <div class="input-cont">
          <label for="taille">Taille</label>
          <input type="text" name="taille" id="taille" required>
        </div>
        <div class="input-cont">
          <label for="matiere">Matière</label>
          <input type="text" name="matiere" id="matiere" required>
        </div>
        <div class="input-cont">
          <label for="motif">Motif</label>
          <input type="text" name="motif" id="motif">
        </div>
        <div class="input-cont">
          <label for="photo">Photo</label>
          <input type="file" name="photo" id="photo" required>
        </div>
        <div class="input-cont">
          <label for="email">Adresse email</label>
          <input type="email" name="email" id="email" required>
        </div>
        <button type="submit">Créer mon compte</button>
        <?= (isset($_GET["success"])) ? "<p>Membre ajouté avec succès</p>" : ""; ?>
      </form>
    </div>

  </main>
  
</body>

</html>
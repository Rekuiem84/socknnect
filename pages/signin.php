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
  <meta name="description" content="Site de rencontre entre chaussettes" />
  <title>Document</title>
  <meta name='description' content=''>
  <link rel='stylesheet' href='../assets/style/style.css' />
  <link rel='shortcut icon' type='image/png' href='' />
  <script src='' defer></script>
</head>

<body>
  <?php


  if ($form->isSubmitted()) {
    var_dump($_FILES);

    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $couleur = $_POST["couleur"];
    $taille = $_POST["taille"];
    $matiere = $_POST["matiere"];
    $motif = $_POST["motif"];
    $photo = $_FILES["photo"];

    // Gérer le téléchargement de la photo
    if (isset($photo) && $photo['error'] === UPLOAD_ERR_OK) {
      $photoTmpPath = $photo['tmp_name'];
      $photoName = $photo['name'];
      $photoNameCmps = explode(".", $photoName);
      $photoExtension = strtolower(end($photoNameCmps));
    } else {
      $errors[] = 'Erreur lors du téléchargement de la photo.';
    }

    if ($form->isValidUser()) {
      var_dump("ok");
      $user = new user($nom, $email, $password, $couleur, $taille, $matiere, $motif, $photo);

      $user->insertUser($nom, $email, $password, $couleur, $taille, $matiere, $motif, $photo);

      // Création des paires avec tous les autres utilisateurs
      $id = $user->getLastId();

      // Renommer la photo avec le nom original suivi de l'ID de l'utilisateur
      $newPhotoName = pathinfo($photoName, PATHINFO_FILENAME) . "-" . $id . '.' . $photoExtension;
      $uploadFileDir = '../user_photos/';
      $dest_path = $uploadFileDir . $newPhotoName;

      if (move_uploaded_file($photoTmpPath, $dest_path)) {
        $photo = $newPhotoName;

        // Mettre à jour l'utilisateur avec le nom de la photo
        $user->updateUserPhoto($id, $photo);

        foreach ($user->getAllIdExceptLast() as $value) {
          $other_user_id = $value[0];
          $user->createPair($id, $other_user_id);
        }

        header("Location: ./login.php?success");
      } else {
        $errors = $form->getErrorsUser();
      }
    }
  }
  $page = "signin";
  include "../include/header.php" ?>
  <main>
    <div class="bg-accent-1 window form-cont">
      <h1>INSCRIPTION</h1>
      <form method="post" enctype='multipart/form-data'>

        <div class="input-cont">
          <label for="nom">Pseudo</label>
          <input type="text" name="nom" id="nom" placeholder="Pseudo" required>
        </div>
        <div class="input-cont">
          <label for="password">Mot de passe</label>
          <input type="password" name="password" id="password" placeholder="Mot de passe" required>
        </div>
        <div class="input-cont">
          <label for="couleur">Couleur</label>
          <input type="text" name="couleur" id="couleur" placeholder="Couleur" required>
        </div>
        <div class="input-cont">
          <label for="taille">Taille</label>
          <input type="text" name="taille" id="taille" placeholder="Taille" required>
        </div>
        <div class="input-cont">
          <label for="matiere">Matière</label>
          <input type="text" name="matiere" id="matiere" placeholder="Matière" required>
        </div>
        <div class="input-cont">
          <label for="motif">Motif</label>
          <input type="text" name="motif" id="motif" placeholder="Motif">
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
        <div class="input-cont">
          <label for="email">Adresse Email</label>
          <input type="email" name="email" id="email" placeholder="Email" required>
        </div>
        <button class="btn-submit" type="submit">Créer mon compte</button>
      </form>
    </div>

  </main>

  <!-- JavaScript pour la prévisualisation de l'image -->
  <script>
    const photoInput = document.getElementById('photo');
    const imagePreview = document.getElementById('imagePreview');

    photoInput.addEventListener('change', function() {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
          imagePreview.setAttribute('src', event.target.result);
          imagePreview.style.display = 'block';
        }
        reader.readAsDataURL(file);
      }
    });
  </script>
</body>

</html>
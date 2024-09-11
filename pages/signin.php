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
  $page = "login";
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
      </form>
    </div>

  </main>
</body>

</html>
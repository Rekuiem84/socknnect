<!-- Page login -->
<?php
require "../assets/classes/Db.php";
require "../assets/classes/Form.php";
require "../assets/classes/Login.php";

session_start();

$form = new Form;
$login = new Login;
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
    if ($form->isValidLoginForm($params)) {
      $email = $_POST["email"];
      $mdp = $_POST["password"];
      if ($login->checkAccess($email, $mdp)) {
        $userData = $form->getUserData($email)[0];
        // ajouter un array avec toutes les infos du man avec une fonction de membre
        $_SESSION["is_connected"] = true;
        $_SESSION["id"] = $userData["id"];
        $_SESSION["nom"] = $userData["nom"];
        $_SESSION["email"] = $userData["email"];
        $_SESSION["couleur"] = $userData["couleur"];
        $_SESSION["taille"] = $userData["taille"];
        $_SESSION["matiere"] = $userData["matiere"];
        $_SESSION["motif"] = $userData["motif"];
        $_SESSION["photo"] = $userData["photo"];
        $login->connect();
      } else {
        $message = "Email ou mot de passe incorrect";
      }
    } else {
      $errors = $form->getErrors();
    }
  }
  ?>

  <?php
  $page = "login";
  include "../include/header.php" ?>
  <main>
    <?php if (isset($_GET["success"])): ?>
      <p>Votre compte a bien été créé, vous pouvez maintenant vous connecter</p>
    <?php endif; ?>

    <div class="bg-accent-1 window form-cont">
      <h1>Connexion</h1>
      <form method="post">
        <div class="input-cont">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" placeholder="email" required>
        </div>
        <div class="input-cont">
          <label for="password">Mot de passe</label>
          <input type="password" name="password" id="password" placeholder="mot de passe" required>
        </div>
        <button class="btn-submit type=" submit">Sock in !</button>
      </form>
    </div>

  </main>
</body>

</html>
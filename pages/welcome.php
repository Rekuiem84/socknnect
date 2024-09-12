<!-- Page login -->
<?php
require "../assets/classes/Db.php";
require "../assets/classes/Form.php";
require "../assets/classes/User.php";

session_start();

if ($_SESSION["is_connected"]) :

  if (isset($_POST["deconnexion"])) {
    session_destroy();
    include "./redirect-index.php";
  }

  $nom = $_SESSION["nom"];
  $email = $_SESSION["email"];
  $id = $_SESSION["id"];
  $couleur = $_SESSION["couleur"];
  $taille = $_SESSION["taille"];
  $matiere = $_SESSION["matiere"];
  $motif = $_SESSION["motif"];
  $photo = $_SESSION["photo"];
  $password = "";

  $form = new Form;
  $user = new User($nom, $email, $password, $couleur, $taille, $matiere, $motif, $photo);
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
    <title>Match</title>
    <meta name='description' content=''>
    <link rel='stylesheet' href='../assets/style/style.css' />
    <link rel='shortcut icon' type='image/png' href='' />
    <script src='' defer></script>
  </head>

  <body>
    <?php
    $page = "welcome";
    include "../include/header.php";

    // toutes les paires qui n'ont pas été liké par l'utilisateur
    $unlikedMatches = $user->getUnlikedUsers($id);
    foreach ($unlikedMatches as $value) {
      // tous les utilisateurs qui n'ont pas été liké
      $unlikedMatchesId[] = $value["id"];
      $unlikedUsers[] = $value["user1"];
    }

    foreach ($unlikedUsers as $value) {
      var_dump($value);
      var_dump($user->getUser($value));
      echo "<br>";
      echo "<br>";
    }




    ?>
    <main>
      <form method="post" class="deconnexion">
        <input type="hidden" name="deconnexion" value="true">
        <button id="btn-logout">Se déconnecter</button>
      </form>
      <a href="../pages/profil.php">
        <button>Votre Profil</button>
      </a>
      <div class="profile-cont window">
        <div class="img-cont"><img src="../user_photos/sock-3.webp" alt=""></div>
        <div class="infos-cont">
          <p class="infos__name"><?= $_SESSION["nom"] ?></p>
          <div class="infos-tags">
            <span class="tag--couleur"><?= $_SESSION["couleur"] ?></span>
            <span class="tag--taille"><?= $_SESSION["taille"] ?></span>
            <span class="tag--matiere"><?= $_SESSION["matiere"] ?></span>
            <span class="tag--motif"><?= $_SESSION["motif"] ?></span>
          </div>
        </div>
        <div class="actions-cont">
          <form method="post">
            <input type="hidden" name="action" value="skip">
            <button type="submit" class="btn--skip">X</button>
          </form>
          <form method="post">
            <input type="hidden" name="action" value="like">
            <button type="submit" class="btn--like">O</button>
          </form>
        </div>
      </div>
    </main>
  </body>

  </html>
<?php
else :
  header("Location: ./redirect-index.php");

endif;
?>
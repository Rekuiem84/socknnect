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

    $unseenMatches = $user->getUnseenMatches($id);

    foreach ($unseenMatches as $match) {
      $other_user_id = $match["other_user"];
      $other_users[] = $user->getUser($other_user_id);
    }
    // var_dump($other_users[0][0]["photo"]);
    if (!empty($other_users)) {

      if ($form->isSubmitted()) {
        if (isset($_POST["action"])) {
          $action = $_POST["action"];
          if ($action == "like") {
            $user->likeUser($id, $other_users[0][0]["id"]);
          } else {
            $user->skipUser($id, $other_users[0][0]["id"]);
          }
          array_shift($other_users);
        }
      }
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
      <?php
      if (!empty($other_users)) :
      ?>
        <div class="profile-cont window">
          <div class="img-cont"><img src="../user_photos/<?= $other_users[0][0]["photo"] ?>" alt=""></div>
          <div class="infos-cont">
            <p class="infos__name"><?= $other_users[0][0]["nom"] ?></p>
            <div class="infos-tags">
              <span class="tag--couleur"><?= $other_users[0][0]["couleur"] ?></span>
              <span class="tag--taille"><?= $other_users[0][0]["taille"] ?></span>
              <span class="tag--matiere"><?= $other_users[0][0]["matiere"] ?></span>
              <span class="tag--motif"><?= $other_users[0][0]["motif"] ?></span>
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
      <?php
      else :
      ?>
        <div class="profile-cont window profile-empty">
          <p>Il n'y a plus de profils à voir, gros charo</p>
        </div>
      <?php
      endif;
      ?>
    </main>
  </body>

  </html>
<?php
else :
  header("Location: ./redirect-index.php");

endif;
?>
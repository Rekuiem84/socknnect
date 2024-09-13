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
    $page = "matches";
    include "../include/header.php";

    $likedUsers = $user->getLikedUsers($id);
    ?>
    <table class="matches">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Email</th>
          <th>Couleur</th>
          <th>Taille</th>
          <th>Matière</th>
          <th>Motif</th>
          <th>Photo</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($likedUsers as $likes) {
          $likedBy = $user->getMatchedUsers($id);
        }
        $matchesId = $user->getMatchesId($likedUsers, $likedBy);
        foreach ($matchesId as $matchId):
          $matchesInfo = $user->getMatchedInfo($matchId);
        ?>
          <tr>
            <td><?= $matchesInfo[0]["nom"] ?></td>
            <td><?= $matchesInfo[0]["email"] ?></td>
            <td><?= $matchesInfo[0]["couleur"] ?></td>
            <td><?= $matchesInfo[0]["taille"] ?></td>
            <td><?= $matchesInfo[0]["matiere"] ?></td>
            <td><?= $matchesInfo[0]["motif"] ?></td>
            <td><img src="../user_photos/<?= $matchesInfo[0]["photo"] ?>" alt="photo de l'utilisateur"></td>
          </tr>
        <?php endforeach; ?>
    </table>
  </body>

  </html>
<?php
else :
  header("Location: ./redirect-index.php");

endif;
?>
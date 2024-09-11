<?php
require "../assets/classes/Db.php";
require "../assets/classes/Form.php";
require "../assets/classes/Login.php";

session_start();

if ($_SESSION["is_connected"]) :

  if (isset($_POST["deconnexion"])) {
    session_destroy();
    header("Location: index.php");
  }
  if (!$_SESSION["is_admin"]) {
    header("Location: dashboard_Representations.php");
  }

  $form = new Form;
  $params = [];
  $errors = [];
?>

  <!DOCTYPE html>
  <html lang='fr'>

  <head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Socknnect</title>
    <meta name='description' content=''>
    <link rel='stylesheet' href='./assets/style/style.css' />
    <link rel='shortcut icon' type='image/png' href='' />
    <script src='' defer></script>
  </head>

  <body>
    <?php
    $page = "accueil";
    include "./include/header.php"
    ?>
    <?php
    include "./include/home-card.php"
    ?>
    <?php
    include "./include/footer.php"
    ?>
  </body>

  </html>
<?php
else :
  header("Location: index.php");
endif;
?>
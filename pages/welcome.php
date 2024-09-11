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

if ($_SESSION["is_connected"]) :

  if (isset($_POST["deconnexion"])) {
    session_destroy();
    header("Location: ./redirect-index.php");
  }
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
    include "../include/header.php" ?>
    <main>
      <p>welcome</p>
      <?php
      var_dump($_SESSION);
      ?>
    </main>
  </body>

  </html>
<?php
else :
  header("Location: ./redirect-index.php");

endif;
?>
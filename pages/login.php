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
      <h1>Connexion</h1>
      <form method="post">
        <div class="input-cont">
          <label for="email">Adresse email</label>
          <input type="email" name="email" id="email" required>
        </div>
        <div class="input-cont">
          <label for="password">Mot de passe</label>
          <input type="password" name="password" id="password" required>
        </div>
        <button type="submit">Sock in !</button>
      </form>
    </div>

  </main>
</body>

</html>
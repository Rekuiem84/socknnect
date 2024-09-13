<?php

class User
{
  private $id;
  private $nom;
  private $email;
  private $password;
  private $couleur;
  private $taille;
  private $matiere;
  private $motif;
  private $photo;


  public function getId()
  {
    return $this->id;
  }
  public function getNom()
  {
    return $this->nom;
  }
  public function getEmail()
  {
    return $this->email;
  }
  public function getPassword()
  {
    return $this->password;
  }
  public function getCouleur()
  {
    return $this->couleur;
  }
  public function getTaille()
  {
    return $this->taille;
  }
  public function getMatiere()
  {
    return $this->matiere;
  }
  public function getMotif()
  {
    return $this->motif;
  }
  public function getPhoto()
  {
    return $this->photo;
  }

  public function setNom($nom)
  {
    $this->nom = $nom;
  }
  public function setEmail($email)
  {
    $this->email = $email;
  }
  public function setPassword($password)
  {
    $this->password = $password;
  }
  public function setCouleur($couleur)
  {
    $this->couleur = $couleur;
  }
  public function setTaille($taille)
  {
    $this->taille = $taille;
  }
  public function setMatiere($matiere)
  {
    $this->matiere = $matiere;
  }
  public function setMotif($motif)
  {
    $this->motif = $motif;
  }
  public function setPhoto($photo)
  {
    $this->photo = $photo;
  }

  public function __construct($nom, $email, $password, $couleur, $taille, $matiere, $motif, $photo)
  {
    $this->nom = $nom;
    $this->email = $email;
    $this->password = sha1($password);
    $this->couleur = $couleur;
    $this->taille = $taille;
    $this->matiere = $matiere;
    $this->motif = $motif;
    $this->photo = $photo;
  }
  public function insertUser($nom, $email, $password, $couleur, $taille, $matiere, $motif, $photo)
  {
    $co = new Db;
    $db = $co->dbCo("socknnect", "root", "root");

    // Vérifie si l'email existe déjà
    $sqlCheck = "SELECT * FROM `user` WHERE email = ?";
    $paramCheck = [$email];
    $resultCheck = $co->SQLWithParam($sqlCheck, $paramCheck, $db);

    // Si l'utilisateur existe déjà, renvoie un message d'erreur
    if (!empty($resultCheck)) {
      return ["status" => "error", "message" => "Cet email est déjà utilisé."];
    }

    $sql = "INSERT INTO `user` (`nom`,`email`,`password`,`couleur`,`taille`,`matiere`,`motif`,`photo`) VALUES (?,?,?,?,?,?,?,?)";
    $param = [$nom, $email, sha1($password), $couleur, $taille, $matiere, $motif, $photo];
    // si la requête est exécutée, on enregistre la photo dans le dossier
    if ($co->SQLWithParam($sql, $param, $db)) {
      $this->savePhotoFile($photo);
    };
  }
  public function savePhotoFile($photo) {}

  public function getUser($id)
  {
    $co = new Db();
    $db = $co->dbCo("socknnect", "root", "root");

    /* Utilisation de la fonction SQLWithParam */
    $sql = "SELECT * FROM `user` where id=?";
    $param = [$id];
    $datas = $co->SQLWithParam($sql, $param, $db);

    if (!empty($datas)) {
      $user = $datas[0];

      $this->nom = $user["nom"];
      $this->email = $user["email"];
    }
    return $datas;
  }

  public function setUser($nom, $couleur, $taille, $matiere, $motif, $email, $id)
  {
    $_SESSION["nom"] = $nom;
    $_SESSION["couleur"] = $couleur;
    $_SESSION["taille"] = $taille;
    $_SESSION["matiere"] = $matiere;
    $_SESSION["motif"] = $motif;
    $_SESSION["email"] = $email;

    $co = new Db();
    $db = $co->dbCo("socknnect", "root", "root");

    $sql = "UPDATE `user` SET `nom`=?, `couleur`=?, `taille`=?, `matiere`=?, `motif`=?, `email`=? WHERE id=?";
    $param = [$nom, $couleur, $taille, $matiere, $motif, $email, $id];
    $datas = $co->SQLWithParam($sql, $param, $db);
  }
  // change le nom de la photo de l'utilisateur pour correspondre au nom de la photo téléchargée
  public function updateUserPhoto($id, $photo)
  {
    $co = new Db();
    $db = $co->dbCo("socknnect", "root", "root");
    $sql = "UPDATE `user` SET `photo` = ? WHERE `id` = ?";
    $params = [$photo, $id];
    $co->SQLWithParam($sql, $params, $db);
  }
  // selectionne les match qui n'ont pas été vus
  public function getUnseenMatches($id)
  {
    $co = new Db();
    $db = $co->dbCo("socknnect", "root", "root");

    $sql = "SELECT * FROM `matches` WHERE (user = ? and like_status is NULL)";
    $params = [$id];
    $datas = $co->SQLWithParam($sql, $params, $db);
    return $datas;
  }
  // get l'id du dernier user créé
  public function getLastId()
  {
    $co = new Db();
    $db = $co->dbCo("socknnect", "root", "root");

    $sql = "SELECT MAX(id) FROM `user`";
    $datas = $co->SQLWithoutParam($sql, $db);
    var_dump($datas[0]["MAX(id)"]);
    return $datas[0]["MAX(id)"];
  }
  // récupère tous les id sauf le dernier
  public function getAllIdExceptLast()
  {
    $co = new Db();
    $db = $co->dbCo("socknnect", "root", "root");

    $sql = "SELECT id FROM `user` WHERE id!=(SELECT MAX(id) FROM `user`)";
    $datas = $co->SQLWithoutParam($sql, $db);
    return $datas;
  }
  // crée une paire de matching
  public function createPair($currentUser, $otherUser)
  {
    $co = new Db();
    $db = $co->dbCo("socknnect", "root", "root");

    // associe le nouvel user à un autre user
    $sql = "INSERT INTO `matches` (`user`,`other_user`) VALUES (?,?)";
    $params = [$currentUser, $otherUser];
    $co->SQLWithParam($sql, $params, $db);

    // associe un autre user au nouvel user
    $sql = "INSERT INTO `matches` (`user`,`other_user`) VALUES (?,?)";
    $params = [$otherUser, $currentUser];
    $co->SQLWithParam($sql, $params, $db);
  }
  /**
   * Vérifie si un utilisateur avec l'email donné existe déjà.
   * Retourne true si l'email existe, sinon false.
   */
  public function emailExists($email)
  {
    $co = new Db();
    $db = $co->dbCo("socknnect", "root", "root");

    $sql = "SELECT COUNT(*) as count FROM `user` WHERE email = ?";
    $param = [$email];
    $datas = $co->SQLWithParam($sql, $param, $db);

    return $datas[0]['count'] > 0;
  }
  // like un user
  public function likeUser($currentUser, $otherUser)
  {
    $co = new Db();
    $db = $co->dbCo("socknnect", "root", "root");

    $sql = "UPDATE `matches` SET `like_status`=1 WHERE user=? AND `other_user`=?";
    $params = [$currentUser, $otherUser];
    $co->SQLWithParam($sql, $params, $db);
  }
  // skip un user
  public function skipUser($currentUser, $otherUser)
  {
    $co = new Db();
    $db = $co->dbCo("socknnect", "root", "root");

    $sql = "UPDATE `matches` SET `like_status`=0 WHERE user=? AND `other_user`=?";
    $params = [$currentUser, $otherUser];
    $co->SQLWithParam($sql, $params, $db);
  }
  // récupère tous les matchs
  public function getLikedUsers($user)
  {
    $co = new Db();
    $db = $co->dbCo("socknnect", "root", "root");

    $sql = "SELECT * FROM `matches` WHERE user=? AND like_status = 1";
    $params = [$user];
    $datas = $co->SQLWithParam($sql, $params, $db);
    return $datas;
  }
  // récupère toutes les personnes qui ont liké l'utilisateur
  public function getMatchedUsers($user)
  {
    $co = new Db();
    $db = $co->dbCo("socknnect", "root", "root");

    $sql = "SELECT * FROM `matches` WHERE other_user=? AND like_status = 1";
    $params = [$user];
    $datas = $co->SQLWithParam($sql, $params, $db);
    return $datas;
  }
  // récupère tous les matchs
  public function getMatchesId($userLikes, $userLiked)
  {
    $matches = [];
    foreach ($userLikes as $like) {
      foreach ($userLiked as $liked) {
        if ($like['other_user'] === $liked['user']) {
          $matches[] = $like['other_user'];
        }
      }
    }
    return $matches;
  }
  // récupère les infos des matchs
  public function getMatchedInfo($id)
  {
    $co = new Db();
    $db = $co->dbCo("socknnect", "root", "root");

    $sql = "SELECT * FROM `user` WHERE id=?";
    $params = [$id];
    $datas = $co->SQLWithParam($sql, $params, $db);
    return $datas;
  }
}

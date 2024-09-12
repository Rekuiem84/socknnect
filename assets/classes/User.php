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
  // selectionne les users qui n'ont pas été liké par l'utilisateur connecté
  public function getUnlikedUsers($id)
  {
    $co = new Db();
    $db = $co->dbCo("socknnect", "root", "root");

    $sql = "SELECT * FROM `matching` WHERE (user1 = ? and user1_liked = 0) or (user2 = ? and user2_liked = 0);";
    $params = [$id, $id];
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
  public function createPair($user1, $user2)
  {
    $co = new Db();
    $db = $co->dbCo("socknnect", "root", "root");

    //check if pair already exists
    $sql = "SELECT * FROM `matching` WHERE user1=? AND user2=?";
    $params = [$user1, $user2];
    $datas = $co->SQLWithParam($sql, $params, $db);

    if (empty($datas)) {
      $sql = "INSERT INTO `matching` (`user1`,`user2`, `user1_liked`, `user2_liked`) VALUES (?,?, 0, 0)";
      $params = [$user1, $user2];
      $co->SQLWithParam($sql, $params, $db);
    } else {
      return;
    }
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
}

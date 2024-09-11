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
    $this->password = $password;
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
 
    $sql = "INSERT INTO `user` (`nom`,`email`,`password`,`couleur`,`taille`,`matiere`,`motif`,`photo`) VALUES (?,?,?,?,?)";
    $param = [$nom, $email, $password, $couleur, $taille, $matiere, $motif, $photo];
    $co->SQLWithParam($sql, $param, $db);
  }
 
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
}

public function setUser($id, $nom, $email, $password, $couleur, $taille, $matiere, $motif, $photo)
{
    $_SESSION["user_nom"] = $nom;
    $_SESSION["user_email"] = $email;
    $_SESSION["user_password"] = $password;
    $_SESSION["user_couleur"] = $couleur;
    $_SESSION["user_taille"] = $taille;
    $_SESSION["user_matiere"] = $matiere;
    $_SESSION["user_motif"] = $motif;
    $_SESSION["user_photo"] = $photo;
    
    $co = new Db();
    $db = $co->dbCo("socknnect", "root", "root");

    $sql = "UPDATE `user` SET `nom`=?, `email`=?, `password`=?, `couleur`=?, `taille`=?, `matiere`=?, `motif`=?, `photo`=? WHERE id=?";
    $param = [$nom, $email, $password, $couleur, $taille, $matiere, $motif, $photo, $id];
    $datas = $co->SQLWithParam($sql, $param, $db);
}
}

?>
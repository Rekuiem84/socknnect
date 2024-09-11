<?php
class User {
    private $conn;
    private $table = 'user'; // Assurez-vous que cette table existe dans votre base de données

    public $nom;
    public $email;
    public $password;
    public $couleur;
    public $taille;
    public $matiere;
    public $motif;
    public $photo;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createUser($nom, $email, $password, $couleur, $taille, $matiere, $motif, $photo) {

          // Protection contre les injections SQL
        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->couleur = htmlspecialchars(strip_tags($this->couleur));
        $this->taille = htmlspecialchars(strip_tags($this->taille));    
        $this->matiere = htmlspecialchars(strip_tags($this->matiere));
        $this->motif = htmlspecialchars(strip_tags($this->motif));
        $this->photo = htmlspecialchars(strip_tags($this->photo));
        $this->email = htmlspecialchars(strip_tags($this->email));
        
        $db = new Db;
        $co = $db->dbCo("socknnect", "root", "root");

        $sql = 'INSERT INTO ' . $this->table . ' (nom, password, couleur, taille, matiere, motif, photo, email ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        $param = [$nom, sha1($password), $couleur, $taille, $matiere, $motif, $photo, $email];
        $result = $db->SQLWithParam($sql, $param, $co);
        return $result;

    }
}
?>
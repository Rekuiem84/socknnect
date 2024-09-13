<?php

class Form
{
    // Cette fonction vérifie si le formulaire a été soumis 
    public function isSubmitted(): bool
    {
        return !empty($_POST);
    }

    // Cette fonction vérifie tous les champs du formulaire de login sont remplis
    public function isValidLoginForm(): bool
    {
        return (!empty($_POST["email"]) && !empty($_POST["password"]));
    }

    // Cette fonction renvoie un array avec les erreurs de validation du formulaire
    public function getErrors(): array
    {
        $errors = [
            "email" => empty($_POST["email"]) ? "Merci de renseigner votre email" : "",
            "mdp" => empty($_POST["password"]) ? "Merci de renseigner votre mot de passe" : ""
        ];
        return $errors;
    }

    // Cette fonction vérifie si les champs spécifiés dans le paramètre $params sont valides (non vides)
    // $params est un array associatif
    public function isValidAnyForm($params): bool
    {
        foreach ($params as $param) {
            if (empty($param)) {
                return false;
            }
        }
        return true;
    }

    // Cette fonction renvoie un array avec les erreurs de validation du formulaire de création de spectacle
    public function getErrorsSpec(): array
    {
        $errors = [
            "nom" => empty($_POST["nom"]) ? "Merci de renseigner le nom" : "",
            "couleur" => empty($_POST["couleur"]) ? "Merci de renseigner la couleur" : "",
            "taille" => empty($_POST["taille"]) ? "Merci de renseigner la taille" : "",
            "matiere" => empty($_POST["matiere"]) ? "Merci de renseigner la matière" : "",
            "motif" => empty($_POST["motif"]) ? "Merci de renseigner le motif" : "",
            "photo" => empty($_POST["photo"]) ? "Merci de télécharger une photo" : "",
            "email" => empty($_POST["email"]) ? "Merci de renseigner l'email" : "",
        ];
        return $errors;
    }

    public function isValidUser()
    {
        return (!empty($_POST["nom"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["couleur"]) && !empty($_POST["taille"]) && !empty($_POST["matiere"]) && !empty($_POST["motif"]) && !empty($_FILES["photo"]));
    }

    public function getErrorsUser()
    {
        $errors = [
            "nom" => empty($_POST["nom"]) ? "Merci de renseigner le nom" : "",
            "email" => empty($_POST["email"]) ? "Merci de renseigner l'email" : "",
            "password" => empty($_POST["password"]) ? "Merci de renseigner le mot de passe" : "",
            "couleur" => empty($_POST["couleur"]) ? "Merci de renseigner la couleur" : "",
            "taille" => empty($_POST["taille"]) ? "Merci de renseigner la taille" : "",
            "matiere" => empty($_POST["matiere"]) ? "Merci de renseigner la matière" : "",
            "motif" => empty($_POST["motif"]) ? "Merci de renseigner le motif" : "",
        ];
        return $errors;
    }
    public function getUserData($email)
    {
        $db = new Db;
        $co = $db->dbCo("socknnect", "root", "root");

        $sql = "SELECT * FROM `user` WHERE email = ?";
        $param = [$email];
        $result = $db->SQLWithParam($sql, $param, $co);
        return $result;
    }
}

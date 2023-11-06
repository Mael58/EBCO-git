<?php

class ProduitsBDD
{
    private $db;
    private $username;
    private $mdp;
    public function __construct()
    {
        try {
            $this->db = new PDO(
                'mysql:host=localhost;dbname=ebcon_crm;',
                'root',
                ''
            );
        } catch (Exception $e) {
            die('erreur: ' . $e);
        }
    }

    public function getVente($categorie)
    {
        $sqlQuery = "SELECT * FROM vente WHERE categorie='$categorie';";
        $donnees = $this->db->prepare($sqlQuery);

        $donnees->execute();
        return $donnees->fetchAll();
    }

    public function getProduit()
    {
        $sqlQuery = "SELECT * FROM vente order by id desc limit 4;";
        $donnees = $this->db->prepare($sqlQuery);

        $donnees->execute();
        return $donnees->fetchAll();
    }

    public function inscription($username, $pass)
    {
        if (empty($username) || empty($pass)) {
            echo "veuillez remplir les champs";
        } else {
            $sqlQuery = "SELECT * FROM `acces` WHERE nom = :username";
            $checkUser = $this->db->prepare($sqlQuery);
            $checkUser->bindParam(':username', $username);
            $checkUser->execute();

            if ($checkUser->rowCount() > 0) {
                echo 'L\'utilisateur existe déjà.';
            } else {

                $hashedPassword = hash('sha256', $pass);
                $sqlQuery = "INSERT into `acces` (nom, pswd)
    VALUES (:username, :password )";
                $donnees = $this->db->prepare($sqlQuery);
                $donnees->bindParam(':username', $username);
                $donnees->bindParam(':password', $hashedPassword);
                try {
                    $donnees->execute();
                    echo 'Inscription réussie';
                } catch (PDOException $e) {
                    echo 'Erreur lors de l\'inscription : ' . $e->getMessage();
                }
            }
        }
    }

    public function connexion($username, $pass)
    {
        $this->username = $username;


        $hashedPassword = hash('sha256', $pass);
        $this->mdp = $hashedPassword;
        $sqlQuery = "select * from `acces` where nom=:user and pswd=:pass ";
        $checkUser = $this->db->prepare($sqlQuery);
        $checkUser->bindParam(":user", $this->username);
        $checkUser->bindParam(":pass", $hashedPassword);
        $checkUser->execute();
        if ($checkUser->rowCount() == 1) {





            if (isset($_COOKIE['panier-' . $username])) {
                // Désérialiser le panier depuis le cookie
                $panierPrecedent = unserialize($_COOKIE['panier-' . $username]);

                // Stocker le panier dans la session de l'utilisateur
                $_SESSION['panier'][$username] = $panierPrecedent;
            }



            // Stockez les informations de session spécifiques à l'utilisateur, par exemple l'ID de l'utilisateur
            $_SESSION['username'] = $username;
            echo var_dump($_SESSION['username']);



            header("Location: index.php?nom=$username&mdp=$hashedPassword");
            exit;
        } else {
            echo "Le nom d'utilisateur ou le mot de passe est incorrect.";
        }
        ob_end_flush();
    }


    public function mdpOublie($username, $pass)
    {
        if (empty($username) || empty($pass)) {
            echo "Nom d'utilisateur et/ou mot de passe non valides.";
            return;
        }
        try {
            $hashedPassword = hash('sha256', $pass);

            $sqlQuery = "update `acces` set pswd=:newPassword where nom=:user";

            $checkUser = $this->db->prepare($sqlQuery);
            $checkUser->bindParam(':newPassword', $hashedPassword);
            $checkUser->bindParam(':user', $username);
            if ($checkUser->execute()) {
                echo "Mot de passe mis à jour avec succès.";
            } else {
                echo "Erreur lors de la mise à jour du mot de passe.";
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour du mot de passe : " . $e->getMessage();
        }
    }
}

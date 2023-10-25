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

    public function connexion($username, $pass)
    {
       $this->username=$username;
       
       
        $hashedPassword = hash('sha256', $pass);
        $this->mdp=$hashedPassword;
        $sqlQuery = "select * from `acces` where nom='$this->username' and pswd='$hashedPassword'";
        $checkUser = $this->db->prepare($sqlQuery);
        $checkUser->execute();
        if ($checkUser->rowCount() == 1) {  
                          
           
          
    
            header("Location: index.php?nom=$username&mdp=$hashedPassword");
            exit;
           
          
        } else {
            echo "Le nom d'utilisateur ou le mot de passe est incorrect.";
        }
        ob_end_flush();
    }
   

    public function mdpOublie($username, $pass)
    {
        if(empty($username) || empty($pass)){
            echo "Nom d'utilisateur et/ou mot de passe non valides.";
            return;
        }
       try{
        $hashedPassword = hash('sha256', $pass);
       
        $sqlQuery = "update `acces` set pswd=':newPassword' where nom=':user'";

        $checkUser = $this->db->prepare($sqlQuery);
        $checkUser->bindParam(':newPassword', $hashedPassword);
        $checkUser->bindParam(':user', $username);
        if ($checkUser->execute()) {
            echo "Mot de passe mis à jour avec succès.";
        } else {
            echo "Erreur lors de la mise à jour du mot de passe.";
        }
       }
 catch (PDOException $e) {
        echo "Erreur lors de la mise à jour du mot de passe : " . $e->getMessage();
    }
      
    }

    


}

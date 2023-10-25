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

    public function connexion($username, $pass, $remember=false)
    {
       $this->username=$username;
       
       
        $hashedPassword = hash('sha256', $pass);
        $this->mdp=$hashedPassword;
        $sqlQuery = "select * from `acces` where nom='$this->username' and pswd='$hashedPassword'";
        $checkUser = $this->db->prepare($sqlQuery);
        $checkUser->execute();
        if ($checkUser->rowCount() == 1) {
        //   $this->rememberMe($remember);
            header("Location: index.php?nom=$username&mdp=$hashedPassword");
            exit;
           
          
        } else {
            echo "Le nom d'utilisateur ou le mot de passe est incorrect.";
        }
        ob_end_flush();
    }
    // public function rememberMe($rememberMe=false){
    //     if ($rememberMe) {
    //         $cookieExpire = time() + 60 * 60 * 24 * 30; // Par exemple, 30 jours
    //         setcookie('remember_me_username', $this->username, $cookieExpire);
    //         setcookie('remember_me_password', $this->mdp, $cookieExpire);
    //     }
       
        
    // }

    public function mdpOublie($username, $pass)
    {
       
        $hashedPassword = hash('sha256', $pass);
       
        $sqlQuery = "update `acces` set pswd='$hashedPassword' where nom='$username'";

        $checkUser = $this->db->prepare($sqlQuery);
        $checkUser->execute();
      
    }

    


}

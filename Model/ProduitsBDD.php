<?php
require_once 'DB.php';
class ProduitsBDD
{
    private $db;
    private $username;
    private $db_host = DB_HOST;
    private $db_name = DB_NAME;
    private $db_user = DB_USERNAME;
    private $db_pass = DB_PASSWORD;

    private $mdp;
    public function __construct()

    {
        try {
            $this->db = new PDO(
                'mysql:host=' . $this->db_host . ';dbname=' . $this->db_name . ';',
                $this->db_user,
                $this->db_pass
            );
        } catch (Exception $e) {
            die('erreur: ' . $e);
        }
    }

    public function close(){
        $this->db=null;
    }

    public function getVente($categorie)
    {


        $sqlQuery = "SELECT * FROM vente WHERE categorie='$categorie' ORDER BY 'nom';";
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
                $sqlQuery = "INSERT into `acces` (nom, pswd, role)
    VALUES (:username, :password, 'commercial')";
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
        // $this->connexion($username, $pass);
    }

    public function connexion($username, $pass)
    {
        $this->username = $username;


        $hashedPassword = hash('sha256', $pass);
        $this->mdp = $hashedPassword;
        $sqlQuery = "select * from `acces` where nom=:user and pswd=:pass";
        $checkUser = $this->db->prepare($sqlQuery);
        $checkUser->bindParam(":user", $this->username);
        $checkUser->bindParam(":pass", $hashedPassword);
        $checkUser->execute();



        // Envoyer une réponse JSON pour indiquer que la connexion a réussi




        $_SESSION['username'] = $username;




        if (isset($_COOKIE['panier-' . $username])) {
            // Désérialiser le panier depuis le cookie
            if (!isset($_SESSION['panier'])) {
                $_SESSION['panier'] = array();
            }
            $panierPrecedent = json_decode($_COOKIE['panier-' . $username], true);

            // Ajouter chaque produit du panier à $_SESSION['panier']
            foreach ($panierPrecedent as $produit) {
                $_SESSION['panier'][] = $produit;
            }
        }










        if (isset($_COOKIE['adresse-' . $username])) {
            $user_data = json_decode($_COOKIE['adresse-' . $username], true);


            $_SESSION['adresse'] = $user_data;
        }

        if (isset($_COOKIE['adresseFacturation-' . $username])) {
            $user_data = json_decode($_COOKIE['adresseFacturation-' . $username], true);


            $_SESSION['adresseFacturation'] = $user_data;
        }

        if (isset($_COOKIE['nbArticle-' . $username])) {
            $user_data = json_decode($_COOKIE['nbArticle-' . $username], true);


            $_SESSION['nombreTotalArticles'] = $user_data;
          
        }
        setcookie('panier-' . $username, '', time() - 3600, '/', '', true, true);
        setcookie('adresse-' . $username, '', time() - 3600, '/', '', true, true);
        setcookie('adresseFacturation-' . $username, '', time() - 3600, '/', '', true, true);
        setcookie('nbArticle-' . $username, '', time() - 3600, '/', '', true, true);
     
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

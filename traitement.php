<?php
ob_start();
session_start();
include 'modele/ProduitsBDD.php';



if (isset($_GET['username2']) && isset($_GET['password2'])) {
    $username2 = $_GET['username2'];
    $password2 = $_GET['password2'];


    $bdd = new ProduitsBDD;
    $verif = $bdd->connexion($username2, $password2);

    echo json_encode(['success' => true, 'isLoggedIn' => true, 'username' => $username2]);
}

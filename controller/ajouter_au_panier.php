<?php
session_start();

// Si l'utilisateur est déconnecté
if (!isset($_SESSION['username']) || !is_array($_SESSION['username'])) {

    if (!isset($_SESSION['panier']) || !is_array($_SESSION['panier'])) {
        $_SESSION['panier'] = array();
    }

    // Ajouter le produit au panier global
    $produit = array(
        'nom' => $_GET['nom'],
        'prix' => $_GET['prix'],
        'image' => $_GET['image'],
        'quantite' => $_GET['quantite'],
    );

    array_push($_SESSION['panier'], $produit);
    //header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {

    if (isset($_SESSION['panier']) && is_array($_SESSION['panier']) && count($_SESSION['panier']) > 0) {

        foreach ($_SESSION['panier'] as $produit) {


            $_SESSION['panier'][] = $produit;
        }

        
     



        $_SESSION['panier'] = array();
    }
}





// Calculer et stocker le nombre total d'articles dans le panier global
$nombreTotalArticles = 0;
foreach ($_SESSION['panier'] as $produit) {
    
    $quantiteMax= $_SESSION['quantiteMax'];
    if($produit['quantite'] > $quantiteMax){
        $produit['quantite'] = $quantiteMax;
    }
    $nombreTotalArticles += $produit['quantite'];
}
$_SESSION['nombreTotalArticles'] = $nombreTotalArticles;

// Afficher le nombre total d'articles dans le panier global
echo $nombreTotalArticles;
header("Location:". $_SERVER['HTTP_REFERER']); 
exit(); 

<?php
session_start();



// Vérifier si les données nécessaires sont présentes dans la requête POST
if (!isset($_POST['nom'], $_POST['prix'], $_POST['image'], $_POST['quantite'])) {
    echo 'Erreur : Paramètres manquants.';
    exit();
}


// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username']) || !is_array($_SESSION['username'])) {

    // Initialiser le panier s'il n'existe pas encore
    if (!isset($_SESSION['panier']) || !is_array($_SESSION['panier'])) {
        $_SESSION['panier'] = array();
    }



    // Ajouter le produit au panier global
    $produit = array(
        'nom' => $_POST['nom'],
        'prix' => $_POST['prix'],
        'image' => $_POST['image'],
        'quantite' => $_POST['quantite'],
    );

    // Vérifier si le produit est déjà dans le panier
    $produitExiste = false;
    foreach ($_SESSION['panier'] as &$p) {
        if (is_array($p) && isset($p['nom']) && $p['nom'] === $produit['nom']) {
            // Le produit existe déjà dans le panier, mettez à jour la quantité
            $produitExiste = true;
            $p['quantite'] += $produit['quantite'];

            $p['sousTotal'] = $p['quantite'] * $p['prix'];

            // Appliquer des réductions en fonction de la quantité
            if ($p['quantite'] >= 10 && $p['quantite'] < 50) {
                $p['sousTotal'] *= 0.97;
            } elseif ($p['quantite'] >= 50 && $p['quantite'] < 100) {
                $p['sousTotal'] *= 0.931;
            } elseif ($p['quantite'] >= 100) {
                $p['sousTotal'] *= 0.866;
            }
            

            

            break;
        }
    }


    // Si le produit n'existe pas, ajoutez-le au panier
    if (!$produitExiste) {
        $produit['sousTotal'] = $produit['quantite'] * $produit['prix'];

        if ($produit['quantite'] >= 10 && $produit['quantite'] < 50) {
            $produit['sousTotal'] *= 0.97;
        } elseif ($produit['quantite'] >= 50 && $produit['quantite'] < 100) {
            $produit['sousTotal'] *= 0.93;
        } elseif ($produit['quantite'] >= 100) {
            $produit['sousTotal'] *= 0.86;
        }

        $_SESSION['panier'][] = $produit;
    }

    // Calculer et stocker le nombre total d'articles dans le panier global
    $nombreTotalArticles = array_sum(array_column($_SESSION['panier'], 'quantite'));
    $_SESSION['nombreTotalArticles'] = $nombreTotalArticles;

   

    // Afficher le nombre total d'articles dans le panier global
    // À la fin de votre script PHP
    echo json_encode(['nombreTotalArticles' => $nombreTotalArticles, 'produits' => array_values($_SESSION['panier'])]);
}

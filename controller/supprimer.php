<?php
session_start();

if (isset($_GET['nom']) && isset($_SESSION['panier'][$_SESSION['username']])) {
    $nomProduit = $_GET['nom'];
    foreach ($_SESSION['panier'][$_SESSION['username']] as $key => $produit) {
        if ($produit['nom'] == $nomProduit) {
            unset($_SESSION['panier'][$_SESSION['username']][$key]);
        }
    }
}

header('Location: ../cart.php');

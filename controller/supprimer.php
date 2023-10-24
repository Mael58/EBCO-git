<?php
session_start();

if (isset($_GET['nom']) && isset($_SESSION['panier'])) {
    $nomProduit = $_GET['nom'];
    foreach ($_SESSION['panier'] as $key => $produit) {
        if ($produit['nom'] == $nomProduit) {
            unset($_SESSION['panier'][$key]);
        }
    }
}

header('Location: ../cart.php');

<?php
session_start();

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}

$produit = array(
    'nom' => $_GET['nom'],
    'prix' => $_GET['prix'],
    'image' => $_GET['image'],
    'quantite' => $_GET['quantite'],


);
echo "<script>updateCartCount()</script>";


array_push($_SESSION['panier'], $produit);


//header('Location: ../details.php?nom=' . urlencode($_GET['nom']));
header('Location: ' . $_SERVER['HTTP_REFERER']);
<?php
session_start();
$username = $_SESSION['username'];
if (!isset($_SESSION['panier'][$username])) {
    $_SESSION['panier'][$username] = array();
}

$produit = array(
    'nom' => $_GET['nom'],
    'prix' => $_GET['prix'],
    'image' => $_GET['image'],
    'quantite' => $_GET['quantite'],


);
echo "<script>updateCartCount()</script>";


array_push($_SESSION['panier'][$username], $produit);






//header('Location: ../details.php?nom=' . urlencode($_GET['nom']));
header('Location: ' . $_SERVER['HTTP_REFERER']);

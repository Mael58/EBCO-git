<?php
session_start();

$cartData = array(
    'montantUnitaire' => isset($_POST['prix']) ? $_POST['prix'] : 0,
    'quantite' => isset($_POST['quantite']) ? $_POST['quantite'] : 0,
    'nomProduit' => isset($_POST['nomProduit']) ? $_POST['nomProduit'] : ''
);


echo json_encode(['cartData' => $cartData]);
?>
